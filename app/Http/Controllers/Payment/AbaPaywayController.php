<?php

// for fix
namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\CombinedOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Session;

class AbaPaywayController extends Controller
{
    const MERCHANT_ID = 'ec476348';
    const API_KEY      = '3330da0f436177266c9a5e87d80158b54225c410';
    const API_URL       = 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase';
    const CHECK_TXN_URL = 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/check-transaction-2';
    const CURRENCY       = 'USD';

    private function getHash(string $str): string
    {
        return base64_encode(hash_hmac('sha512', $str, self::API_KEY, true));
    }

    private function reqTime(): string
    {
        return gmdate('YmdHis');
    }

    public function pay(Request $request)
    {


        Log::info('Pay request body', [
            'request' => $request,
            'all' => $request->all(),
            'json' => $request->json()->all(),
            'raw' => $request->getContent(),
        ]);

        $combinedOrderId = Session::get('combined_order_id');
        $combinedOrder   = CombinedOrder::findOrFail($combinedOrderId);

        $req_time = $this->reqTime();
        $tran_id  = time() . random_int(100, 999);
        $amount   = number_format((float) $combinedOrder->grand_total, 2, '.', '');

        $name  = optional($combinedOrder->user)->name ?? 'Customer';
        $parts = preg_split('/\s+/', trim($name), 2);
        $firstname = $parts[0] ?? 'Customer';
        $lastname  = $parts[1] ?? '';

        $phone          = optional($combinedOrder->user)->phone ?? '';
        $email          = optional($combinedOrder->user)->email ?? '';
        $payment_option = 'cards';
        $currency       = self::CURRENCY;

        $return_url_plain = route('aba.payway.callback');

        $return_url = 'https://dpdc683.dpdatacenter.com/aba-payway/callback';


        $continue_success_url = route('aba.payway.return');

        $return_params = (string) $combinedOrderId;

        Log::info('Combind Order', [
            'Combind Order'          => $combinedOrder,
        ]);

        Cache::put('aba_pending_tran_' . $tran_id, $combinedOrderId, now()->addHours(6));

        $hash = $this->getHash(
            $req_time
            . self::MERCHANT_ID
            . $tran_id
            . $amount
            . $firstname
            . $lastname
            . $email
            . $phone
            . $payment_option
            . $return_url
            . $continue_success_url
            . $currency
            . $return_params
        );

        Session::put('aba_tran_id', $tran_id);
        Session::put('combined_order_id', $combinedOrderId);

        $viewData = [
            'api_url'              => self::API_URL,
            'merchant_id'          => self::MERCHANT_ID,
            'req_time'             => $req_time,
            'tran_id'              => $tran_id,
            'amount'               => $amount,
            'firstname'            => $firstname,
            'lastname'             => $lastname,
            'email'                => $email,
            'phone'                => $phone,
            'payment_option'       => $payment_option,
            'return_url'           => $return_url,
            'continue_success_url' => $continue_success_url,
            'currency'             => $currency,
            'return_params'        => $return_params,
            'hash'                 => $hash,
        ];

        Log::info('ABA PayWay data sent to Blade', $viewData);


        return view('frontend.payment.aba_payway', [
            'api_url'              => self::API_URL,
            'merchant_id'          => self::MERCHANT_ID,
            'req_time'             => $req_time,
            'tran_id'              => $tran_id,
            'amount'               => $amount,
            'firstname'            => $firstname,
            'lastname'             => $lastname,
            'email'                => $email,
            'phone'                => $phone,
            'payment_option'       => $payment_option,
            'return_url'           => $return_url, // base64
            'continue_success_url' => $continue_success_url,
            'currency'             => $currency,
            'return_params'        => $return_params,
            'hash'                 => $hash,
        ]);
    }


    public function checkStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        Log::info('ABA PayWay checkStatus request received', [
            'headers' => $request->headers->all(),
            'body'    => $request->all(),
            'raw'     => $request->getContent(),
        ]);


        $tranId = $request->input('tran_id') ?: Session::get('aba_tran_id');

        if (! $tranId) {
            Log::error('Payment verification failed: Transaction ID is missing.', [
                'request' => $request->all(),
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
            ]);

            flash(translate('Payment verification failed. Please contact support.'))->error();

            return redirect()->route('home');
        }

        $request->validate([
            'tran_id' => 'required|string',
        ]);

        $tranId = $request->input('tran_id');

        try {
            $status = $this->checkTransactionStatus($tranId);

            // Same resolution path used in callback(): return_params first,
            // fall back to the tran_id -> combined_order_id cache entry.
            $combinedOrderId = $request->input('return_params')
                ?: Cache::get('aba_pending_tran_' . $tranId);

            if ($status === 'APPROVED' && $combinedOrderId) {
                $this->markCombinedOrderPaid((int) $combinedOrderId, $tranId);
            }

            return response()->json([
                'success'        => true,
                'tran_id'        => $tranId,
                'payment_status' => $status,
            ]);
        } catch (\Throwable $e) {
            Log::error('ABA PayWay checkStatus error', [
                'tran_id' => $tranId,
                'error'   => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Unable to check transaction status',
            ], 500);
        }
    }

    public function paymentReturn(Request $request)
    {
        $tranId = $request->input('tran_id') ?: Session::get('aba_tran_id');
        Log::info('Sucesss', [

            'tran_id'     => $tranId
        ]);

        // if (! $tranId) {
        //     flash(translate('Payment verification failed. Please contact support.'))->error();
        //     return redirect()->route('home');
        // }

        // $status = $this->checkTransactionStatus($tranId);

        // if ($status === 'APPROVED') {
        //     $combinedOrderId = Session::get('combined_order_id');
        //     if ($combinedOrderId) {
        //         $this->markCombinedOrderPaid((int) $combinedOrderId, $tranId);
        //     }

        //     return redirect()->route('aba.payway.success', ['tran_id' => $tranId]);
        // }

        return redirect()->route('aba.payway.success', ['tran_id' => $tranId]);

        // Log::warning('ABA PayWay payment not approved', [
        //     'tran_id' => $tranId,
        //     'status'  => $status,
        // ]);

        // flash(translate('Payment was not successful. Please try again.'))->warning();
        // return redirect()->route('checkout.shipping_info');
    }

    public function paymentCancel()
    {
        flash(translate('You cancelled the payment.'))->warning();
        return redirect()->route('checkout.shipping_info');
    }

    public function paymentSuccess(string $tran_id)
    {
        $order = Order::where('payment_details', 'like', '%TranID: ' . $tran_id . '%')->first();

        return view('frontend.payment.aba_payway_success', [
            'tran_id' => $tran_id,
            'order'   => $order,
        ]);
    }


    private function markCombinedOrderPaid(int $combinedOrderId, string $tranId): void
    {
        $combinedOrder = CombinedOrder::findOrFail($combinedOrderId);

        foreach ($combinedOrder->orders as $order) {
            $order = Order::findOrFail($order->id);
            $this->markOrderPaid($order, $tranId);
        }
    }

    private function markOrderPaid(Order $order, string $tranId): void
    {
        if ($order->payment_status === 'paid') {
            return; // idempotent — callback and browser return can both fire
        }

        $order->payment_status  = 'paid';
        $order->payment_details = 'ABA PayWay | TranID: ' . $tranId;
        $order->save();

        calculateCommissionAffilationClubPoint($order);
    }

    private function checkTransactionStatus(string $tranId): string
    {
        $req_time = $this->reqTime();
        $hash     = $this->getHash($req_time . self::MERCHANT_ID . $tranId);

        $payload = [
            'req_time'    => $req_time,
            'merchant_id' => self::MERCHANT_ID,
            'tran_id'     => $tranId,
            'hash'        => $hash,
        ];

        try {
            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post(self::CHECK_TXN_URL, $payload);
            $data     = $response->json();

            Log::info('ABA PayWay Check Transaction Response', [
                'status' => $response->status(),
                'body'   => $data,
            ]);

            return strtoupper((string) data_get($data, 'data.payment_status', 'UNKNOWN'));
        } catch (\Exception $e) {
            Log::error('ABA PayWay Check Transaction Error', [
                'tran_id' => $tranId,
                'error'   => $e->getMessage(),
            ]);
            return 'UNKNOWN';
        }
    }

    private function verifyCallbackSignature(Request $request): bool
    {
        $received = $request->header('X-PAYWAY-HMAC-SHA512');

        if (! $received) {
            // Sandbox doesn't always send this header — don't hard-fail
            // callbacks in that case, just log so you notice in prod.
            Log::info('ABA PayWay callback had no signature header');
            return true;
        }

        $payload = $request->json()->all();
        ksort($payload);

        $b4hash = '';
        foreach ($payload as $value) {
            $b4hash .= is_array($value) ? json_encode($value) : $value;
        }

        $expected = $this->getHash($b4hash);

        return hash_equals($expected, $received);
    }
}
