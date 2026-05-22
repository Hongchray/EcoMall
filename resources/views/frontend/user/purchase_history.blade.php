@extends('frontend.layouts.user_panel')

@section('panel_content')

<style>
    .purchase-card {
        border: 1px solid #edf2f7;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
    }

    .purchase-header {
        padding: 24px 24px 10px;
        border-bottom: 1px solid #f1f5f9;
    }

    .purchase-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .purchase-table {
        margin-bottom: 0;
    }

    .purchase-table thead th {
        border: 0;
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        font-weight: 600;
        padding: 16px;
        white-space: nowrap;
    }

    .purchase-table tbody tr {
        transition: 0.2s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .purchase-table tbody tr:hover {
        background: #f8fbff;
    }

    .purchase-table tbody td {
        padding: 18px 16px;
        vertical-align: middle;
        border-top: 0;
    }

    .order-code {
        font-weight: 700;
        color: #0d6efd;
        text-decoration: none;
    }

    .order-date {
        color: #64748b;
        font-size: 13px;
    }

    .order-price {
        font-size: 15px;
        font-weight: 700;
        color: #111827;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 14px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-paid {
        background: rgba(34,197,94,.12);
        color: #16a34a;
    }

    .status-unpaid {
        background: rgba(239,68,68,.12);
        color: #dc2626;
    }

    .delivery-status {
        font-weight: 600;
        color: #334155;
    }

    .option-group {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        flex-wrap: wrap;
    }

    .action-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        position: relative;
        transition: 0.2s ease;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        border-color: #0d6efd;
        box-shadow: 0 6px 18px rgba(13,110,253,.12);
    }

    .action-btn[data-tooltip]::before,
    .reorder-btn[data-tooltip]::before {
        background: #111827;
        border-radius: 7px;
        bottom: calc(100% + 9px);
        color: #fff;
        content: attr(data-tooltip);
        font-size: 11px;
        font-weight: 800;
        left: 50%;
        line-height: 1;
        opacity: 0;
        padding: 7px 9px;
        pointer-events: none;
        position: absolute;
        transform: translate(-50%, 4px);
        transition: opacity .18s ease, transform .18s ease;
        white-space: nowrap;
        z-index: 20;
    }

    .action-btn[data-tooltip]::after,
    .reorder-btn[data-tooltip]::after {
        border: 5px solid transparent;
        border-top-color: #111827;
        bottom: calc(100% - 1px);
        content: "";
        left: 50%;
        opacity: 0;
        pointer-events: none;
        position: absolute;
        transform: translate(-50%, 4px);
        transition: opacity .18s ease, transform .18s ease;
        z-index: 20;
    }

    .action-btn[data-tooltip]:hover::before,
    .action-btn[data-tooltip]:hover::after,
    .reorder-btn[data-tooltip]:hover::before,
    .reorder-btn[data-tooltip]:hover::after {
        opacity: 1;
        transform: translate(-50%, 0);
    }

    .reorder-btn {
        border: none;
        background: #eff6ff;
        color: #0d6efd;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        position: relative;
        transition: 0.2s ease;
    }

    .reorder-btn:hover {
        background: #0d6efd;
        color: #fff;
    }

    .new-indicator {
        color: #22c55e;
        font-weight: 700;
        margin-left: 5px;
    }

    @media (max-width: 768px) {
        .purchase-card {
            margin: 0 -15px 76px;
            border-right: 0;
            border-left: 0;
            border-radius: 0;
            background: #fff;
        }

        .purchase-header {
            padding: 17px 12px 10px;
            border-bottom: 0;
        }

        .purchase-title {
            font-size: 20px;
            font-weight: 800;
            line-height: 1.2;
        }

        .purchase-card > .p-4 {
            padding: 16px 12px 24px !important;
        }
    }

    .purchase-mobile-list {
        display: none;
    }

    .purchase-mobile-card {
        margin: 0 12px 12px;
        padding: 12px;
        background: #fff;
        border: 1px solid #e7edf3;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.035);
    }

    .purchase-mobile-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 12px;
        margin-bottom: 12px;
        border-bottom: 1px solid #f1f5f9;
    }

    .purchase-mobile-code {
        color: #0d6efd;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.25;
        text-decoration: none !important;
        overflow-wrap: anywhere;
    }

    .purchase-mobile-date {
        display: block;
        margin-top: 6px;
        color: #526174;
        font-size: 11px;
        font-weight: 700;
    }

    .purchase-mobile-amount {
        flex: 0 0 auto;
        color: #111827;
        font-size: 15px;
        font-weight: 800;
        line-height: 1.2;
        text-align: right;
    }

    .purchase-mobile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 12px;
    }

    .purchase-mobile-field {
        min-width: 0;
        min-height: 64px;
        padding: 10px;
        background: #f8fafc;
        border-radius: 8px;
    }

    .purchase-mobile-label {
        display: block;
        margin-bottom: 6px;
        color: #587086;
        font-size: 10px;
        font-weight: 800;
        line-height: 1.2;
    }

    .purchase-mobile-value {
        display: block;
        color: #1e293b;
        font-size: 12px;
        font-weight: 800;
        line-height: 1.35;
        overflow-wrap: anywhere;
    }

    .purchase-mobile-actions {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 40px 40px 40px;
        gap: 7px;
        align-items: center;
    }

    @media (max-width: 768px) {
        .purchase-desktop-table {
            display: none;
        }

        .purchase-mobile-list {
            display: block;
        }

        .purchase-mobile-actions .reorder-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 8px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 800;
            text-align: center;
        }

        .purchase-mobile-actions .action-btn {
            width: 40px;
            height: 38px;
            border-radius: 8px;
        }

        .purchase-mobile-card .status-badge {
            min-width: 66px;
            padding: 7px 10px;
            border-radius: 18px;
            font-size: 11px;
            font-weight: 700;
        }
    }
</style>

<div class="purchase-card">

    <!-- Header -->
    <div class="purchase-header">
        <h5 class="purchase-title">
            {{ translate('Purchase History') }}
        </h5>
    </div>

    <!-- Table -->
    <div class="table-responsive purchase-desktop-table">
        <table class="table purchase-table aiz-table">

            <thead>
                <tr>
                    <th>{{ translate('Code')}}</th>
                    <th>{{ translate('Date')}}</th>
                    <th>{{ translate('Amount')}}</th>
                    <th>{{ translate('Delivery Status')}}</th>
                    <th>{{ translate('Payment Status')}}</th>
                    <th class="text-right">{{ translate('Options')}}</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($orders as $key => $order)

                    @if (count($order->orderDetails) > 0)

                        <tr>

                            <!-- CODE -->
                            <td data-label="{{ translate('Code')}}">
                                <a href="{{route('purchase_history.details', encrypt($order->id))}}"
                                   class="order-code">
                                    {{ $order->code }}
                                </a>
                            </td>

                            <!-- DATE -->
                            <td data-label="{{ translate('Date')}}">
                                <span class="order-date">
                                    {{ date('d M Y', $order->date) }}
                                </span>
                            </td>

                            <!-- AMOUNT -->
                            <td data-label="{{ translate('Amount')}}">
                                <span class="order-price">
                                    {{ single_price($order->grand_total) }}
                                </span>
                            </td>

                            <!-- DELIVERY -->
                            <td data-label="{{ translate('Delivery Status')}}">

                                <span class="delivery-status">
                                    {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}
                                </span>

                                @if($order->delivery_viewed == 0)
                                    <span class="new-indicator">*</span>
                                @endif

                            </td>

                            <!-- PAYMENT -->
                            <td data-label="{{ translate('Payment Status')}}">

                                @if ($order->payment_status == 'paid')

                                    <span class="status-badge status-paid">
                                        {{translate('Paid')}}
                                    </span>

                                @else

                                    <span class="status-badge status-unpaid">
                                        {{translate('Unpaid')}}
                                    </span>

                                @endif

                                @if($order->payment_status_viewed == 0)
                                    <span class="new-indicator">*</span>
                                @endif

                            </td>

                            <!-- OPTIONS -->
                            <td class="text-right" data-label="{{ translate('Options')}}">

                                <div class="option-group">

                                    <!-- REORDER -->
                                    <a class="reorder-btn"
                                       href="{{ route('re_order', encrypt($order->id)) }}"
                                       data-tooltip="{{ translate('Reorder') }}">
                                        {{ translate('Reorder') }}
                                    </a>

                                    <!-- CANCEL -->
                                    @if ($order->delivery_status == 'pending' && $order->payment_status == 'unpaid')

                                        <a href="javascript:void(0)"
                                           class="action-btn confirm-delete"
                                           data-href="{{route('purchase_history.destroy', $order->id)}}"
                                           data-tooltip="{{ translate('Delete') }}"
                                           title="{{ translate('Delete') }}">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 width="14"
                                                 height="14"
                                                 viewBox="0 0 9.202 12">
                                                <path d="M15.041,7.608l-.193,5.85a1.927,1.927,0,0,1-1.933,1.864H9.243A1.927,1.927,0,0,1,7.31,13.46L7.117,7.608a.483.483,0,0,1,.966-.032l.193,5.851a.966.966,0,0,0,.966.929h3.672a.966.966,0,0,0,.966-.931l.193-5.849a.483.483,0,1,1,.966.032Zm.639-1.947a.483.483,0,0,1-.483.483H6.961a.483.483,0,1,1,0-.966h1.5a.617.617,0,0,0,.615-.555,1.445,1.445,0,0,1,1.442-1.3h1.126a1.445,1.445,0,0,1,1.442,1.3.617.617,0,0,0,.615.555h1.5a.483.483,0,0,1,.483.483Z"
                                                      transform="translate(-6.478 -3.322)"
                                                      fill="#ef4444"/>
                                            </svg>

                                        </a>

                                    @endif

                                    <!-- DETAILS -->
                                    <a href="{{route('purchase_history.details', encrypt($order->id))}}"
                                       class="action-btn"
                                       data-tooltip="{{ translate('View') }}"
                                       title="{{ translate('Order Details') }}">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="14"
                                             height="14"
                                             viewBox="0 0 12 10">
                                            <g transform="translate(-1339 -422)">
                                                <rect width="12" height="1" transform="translate(1339 422)" fill="#3b82f6"/>
                                                <rect width="12" height="1" transform="translate(1339 425)" fill="#3b82f6"/>
                                                <rect width="12" height="1" transform="translate(1339 428)" fill="#3b82f6"/>
                                                <rect width="12" height="1" transform="translate(1339 431)" fill="#3b82f6"/>
                                            </g>
                                        </svg>

                                    </a>

                                    <!-- INVOICE -->
                                    <a href="{{ route('invoice.download', $order->id) }}"
                                       class="action-btn"
                                       data-tooltip="{{ translate('Download') }}"
                                       title="{{ translate('Download Invoice') }}">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             width="14"
                                             height="14"
                                             viewBox="0 0 12 12.001">
                                            <g transform="translate(-1341 -424.999)">
                                                <path d="M13936.389,851.5l.707-.707,2.355,2.355V846h1v7.1l2.306-2.306.707.707-3.538,3.538Z"
                                                      transform="translate(-12592.95 -421)"
                                                      fill="#f59e0b"/>
                                                <rect width="12" height="1"
                                                      transform="translate(1341 436)"
                                                      fill="#f59e0b"/>
                                            </g>
                                        </svg>

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endif

                @endforeach

            </tbody>

        </table>
    </div>

    <div class="purchase-mobile-list">
        @foreach ($orders as $key => $order)
            @if (count($order->orderDetails) > 0)
                <div class="purchase-mobile-card">
                    <div class="purchase-mobile-top">
                        <div>
                            <a href="{{route('purchase_history.details', encrypt($order->id))}}" class="purchase-mobile-code">
                                {{ $order->code }}
                            </a>
                            <span class="purchase-mobile-date">
                                {{ date('d', $order->date) }} {{ translate(date('F', $order->date)) }} {{ date('Y', $order->date) }}
                            </span>
                        </div>
                        <div class="purchase-mobile-amount">{{ single_price($order->grand_total) }}</div>
                    </div>

                    <div class="purchase-mobile-grid">
                        <div class="purchase-mobile-field">
                            <span class="purchase-mobile-label">{{ translate('Delivery Status') }}</span>
                            <span class="purchase-mobile-value">
                                {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}
                                @if($order->delivery_viewed == 0)
                                    <span class="new-indicator">*</span>
                                @endif
                            </span>
                        </div>
                        <div class="purchase-mobile-field">
                            <span class="purchase-mobile-label">{{ translate('Payment Status') }}</span>
                            @if ($order->payment_status == 'paid')
                                <span class="status-badge status-paid">{{translate('Paid')}}</span>
                            @else
                                <span class="status-badge status-unpaid">{{translate('Unpaid')}}</span>
                            @endif
                            @if($order->payment_status_viewed == 0)
                                <span class="new-indicator">*</span>
                            @endif
                        </div>
                    </div>

                    <div class="purchase-mobile-actions">
                        <a class="reorder-btn" href="{{ route('re_order', encrypt($order->id)) }}">
                            {{ translate('Reorder') }}
                        </a>

                        @if ($order->delivery_status == 'pending' && $order->payment_status == 'unpaid')
                            <a href="javascript:void(0)"
                               class="action-btn confirm-delete"
                               data-href="{{route('purchase_history.destroy', $order->id)}}"
                               title="{{ translate('Cancel') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 9.202 12">
                                    <path d="M15.041,7.608l-.193,5.85a1.927,1.927,0,0,1-1.933,1.864H9.243A1.927,1.927,0,0,1,7.31,13.46L7.117,7.608a.483.483,0,0,1,.966-.032l.193,5.851a.966.966,0,0,0,.966.929h3.672a.966.966,0,0,0,.966-.931l.193-5.849a.483.483,0,1,1,.966.032Zm.639-1.947a.483.483,0,0,1-.483.483H6.961a.483.483,0,1,1,0-.966h1.5a.617.617,0,0,0,.615-.555,1.445,1.445,0,0,1,1.442-1.3h1.126a1.445,1.445,0,0,1,1.442,1.3.617.617,0,0,0,.615.555h1.5a.483.483,0,0,1,.483.483Z" transform="translate(-6.478 -3.322)" fill="#ef4444"/>
                                </svg>
                            </a>
                        @else
                            <span></span>
                        @endif

                        <a href="{{route('purchase_history.details', encrypt($order->id))}}" class="action-btn" title="{{ translate('Order Details') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 10">
                                <g transform="translate(-1339 -422)">
                                    <rect width="12" height="1" transform="translate(1339 422)" fill="#3b82f6"/>
                                    <rect width="12" height="1" transform="translate(1339 425)" fill="#3b82f6"/>
                                    <rect width="12" height="1" transform="translate(1339 428)" fill="#3b82f6"/>
                                    <rect width="12" height="1" transform="translate(1339 431)" fill="#3b82f6"/>
                                </g>
                            </svg>
                        </a>

                        <a href="{{ route('invoice.download', $order->id) }}" class="action-btn" title="{{ translate('Download Invoice') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 12 12.001">
                                <g transform="translate(-1341 -424.999)">
                                    <path d="M13936.389,851.5l.707-.707,2.355,2.355V846h1v7.1l2.306-2.306.707.707-3.538,3.538Z" transform="translate(-12592.95 -421)" fill="#f59e0b"/>
                                    <rect width="12" height="1" transform="translate(1341 436)" fill="#f59e0b"/>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="p-4">
        <div class="aiz-pagination">
            {{ $orders->links() }}
        </div>
    </div>

</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
