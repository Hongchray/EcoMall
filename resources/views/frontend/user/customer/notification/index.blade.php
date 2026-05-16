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
                            {{ translate('Your Order: ') }}<strong>{{ $notification->data['order_code'] }}</strong>
                            {{ translate(' has been '. $status) }}
                        </span>
                        <span class="ecm-notification-row-time">
                            <i class="las la-clock"></i>
                            {{ date("F j Y, g:i a", strtotime($notification->created_at)) }}
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
