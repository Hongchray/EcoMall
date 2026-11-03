<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\OrderDetail;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\BusinessSetting;
use App\Models\Shop;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Log;
use \App\Utility\NotificationUtility;
use App\Models\CombinedOrder;
use App\Http\Controllers\AffiliateController;

class OrderController extends Controller
{
    /**
     * Create an order.
     *
     * - Normal checkout (default): orders everything in the user's cart,
     *   then clears the cart. Unchanged behaviour.
     * - Buy Now (`buy_now=1`): orders ONLY the given product. The cart is
     *   never read, changed or cleared.
     *
     * Buy Now request fields:
     *   buy_now=1, product_id, quantity, variant (nullable),
     *   payment_type, delivery_address, phone, province (+ optional
     *   country, city, postal_code)
     */
    public function store(Request $request, $set_paid = false)
    {
        $buyNow = $request->boolean('buy_now');
        $user = User::find(auth()->id());
        $cartItems = collect();
        $lines = [];

        if ($buyNow) {
            $line = $this->buildBuyNowLine($request);
            if ($line instanceof \Illuminate\Http\JsonResponse) {
                return $line;
            }
            $lines[] = $line;

            if (get_setting('minimum_order_amount_check') == 1) {
                $amount = cart_product_price($line['data'], $line['product'], false, false) * (int) $request->quantity;
                if ($amount < get_setting('minimum_order_amount')) {
                    return $this->failed(translate('You order amount is less then the minimum order amount'));
                }
            }
        } else {
            $cartItems = Cart::where('user_id', auth()->id())->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'combined_order_id' => 0,
                    'result' => false,
                    'message' => translate('Cart is Empty'),
                ]);
            }

            if (get_setting('minimum_order_amount_check') == 1) {
                $subtotal = 0;
                foreach ($cartItems as $item) {
                    $subtotal += cart_product_price($item, Product::find($item->product_id), false, false) * $item->quantity;
                }
                if ($subtotal < get_setting('minimum_order_amount')) {
                    return $this->failed(translate('You order amount is less then the minimum order amount'));
                }
            }

            foreach ($cartItems as $item) {
				$product = Product::with('stocks', 'taxes')->find($item->product_id);
                if ($product) {
                    $lines[] = ['product' => $product, 'data' => $item->toArray()];
                }
            }
        }

        // ── Shipping address ──
        $shippingAddress = [];
        if ($buyNow) {
            $shippingAddress = [
                'name' => $user->name,
                'email' => $user->email,
                'address' => $request->input('delivery_address', $request->input('address', '')),
                'country' => $request->input('country', ''),
                'state' => $request->input('province', ''),
                'city' => $request->input('city', ''),
                'postal_code' => $request->input('postal_code', ''),
                'phone' => $request->input('phone', $user->phone),
            ];
        } else {
            $address = Address::where('id', $cartItems->first()->address_id)->first();
            if ($address) {
                $shippingAddress = [
                    'name' => $user->name,
                    'email' => $user->email,
                    'address' => $address->address,
                    'country' => optional($address->country)->name,
                    'state' => optional($address->state)->getTranslation('name'),
                    'city' => optional($address->city)->name,
                    'postal_code' => $address->postal_code,
                    'phone' => $address->phone,
                ];
                if ($address->latitude || $address->longitude) {
                    $shippingAddress['lat_lang'] = $address->latitude . ',' . $address->longitude;
                }
            }
        }

        // ── Create the order(s) inside one transaction ──
        try {
            [$combined_order, $orders] = DB::transaction(function () use ($request, $set_paid, $buyNow, $user, $shippingAddress, $lines) {
                $combined_order = new CombinedOrder;
                $combined_order->user_id = $user->id;
                $combined_order->shipping_address = json_encode($shippingAddress);
                $combined_order->save();

                // Group lines by seller: one Order per seller.
                $sellerProducts = [];
                foreach ($lines as $line) {
                    $sellerProducts[$line['product']->user_id][] = array_merge($line['data'], ['_product' => $line['product']]);
                }

                $orders = [];
                foreach ($sellerProducts as $sellerProduct) {
                    $order = new Order;
                    $order->combined_order_id = $combined_order->id;
                    $order->user_id = $user->id;
                    $order->shipping_address = $combined_order->shipping_address;
                    $order->order_from = 'app';
                    $order->payment_type = $request->payment_type;
                    $order->delivery_viewed = '0';
                    $order->payment_status_viewed = '0';
                    $order->code = date('Ymd-His') . rand(10, 99);
                    $order->date = strtotime('now');
                    $order->payment_status = $set_paid ? 'paid' : 'unpaid';
                    $order->delivery_status = 'pending';
                    $order->save();
                    $orders[] = $order;

                    $subtotal = $tax = $shipping = $couponDiscount = 0;

                    foreach ($sellerProduct as $item) {
                        $product = $item['_product'];
                        $quantity = (int) $item['quantity'];
                        $variation = (string) ($item['variation'] ?? '');

                        $subtotal += cart_product_price($item, $product, false, false) * $quantity;
                        $tax += cart_product_tax($item, $product, false) * $quantity;
                        $couponDiscount += $item['discount'] ?? 0;

                        // Lock the stock row so two buyers can't take the last item.
                        $stock = ProductStock::where('product_id', $product->id)
                            ->where(function ($q) use ($variation) {
                                $q->where('variant', $variation);
                                if ($variation === '') {
                                    $q->orWhereNull('variant');
                                }
                            })
                            ->lockForUpdate()
                            ->first();

                        if ($product->digital != 1) {
                            if (!$stock || $quantity > $stock->qty) {
                                // Throwing rolls the whole transaction back.
                                throw new \DomainException(
                                    translate('The requested quantity is not available for ') . $product->name
                                );
                            }
                            $stock->qty -= $quantity;
                            $stock->save();
                        }

                        $detail = new OrderDetail;
                        $detail->order_id = $order->id;
                        $detail->seller_id = $product->user_id;
                        $detail->product_id = $product->id;
                        $detail->variation = $variation;
                        $detail->price = cart_product_price($item, $product, false, false) * $quantity;
                        $detail->tax = cart_product_tax($item, $product, false) * $quantity;
                        $detail->shipping_type = $item['shipping_type'] ?? 'flat_rate';
                        $detail->product_referral_code = $item['product_referral_code'] ?? null;
                        $detail->shipping_cost = $item['shipping_cost'] ?? 0;
                        $shipping += $detail->shipping_cost;

                        if (addon_is_activated('club_point')) {
                            $detail->earn_point = $product->earn_point;
                        }

                        $detail->quantity = $quantity;
                        $detail->delivery_status = 'pending';
                        $detail->save();

                        $product->num_of_sale += $quantity;
                        $product->save();

                        $order->seller_id = $product->user_id;
                        $order->shipping_type = $item['shipping_type'] ?? 'flat_rate';
                        if (($item['shipping_type'] ?? '') == 'pickup_point') {
                            $order->pickup_point_id = $item['pickup_point'] ?? null;
                        }
                        if (($item['shipping_type'] ?? '') == 'carrier') {
                            $order->carrier_id = $item['carrier_id'] ?? null;
                        }

                        if ($product->added_by == 'seller' && $product->user->seller) {
                            $seller = $product->user->seller;
                            $seller->num_of_sale += $quantity;
                            $seller->save();
                        }

                        if (addon_is_activated('affiliate_system') && $detail->product_referral_code) {
                            $referrer = User::where('referral_code', $detail->product_referral_code)->first();
                            if ($referrer) {
                                (new AffiliateController)->processAffiliateStats($referrer->id, 0, $quantity, 0, 0);
                            }
                        }
                    }

                    $order->grand_total = $subtotal + $tax + $shipping;

                    if (!empty($sellerProduct[0]['coupon_code'])) {
                        $order->coupon_discount = $couponDiscount;
                        $order->grand_total -= $couponDiscount;

                        $coupon = Coupon::where('code', $sellerProduct[0]['coupon_code'])->first();
                        if ($coupon) {
                            CouponUsage::create(['user_id' => $user->id, 'coupon_id' => $coupon->id]);
                        }
                    }

                    $combined_order->grand_total += $order->grand_total;

                    if (strpos($request->payment_type, 'manual_payment_') !== false) {
                        $order->manual_payment = 1;
                    }
                    $order->save();
                }

                $combined_order->save();

                // Only a cart checkout empties the cart. Buy Now never touches it.
                if (!$buyNow) {
                    Cart::where('user_id', auth()->id())->delete();
                }

                return [$combined_order, $orders];
            });
        } catch (\DomainException $e) {
            return response()->json([
                'combined_order_id' => 0,
                'result' => false,
                'message' => $e->getMessage(),
            ], 422);
        }

        // Notifications run after the order is safely committed. A failure
        // here must never turn a placed order into an error response.
        try {
            if (
                $request->payment_type == 'cash_on_delivery'
                || $request->payment_type == 'wallet'
                || strpos($request->payment_type, 'manual_payment_') !== false
            ) {
                foreach ($orders as $placedOrder) {
                    NotificationUtility::sendOrderPlacedNotification($placedOrder);
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Order placed notification failed: ' . $e->getMessage());
        }

        return response()->json([
            'combined_order_id' => $combined_order->id,
            'result' => true,
            'message' => translate('Your order has been placed successfully'),
        ]);
    }

    /**
     * Validates a Buy Now request and builds its single order line.
     * Returns the line array, or a JsonResponse describing the error.
     */
    private function buildBuyNowLine(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant' => 'nullable|string',
            'payment_type' => 'required|string',
        ]);

       		$product = Product::with('stocks', 'taxes')
            ->whereKey($request->product_id)
            ->where('published', 1)
            ->where('approved', 1)
            ->first();

        if (!$product) {
            return response()->json(['result' => false, 'message' => translate('Product is unavailable')], 422);
        }
        if ($request->quantity < $product->min_qty) {
            return response()->json(['result' => false, 'message' => translate('Minimum quantity not met')], 422);
        }

        $variant = (string) $request->input('variant', '');
        $choices = json_decode($product->choice_options, true) ?: [];
        $hasVariants = !empty($choices) || !empty(json_decode($product->colors, true));

        // Alternative input style: separate `color` + `variants[]` params.
        if ($request->has('color') || $request->has('variants')) {
            $parts = [];
            if ($request->filled('color')) {
                $parts[] = (string) $request->input('color');
            }
            foreach ((array) $request->input('variants', []) as $choiceValue) {
                $parts[] = str_replace(' ', '', (string) $choiceValue);
            }
            $variant = implode('-', $parts);
        }

        $stock = $product->stocks->firstWhere('variant', $variant);
        if (
            !$stock && !$hasVariants
            && ($request->input('variant') === null || $variant === '')
            && $product->stocks->count() === 1
        ) {
            $stock = $product->stocks->first();
            $variant = (string) $stock->variant;
        }

        if (($hasVariants && $variant === '') || !$stock) {
            return response()->json([
                'result' => false,
                'message' => translate('The selected variant is not available for this product.'),
            ], 422);
        }

        if ($product->digital != 1 && $request->quantity > $stock->qty) {
            return response()->json([
                'result' => false,
                'message' => $stock->qty > 0
                    ? translate('Only') . " {$stock->qty} " . translate('item(s) are available')
                    : translate('Stock out'),
            ], 422);
        }

        $shippingType = get_setting('shipping_type') ?: 'flat_rate';
        $data = [
            'product_id' => $product->id,
            'variation' => $variant,
            'quantity' => (int) $request->quantity,
            'discount' => 0,
            'shipping_cost' => 0,
            'shipping_type' => $shippingType,
            'product_referral_code' => null,
            'coupon_code' => null,
            'pickup_point' => null,
            'carrier_id' => null,
        ];

        if ($shippingType == 'flat_rate') {
            $data['shipping_cost'] = (float) get_setting('flat_rate_shipping_cost');
        } elseif ($shippingType == 'seller_wise_shipping') {
            $data['shipping_cost'] = $product->added_by == 'admin'
                ? (float) get_setting('shipping_cost_admin')
                : (float) optional(Shop::where('user_id', $product->user_id)->first())->shipping_cost;
        } elseif ($shippingType == 'product_wise_shipping') {
            $data['shipping_cost'] = (float) $product->shipping_cost
                * ($product->is_quantity_multiplied ? (int) $request->quantity : 1);
        }

        return ['product' => $product, 'data' => $data];
    }

    public function order_cancel($id)
    {
        $order = Order::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if ($order && ($order->delivery_status == 'pending' && $order->payment_status == 'unpaid')) {
            $order->delivery_status = 'cancelled';
            $order->save();

            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->delivery_status = 'cancelled';
                $orderDetail->save();
                product_restock($orderDetail);
            }

            return $this->success(translate('Order has been canceled successfully'));
        } else {
            return $this->failed(translate('Something went wrong'));
        }
    }
}