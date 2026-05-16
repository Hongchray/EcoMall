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

        .ecm-step-card.active,
        .ecm-step-card.done {
            border-bottom-color: #74ad5c;
            color: #74ad5c;
        }

        .ecm-step-card i,
        .ecm-step-card svg {
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

        .ecm-confirm-page {
            color: #111827;
        }

        .ecm-confirm-hero,
        .ecm-confirm-card,
        .ecm-order-card {
            background: #fff;
            border: 1px solid #e3edf7;
            border-radius: 8px;
            box-shadow: 0 18px 45px rgba(31, 41, 55, 0.08);
            overflow: hidden;
        }

        .ecm-confirm-hero {
            padding: 42px 28px;
            text-align: center;
        }

        .ecm-confirm-icon {
            align-items: center;
            background: #eaf7e6;
            border-radius: 999px;
            color: #74ad5c;
            display: inline-flex;
            height: 84px;
            justify-content: center;
            margin-bottom: 18px;
            width: 84px;
        }

        .ecm-confirm-icon i {
            font-size: 44px;
            line-height: 1;
        }

        .ecm-confirm-hero h1 {
            color: #111827;
            font-size: 30px;
            font-weight: 900;
            margin-bottom: 10px;
        }

        .ecm-confirm-hero p {
            color: #6b7280;
            font-size: 14px;
            margin: 0;
        }

        .ecm-confirm-card {
            margin-bottom: 24px;
            padding: 0;
        }

        .ecm-confirm-card-head,
        .ecm-order-card-head {
            align-items: center;
            background: linear-gradient(135deg, #f8fbfe, #eef7fd);
            border-bottom: 1px solid #e3edf7;
            display: flex;
            justify-content: space-between;
            padding: 20px 24px;
        }

        .ecm-confirm-card-head h5,
        .ecm-order-card-head h5 {
            color: #111827;
            font-size: 16px;
            font-weight: 900;
            margin: 0;
        }

        .ecm-order-code {
            background: #e7f4fb;
            border-radius: 999px;
            color: #2e94d0;
            font-size: 13px;
            font-weight: 900;
            padding: 8px 12px;
        }

        .ecm-summary-grid {
            padding: 22px 24px;
        }

        .ecm-summary-table.table td {
            border-top: 0;
            border-bottom: 1px solid #edf2f7;
            color: #111827;
            padding: 10px 0;
            vertical-align: top;
        }

        .ecm-summary-table.table td:first-child {
            color: #7d8592;
            font-weight: 800;
            padding-right: 16px;
            width: 42%;
        }

        .ecm-order-card {
            margin-bottom: 24px;
        }

        .ecm-order-body {
            padding: 24px;
        }

        .ecm-order-table {
            margin-bottom: 24px;
        }

        .ecm-order-table thead th {
            border-top: 0;
            border-bottom: 1px solid #e3edf7;
            color: #8b94a3;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .ecm-order-table tbody td {
            border-top: 0;
            border-bottom: 1px solid #edf2f7;
            color: #111827;
            vertical-align: middle;
        }

        .ecm-order-table a {
            color: #111827;
            font-weight: 800;
        }

        .ecm-order-totals {
            background: #f8fbfe;
            border: 1px solid #e3edf7;
            border-radius: 8px;
            padding: 14px 18px;
        }

        .ecm-order-totals .table {
            margin-bottom: 0;
        }

        .ecm-order-totals th,
        .ecm-order-totals td {
            border-top: 0 !important;
            color: #111827;
            padding: 8px 0 !important;
        }

        .ecm-order-totals th {
            color: #7d8592;
            font-weight: 800;
        }

        .ecm-order-totals tr:last-child th,
        .ecm-order-totals tr:last-child td {
            border-top: 1px solid #e3edf7 !important;
            font-size: 16px;
            padding-top: 12px !important;
        }

        @media (max-width: 575.98px) {
            .ecm-step-card {
                min-height: 62px;
                padding: 12px 6px;
            }

            .ecm-step-card i,
            .ecm-step-card svg {
                font-size: 24px;
                margin-bottom: 0;
            }

            .ecm-confirm-card-head,
            .ecm-order-card-head {
                align-items: flex-start;
                flex-direction: column;
                gap: 10px;
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
                        <div class="col done">
                            <div class="ecm-step-card done">
                                <i class="las la-credit-card"></i>
                                <h3 class="d-none d-lg-block">{{ translate('4. Payment') }}</h3>
                            </div>
                        </div>
                        <div class="col active">
                            <div class="ecm-step-card active">
                                <i class="las la-check-circle cart-rotate"></i>
                                <h3 class="d-none d-lg-block">{{ translate('5. Confirmation') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Confirmation -->
    <section class="py-4 ecm-confirm-page">
        <div class="container text-left">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    @php
                        $first_order = $combined_order->orders->first()
                    @endphp
                    <!-- Order Confirmation Text-->
                    <div class="ecm-confirm-hero mb-4">
                        <span class="ecm-confirm-icon">
                            <i class="las la-check"></i>
                        </span>
                        <h1>{{ translate('Thank You for Your Order!')}}</h1>
                        <p class="fs-13 text-soft-dark">{{  translate('A copy or your order summary has been sent to') }} <strong>{{ json_decode($first_order->shipping_address)->email }}</strong></p>
                    </div>
                    <!-- Order Summary -->
                    <div class="ecm-confirm-card">
                        <div class="ecm-confirm-card-head">
                            <h5>{{ translate('Order Summary')}}</h5>
                        </div>
                        <div class="row ecm-summary-grid">
                            <div class="col-md-6">
                                <table class="table fs-14 text-soft-dark ecm-summary-table">
                                    <tr>
                                        <td class="w-50 fw-600 border-top-0 pl-0 py-2">{{ translate('Order date')}}:</td>
                                        <td class="border-top-0 py-2">{{ date('d-m-Y H:i A', $first_order->date) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-50 fw-600 border-top-0 pl-0 py-2">{{ translate('Name')}}:</td>
                                        <td class="border-top-0 py-2">{{ json_decode($first_order->shipping_address)->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-50 fw-600 border-top-0 pl-0 py-2">{{ translate('Email')}}:</td>
                                        <td class="border-top-0 py-2">{{ json_decode($first_order->shipping_address)->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-50 fw-600 border-top-0 pl-0 py-2">{{ translate('Shipping address')}}:</td>
                                        <td class="border-top-0 py-2">{{ json_decode($first_order->shipping_address)->address }}, {{ json_decode($first_order->shipping_address)->city }}, {{ json_decode($first_order->shipping_address)->country }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table ecm-summary-table">
                                    <tr>
                                        <td class="w-50 fw-600 border-top-0 py-2">{{ translate('Order status')}}:</td>
                                        <td class="border-top-0 pr-0 py-2">{{ translate(ucfirst(str_replace('_', ' ', $first_order->delivery_status))) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-50 fw-600 border-top-0 py-2">{{ translate('Total order amount')}}:</td>
                                        <td class="border-top-0 pr-0 py-2">{{ single_price($combined_order->grand_total) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-50 fw-600 border-top-0 py-2">{{ translate('Shipping')}}:</td>
                                        <td class="border-top-0 pr-0 py-2">{{ translate('Flat shipping rate')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="w-50 fw-600 border-top-0 py-2">{{ translate('Payment method')}}:</td>
                                        <td class="border-top-0 pr-0 py-2">{{ translate(ucfirst(str_replace('_', ' ', $first_order->payment_type))) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Orders Info -->
                    @foreach ($combined_order->orders as $order)
                        <div class="card shadow-none border-0 ecm-order-card">
                            <div class="ecm-order-card-head">
                                <!-- Order Code -->
                                <h5>{{ translate('Order Details')}}</h5>
                                <span class="ecm-order-code">{{ translate('Order Code:')}} {{ $order->code }}</span>
                            </div>
                            <div class="card-body ecm-order-body">
                                <!-- Order Details -->
                                <div>
                                    <!-- Product Details -->
                                    <div>
                                        <table class="table table-responsive-md text-soft-dark fs-14 ecm-order-table">
                                            <thead>
                                                <tr>
                                                    <th class="opacity-60 border-top-0 pl-0">#</th>
                                                    <th class="opacity-60 border-top-0" width="30%">{{ translate('Product')}}</th>
                                                    <th class="opacity-60 border-top-0">{{ translate('Variation')}}</th>
                                                    <th class="opacity-60 border-top-0">{{ translate('Quantity')}}</th>
                                                    <th class="opacity-60 border-top-0">{{ translate('Delivery Type')}}</th>
                                                    <th class="text-right opacity-60 border-top-0 pr-0">{{ translate('Price')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->orderDetails as $key => $orderDetail)
                                                    <tr>
                                                        <td class="border-top-0 border-bottom pl-0">{{ $key+1 }}</td>
                                                        <td class="border-top-0 border-bottom">
                                                            @if ($orderDetail->product != null)
                                                                <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank" class="text-reset">
                                                                    {{ $orderDetail->product->getTranslation('name') }}
                                                                    @php
                                                                        if($orderDetail->combo_id != null) {
                                                                            $combo = \App\ComboProduct::findOrFail($orderDetail->combo_id);

                                                                            echo '('.$combo->combo_title.')';
                                                                        }
                                                                    @endphp
                                                                </a>
                                                            @else
                                                                <strong>{{  translate('Product Unavailable') }}</strong>
                                                            @endif
                                                        </td>
                                                        <td class="border-top-0 border-bottom">
                                                            {{ $orderDetail->variation }}
                                                        </td>
                                                        <td class="border-top-0 border-bottom">
                                                            {{ $orderDetail->quantity }}
                                                        </td>
                                                        <td class="border-top-0 border-bottom">
                                                            @if ($order->shipping_type != null && $order->shipping_type == 'home_delivery')
                                                                {{  translate('Home Delivery') }}
                                                            @elseif ($order->shipping_type != null && $order->shipping_type == 'carrier')
                                                                {{  translate('Carrier') }}
                                                            @elseif ($order->shipping_type == 'pickup_point')
                                                                @if ($order->pickup_point != null)
                                                                    {{ $order->pickup_point->getTranslation('name') }} ({{ translate('Pickip Point') }})
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td class="border-top-0 border-bottom pr-0 text-right">{{ single_price($orderDetail->price) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Order Amounts -->
                                    <div class="row">
                                        <div class="col-xl-5 col-md-6 ml-auto mr-0">
                                            <div class="ecm-order-totals">
                                            <table class="table">
                                                <tbody>
                                                    <!-- Subtotal -->
                                                    <tr>
                                                        <th class="border-top-0 py-2">{{ translate('Subtotal')}}</th>
                                                        <td class="text-right border-top-0 pr-0 py-2">
                                                            <span class="fw-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                                                        </td>
                                                    </tr>
                                                    <!-- Shipping -->
                                                    <tr>
                                                        <th class="border-top-0 py-2">{{ translate('Shipping')}}</th>
                                                        <td class="text-right border-top-0 pr-0 py-2">
                                                            <span>{{ single_price($order->orderDetails->sum('shipping_cost')) }}</span>
                                                        </td>
                                                    </tr>
                                                    <!-- Tax -->
                                                    <tr>
                                                        <th class="border-top-0 py-2">{{ translate('Tax')}}</th>
                                                        <td class="text-right border-top-0 pr-0 py-2">
                                                            <span>{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                                        </td>
                                                    </tr>
                                                    <!-- Coupon Discount -->
                                                    <tr>
                                                        <th class="border-top-0 py-2">{{ translate('Coupon Discount')}}</th>
                                                        <td class="text-right border-top-0 pr-0 py-2">
                                                            <span>{{ single_price($order->coupon_discount) }}</span>
                                                        </td>
                                                    </tr>
                                                    <!-- Total -->
                                                    <tr>
                                                        <th class="py-2"><span class="fw-600">{{ translate('Total')}}</span></th>
                                                        <td class="text-right pr-0">
                                                            <strong><span>{{ single_price($order->grand_total) }}</span></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
