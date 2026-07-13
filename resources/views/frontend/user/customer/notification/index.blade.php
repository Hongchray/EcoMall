<style id="ecm-notifications-page-design">
.ecm-notifications-page {
    padding-bottom: 12px;
}

.ecm-notifications-hero {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 22px 24px;
    margin-bottom: 14px;
    color: #ffffff;
    background: linear-gradient(135deg, #1d8ec5 0%, #34a6dc 54%, #69c27d 100%);
    border-radius: 8px;
    box-shadow: 0 16px 32px rgba(29, 142, 197, 0.18);
}

.ecm-notifications-kicker {
    display: block;
    margin-bottom: 5px;
    color: rgba(255, 255, 255, 0.78);
    font-size: 11px;
    font-weight: 800;
    line-height: 1;
    text-transform: uppercase;
}

.ecm-notifications-hero h5 {
    margin: 0;
    color: #ffffff;
    font-size: 24px;
    font-weight: 800;
    line-height: 1.15;
}

.ecm-notifications-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
    min-width: 42px;
    height: 42px;
    padding: 0 12px;
    color: #1e6f9d;
    background: #ffffff;
    border-radius: 21px;
    font-size: 15px;
    font-weight: 800;
    box-shadow: 0 8px 18px rgba(17, 24, 39, 0.12);
}

.ecm-notifications-list {
    display: grid;
    gap: 10px;
}

.ecm-notification-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    min-width: 0;
    padding: 14px;
    color: #111827 !important;
    background: #ffffff;
    border: 1px solid #e7edf3;
    border-radius: 8px;
    box-shadow: 0 8px 22px rgba(17, 24, 39, 0.045);
    text-decoration: none !important;
    transition: border-color 0.18s ease, box-shadow 0.18s ease, transform 0.18s ease;
}

.ecm-notification-row:hover {
    border-color: #bfe0f2;
    box-shadow: 0 12px 28px rgba(52, 155, 212, 0.12);
    transform: translateY(-1px);
}

.ecm-notification-row-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 42px;
    width: 42px;
    height: 42px;
    color: #2095cf;
    background: #eaf7fd;
    border-radius: 8px;
    font-size: 23px;
}

.ecm-notification-row-content {
    display: block;
    min-width: 0;
    flex: 1 1 auto;
}

.ecm-notification-row-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 5px;
}

.ecm-notification-row-title {
    min-width: 0;
    color: #101828;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.25;
}

.ecm-notification-row-chip {
    display: inline-flex;
    align-items: center;
    flex: 0 0 auto;
    max-width: 118px;
    min-height: 24px;
    padding: 4px 9px;
    color: #1d7e4f;
    background: #e9f8ef;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 800;
    line-height: 1.2;
    text-align: center;
}

.ecm-notification-row-message {
    display: block;
    color: #4b5563;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.45;
}

.ecm-notification-row-message strong {
    color: #168dcc;
    font-weight: 800;
}

.ecm-notification-row-time {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-top: 8px;
    color: #8b98a7;
    font-size: 12px;
    font-weight: 700;
    line-height: 1.25;
}

.ecm-notification-row-arrow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 22px;
    width: 22px;
    height: 42px;
    color: #b2bfca;
    font-size: 16px;
}

.ecm-notifications-empty {
    padding: 42px 18px;
    color: #6b7280;
    background: #ffffff;
    border: 1px dashed #dbe5ed;
    border-radius: 8px;
    text-align: center;
}

.ecm-notifications-empty span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    margin-bottom: 12px;
    color: #9db0bf;
    background: #f2f6f9;
    border-radius: 24px;
    font-size: 26px;
}

.ecm-notifications-empty h6 {
    margin: 0;
    color: #374151;
    font-size: 15px;
    font-weight: 800;
}

.ecm-notifications-pagination {
    margin-top: 18px;
}

@media (max-width: 767.98px) {
    .ecm-notifications-page {
        padding: 0 0 86px;
    }

    .ecm-notifications-hero {
        padding: 18px 16px;
        margin: 0 0 12px;
        border-radius: 0;
        box-shadow: none;
    }

    .ecm-notifications-hero h5 {
        font-size: 22px;
    }

    .ecm-notifications-list {
        gap: 8px;
    }

    .ecm-notification-row {
        padding: 13px 12px;
        border-right: 0;
        border-left: 0;
        border-radius: 0;
        box-shadow: none;
    }

    .ecm-notification-row-icon {
        flex-basis: 38px;
        width: 38px;
        height: 38px;
        font-size: 21px;
    }

    .ecm-notification-row-top {
        display: block;
    }

    .ecm-notification-row-chip {
        margin-top: 6px;
    }

    .ecm-notification-row-arrow {
        display: none;
    }

    .ecm-notifications-pagination {
        padding: 0 12px;
</style>
@extends('frontend.layouts.user_panel')

@section('panel_content')

<div class="ecm-notifications-page">
    <div class="ecm-notifications-hero">
        <div>
            <span class="ecm-notifications-kicker">{{ translate('Account updates') }}</span>
            <h5>{{ translate('Notifications') }}</h5>
        </div>
        <span class="ecm-notifications-count">{{ $notifications->total() }}</span>
    </div>

    <div class="ecm-notifications-list">
        @forelse($notifications as $notification)
            @if($notification->type == 'App\Notifications\OrderNotification')
                @php
                    $status = ucfirst(str_replace('_', ' ', $notification->data['status']));
                @endphp
                <a class="ecm-notification-row" href="{{ route('purchase_history.details', encrypt($notification->data['order_id'])) }}">
                    <span class="ecm-notification-row-icon">
                        <i class="las la-receipt"></i>
                    </span>
                    <span class="ecm-notification-row-content">
                        <span class="ecm-notification-row-top">
                            <span class="ecm-notification-row-title">{{ translate('Order placed') }}</span>
                            <span class="ecm-notification-row-chip">{{ translate($status) }}</span>
                        </span>
                        <span class="ecm-notification-row-message">
                            {{ translate('your_order') }}:<strong>{{ $notification->data['order_code'] }}</strong>
                            {{ translate('has_been_'.$notification->data['status']) }}
                        </span>
                        <span class="ecm-notification-row-time">
                            <i class="las la-clock"></i>
                            {{ translate(date("F", strtotime($notification->created_at))) }}
                            {{ date("j Y, g:i", strtotime($notification->created_at)) }}
                            {{ translate(date("a", strtotime($notification->created_at))) }}
                        </span>
                    </span>
                    <span class="ecm-notification-row-arrow">
                        <i class="las la-angle-right"></i>
                    </span>
                </a>
            @endif
        @empty
            <div class="ecm-notifications-empty">
                <span><i class="las la-bell-slash"></i></span>
                <h6>{{ translate('No notification found') }}</h6>
            </div>
        @endforelse
    </div>

    <div class="aiz-pagination ecm-notifications-pagination">
        {{ $notifications->links() }}
    </div>
</div>

@endsection

@section('modal')
    <!-- Delete modal -->
    @include('modals.delete_modal')

    <!-- Rrder details modal -->
    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

    <!-- Payment modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div id="payment_modal_body">

                </div>
            </div>
        </div>
    </div>
@endsection

