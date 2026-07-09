@extends('frontend.layouts.app')

@section('content')
<div class="py-6">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                <div class="bg-white rounded shadow-sm p-4 text-left">
                    <h1 class="h3 fw-600 mb-3">{{ translate('Verify Your Email Address') }}</h1>
                    <p class="opacity-60">
                        {{ translate('We sent a 6-digit verification code to') }} <strong>{{ $email }}</strong>.
                        {{ translate('Please enter it below to complete your registration.') }}
                    </p>

                    <div class="alert alert-warning" role="alert">
                        {{ translate("Don't see the email? Please also check your Spam or Junk folder.") }}
                    </div>

                    <form method="POST" action="{{ route('otp.verify') }}" class="mt-3">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label" for="code">{{ translate('Verification Code') }}</label>
                            <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror"
                                inputmode="numeric" maxlength="6" autocomplete="one-time-code" autofocus>
                            @error('code')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">{{ translate('Verify') }}</button>
                    </form>

                    <form method="POST" action="{{ route('otp.resend') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-block">{{ translate('Resend Code') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
