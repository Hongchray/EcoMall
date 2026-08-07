{{-- resources/views/frontend/payment/aba_payway.blade.php --}}
@extends('frontend.layouts.app')

@section('content')
<section class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card border-0 shadow-sm rounded-lg text-center p-5">
                    <h5 class="fw-700 mb-2">{{ translate('Pay with ABA PayWay') }}</h5>
                    <p class="text-muted fs-14 mb-4">{{ translate('Total') }}: ${{ $amount }}</p>
                    <input type="button" id="checkout_button" class="btn btn-primary" value="{{ translate('Checkout Now') }}">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Popup checkout form — every field posted here MUST also be part of the
     hash string built in AbaPaywayController@pay, in the same order. --}}
<div id="aba_main_modal" class="aba-modal">
    <div class="aba-modal-content">
        <form method="POST" target="aba_webservice" action="{{ $api_url }}" id="aba_merchant_request">
            <input type="hidden" name="hash"                  value="{{ $hash }}" id="hash">
            <input type="hidden" name="req_time"               value="{{ $req_time }}">
            <input type="hidden" name="merchant_id"            value="{{ $merchant_id }}">
            <input type="hidden" name="tran_id"                value="{{ $tran_id }}" id="tran_id">
            <input type="hidden" name="amount"                 value="{{ $amount }}" id="amount">
            <input type="hidden" name="firstname"              value="{{ $firstname }}">
            <input type="hidden" name="lastname"               value="{{ $lastname }}">
            <input type="hidden" name="email"                  value="{{ $email }}">
            <input type="hidden" name="phone"                  value="{{ $phone }}">
            <input type="hidden" name="payment_option"         value="{{ $payment_option }}">
            <input type="hidden" name="return_url"             value="{{ $return_url }}">
            <input type="hidden" name="continue_success_url"   value="{{ $continue_success_url }}">
            <input type="hidden" name="currency"               value="{{ $currency }}">
            <input type="hidden" name="return_params"          value="{{ $return_params }}">
            <input type="hidden" name="payment_gate" value="0"/>

        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://checkout.payway.com.kh/plugins/checkout2-0.js"></script>
<script>
    $(document).ready(function () {
        $('#checkout_button').click(function () {
            AbaPayway.checkout();
        });
    });
</script>
@endsection
