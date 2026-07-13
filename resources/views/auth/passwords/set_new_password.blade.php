@extends('frontend.layouts.app')

@section('content')
<div class="py-6">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                <div class="bg-white rounded shadow-sm p-4 text-left">
                    <h1 class="h3 fw-600 mb-3">{{ translate('Set New Password') }}</h1>
                    <p class="opacity-60">
                        {{ translate('Your code has been verified. Please enter your new password below.') }}
                    </p>

                    <form method="POST" action="{{ route('password.reset.complete') }}" class="mt-3">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label" for="password">{{ translate('New Password') }}</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autofocus>
                            @error('password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label" for="password_confirmation">{{ translate('Confirm Password') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">{{ translate('Reset Password') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
