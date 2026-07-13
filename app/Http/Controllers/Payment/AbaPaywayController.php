<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\CombinedOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Session;

class AbaPaywayController extends Controller
{
    // Same constants as your working sample file — keep these identical to
    // what PayWay gave you. If these are wrong, nothing else matters.
    const MERCHANT_ID = 'ec000262';
    const API_KEY      = '308f1c5f450ff6d971bf8a805b4d18a6ef142464';
    const API_URL       = 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase';
    const CHECK_TXN_URL = 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/check-transaction-2';


    // ec476348
    // 3330da0f436177266c9a5e87d80158b54225c410
    /**
     * Hash logic copied 1:1 from PayWayApiCheckout::getHash() in your sample.
     */
    private function getHash(string $str): string
    {
        return base64_encode(hash_hmac('sha512', $str, self::API_KEY, true));
    }

    /**
     * Entry point — called by the checkout decorator: (new AbaPaywayController)->pay($request)
     *
     * Mirrors the sample file exactly:
     *   hash = getHash(req_time . merchant_id . tran_id . amount . firstname . lastname . email . phone . return_params)
     */
    public function pay(Request $request)
    {
        $combinedOrderId = Session::get('combined_order_id');
        $combinedOrder   = CombinedOrder::findOrFail($combinedOrderId);

        $req_time      = time();
        $tran_id       = time();
        $amount        = number_format((float) $combinedOrder->grand_total, 2, '.', '');

        $name  = optional($combinedOrder->user)->name ?? 'Customer';
        $parts = preg_split('/\s+/', trim($name), 2);
        $firstname = $parts[0] ?? 'Customer';
        $lastname  = $parts[1] ?? '';

        $phone          = optional($combinedOrder->user)->phone ?? '';
        $email          = optional($combinedOrder->user)->email ?? '';
        $return_params  = '';
        $payment_option = 'cards'; // Restricts checkout to card payments only

        $hash = $this->getHash(
            $req_time . self::MERCHANT_ID . $tran_id . $amount . $firstname . $lastname . $email . $phone . $payment_option . $return_params
        );

        // Session::put('aba_tran_id', $tran_id);

        return view('frontend.payment.aba_payway', [
            'api_url'        => self::API_URL,
            'merchant_id'    => self::MERCHANT_ID,
            'req_time'       => $req_time,
            'tran_id'        => $tran_id,
            'amount'         => $amount,
            'firstname'      => $firstname,
            'lastname'       => $lastname,
            'email'          => $email,
            'phone'          => $phone,
            'payment_option' => $payment_option,
            'return_params'  => $return_params,
            'hash'           => $hash,
        ]);
    }

    /**
     * ABA redirects here after payment (supports both GET and POST)
     */
    public function paymentReturn(Request $request)
    {
        $tranId = $request->input('tran_id') ?: Session::get('aba_tran_id');

        if (! $tranId) {
            flash(translate('Payment verification failed. Please contact support.'))->error();
            return redirect()->route('home');
        }

        $status = $this->checkTransactionStatus($tranId);

        if ($status === 'APPROVED') {
            return $this->handleSuccess($tranId);
        }

        Log::warning('ABA PayWay payment not approved', [
            'tran_id' => $tranId,
            'status'  => $status,
        ]);

        flash(translate('Payment was not successful. Please try again.'))->warning();
        return redirect()->route('checkout.shipping_info');
    }

    public function paymentCancel()
    {
        flash(translate('You cancelled the payment.'))->warning();
        return redirect()->route('checkout.shipping_info');
    }

    // ── Private helpers ───────────────────────────────────────────────────────

    private function handleSuccess(string $tranId): \Illuminate\Http\RedirectResponse
    {
        $combinedOrderId = Session::get('combined_order_id');
        $combinedOrder   = CombinedOrder::findOrFail($combinedOrderId);

        foreach ($combinedOrder->orders as $order) {
            $order = Order::findOrFail($order->id);
            $order->payment_status  = 'paid';
            $order->payment_details = 'ABA PayWay | TranID: ' . $tranId;
            $order->save();

            calculateCommissionAffilationClubPoint($order);
        }

        Session::put('combined_order_id', $combinedOrderId);

        flash(translate('Payment completed successfully!'))->success();
        return redirect()->route('order_confirmed');
    }

    private function checkTransactionStatus(string $tranId): string
    {
        $req_time = time();
        $hash     = $this->getHash($req_time . self::MERCHANT_ID . $tranId);

        $payload = [
            'req_time'    => $req_time,
            'merchant_id' => self::MERCHANT_ID,
            'tran_id'     => $tranId,
            'hash'        => $hash,
        ];

        try {
            $response = Http::timeout(30)->post(self::CHECK_TXN_URL, $payload);
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
}
