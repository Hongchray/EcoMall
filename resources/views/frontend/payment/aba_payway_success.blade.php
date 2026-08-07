@extends('frontend.layouts.app')

@section('content')
<section class="my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card border-0 shadow-sm rounded-lg text-center p-5">
                    <div class="mb-3">
                        <i class="las la-check-circle text-success" style="font-size:64px;"></i>
                    </div>
                    <h4 class="fw-700 mb-2">{{ translate('Payment Successful!') }}</h4>
                    <p class="text-muted mb-1">{{ translate('Transaction ID') }}: {{ $tran_id }}</p>

                    @if($order)
                        <p class="text-muted mb-4">
                            {{ translate('Order') }} #{{ $order->id }} — {{ translate('Status') }}: {{ ucfirst($order->payment_status) }}
                        </p>
                    @endif

                    <a href="{{ route('order_confirmed') }}" class="btn btn-primary">
                        {{ translate('View Order Details') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
