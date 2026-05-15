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
        transition: 0.2s ease;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        border-color: #0d6efd;
        box-shadow: 0 6px 18px rgba(13,110,253,.12);
    }

    .reorder-btn {
        border: none;
        background: #eff6ff;
        color: #0d6efd;
        padding: 10px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
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

        .purchase-table thead {
            display: none;
        }

        .purchase-table,
        .purchase-table tbody,
        .purchase-table tr,
        .purchase-table td {
            display: block;
            width: 100%;
        }

        .purchase-table tr {
            border: 1px solid #edf2f7;
            border-radius: 16px;
            margin-bottom: 16px;
            padding: 10px;
        }

        .purchase-table td {
            padding: 10px 12px;
            text-align: left !important;
        }

        .option-group {
            justify-content: flex-start;
            margin-top: 10px;
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
    <div class="table-responsive">
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
                            <td>
                                <a href="{{route('purchase_history.details', encrypt($order->id))}}"
                                   class="order-code">
                                    {{ $order->code }}
                                </a>
                            </td>

                            <!-- DATE -->
                            <td>
                                <span class="order-date">
                                    {{ date('d M Y', $order->date) }}
                                </span>
                            </td>

                            <!-- AMOUNT -->
                            <td>
                                <span class="order-price">
                                    {{ single_price($order->grand_total) }}
                                </span>
                            </td>

                            <!-- DELIVERY -->
                            <td>

                                <span class="delivery-status">
                                    {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}
                                </span>

                                @if($order->delivery_viewed == 0)
                                    <span class="new-indicator">*</span>
                                @endif

                            </td>

                            <!-- PAYMENT -->
                            <td>

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
                            <td class="text-right">

                                <div class="option-group">

                                    <!-- REORDER -->
                                    <a class="reorder-btn"
                                       href="{{ route('re_order', encrypt($order->id)) }}">
                                        {{ translate('Reorder') }}
                                    </a>

                                    <!-- CANCEL -->
                                    @if ($order->delivery_status == 'pending' && $order->payment_status == 'unpaid')

                                        <a href="javascript:void(0)"
                                           class="action-btn confirm-delete"
                                           data-href="{{route('purchase_history.destroy', $order->id)}}"
                                           title="{{ translate('Cancel') }}">

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
