@extends('frontend.layouts.user_panel')

@section('panel_content')
<style>
        .ecm-order-details-page {
            color: #111827;
        }

        .ecm-order-hero {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 16px;
            padding: 20px;
            color: #fff;
            background: linear-gradient(135deg, #1d8ec5 0%, #34a6dc 58%, #69c27d 100%);
            border-radius: 8px;
            box-shadow: 0 14px 30px rgba(29, 142, 197, 0.16);
        }

        .ecm-order-kicker {
            display: block;
            margin-bottom: 6px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 11px;
            font-weight: 800;
            line-height: 1;
            text-transform: uppercase;
        }

        .ecm-order-title {
            margin: 0;
            color: #fff;
            font-size: 24px;
            font-weight: 800;
            line-height: 1.2;
            overflow-wrap: anywhere;
        }

        .ecm-order-hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .ecm-order-hero-pill {
            display: inline-flex;
            align-items: center;
            min-height: 28px;
            padding: 6px 10px;
            color: #0f5f84;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 14px;
            font-size: 12px;
            font-weight: 800;
            line-height: 1.2;
        }

        .ecm-order-hero-amount {
            flex: 0 0 auto;
            min-width: 118px;
            padding: 12px 14px;
            color: #111827;
            background: #fff;
            border-radius: 8px;
            text-align: right;
            box-shadow: 0 8px 18px rgba(17, 24, 39, 0.12);
        }

        .ecm-order-hero-amount span {
            display: block;
            margin-bottom: 4px;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
            line-height: 1;
            text-transform: uppercase;
        }

        .ecm-order-hero-amount strong {
            display: block;
            color: #111827;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.15;
        }

        .ecm-order-panel {
            overflow: hidden;
            background: #fff;
            border: 1px solid #e7edf3;
            border-radius: 8px;
            box-shadow: 0 8px 22px rgba(17, 24, 39, 0.045);
        }

        .ecm-order-panel-header {
            padding: 18px 20px;
            border-bottom: 1px solid #edf2f7;
        }

        .ecm-order-panel-header h5,
        .ecm-order-panel-header b {
            margin: 0;
            color: #111827;
            font-size: 16px;
            font-weight: 800;
        }

        .ecm-order-panel-body {
            padding: 18px 20px;
        }

        .ecm-order-info-table {
            margin: 0;
        }

        .ecm-order-info-table td {
            padding: 9px 0;
            color: #111827;
            font-size: 14px;
            line-height: 1.45;
            vertical-align: top;
        }

        .ecm-order-info-table td:first-child {
            width: 42%;
            padding-right: 16px;
            color: #4b5563;
            font-weight: 800;
        }

        .ecm-order-summary-mobile {
            display: none;
        }

        .ecm-order-summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .ecm-order-summary-item {
            min-width: 0;
            padding: 11px 12px;
            background: #f8fafc;
            border-radius: 8px;
        }

        .ecm-order-summary-item.is-wide {
            grid-column: 1 / -1;
        }

        .ecm-order-summary-label {
            display: block;
            margin-bottom: 6px;
            color: #587086;
            font-size: 10px;
            font-weight: 800;
            line-height: 1.2;
        }

        .ecm-order-summary-value {
            display: block;
            color: #111827;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .ecm-order-products-table {
            margin-bottom: 0;
        }

        .ecm-order-products-table thead th {
            border: 0;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            padding: 14px 12px;
            white-space: nowrap;
        }

        .ecm-order-products-table tbody td {
            padding: 14px 12px;
            border-top: 1px solid #edf2f7;
            color: #111827;
            vertical-align: middle;
        }

        .ecm-order-products-table a {
            color: #0d6efd;
            font-weight: 800;
        }

        .ecm-order-total-table {
            margin: 0;
        }

        .ecm-order-total-table td {
            padding: 10px 0;
            border-top: 1px solid #f1f5f9;
        }

        .ecm-order-total-table tr:first-child td {
            border-top: 0;
        }

        .ecm-order-products-mobile {
            display: none;
        }

        .ecm-order-product-card {
            padding: 12px 0;
            border-bottom: 1px solid #edf2f7;
        }

        .ecm-order-product-card:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .ecm-order-product-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
        }

        .ecm-order-product-name {
            color: #0d6efd;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.35;
            text-decoration: none !important;
        }

        .ecm-order-product-price {
            flex: 0 0 auto;
            color: #111827;
            font-size: 15px;
            font-weight: 800;
            line-height: 1.2;
            text-align: right;
        }

        .ecm-order-product-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .ecm-order-product-field {
            min-width: 0;
            padding: 9px 10px;
            background: #f8fafc;
            border-radius: 8px;
        }

        .ecm-order-product-label {
            display: block;
            margin-bottom: 5px;
            color: #587086;
            font-size: 10px;
            font-weight: 800;
            line-height: 1.2;
        }

        .ecm-order-product-value {
            display: block;
            color: #1e293b;
            font-size: 12px;
            font-weight: 800;
            line-height: 1.35;
            overflow-wrap: anywhere;
        }

        .ecm-order-total-table td:first-child {
            color: #64748b;
            font-size: 13px;
            font-weight: 800;
        }

        .ecm-order-total-table td:last-child {
            color: #111827;
            font-size: 13px;
            font-weight: 800;
        }

        .ecm-order-total-table tr:last-child td {
            padding-top: 14px;
            color: #111827;
            font-size: 15px;
            border-top: 1px solid #dfe8f0;
        }

        .ecm-order-total-table tr:last-child strong {
            color: #0d6efd;
            font-size: 18px;
            font-weight: 800;
        }

        @media (max-width: 768px) {
            .ecm-order-details-page {
                margin: 0 -15px;
                padding-bottom: 88px;
            }

            .ecm-order-hero {
                display: block;
                margin: 0 12px 12px;
                padding: 16px;
                border-radius: 8px;
                box-shadow: none;
            }

            .ecm-order-title {
                font-size: 20px;
            }

            .ecm-order-hero-meta {
                margin-top: 10px;
            }

            .ecm-order-hero-pill {
                min-height: 26px;
                padding: 6px 9px;
                font-size: 11px;
            }

            .ecm-order-hero-amount {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                min-width: 0;
                margin-top: 14px;
                padding: 11px 12px;
                text-align: left;
            }

            .ecm-order-panel {
                margin-right: 12px !important;
                margin-left: 12px !important;
                border-radius: 8px;
            }

            .ecm-order-panel-header,
            .ecm-order-panel-body {
                padding: 16px;
            }

            .ecm-order-info-table,
            .ecm-order-info-table tbody,
            .ecm-order-info-table tr,
            .ecm-order-info-table td {
                display: none;
            }

            .ecm-order-summary-mobile {
                display: block;
            }

            .ecm-order-summary-grid {
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }

            .ecm-order-products-wrap {
                overflow: visible !important;
            }

            .ecm-order-products-table {
                display: none;
            }

            .ecm-order-products-mobile {
                display: block;
            }

            .ecm-order-total-table td {
                padding: 11px 0;
            }

            .ecm-order-total-table tr:last-child td {
                padding-top: 15px;
            }
        }
</style>

    <div class="ecm-order-details-page">
    <!-- Order id -->
    <div class="ecm-order-hero">
        <div>
            <span class="ecm-order-kicker">{{ translate('Order details') }}</span>
            <h1 class="ecm-order-title">{{ translate('Order id') }}: {{ $order->code }}</h1>
            <div class="ecm-order-hero-meta">
                <span class="ecm-order-hero-pill">{{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}</span>
                <span class="ecm-order-hero-pill">{{ date('d', $order->date) }} {{ translate(date('F', $order->date)) }} {{ date('Y, h:i', $order->date) }} {{ translate(strtolower(date('A', $order->date))) }}</span>
            </div>
        </div>
        <div class="ecm-order-hero-amount">
            <span>{{ translate('Total') }}</span>
            <strong>{{ single_price($order->grand_total) }}</strong>
        </div>
    </div>

    <!-- Order Summary -->
    <div class="ecm-order-panel mb-4">
        <div class="ecm-order-panel-header">
            <h5>{{ translate('Order Summary') }}</h5>
        </div>
        <div class="ecm-order-panel-body">
            <div class="ecm-order-summary-mobile">
                <div class="ecm-order-summary-grid">
                    <div class="ecm-order-summary-item">
                        <span class="ecm-order-summary-label">{{ translate('Order Code') }}</span>
                        <span class="ecm-order-summary-value">{{ $order->code }}</span>
                    </div>
                    <div class="ecm-order-summary-item">
                        <span class="ecm-order-summary-label">{{ translate('Customer') }}</span>
                        <span class="ecm-order-summary-value">{{ json_decode($order->shipping_address)->name }}</span>
                    </div>
                    <div class="ecm-order-summary-item is-wide">
                        <span class="ecm-order-summary-label">{{ translate('Email') }}</span>
                        <span class="ecm-order-summary-value">
                            @if ($order->user_id != null)
                                {{ $order->user->email }}
                            @endif
                        </span>
                    </div>
                    <div class="ecm-order-summary-item is-wide">
                        <span class="ecm-order-summary-label">{{ translate('Shipping address') }}</span>
                        <span class="ecm-order-summary-value">
                            {{ json_decode($order->shipping_address)->address }},
                            {{ json_decode($order->shipping_address)->city }},
                            @if(isset(json_decode($order->shipping_address)->state)) {{ json_decode($order->shipping_address)->state }} - @endif
                            {{ json_decode($order->shipping_address)->postal_code }},
                            {{ json_decode($order->shipping_address)->country }}
                        </span>
                    </div>
                    <div class="ecm-order-summary-item">
                        <span class="ecm-order-summary-label">{{ translate('Order date') }}</span>
                        <span class="ecm-order-summary-value">{{ date('d', $order->date) }} {{ translate(date('F', $order->date)) }} {{ date('Y, h:i', $order->date) }} {{ translate(strtolower(date('A', $order->date))) }}</span>
                    </div>
                    <div class="ecm-order-summary-item">
                        <span class="ecm-order-summary-label">{{ translate('Order status') }}</span>
                        <span class="ecm-order-summary-value">{{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}</span>
                    </div>
                    <div class="ecm-order-summary-item">
                        <span class="ecm-order-summary-label">{{ translate('Total order amount') }}</span>
                        <span class="ecm-order-summary-value">{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</span>
                    </div>
                    <div class="ecm-order-summary-item">
                        <span class="ecm-order-summary-label">{{ translate('Shipping method') }}</span>
                        <span class="ecm-order-summary-value">{{ translate('Flat shipping rate') }}</span>
                    </div>
                    <div class="ecm-order-summary-item">
                        <span class="ecm-order-summary-label">{{ translate('Payment method') }}</span>
                        <span class="ecm-order-summary-value">{{ translate(ucfirst(str_replace('_', ' ', $order->payment_type))) }}</span>
                    </div>
                    <div class="ecm-order-summary-item">
                        <span class="ecm-order-summary-label">{{ translate('Additional Info') }}</span>
                        <span class="ecm-order-summary-value">{{ $order->additional_info ?: '-' }}</span>
                    </div>
                    @if ($order->tracking_code)
                        <div class="ecm-order-summary-item is-wide">
                            <span class="ecm-order-summary-label">{{ translate('Tracking code') }}</span>
                            <span class="ecm-order-summary-value">{{ $order->tracking_code }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <table class="table-borderless table ecm-order-info-table">
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order Code') }}:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Customer') }}:</td>
                            <td>{{ json_decode($order->shipping_address)->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Email') }}:</td>
                            @if ($order->user_id != null)
                                <td>{{ $order->user->email }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Shipping address') }}:</td>
                            <td>{{ json_decode($order->shipping_address)->address }},
                                {{ json_decode($order->shipping_address)->city }},
                                @if(isset(json_decode($order->shipping_address)->state)) {{ json_decode($order->shipping_address)->state }} - @endif
                                {{ json_decode($order->shipping_address)->postal_code }},
                                {{ json_decode($order->shipping_address)->country }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table-borderless table ecm-order-info-table">
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order date') }}:</td>
                            <td>{{ date('d', $order->date) }} {{ translate(date('F', $order->date)) }} {{ date('Y, h:i', $order->date) }} {{ translate(strtolower(date('A', $order->date))) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Order status') }}:</td>
                            <td>{{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Total order amount') }}:</td>
                            <td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Shipping method') }}:</td>
                            <td>{{ translate('Flat shipping rate') }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 fw-600">{{ translate('Payment method') }}:</td>
                            <td>{{ translate(ucfirst(str_replace('_', ' ', $order->payment_type))) }}</td>
                        </tr>
                        <tr>
                            <td class="text-main text-bold">{{ translate('Additional Info') }}</td>
                            <td class="">{{ $order->additional_info }}</td>
                        </tr>
                        @if ($order->tracking_code)
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Tracking code') }}:</td>
                                <td>{{ $order->tracking_code }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Details -->
    <div class="row gutters-16">
        <div class="col-md-9">
            <div class="ecm-order-panel mt-2 mb-4">
                <div class="ecm-order-panel-header">
                    <h5>{{ translate('Order Details') }}</h5>
                </div>
                <div class="ecm-order-panel-body table-responsive ecm-order-products-wrap">
                    <table class="aiz-table table ecm-order-products-table">
                        <thead class="text-gray fs-12">
                            <tr>
                                <th class="pl-0">#</th>
                                <th width="30%">{{ translate('Product') }}</th>
                                <th data-breakpoints="md">{{ translate('Variation') }}</th>
                                <th>{{ translate('Quantity') }}</th>
                                <th data-breakpoints="md">{{ translate('Delivery Type') }}</th>
                                <th>{{ translate('Price') }}</th>
                                @if (addon_is_activated('refund_request'))
                                    <th data-breakpoints="md">{{ translate('Refund') }}</th>
                                @endif
                                <th data-breakpoints="md" class="text-right pr-0">{{ translate('Review') }}</th>
                            </tr>
                        </thead>
                        <tbody class="fs-14">
                            @foreach ($order->orderDetails as $key => $orderDetail)
                                <tr>
                                    <td class="pl-0" data-label="#">{{ sprintf('%02d', $key+1) }}</td>
                                    <td data-label="{{ translate('Product') }}">
                                        @if ($orderDetail->product != null && $orderDetail->product->auction_product == 0)
                                            <a href="{{ route('product', $orderDetail->product->slug) }}"
                                                target="_blank">{{ $orderDetail->product->getTranslation('name') }}</a>
                                        @elseif($orderDetail->product != null && $orderDetail->product->auction_product == 1)
                                            <a href="{{ route('auction-product', $orderDetail->product->slug) }}"
                                                target="_blank">{{ $orderDetail->product->getTranslation('name') }}</a>
                                        @else
                                            <strong>{{ translate('Product Unavailable') }}</strong>
                                        @endif
                                    </td>
                                    <td data-label="{{ translate('Variation') }}">
                                        {{ $orderDetail->variation }}
                                    </td>
                                    <td data-label="{{ translate('Quantity') }}">
                                        {{ $orderDetail->quantity }}
                                    </td>
                                    <td data-label="{{ translate('Delivery Type') }}">
                                        @if ($order->shipping_type != null && $order->shipping_type == 'home_delivery')
                                            {{ translate('Home Delivery') }}
                                        @elseif ($order->shipping_type == 'pickup_point')
                                            @if ($order->pickup_point != null)
                                                {{ $order->pickup_point->name }} ({{ translate('Pickip Point') }})
                                            @else
                                                {{ translate('Pickup Point') }}
                                            @endif
                                        @elseif($order->shipping_type == 'carrier')
                                            @if ($order->carrier != null)
                                                {{ $order->carrier->name }} ({{ translate('Carrier') }})
                                                <br>
                                                {{ translate('Transit Time').' - '.$order->carrier->transit_time }}
                                            @else
                                                {{ translate('Carrier') }}
                                            @endif
                                        @endif
                                    </td>
                                    <td class="fw-700" data-label="{{ translate('Price') }}">{{ single_price($orderDetail->price) }}</td>
                                    @if (addon_is_activated('refund_request'))
                                        @php
                                            $no_of_max_day = get_setting('refund_request_time');
                                            $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                                            $today_date = Carbon\Carbon::now();
                                        @endphp
                                        <td data-label="{{ translate('Refund') }}">
                                            @if ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null && $today_date <= $last_refund_date && $orderDetail->payment_status == 'paid' && $orderDetail->delivery_status == 'delivered')
                                                <a href="{{ route('refund_request_send_page', $orderDetail->id) }}"
                                                    class="btn btn-primary btn-sm rounded-0">{{ translate('Send') }}</a>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                <b class="text-info">{{ translate('Pending') }}</b>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 2)
                                                <b class="text-success">{{ translate('Rejected') }}</b>
                                            @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                <b class="text-success">{{ translate('Approved') }}</b>
                                            @elseif ($orderDetail->product->refundable != 0)
                                                <b>{{ translate('N/A') }}</b>
                                            @else
                                                <b>{{ translate('Non-refundable') }}</b>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="text-xl-right pr-0" data-label="{{ translate('Review') }}">
                                        @if ($orderDetail->delivery_status == 'delivered')
                                            <a href="javascript:void(0);"
                                                onclick="product_review('{{ $orderDetail->product_id }}')"
                                                class="btn btn-primary btn-sm rounded-0"> {{ translate('Review') }} </a>
                                        @else
                                            <span class="text-danger">{{ translate('Not Delivered Yet') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="ecm-order-products-mobile">
                        @foreach ($order->orderDetails as $key => $orderDetail)
                            <div class="ecm-order-product-card">
                                <div class="ecm-order-product-top">
                                    <div>
                                        @if ($orderDetail->product != null && $orderDetail->product->auction_product == 0)
                                            <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank" class="ecm-order-product-name">
                                                {{ sprintf('%02d', $key+1) }}. {{ $orderDetail->product->getTranslation('name') }}
                                            </a>
                                        @elseif($orderDetail->product != null && $orderDetail->product->auction_product == 1)
                                            <a href="{{ route('auction-product', $orderDetail->product->slug) }}" target="_blank" class="ecm-order-product-name">
                                                {{ sprintf('%02d', $key+1) }}. {{ $orderDetail->product->getTranslation('name') }}
                                            </a>
                                        @else
                                            <strong class="ecm-order-product-name">{{ sprintf('%02d', $key+1) }}. {{ translate('Product Unavailable') }}</strong>
                                        @endif
                                    </div>
                                    <div class="ecm-order-product-price">{{ single_price($orderDetail->price) }}</div>
                                </div>

                                <div class="ecm-order-product-grid">
                                    <div class="ecm-order-product-field">
                                        <span class="ecm-order-product-label">{{ translate('Variation') }}</span>
                                        <span class="ecm-order-product-value">{{ $orderDetail->variation ?: '-' }}</span>
                                    </div>
                                    <div class="ecm-order-product-field">
                                        <span class="ecm-order-product-label">{{ translate('Quantity') }}</span>
                                        <span class="ecm-order-product-value">{{ $orderDetail->quantity }}</span>
                                    </div>
                                    <div class="ecm-order-product-field">
                                        <span class="ecm-order-product-label">{{ translate('Delivery Type') }}</span>
                                        <span class="ecm-order-product-value">
                                            @if ($order->shipping_type != null && $order->shipping_type == 'home_delivery')
                                                {{ translate('Home Delivery') }}
                                            @elseif ($order->shipping_type == 'pickup_point')
                                                @if ($order->pickup_point != null)
                                                    {{ $order->pickup_point->name }} ({{ translate('Pickip Point') }})
                                                @else
                                                    {{ translate('Pickup Point') }}
                                                @endif
                                            @elseif($order->shipping_type == 'carrier')
                                                @if ($order->carrier != null)
                                                    {{ $order->carrier->name }} ({{ translate('Carrier') }})
                                                @else
                                                    {{ translate('Carrier') }}
                                                @endif
                                            @endif
                                        </span>
                                    </div>
                                    <div class="ecm-order-product-field">
                                        <span class="ecm-order-product-label">{{ translate('Review') }}</span>
                                        <span class="ecm-order-product-value">
                                            @if ($orderDetail->delivery_status == 'delivered')
                                                <a href="javascript:void(0);" onclick="product_review('{{ $orderDetail->product_id }}')">{{ translate('Review') }}</a>
                                            @else
                                                {{ translate('Not Delivered Yet') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Ammount -->
        <div class="col-md-3">
            <div class="ecm-order-panel mt-2">
                <div class="ecm-order-panel-header">
                    <b>{{ translate('Order Ammount') }}</b>
                </div>
                <div class="ecm-order-panel-body">
                    <table class="table-borderless table ecm-order-total-table">
                        <tbody>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Subtotal') }}</td>
                                <td class="text-right">
                                    <span class="strong-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Shipping') }}</td>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Tax') }}</td>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Coupon') }}</td>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->coupon_discount) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="w-50 fw-600">{{ translate('Total') }}</td>
                                <td class="text-right">
                                    <strong>{{ single_price($order->grand_total) }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($order->manual_payment && $order->manual_payment_data == null)
                <button onclick="show_make_payment_modal({{ $order->id }})"
                    class="btn btn-block btn-primary">{{ translate('Make Payment') }}</button>
            @endif
        </div>
    </div>
    </div>
@endsection

@section('modal')
    <!-- Product Review Modal -->
    <div class="modal fade" id="product-review-modal">
        <div class="modal-dialog">
            <div class="modal-content" id="product-review-modal-content">

            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="payment_modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        function show_make_payment_modal(order_id) {
            $.post('{{ route('checkout.make_payment') }}', {
                _token: '{{ csrf_token() }}',
                order_id: order_id
            }, function(data) {
                $('#payment_modal_body').html(data);
                $('#payment_modal').modal('show');
                $('input[name=order_id]').val(order_id);
            });
        }

        function product_review(product_id) {
            $.post('{{ route('product_review_modal') }}', {
                _token: '{{ @csrf_token() }}',
                product_id: product_id
            }, function(data) {
                $('#product-review-modal-content').html(data);
                $('#product-review-modal').modal('show', {
                    backdrop: 'static'
                });
                AIZ.extra.inputRating();
            });
        }
    </script>
@endsection
