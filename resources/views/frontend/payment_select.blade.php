@extends('frontend.layouts.app')

@section('content')
    <style>
        .ecm-checkout-steps {
            background: linear-gradient(180deg, #f7fbff 0%, #fff 100%);
        }

        .ecm-step-card {
            align-items: center;
            background: #fff;
            border: 1px solid #e3edf7;
            border-bottom: 4px solid #d7dee8;
            border-radius: 8px;
            box-shadow: 0 10px 26px rgba(31, 41, 55, 0.06);
            color: #8b94a3;
            display: flex;
            flex-direction: column;
            min-height: 94px;
            padding: 16px 10px 14px;
            text-align: center;
        }

        .ecm-step-card.active {
            border-bottom-color: #3c9bd3;
            color: #2e94d0;
        }

        .ecm-step-card.done {
            border-bottom-color: #74ad5c;
            color: #74ad5c;
        }

        .ecm-step-card i {
            font-size: 30px;
            line-height: 1;
            margin-bottom: 9px;
        }

        .ecm-step-card h3 {
            color: inherit;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.25;
            margin: 0;
        }

        .ecm-payment-page {
            color: #111827;
        }

        .ecm-payment-shell,
        .ecm-payment-page #cart_summary > .card {
            background: #fff;
            border: 1px solid #e3edf7 !important;
            border-radius: 8px !important;
            box-shadow: 0 18px 45px rgba(31, 41, 55, 0.08) !important;
            overflow: hidden;
        }

        .ecm-payment-heading {
            align-items: center;
            background: linear-gradient(135deg, #f8fbfe, #eef7fd);
            border-bottom: 1px solid #e3edf7;
            display: flex;
            justify-content: space-between;
            padding: 22px 26px;
        }

        .ecm-payment-heading h2 {
            font-size: 22px;
            font-weight: 800;
            margin: 0;
        }

        .ecm-payment-heading span {
            background: #e7f4fb;
            border-radius: 999px;
            color: #2e94d0;
            font-size: 12px;
            font-weight: 800;
            padding: 7px 12px;
        }

        .ecm-payment-section {
            padding: 24px 26px 0;
        }

        .ecm-payment-section-title {
            color: #111827;
            font-size: 16px;
            font-weight: 800;
            margin: 0 0 14px;
        }

        .ecm-payment-note {
            background: #f8fbfe;
            border: 1px solid #e3edf7;
            border-radius: 8px;
            min-height: 120px;
            resize: vertical;
        }

        .ecm-payment-options {
            padding-bottom: 8px;
        }

        .ecm-payment-options .aiz-megabox-elem {
            align-items: center;
            border: 1px solid #e3edf7;
            border-radius: 8px !important;
            display: flex !important;
            flex-direction: column;
            justify-content: center;
            min-height: 118px;
            padding: 16px 12px !important;
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .ecm-payment-options .aiz-megabox:hover .aiz-megabox-elem {
            border-color: #b9dff4;
            box-shadow: 0 12px 28px rgba(46, 148, 208, 0.12);
            transform: translateY(-2px);
        }

        .ecm-payment-options .aiz-megabox input:checked ~ .aiz-megabox-elem {
            border-color: #2e94d0;
            box-shadow: 0 12px 28px rgba(46, 148, 208, 0.18);
        }

        .ecm-payment-options .aiz-megabox-elem img {
            height: 34px;
            margin-bottom: 12px !important;
            max-width: 92px;
            object-fit: contain;
        }

        .ecm-payment-options .aiz-megabox-elem .fs-15 {
            color: #111827;
            font-size: 13px !important;
            font-weight: 800 !important;
            line-height: 1.25;
        }

        .ecm-manual-payment {
            border-color: #e3edf7 !important;
            border-radius: 8px !important;
            margin: 0 26px 24px;
        }

        .ecm-wallet-box {
            background: #f8fbfe;
            border: 1px solid #e3edf7;
            border-radius: 8px;
            margin: 0 26px 24px;
            padding: 22px;
            text-align: center;
        }

        .ecm-policy-box {
            background: #f8fbfe;
            border-top: 1px solid #e3edf7;
            color: #4b5563;
            padding: 18px 26px;
        }

        .ecm-payment-footer {
            align-items: center;
            display: flex;
            justify-content: space-between;
            padding: 22px 26px 26px;
        }

        .ecm-payment-return {
            align-items: center;
            color: #2e94d0;
            display: inline-flex;
            font-size: 14px;
            font-weight: 800;
            min-height: 44px;
            text-decoration: none;
        }

        .ecm-payment-return:hover,
        .ecm-payment-return:focus {
            color: #227eb8;
            text-decoration: none;
        }

        .ecm-payment-complete,
        .ecm-wallet-pay {
            background: #2e94d0;
            border: 0;
            border-radius: 6px;
            box-shadow: 0 12px 24px rgba(46, 148, 208, 0.22);
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            min-height: 46px;
            padding: 12px 24px;
        }

        .ecm-payment-complete:hover,
        .ecm-payment-complete:focus,
        .ecm-wallet-pay:hover,
        .ecm-wallet-pay:focus {
            background: #227eb8;
            color: #fff;
        }

        .ecm-payment-page #cart_summary .card-header {
            background: linear-gradient(135deg, #f8fbfe, #eef7fd);
            border-bottom: 1px solid #e3edf7 !important;
            padding: 20px 22px !important;
        }

        .ecm-payment-page #cart_summary .card-body {
            padding: 22px !important;
        }

        @media (max-width: 767.98px) {
            .ecm-payment-page .container {
                max-width: 430px;
                padding-left: 16px;
                padding-right: 16px;
            }

            .ecm-payment-page .container > .row {
                margin-left: 0;
                margin-right: 0;
            }

            .ecm-payment-page .container > .row > [class*="col-"] {
                padding-left: 0;
                padding-right: 0;
            }

            .ecm-payment-page .col-lg-8 {
                order: 2;
            }

            .ecm-payment-page #cart_summary {
                margin-bottom: 18px;
                margin-top: 0 !important;
                order: 1;
            }

            .ecm-payment-heading,
            .ecm-payment-section,
            .ecm-policy-box,
            .ecm-payment-footer {
                padding-left: 18px;
                padding-right: 18px;
            }

            .ecm-manual-payment,
            .ecm-wallet-box {
                margin-left: 18px;
                margin-right: 18px;
            }

            .ecm-payment-footer {
                align-items: stretch;
                flex-direction: column-reverse;
                gap: 16px;
                text-align: center;
            }

            .ecm-payment-return {
                justify-content: center;
            }

            .ecm-payment-complete {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .ecm-step-card {
                min-height: 62px;
                padding: 12px 6px;
            }

            .ecm-step-card i {
                font-size: 24px;
                margin-bottom: 0;
            }
        }
    </style>

    <!-- Steps -->
    <section class="ecm-checkout-steps pt-5 pb-2 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 mx-auto">
                    <div class="row gutters-5 sm-gutters-10">
                        <div class="col done">
                            <div class="ecm-step-card done">
                                <i class="las la-shopping-cart"></i>
                                <h3 class="d-none d-lg-block">{{ translate('1. My Cart') }}</h3>
                            </div>
                        </div>
                        <div class="col done">
                            <div class="ecm-step-card done">
                                <i class="las la-map"></i>
                                <h3 class="d-none d-lg-block">{{ translate('2. Shipping info') }}</h3>
                            </div>
                        </div>
                        <div class="col done">
                            <div class="ecm-step-card done">
                                <i class="las la-truck"></i>
                                <h3 class="d-none d-lg-block">{{ translate('3. Delivery info') }}</h3>
                            </div>
                        </div>
                        <div class="col active">
                            <div class="ecm-step-card active">
                                <i class="las la-credit-card cart-animate"></i>
                                <h3 class="d-none d-lg-block">{{ translate('4. Payment') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ecm-step-card">
                                <i class="las la-check-circle"></i>
                                <h3 class="d-none d-lg-block">{{ translate('5. Confirmation') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Info -->
    <section class="mb-4 ecm-payment-page">
        <div class="container text-left">
            <div class="row">
                <div class="col-lg-8">
                    <form action="{{ route('payment.checkout') }}" class="form-default" role="form" method="POST"
                        id="checkout-form">
                        @csrf
                        <input type="hidden" name="owner_id" value="{{ $carts[0]['owner_id'] }}">

                        <div class="card ecm-payment-shell border-0 shadow-none">
                            <div class="ecm-payment-heading">
                                <h2>{{ translate('Payment') }}</h2>
                                <span>{{ translate('Secure Checkout') }}</span>
                            </div>
                            <!-- Additional Info -->
                            <div class="ecm-payment-section">
                                <h3 class="ecm-payment-section-title">
                                    {{ translate('Any additional info?') }}
                                </h3>
                            </div>
                            <div class="form-group px-4 px-md-4 mx-0" style="padding-left: 26px !important; padding-right: 26px !important;">
                                <textarea name="additional_info" rows="5" class="form-control ecm-payment-note"
                                    placeholder="{{ translate('Type your text...') }}"></textarea>
                            </div>

                            <div class="ecm-payment-section">
                                <h3 class="ecm-payment-section-title">
                                    {{ translate('Select a payment option') }}
                                </h3>
                            </div>
                            <div class="row gutters-10 p-4">

                                <!-- ABA PayWay -->
                                <div class="col-6">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input
                                            value="aba_payway"
                                            class="online_payment"
                                            type="radio"
                                            name="payment_option"
                                            checked
                                        >

                                        <span class="d-flex flex-column align-items-center justify-content-center aiz-megabox-elem rounded p-4 h-100">
                                            <img
                                                src="{{ asset('assets/img/cards/aba-payway.png') }}"
                                                alt="ABA PayWay"
                                                style="width:80px;height:50px;object-fit:contain;"
                                            >

                                            <span class="fw-700 fs-15 mt-3">
                                                ABA PayWay
                                            </span>

                                            <small class="text-muted">
                                                Secure Online Payment
                                            </small>
                                        </span>
                                    </label>
                                </div>

                                <!-- Cash on Delivery -->
                                <div class="col-6">
                                    <label class="aiz-megabox d-block mb-3">
                                        <input
                                            value="cash_on_delivery"
                                            class="online_payment"
                                            type="radio"
                                            name="payment_option"
                                        >

                                        <span class="d-flex flex-column align-items-center justify-content-center aiz-megabox-elem rounded p-4 h-100">
                                            <img
                                                src="{{ static_asset('assets/img/cards/cod-hand.png') }}"
                                                alt="Cash on Delivery"
                                                style="width:80px;height:50px;object-fit:contain;"
                                            >

                                            <span class="fw-700 fs-15 mt-3">
                                                {{ translate('Cash on Delivery') }}
                                            </span>

                                            <small class="text-muted">
                                                Pay When Delivered
                                            </small>
                                        </span>
                                    </label>
                                </div>

                            </div>

                            <!-- Agree Box -->
                            <div class="ecm-policy-box fs-14">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" required id="agree_checkbox">
                                    <span class="aiz-square-check"></span>
                                    <span>{{ translate('I agree to the') }}</span>
                                </label>
                                <a href="{{ route('terms') }}"
                                    class="fw-700">{{ translate('terms and conditions') }}</a>,
                                <a href="{{ route('returnpolicy') }}"
                                    class="fw-700">{{ translate('return policy') }}</a> &
                                <a href="{{ route('privacypolicy') }}"
                                    class="fw-700">{{ translate('privacy policy') }}</a>
                            </div>

                            <div class="ecm-payment-footer">
                                <!-- Return to shop -->
                                <div>
                                    <a href="{{ route('home') }}" class="ecm-payment-return">
                                        <i class="las la-arrow-left fs-16"></i>
                                        {{ translate('Return to shop') }}
                                    </a>
                                </div>
                                <!-- Complete Ordert -->
                                <div>
                                    <button type="button" onclick="submitOrder(this)"
                                        class="btn ecm-payment-complete">{{ translate('Complete Order') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Cart Summary -->
                <div class="col-lg-4 mt-lg-0 mt-4" id="cart_summary">
                    @include('frontend.'.get_setting('homepage_select').'.partials.cart_summary')
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".online_payment").click(function() {
                $('#manual_payment_description').parent().addClass('d-none');
            });
            toggleManualPaymentData($('input[name=payment_option]:checked').data('id'));
        });

        var minimum_order_amount_check = {{ get_setting('minimum_order_amount_check') == 1 ? 1 : 0 }};
        var minimum_order_amount =
            {{ get_setting('minimum_order_amount_check') == 1 ? get_setting('minimum_order_amount') : 0 }};

        function use_wallet() {
            $('input[name=payment_option]').val('wallet');
            if ($('#agree_checkbox').is(":checked")) {
                ;
                if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {
                    AIZ.plugins.notify('danger',
                        '{{ translate('You order amount is less then the minimum order amount') }}');
                } else {
                    $('#checkout-form').submit();
                }
            } else {
                AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
            }
        }

        function submitOrder(el) {
            $(el).prop('disabled', true);
            if ($('#agree_checkbox').is(":checked")) {
                if (minimum_order_amount_check && $('#sub_total').val() < minimum_order_amount) {
                    AIZ.plugins.notify('danger',
                        '{{ translate('You order amount is less then the minimum order amount') }}');
                } else {
                    var offline_payment_active = '{{ addon_is_activated('offline_payment') }}';
                    if (offline_payment_active == '1' && $('.offline_payment_option').is(":checked") && $('#trx_id')
                        .val() == '') {
                        AIZ.plugins.notify('danger', '{{ translate('You need to put Transaction id') }}');
                        $(el).prop('disabled', false);
                    } else {
                        $('#checkout-form').submit();
                    }
                }
            } else {
                AIZ.plugins.notify('danger', '{{ translate('You need to agree with our policies') }}');
                $(el).prop('disabled', false);
            }
        }

        function toggleManualPaymentData(id) {
            if (typeof id != 'undefined') {
                $('#manual_payment_description').parent().removeClass('d-none');
                $('#manual_payment_description').html($('#manual_payment_info_' + id).html());
            }
        }

        $(document).on("click", "#coupon-apply", function() {
            var data = new FormData($('#apply-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ route('checkout.apply_coupon_code') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    AIZ.plugins.notify(data.response_message.response, data.response_message.message);
                    $("#cart_summary").html(data.html);
                }
            })
        });

        $(document).on("click", "#coupon-remove", function() {
            var data = new FormData($('#remove-coupon-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "{{ route('checkout.remove_coupon_code') }}",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data, textStatus, jqXHR) {
                    $("#cart_summary").html(data);
                }
            })
        })
    </script>
@endsection
