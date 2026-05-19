@extends('frontend.layouts.app')

@section('content')
<style>
    .auth-section {
        background: linear-gradient(135deg, #f8f9ff 0%, #eef2ff 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding: 60px 0;
    }

    .auth-card {
    border: 0;
    border-radius: 28px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
}

.auth-card .row {
    min-height: 720px;
}

.auth-image-side {
    position: relative;
    width: 100%;
    height: 100%;
    min-height: 720px;
    overflow: hidden;
}

.auth-side-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.auth-image-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(17,24,39,.35),
        rgba(17,24,39,.05)
    );
}

    .auth-left {
        padding: 50px;
    }

    .auth-title {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 10px;
    }

    .auth-subtitle {
        color: #6b7280;
        font-size: 15px;
        margin-bottom: 35px;
    }

    .auth-label {
        font-size: 13px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }

    .auth-input {
        height: 52px;
        border-radius: 14px !important;
        border: 1px solid #e5e7eb;
        padding: 0 18px;
        font-size: 14px;
        transition: all .25s ease;
        box-shadow: none !important;
    }

    .auth-input:focus {
        border-color: #4f46e5;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, .08) !important;
    }

    .auth-btn {
        height: 54px;
        border-radius: 14px;
        font-size: 15px;
        font-weight: 700;
        border: 0;
        transition: all .25s ease;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    }

    .auth-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(79, 70, 229, .25);
    }

    .auth-link {
        color: #4f46e5;
        transition: .2s ease;
    }

    .auth-link:hover {
        color: #4338ca;
        text-decoration: none;
    }

    .social-login li a {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        background: #f9fafb;
        color: #374151;
        transition: all .25s ease;
    }

    .social-login li a:hover {
        transform: translateY(-3px);
        background: #4f46e5;
        color: #fff;
    }

    .auth-image-side {
        position: relative;
        min-height: 100%;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    }

    .auth-image-side img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .auth-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(17,24,39,.5), rgba(17,24,39,.1));
    }

    .demo-table {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #eef2f7;
    }

    .demo-table td {
        padding: 14px 18px;
        vertical-align: middle;
    }

    .demo-btn {
        border-radius: 10px;
        font-size: 12px;
        font-weight: 600;
        padding: 8px 14px;
    }

    .divider {
        position: relative;
        text-align: center;
        margin: 28px 0;
    }

    .divider::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        height: 1px;
        background: #e5e7eb;
    }

    .divider span {
        position: relative;
        background: #fff;
        padding: 0 14px;
        color: #9ca3af;
        font-size: 13px;
    }

    @media (max-width: 991px) {
        .auth-left {
            padding: 35px 25px;
        }

        .auth-title {
            font-size: 28px;
        }

        .auth-image-side {
            display: none;
        }
    }
</style>

<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11">
                <div class="card auth-card">
                    <div class="row no-gutters">

                        <!-- Left Side -->
                        <div class="col-lg-6">
                            <div class="auth-left">

                                <!-- Header -->
                                <div class="text-center mb-4">
                                    <h1 class="auth-title">
                                        {{ translate('welcome_back') }}
                                    </h1>

                                    <p class="auth-subtitle">
                                        {{ translate('login_to_continue_your_shopping_experience') }}
                                    </p>
                                </div>


                                <!-- Login Form -->
                                <form class="form-default" role="form" action="{{ route('login') }}" method="POST">
                                    @csrf

                                    @if (addon_is_activated('otp_system'))

                                        <!-- Phone -->
                                        <div class="form-group phone-form-group mb-3">
                                            <label for="phone" class="auth-label">
                                                {{ translate('Phone') }}
                                            </label>

                                            <input type="tel"
                                                id="phone-code"
                                                class="form-control auth-input {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                                                value="{{ old('phone') }}"
                                                name="phone"
                                                autocomplete="off">
                                        </div>

                                        <input type="hidden" name="country_code" value="">

                                        <!-- Email -->
                                        <div class="form-group email-form-group mb-3 d-none">
                                            <label for="email" class="auth-label">
                                                {{ translate('Email') }}
                                            </label>

                                            <input type="email"
                                                class="form-control auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                value="{{ old('email') }}"
                                                placeholder="{{ translate('Email') }}"
                                                name="email"
                                                id="email"
                                                autocomplete="off">

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback d-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-right mb-3">
                                            <button class="btn btn-link p-0 auth-link"
                                                type="button"
                                                onclick="toggleEmailPhone(this)">
                                                {{ translate('Use Email Instead') }}
                                            </button>
                                        </div>

                                    @else

                                        <!-- Email -->
                                        <div class="form-group mb-3">
                                            <label for="email" class="auth-label">
                                                {{ translate('Email') }}
                                            </label>

                                            <input type="email"
                                                class="form-control auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                value="{{ old('email') }}"
                                                placeholder="{{ translate('email') }}"
                                                name="email"
                                                id="email"
                                                autocomplete="off">

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback d-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                    @endif

                                    <!-- Password -->
                                    <div class="form-group mb-2">
                                        <label for="password" class="auth-label">
                                            {{ translate('Password') }}
                                        </label>

                                        <input type="password"
                                            class="form-control auth-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            placeholder="{{ translate('Password') }}"
                                            name="password"
                                            id="password">
                                    </div>

                                    <!-- Options -->
                                    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">

                                        <label class="aiz-checkbox mb-0">
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="has-transition fs-13 text-gray-dark">
                                                {{ translate('Remember Me') }}
                                            </span>
                                            <span class="aiz-square-check"></span>
                                        </label>

                                        <a href="{{ route('password.request') }}"
                                            class="fs-13 auth-link fw-600">
                                            {{ translate('Forgot password?') }}
                                        </a>
                                    </div>

                                    <!-- Submit -->
                                    <button type="submit"
                                        class="btn btn-primary btn-block auth-btn">
                                        {{ translate('Login') }}
                                    </button>
                                </form>

                                <!-- Demo -->
                                @if (env("DEMO_MODE") == "On")
                                    <div class="mt-4">
                                        <table class="table demo-table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>{{ translate('Customer Account') }}</td>
                                                    <td class="text-right">
                                                        <button class="btn btn-primary demo-btn"
                                                            onclick="autoFillCustomer()">
                                                            {{ translate('Copy credentials') }}
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                <!-- Social Login -->
                                @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)

                                    <div class="divider">
                                        <span>{{ translate('Or Login With') }}</span>
                                    </div>

                                    <ul class="list-inline social-login text-center mb-4">

                                        @if (get_setting('facebook_login') == 1)
                                            <li class="list-inline-item mx-1">
                                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}">
                                                    <i class="lab la-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @if(get_setting('google_login') == 1)
                                            <li class="list-inline-item mx-1">
                                                <a href="{{ route('social.login', ['provider' => 'google']) }}">
                                                    <i class="lab la-google"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @if (get_setting('twitter_login') == 1)
                                            <li class="list-inline-item mx-1">
                                                <a href="{{ route('social.login', ['provider' => 'twitter']) }}">
                                                    <i class="lab la-twitter"></i>
                                                </a>
                                            </li>
                                        @endif

                                        @if (get_setting('apple_login') == 1)
                                            <li class="list-inline-item mx-1">
                                                <a href="{{ route('social.login', ['provider' => 'apple']) }}">
                                                    <i class="lab la-apple"></i>
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                @endif

                                <!-- Register -->
                                <div class="text-center">
                                    <p class="fs-13 text-muted mb-1">
                                        {{ translate('Dont have an account?') }}
                                    </p>

                                    <a href="{{ route('user.registration') }}"
                                        class="auth-link fw-700 fs-15">
                                        {{ translate('Create Account') }}
                                    </a>
                                </div>

                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="col-lg-6 d-none d-lg-flex p-0">
                            <div class="auth-image-side">

                               <img
                                    src="{{ get_setting('login_page_image') && is_numeric(get_setting('login_page_image'))
                                            ? uploaded_asset(get_setting('login_page_image'))
                                            : 'https://static.vecteezy.com/system/resources/thumbnails/003/689/228/small_2x/online-registration-or-sign-up-login-for-account-on-smartphone-app-user-interface-with-secure-password-mobile-application-for-ui-web-banner-access-cartoon-people-illustration-vector.jpg' }}"
                                    alt="Login Image"
                                    class="auth-side-image"
                                >

                                <div class="auth-image-overlay"></div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
    function autoFillSeller() {
        $('#email').val('seller@example.com');
        $('#password').val('123456');
    }

    function autoFillCustomer() {
        $('#email').val('customer@example.com');
        $('#password').val('123456');
    }

    function autoFillDeliveryBoy() {
        $('#email').val('deliveryboy@example.com');
        $('#password').val('123456');
    }
</script>
@endsection
