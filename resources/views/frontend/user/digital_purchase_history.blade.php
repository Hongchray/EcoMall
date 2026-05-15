@extends('frontend.layouts.user_panel')

@section('panel_content')
    <style>
        .downloads-panel {
            border: 1px solid #edf2f7;
            border-radius: 20px;
            overflow: hidden;
            background: #fff;
        }

        .downloads-header {
            padding: 24px;
            border-bottom: 1px solid #f1f5f9;
        }

        .downloads-title {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .downloads-table {
            margin-bottom: 0;
        }

        .downloads-table thead th {
            border: 0;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            font-weight: 600;
            padding: 16px 24px;
            white-space: nowrap;
        }

        .downloads-table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: 0.2s ease;
        }

        .downloads-table tbody tr:hover {
            background: #f8fbff;
        }

        .downloads-table tbody td {
            padding: 18px 24px;
            vertical-align: middle;
            border-top: 0;
        }

        .download-product {
            display: flex;
            align-items: center;
            min-width: 0;
            color: #1e293b;
            text-decoration: none;
        }

        .download-product:hover {
            color: #0d6efd;
            text-decoration: none;
        }

        .download-thumb {
            width: 72px;
            height: 72px;
            flex: 0 0 72px;
            border-radius: 14px;
            border: 1px solid #edf2f7;
            background: #f8fafc;
            object-fit: cover;
        }

        .download-product-name {
            display: block;
            margin-left: 14px;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.35;
            color: inherit;
        }

        .download-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 38px;
            padding: 9px 14px;
            border-radius: 12px;
            background: #eff6ff;
            color: #0d6efd;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s ease;
            white-space: nowrap;
        }

        .download-action:hover {
            background: #0d6efd;
            color: #fff;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(13, 110, 253, .18);
            transform: translateY(-1px);
        }

        .download-action svg path,
        .download-action svg rect {
            fill: currentColor;
        }

        .downloads-empty {
            padding: 42px 24px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .downloads-header {
                padding: 20px;
            }

            .downloads-table thead {
                display: none;
            }

            .downloads-table,
            .downloads-table tbody,
            .downloads-table tr,
            .downloads-table td {
                display: block;
                width: 100%;
            }

            .downloads-table tr {
                padding: 16px;
            }

            .downloads-table tbody td {
                padding: 0;
            }

            .downloads-table tbody td + td {
                margin-top: 14px;
                text-align: left !important;
            }

            .download-thumb {
                width: 64px;
                height: 64px;
                flex-basis: 64px;
            }
        }
    </style>

    <div class="downloads-panel">
        <div class="downloads-header">
            <h5 class="downloads-title">{{ translate('Download Your Products') }}</h5>
        </div>

        <div class="table-responsive">
            <table class="table downloads-table aiz-table">
                <thead>
                    <tr>
                        <th>{{ translate('Product')}}</th>
                        <th class="text-right" width="24%">{{ translate('Option')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $key => $order_id)
                        @php
                            $order = get_order_details($order_id->id);
                        @endphp
                        @if ($order && $order->product)
                            <tr>
                                <td>
                                    <a href="{{ route('product', $order->product->slug) }}" class="download-product">
                                        <img class="lazyload download-thumb"
                                             src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                             data-src="{{ uploaded_asset($order->product->thumbnail_img) }}"
                                             alt="{{  $order->product->getTranslation('name')  }}"
                                             onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                        <span class="download-product-name">{{ $order->product->getTranslation('name') }}</span>
                                    </a>
                                </td>
                                <td class="text-right">
                                    <a class="download-action" href="{{route('digital-products.download', encrypt($order->product->id))}}" title="{{ translate('Download') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12.001" viewBox="0 0 12 12.001">
                                            <g transform="translate(-1341 -424.999)">
                                                <path d="M13936.389,851.5l.707-.707,2.355,2.355V846h1v7.1l2.306-2.306.707.707-3.538,3.538Z" transform="translate(-12592.95 -421)"/>
                                                <rect width="12" height="1" transform="translate(1341 436)"/>
                                            </g>
                                        </svg>
                                        <span>{{ translate('Download') }}</span>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="2">
                                <div class="downloads-empty">{{ translate('No history found.') }}</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
