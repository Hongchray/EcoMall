<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use App\Utility\CartUtility;
use App\Utility\NagadUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function summary()
    {
        $items = Cart::with('product')->where('user_id', auth()->id())->get();
        if ($items->isEmpty()) {
            return response()->json([
                'sub_total' => format_price(0.00),
                'tax' => format_price(0.00),
                'shipping_cost' => format_price(0.00),
                'discount' => format_price(0.00),
                'grand_total' => format_price(0.00),
                'grand_total_value' => 0.00,
                'coupon_code' => "",
                'coupon_applied' => false,
            ]);
        }

        $sum = 0.00;
        $subtotal = 0.00;
        $tax = 0.00;
        foreach ($items as $cartItem) {
            $product = Product::find($cartItem['product_id']);
            $subtotal += cart_product_price($cartItem, $product, false, false) * $cartItem['quantity'];
            $tax += cart_product_tax($cartItem, $product, false) * $cartItem['quantity'];
        }

        $shipping_cost = $items->sum('shipping_cost');
        $discount = $items->sum('discount');
        $sum = ($subtotal + $tax + $shipping_cost) - $discount;

        return response()->json([
            'sub_total' => single_price($subtotal),
            'tax' => single_price($tax),
            'shipping_cost' => single_price($shipping_cost),
            'discount' => single_price($discount),
            'grand_total' => single_price($sum),
            'grand_total_value' => convert_price($sum),
            'coupon_code' => $items[0]->coupon_code,
            'coupon_applied' => $items[0]->coupon_applied == 1,
        ]);
    }

    public function count()
    {
        $items = Cart::where('user_id', auth()->id())->get();

        return response()->json([
            'count' => sizeof($items),
            'status' => true,
        ]);
    }

    public function getList()
    {
        $items = Cart::with(['product.stocks'])->where('user_id', auth()->id())->get();
        $owner_ids = $items->pluck('owner_id')->unique()->values()->all();
        $currency_symbol = currency_symbol();
        $shops = [];
        $sub_total = 0.00;
        $grand_total = 0.00;
        if (!empty($owner_ids)) {
            foreach ($owner_ids as $owner_id) {
                $shop = array();
                $shop_items_raw_data = $items->where('owner_id', $owner_id)->values()->toArray();
                $shop_items_data = array();
                if (!empty($shop_items_raw_data)) {
                    foreach ($shop_items_raw_data as $shop_items_raw_data_item) {
                        $product = Product::with('stocks')->where('id', $shop_items_raw_data_item["product_id"])->first();
                        if (!$product) continue;
                        $price = cart_product_price($shop_items_raw_data_item, $product, false, false) * intval($shop_items_raw_data_item["quantity"]);
                        $tax = cart_product_tax($shop_items_raw_data_item, $product, false);
                        $shop_items_data_item["id"] = intval($shop_items_raw_data_item["id"]);
                        $shop_items_data_item["owner_id"] = intval($shop_items_raw_data_item["owner_id"]);
                        $shop_items_data_item["user_id"] = intval($shop_items_raw_data_item["user_id"]);
                        $shop_items_data_item["product_id"] = intval($shop_items_raw_data_item["product_id"]);
                        $shop_items_data_item["product_name"] = $product->getTranslation('name');
                        $shop_items_data_item["auction_product"] = $product->auction_product;
                        $shop_items_data_item["product_thumbnail_image"] = uploaded_asset($product->thumbnail_img);
                        $shop_items_data_item["variation"] = $shop_items_raw_data_item["variation"];
                        $shop_items_data_item["price"] = (float) cart_product_price($shop_items_raw_data_item, $product, false, false);
                        $shop_items_data_item["currency_symbol"] = $currency_symbol;
                        $shop_items_data_item["tax"] = (float) cart_product_tax($shop_items_raw_data_item, $product, false);
                        $shop_items_data_item["price"] = single_price($price);
                        $shop_items_data_item["currency_symbol"] = $currency_symbol;
                        $shop_items_data_item["tax"] = single_price($tax);
                        // $shop_items_data_item["tax"] = (float) cart_product_tax($shop_items_raw_data_item, $product, false);
                        $shop_items_data_item["shipping_cost"] = (float) $shop_items_raw_data_item["shipping_cost"];
                        $shop_items_data_item["quantity"] = intval($shop_items_raw_data_item["quantity"]);
                        $shop_items_data_item["lower_limit"] = intval($product->min_qty);
                        $stock = $product->stocks->where('variant', $shop_items_raw_data_item['variation'])->first();
                        $shop_items_data_item["upper_limit"] = $stock ? (int) $stock->qty : 0;

                        $sub_total += $price + $tax;
                        $shop_items_data[] = $shop_items_data_item;
                    }
                }

                $grand_total += $sub_total;
                $shop_data = Shop::where('user_id', $owner_id)->first();
                if ($shop_data) {
                    $shop['name'] = translate($shop_data->name);
                    $shop['owner_id'] = (int) $owner_id;
                    $shop['sub_total'] = single_price($sub_total);
                    $shop['cart_items'] = $shop_items_data;
                } else {
                    $shop['name'] = translate("Inhouse");
                    $shop['owner_id'] = (int) $owner_id;
                    $shop['sub_total'] = single_price($sub_total);
                    $shop['cart_items'] = $shop_items_data;
                }
                $shops[] = $shop;
                $sub_total = 0.00;
            }
        }

        //dd($shops);

        return response()->json([
            "grand_total" => single_price($grand_total),
            "data" =>
            $shops
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant' => 'nullable|string',
            'cost_matrix' => 'nullable|string',
        ]);

        $carts = Cart::where('user_id', auth()->id())->with('product')->get();
        $check_auction_in_cart = CartUtility::check_auction_in_cart($carts);
        $product = Product::with('stocks')->findOrFail($request->id);

        if ($check_auction_in_cart && $product->auction_product == 0) {
            return response()->json([
                'result' => false,
                'message' => translate('Remove auction product from cart to add this product.')
            ], 200);
        }
        if ($check_auction_in_cart == false && count($carts) > 0 && $product->auction_product == 1) {
            return response()->json([
                'result' => false,
                'message' => translate('Remove other products from cart to add this auction product.')
            ], 200);
        }

        if ($product->min_qty > $request->quantity) {
            return response()->json([
                'result' => false,
                'message' => translate("Minimum") . " {$product->min_qty} " . translate("item(s) should be ordered")
            ], 200);
        }

        $variant = $request->input('variant', '');
        $tax = 0;
        $quantity = $request->quantity;

        $product_stock = $product->stocks->firstWhere('variant', $variant);

        // Mobile clients may send null or omit variant for a simple product.
        // Such products normally have one stock row with an empty variant.
        if (!$product_stock && ($variant === null || $variant === '') && $product->stocks->count() === 1) {
            $product_stock = $product->stocks->first();
            $variant = (string) $product_stock->variant;
        }

        if (!$product_stock && $product->digital != 1) {
            return response()->json([
                'result' => false,
                'message' => translate("The selected variant is not available for this product.")
            ], 422);
        }

        if ($product->digital != 1 && $product_stock->qty < $request->quantity) {
            return response()->json([
                'result' => false,
                'message' => $product_stock->qty > 0
                    ? translate('Only') . " {$product_stock->qty} " . translate('item(s) are available')
                    : translate('Stock out'),
            ], 422);
        }

        $cart = Cart::firstOrNew([
            'variation' => $variant,
            'user_id' => auth()->user()->id,
            'product_id' => $request['id']
        ]);

        $variant_string = $variant != null && $variant != "" ? translate("for") . " ($variant)" : "";

        if ($cart->exists && $product->digital == 0) {
            if ($product->auction_product == 1 && ($cart->product_id == $product->id)) {
                return response()->json([
                    'result' => false,
                    'message' => translate('This auction product is already added to your cart.')
                ], 200);
            }
            if ($product_stock->qty < $cart->quantity + $request['quantity']) {
                if ($product_stock->qty == 0) {
                    return response()->json([
                        'result' => false,
                        'message' => translate("Stock out")
                    ], 200);
                } else {
                    return response()->json([
                        'result' => false,
                        'message' => translate("Only") . " {$product_stock->qty} " . translate("item(s) are available") . " {$variant_string}"
                    ], 200);
                }
            }
            if ($product->digital == 1 && ($cart->product_id == $product->id)) {
                return response()->json([
                    'result' => false,
                    'message' => translate('Already added this product')
                ]);
            }
            $quantity = $cart->quantity + $request['quantity'];
        }

        $price = $product_stock ? CartUtility::get_price($product, $product_stock, $quantity) : 0;
        $tax = CartUtility::tax_calculation($product, $price);
        CartUtility::save_cart_data($cart, $product, $price, $tax, $quantity);

        if ($request->filled('cost_matrix') && NagadUtility::create_balance_reference($request->cost_matrix) == false) {
            return response()->json(['result' => false, 'message' => 'Cost matrix error']);
        }

        return response()->json([
            'result' => true,
            'message' => translate('Product added to cart successfully'),
            'cart_item' => $cart->fresh(['product']),
            'cart_count' => Cart::where('user_id', auth()->id())->count(),
        ]);
    }

    public function changeQuantity(Request $request)
    {
        $request->validate(['id' => 'required|integer', 'quantity' => 'required|integer|min:1']);
        $cart = Cart::where('user_id', auth()->id())->find($request->id);
        if ($cart != null) {
            $product = Product::find($cart->product_id);
            if (!$product) return response()->json(['result' => false, 'message' => translate('Product is unavailable')], 404);
            if ($request->quantity < $product->min_qty) return response()->json(['result' => false, 'message' => translate('Minimum quantity not met')], 422);
            if ($product->auction_product == 1) {
                return response()->json(['result' => false, 'message' => translate('Maximum available quantity reached')], 200);
            }
            $stock = $cart->product->stocks->where('variant', $cart->variation)->first();
            if ($product->digital == 1 || ($stock && $stock->qty >= $request->quantity)) {
                $cart->update([
                    'quantity' => $request->quantity
                ]);

                return response()->json(['result' => true, 'message' => translate('Cart updated')], 200);
            } else {
                return response()->json(['result' => false, 'message' => translate('Maximum available quantity reached')], 200);
            }
        }

        return response()->json(['result' => false, 'message' => translate('Something went wrong')], 200);
    }

    public function process(Request $request)
    {
        $request->validate(['cart_ids' => 'required|string', 'cart_quantities' => 'required|string']);
        $cart_ids = explode(",", $request->cart_ids);
        $cart_quantities = explode(",", $request->cart_quantities);

        if (count($cart_ids) !== count($cart_quantities)) {
            return response()->json(['result' => false, 'message' => translate('Cart IDs and quantities must match')], 422);
        }

        if (!empty($cart_ids)) {
            $i = 0;
            foreach ($cart_ids as $cart_id) {
                $cart_item = Cart::where('user_id', auth()->id())->where('id', $cart_id)->first();
                if (!$cart_item || !ctype_digit((string) $cart_quantities[$i]) || (int) $cart_quantities[$i] < 1) {
                    return response()->json(['result' => false, 'message' => translate('Invalid cart item or quantity')], 422);
                }
                $product = Product::where('id', $cart_item->product_id)->first();
                if (!$product) return response()->json(['result' => false, 'message' => translate('Product is unavailable')], 422);

                if ($product->min_qty > $cart_quantities[$i]) {
                    return response()->json(['result' => false, 'message' => translate("Minimum") . " {$product->min_qty} " . translate("item(s) should be ordered for") . " {$product->name}"], 200);
                }

                $product_stock = $cart_item->product->stocks->where('variant', $cart_item->variation)->first();
                $stock = $product_stock ? $product_stock->qty : 0;
                $variant_string = $cart_item->variation != null && $cart_item->variation != "" ? " ($cart_item->variation)" : "";
                if ($stock >= $cart_quantities[$i] || $product->digital == 1) {
                    $cart_item->update([
                        'quantity' => $cart_quantities[$i]
                    ]);
                } else {
                    if ($stock == 0) {
                        return response()->json(['result' => false, 'message' => translate("No item is available for") . " {$product->name}{$variant_string}," . translate("remove this from cart")], 200);
                    } else {
                        return response()->json(['result' => false, 'message' => translate("Only") . " {$stock} " . translate("item(s) are available for") . " {$product->name}{$variant_string}"], 200);
                    }
                }

                $i++;
            }

            return response()->json(['result' => true, 'message' => translate('Cart updated')], 200);
        } else {
            return response()->json(['result' => false, 'message' => translate('Cart is empty')], 200);
        }
    }

    public function destroy($id)
    {
        $deleted = Cart::where('user_id', auth()->id())->where('id', $id)->delete();
        if (!$deleted) return response()->json(['result' => false, 'message' => translate('Cart item not found')], 404);
        return response()->json(['result' => true, 'message' => translate('Product is successfully removed from your cart')], 200);
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        return response()->json(['result' => true, 'message' => translate('Cart cleared successfully')]);
    }
}
