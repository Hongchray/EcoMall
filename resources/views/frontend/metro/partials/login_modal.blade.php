<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <style>
        #login_modal .modal-dialog { max-width: 470px; }
        #login_modal .modal-content { overflow: hidden; border: 0; border-radius: 14px; box-shadow: 0 24px 70px rgba(15, 34, 48, .28); }
        #login_modal .modal-header { align-items: center; padding: 20px 24px; border-bottom: 1px solid #e7f1f7; background: #f8fbfe; }
        #login_modal .modal-title { color: #17212b; font-size: 20px; font-weight: 800; }
        #login_modal .close { width: 36px; height: 36px; margin: -6px -8px -6px auto; padding: 0; border-radius: 50%; background: #eaf4fb; color: #526778; opacity: 1; text-shadow: none; }
        #login_modal .close:hover, #login_modal .close:focus { background: #3c9bd3; color: #fff; outline: 0; }
        #login_modal .close span { display: none; }
        #login_modal .modal-body { padding: 24px 32px 30px; }
        #login_modal .form-group { margin-bottom: 16px; }
        #login_modal .form-control { height: 48px; border: 1px solid #d7e8f3; border-radius: 8px !important; background: #f8fbfe; color: #17212b; font-size: 14px; box-shadow: none; }
        #login_modal .form-control:focus { border-color: #3c9bd3; background: #fff; box-shadow: 0 0 0 3px rgba(60, 155, 211, .14); }
        #login_modal .aiz-checkbox { display: inline-flex; align-items: center; min-height: 22px; }
        #login_modal a { color: #217fb8; font-weight: 700; }
        #login_modal .btn-primary { min-height: 48px; border: 0; border-radius: 8px !important; background: #3c9bd3; font-weight: 800; box-shadow: 0 10px 22px rgba(60, 155, 211, .24); }
        #login_modal .btn-primary:hover, #login_modal .btn-primary:focus { background: #217fb8; }
        #login_modal .login-register-block { padding-top: 18px; border-top: 1px solid #edf5f9; }
        @media (max-width: 575.98px) {
            #login_modal .modal-dialog { margin: 12px; }
            #login_modal .modal-body { padding: 20px; }
        }
    </style>
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-600">{{ translate('Login') }}</h6>
                <button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" onclick="$('#login_modal').modal('hide')" aria-label="{{ translate('Close') }}">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                        @csrf

                        @if (addon_is_activated('otp_system'))
                            <!-- Phone -->
                            <div class="form-group phone-form-group mb-1">
                                <input type="tel" id="phone-code"
                                    class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                    value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                            </div>
                            <!-- Country Code -->
                            <input type="hidden" name="country_code" value="">
                            <!-- Email -->
                            <div class="form-group email-form-group mb-1 d-none">
                                <input type="email"
                                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email"
                                    id="email" autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- Use Email Instead -->
                            <div class="form-group text-right">
                                <button class="btn btn-link p-0 text-primary" type="button"
                                    onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>
                            </div>
                        @else
                            <!-- Email -->
                            <div class="form-group">
                                <input type="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email"
                                    id="email" autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif

                        <!-- Password -->
                        <div class="form-group">
                            <input type="password" name="password" class="form-control h-auto rounded-0 form-control-lg"
                                placeholder="{{ translate('Password') }}">
                        </div>

                        <!-- Remember Me & Forgot password -->
                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class=opacity-60>{{ translate('Remember Me') }}</span>
                                    <span class="aiz-square-check"></span>
                                </label>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('password.request') }}"
                                    class="text-reset opacity-60 hov-opacity-100 fs-14">{{ translate('Forgot password?') }}</a>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="mb-4">
                            <button type="submit"
                                class="btn btn-primary btn-block fw-600 rounded-0">{{ translate('Login') }}</button>
                        </div>
                    </form>

                    <!-- Register Now -->
                    <div class="login-register-block text-center mb-3">
                        <p class="text-muted mb-0">{{ translate('Dont have an account?') }}</p>
                        <a href="{{ route('user.registration') }}">{{ translate('Register Now') }}</a>
                    </div>
                    
                    <!-- Social Login -->
                    @if (get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                        <div class="separator mb-3">
                            <span class="bg-white px-3 opacity-60">{{ translate('Or Login With') }}</span>
                        </div>
                        <ul class="list-inline social colored text-center mb-5">
                            <!-- Facebook -->
                            @if (get_setting('facebook_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                        class="facebook">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                            @endif
                            <!-- Google -->
                            @if (get_setting('google_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                        class="google">
                                        <i class="lab la-google"></i>
                                    </a>
                                </li>
                            @endif
                            <!-- Twitter -->
                            @if (get_setting('twitter_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'twitter']) }}"
                                        class="twitter">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                            @endif
                            <!-- Apple -->
                            @if (get_setting('apple_login') == 1)
                                <li class="list-inline-item">
                                    <a href="{{ route('social.login', ['provider' => 'apple']) }}"
                                        class="apple">
                                        <i class="lab la-apple"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
