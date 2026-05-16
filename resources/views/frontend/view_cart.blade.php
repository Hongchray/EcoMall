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
                        <div class="col active">
                            <div class="ecm-step-card active">
                                <i class="las la-shopping-cart cart-animate"></i>
                                <h3 class="d-none d-lg-block">{{ translate('1. My Cart') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ecm-step-card">
                                <i class="las la-map"></i>
                                <h3 class="d-none d-lg-block">{{ translate('2. Shipping info') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ecm-step-card">
                                <i class="las la-truck"></i>
                                <h3 class="d-none d-lg-block">{{ translate('3. Delivery info') }}</h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ecm-step-card">
                                <i class="las la-credit-card"></i>
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

    <!-- Cart Details -->
    <section class="mb-4" id="cart-summary">
        @include('frontend.'.get_setting('homepage_select').'.partials.cart_details', ['carts' => $carts])
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element) {
            $.post('{{ route('cart.updateQuantity') }}', {
                _token: AIZ.data.csrf,
                id: key,
                quantity: element.value
            }, function(data) {
                updateNavCart(data.nav_cart_view, data.cart_count);
                $('#cart-summary').html(data.cart_view);
            });
        }
    </script>
@endsection
