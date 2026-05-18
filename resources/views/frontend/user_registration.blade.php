@extends('frontend.layouts.app')

@section('content')
    <style>
        .ecm-register-page {
            background: linear-gradient(180deg, #f7fbfd 0%, #eef7fb 100%);
            padding: 48px 0;
        }

        .ecm-register-shell {
            background: #fff;
            border: 1px solid #e4edf2;
            border-radius: 18px;
            box-shadow: 0 22px 70px rgba(18, 54, 78, .12);
            overflow: hidden;
        }

        .ecm-register-form {
            padding: 42px;
        }

        .ecm-register-title {
            color: #12364e;
            font-size: 28px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .ecm-register-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 28px;
        }

        .ecm-register-form .form-group {
            margin-bottom: 18px;
        }

        .ecm-register-form label {
            color: #334155;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .ecm-register-form .form-control {
            background: #f8fbfd;
            border: 1px solid #dbe7ee;
            border-radius: 10px !important;
            color: #12364e;
            min-height: 46px;
            padding: 11px 14px;
            transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
        }

        .ecm-register-form .form-control:focus {
            background: #fff;
            border-color: #3c9bd3;
            box-shadow: 0 0 0 4px rgba(60, 155, 211, .12);
        }

        .ecm-register-form .btn-primary {
            background: #3c9bd3;
            border-color: #3c9bd3;
            border-radius: 10px !important;
            min-height: 48px;
            transition: background-color .2s ease, border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .ecm-register-form .btn-primary:hover {
            background: #2f88bd;
            border-color: #2f88bd;
            box-shadow: 0 10px 28px rgba(60, 155, 211, .25);
            transform: translateY(-1px);
        }

        .ecm-register-login {
            background: #f8fbfd;
            border: 1px solid #e4edf2;
            border-radius: 12px;
            padding: 14px;
        }

        .ecm-register-visual {
            background: #eaf6fb;
            height: 100%;
            min-height: 620px;
            position: relative;
        }

        .ecm-register-visual img {
            height: 100%;
            object-fit: cover;
            width: 100%;
        }

        .ecm-register-visual-panel {
            background: rgba(18, 54, 78, .82);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 16px;
            bottom: 28px;
            color: #fff;
            left: 28px;
            padding: 22px;
            position: absolute;
            right: 28px;
        }

        .ecm-register-visual-panel h2 {
            color: #fff;
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .ecm-register-visual-panel p {
            color: rgba(255, 255, 255, .82);
            font-size: 13px;
            margin: 0;
        }

        .ecm-register-divider {
            align-items: center;
            color: #94a3b8;
            display: flex;
            font-size: 12px;
            gap: 12px;
            margin: 20px 0;
        }

        .ecm-register-divider:before,
        .ecm-register-divider:after {
            background: #e4edf2;
            content: "";
            flex: 1;
            height: 1px;
        }

        @media (max-width: 991.98px) {
            .ecm-register-form {
                padding: 30px;
            }

            .ecm-register-visual {
                min-height: 360px;
            }
        }

        @media (max-width: 575.98px) {
            .ecm-register-page {
                padding: 20px 0;
            }

            .ecm-register-shell {
                border-left: 0;
                border-radius: 0;
                border-right: 0;
            }

            .ecm-register-form {
                padding: 24px 18px;
            }

            .ecm-register-title {
                font-size: 24px;
            }

            .ecm-register-visual {
                display: none;
            }
        }
    </style>

    <section class="ecm-register-page">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-11 mx-auto">
                        <div class="ecm-register-shell">
                            <div class="row no-gutters">
                                <!-- Left Side -->
                                <div class="col-lg-6 col-md-7">
                                    <!-- Titles -->
                                    <!-- Register form -->
                                    <div class="ecm-register-form">
                                        <div>
                                            <h1 class="ecm-register-title">{{ translate('Create an account')}}</h1>
                                            <p class="ecm-register-subtitle">{{ translate('Join EcoMall to shop faster, track orders, and save your favorite products.') }}</p>
                                        </div>
                                        <div class="">
                                            <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                                                @csrf
                                                <!-- Name -->
                                                <div class="form-group">
                                                    <label for="name" class="fs-12 fw-700 text-soft-dark">{{  translate('Full Name') }}</label>
                                                    <input type="text" class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name">
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <!-- Email or Phone -->
                                                @if (addon_is_activated('otp_system'))
                                                    <div class="form-group phone-form-group mb-1">
                                                        <label for="phone" class="fs-12 fw-700 text-soft-dark">{{  translate('Phone') }}</label>
                                                        <input type="tel" id="phone-code" class="form-control rounded-0{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                                    </div>

                                                    <input type="hidden" name="country_code" value="">

                                                    <div class="form-group email-form-group mb-1 d-none">
                                                        <label for="email" class="fs-12 fw-700 text-soft-dark">{{  translate('Email') }}</label>
                                                        <input type="email" class="form-control rounded-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email"  autocomplete="off">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group text-right">
                                                        <button class="btn btn-link p-0 text-primary" type="button" onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>
                                                    </div>
                                                @else
                                                    <div class="form-group">
                                                        <label for="email" class="fs-12 fw-700 text-soft-dark">{{  translate('Email') }}</label>
                                                        <input type="email" class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endif

                                                <!-- password -->
                                                <div class="form-group">
                                                    <label for="password" class="fs-12 fw-700 text-soft-dark">{{  translate('Password') }}</label>
                                                    <input type="password" class="form-control rounded-0{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password">
                                                    <div class="text-right mt-1">
                                                        <span class="fs-12 fw-400 text-gray-dark">{{ translate('Password must contain at least 6 digits') }}</span>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <!-- password Confirm -->
                                                <div class="form-group">
                                                    <label for="password_confirmation" class="fs-12 fw-700 text-soft-dark">{{  translate('Confirm Password') }}</label>
                                                    <input type="password" class="form-control rounded-0" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                                </div>

                                                <!-- Recaptcha -->
                                                @if(get_setting('google_recaptcha') == 1)
                                                    <div class="form-group">
                                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                                    </div>
                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                        </span>
                                                    @endif
                                                @endif

                                                <!-- Terms and Conditions -->
                                                <div class="mb-3">
                                                    <label class="aiz-checkbox">
                                                        <input type="checkbox" name="checkbox_example_1" required>
                                                        <span class="">{{ translate('By signing up you agree to our ')}} <a href="{{ route('terms') }}" class="fw-500">{{ translate('terms and conditions.') }}</a></span>
                                                        <span class="aiz-square-check"></span>
                                                    </label>
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="mb-4 mt-4">
                                                    <button type="submit" class="btn btn-primary btn-block fw-600 rounded-4">{{  translate('Create Account') }}</button>
                                                </div>
                                            </form>
                                             
                                            <!-- Social Login -->
                                            @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                                <div class="ecm-register-divider">
                                                    <span>{{ translate('Or Join With')}}</span>
                                                </div>
                                                <ul class="list-inline social colored text-center mb-4">
                                                    @if (get_setting('facebook_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                                <i class="lab la-facebook-f"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if(get_setting('google_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                                <i class="lab la-google"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('twitter_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                                <i class="lab la-twitter"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if (get_setting('apple_login') == 1)
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('social.login', ['provider' => 'apple']) }}" class="apple">
                                                                <i class="lab la-apple"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            @endif
                                        </div>

                                        <!-- Log In -->
                                        <div class="ecm-register-login text-center">
                                            <p class="fs-12 text-gray mb-0">{{ translate('Already have an account?')}}</p>
                                            <a href="{{ route('user.login') }}" class="fs-14 fw-700 animate-underline-primary">{{ translate('Log In')}}</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right Side Image -->
                                <div class="col-lg-6 col-md-5">
                                    <div class="ecm-register-visual">
                                        <img src="{{ uploaded_asset(get_setting('register_page_image')) }}" alt="">
                                        <div class="ecm-register-visual-panel">
                                            <h2>{{ translate('Welcome to EcoMall!') }}</h2>
                                            <p>{{ translate('Experience the joy of shopping with us. Create your account today and start exploring our wide range of products, exclusive deals, and personalized recommendations.') }}</p>      
                                    </div>
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
    @if(get_setting('google_recaptcha') == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">

        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are human!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });
        @endif
    </script>
@endsection
