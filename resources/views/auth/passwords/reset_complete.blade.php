@extends('frontend.layouts.app')

@section('content')
<div class="py-6">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                <div class="bg-white rounded shadow-sm p-4 text-center">
                    <h1 class="h3 fw-600 mb-3">{{ translate('Password Reset Successful') }}</h1>
                    <p class="opacity-60 mb-4">
                        {{ translate('Your password has been updated. You are now logged in.') }}
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-block">{{ translate('Continue to Home') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
