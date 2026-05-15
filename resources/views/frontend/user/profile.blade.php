@extends('frontend.layouts.user_panel')

@section('panel_content')
    <style>
        .profile-page{display:grid;gap:20px}
        .profile-panel{background:#fff;border:1px solid #edf2f7;border-radius:20px;overflow:hidden}
        .profile-panel-header{align-items:center;border-bottom:1px solid #f1f5f9;display:flex;gap:16px;justify-content:space-between;padding:24px}
        .profile-title{color:#1e293b;font-size:18px;font-weight:800;margin:0}
        .profile-subtitle{color:#64748b;font-size:13px;margin:4px 0 0}
        .profile-body{padding:24px}
        .profile-summary{align-items:center;background:#f8fbfe;border:1.5px solid #e3f3fb;border-radius:14px;display:flex;gap:16px;margin-bottom:22px;padding:18px}
        .profile-avatar{align-items:center;background:#fff;border:1px solid #e3f3fb;border-radius:50%;display:flex;height:76px;justify-content:center;overflow:hidden;width:76px}
        .profile-avatar img{height:100%;object-fit:cover;width:100%}
        .profile-field{margin-bottom:18px}
        .profile-field label{color:#334155;font-size:13px;font-weight:800;margin-bottom:8px}
        .profile-field .form-control{border:1px solid #e2e8f0;border-radius:8px;min-height:44px}
        .profile-field .input-group-text{border-radius:8px 0 0 8px}
        .profile-action{align-items:center;border-radius:5px;display:inline-flex;font-size:13px;font-weight:800;justify-content:center;min-height:42px;padding:10px 16px}
        .address-grid{display:grid;gap:16px;grid-template-columns:repeat(2,minmax(0,1fr))}
        .address-card{background:#f8fbfe;border:1.5px solid #e3f3fb;border-radius:14px;padding:18px;position:relative;transition:.25s ease}
        .address-card:hover{border-color:#3c9bd3;box-shadow:0 10px 36px rgba(60,155,211,.16);transform:translateY(-2px)}
        .address-default{background:#3c9bd3;border-radius:999px;color:#fff;display:inline-flex;font-size:10px;font-weight:800;margin-bottom:12px;padding:5px 10px;text-transform:uppercase}
        .address-row{display:flex;gap:12px;margin-bottom:8px}
        .address-label{color:#64748b;flex:0 0 95px;font-size:12px;font-weight:800}
        .address-value{color:#1e293b;font-size:13px;font-weight:700;min-width:0}
        .address-menu{position:absolute;right:14px;top:14px}
        .address-menu-btn{align-items:center;background:#fff;border:1px solid #e3f3fb;border-radius:50%;color:#3d98d1;display:inline-flex;height:32px;justify-content:center;width:32px}
        .add-address-card{align-items:center;background:#f0f8fd;border:1.5px dashed #9bd0ef;border-radius:14px;color:#3d98d1;cursor:pointer;display:flex;flex-direction:column;font-size:14px;font-weight:800;justify-content:center;min-height:170px;text-align:center;transition:.2s ease}
        .add-address-card:hover{background:#3d98d1;border-color:#3d98d1;color:#fff}
        .add-address-card i{font-size:32px;margin-bottom:8px}
        .email-row{display:grid;gap:12px;grid-template-columns:1fr auto}
        .verify-btn{border-radius:0 8px 8px 0;font-weight:800}
        @media(max-width:767.98px){.profile-panel-header,.profile-body{padding:20px}.profile-summary{align-items:flex-start}.address-grid{grid-template-columns:1fr}.email-row{grid-template-columns:1fr}.verify-btn,.profile-action{width:100%}}
    </style>

    <div class="profile-page">
        <div class="profile-panel">
            <div class="profile-panel-header">
                <div>
                    <h1 class="profile-title">{{ translate('Manage Profile') }}</h1>
                    <p class="profile-subtitle">{{ translate('Update your personal information and account access.') }}</p>
                </div>
            </div>
            <div class="profile-body">
                <div class="profile-summary">
                    <span class="profile-avatar">
                        <img src="{{ Auth::user()->avatar_original ? uploaded_asset(Auth::user()->avatar_original) : static_asset('assets/img/avatar-place.png') }}"
                             alt="{{ Auth::user()->name }}"
                             onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                    </span>
                    <div>
                        <h2 class="h5 fw-800 mb-1 text-dark">{{ Auth::user()->name }}</h2>
                        <div class="fs-14 text-secondary">{{ Auth::user()->email }}</div>
                        @if(Auth::user()->phone)
                            <div class="fs-13 text-secondary mt-1">{{ Auth::user()->phone }}</div>
                        @endif
                    </div>
                </div>

                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 profile-field">
                            <label>{{ translate('Your Name') }}</label>
                            <input type="text" class="form-control" placeholder="{{ translate('Your Name') }}" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="col-md-6 profile-field">
                            <label>{{ translate('Your Phone') }}</label>
                            <input type="text" class="form-control" placeholder="{{ translate('Your Phone')}}" name="phone" value="{{ Auth::user()->phone }}">
                        </div>
                    </div>
                    <div class="profile-field">
                        <label>{{ translate('Photo') }}</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="photo" value="{{ Auth::user()->avatar_original }}" class="selected-files">
                        </div>
                        <div class="file-preview box sm"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 profile-field">
                            <label>{{ translate('Your Password') }}</label>
                            <input type="password" class="form-control" placeholder="{{ translate('New Password') }}" name="new_password">
                        </div>
                        <div class="col-md-6 profile-field">
                            <label>{{ translate('Confirm Password') }}</label>
                            <input type="password" class="form-control" placeholder="{{ translate('Confirm Password') }}" name="confirm_password">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary profile-action">{{ translate('Update Profile')}}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="profile-panel">
            <div class="profile-panel-header">
                <div>
                    <h2 class="profile-title">{{ translate('Address')}}</h2>
                    <p class="profile-subtitle">{{ translate('Manage delivery addresses for your account.') }}</p>
                </div>
            </div>
            <div class="profile-body">
                <div class="address-grid">
                    @foreach (Auth::user()->addresses as $key => $address)
                        <div class="address-card">
                            @if ($address->set_default)
                                <span class="address-default">{{ translate('Default') }}</span>
                            @endif
                            <div class="address-row"><span class="address-label">{{ translate('Address') }}</span><span class="address-value">{{ $address->address }}</span></div>
                            <div class="address-row"><span class="address-label">{{ translate('Postal Code') }}</span><span class="address-value">{{ $address->postal_code }}</span></div>
                            <div class="address-row"><span class="address-label">{{ translate('City') }}</span><span class="address-value">{{ optional($address->city)->name }}</span></div>
                            <div class="address-row"><span class="address-label">{{ translate('State') }}</span><span class="address-value">{{ optional($address->state)->name }}</span></div>
                            <div class="address-row"><span class="address-label">{{ translate('Country') }}</span><span class="address-value">{{ optional($address->country)->name }}</span></div>
                            <div class="address-row mb-0"><span class="address-label">{{ translate('Phone') }}</span><span class="address-value">{{ $address->phone }}</span></div>

                            <div class="dropdown address-menu">
                                <button class="address-menu-btn" type="button" data-toggle="dropdown">
                                    <i class="la la-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" onclick="edit_address('{{ $address->id }}')">{{ translate('Edit') }}</a>
                                    @if (!$address->set_default)
                                        <a class="dropdown-item" href="{{ route('addresses.set_default', $address->id) }}">{{ translate('Make This Default') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('addresses.destroy', $address->id) }}">{{ translate('Delete') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="add-address-card" onclick="add_new_address()">
                        <i class="la la-plus"></i>
                        <span>{{ translate('Add New Address') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('user.change.email') }}" method="POST">
            @csrf
            <div class="profile-panel">
                <div class="profile-panel-header">
                    <div>
                        <h2 class="profile-title">{{ translate('Change your email')}}</h2>
                        <p class="profile-subtitle">{{ translate('Verify your new email before saving changes.') }}</p>
                    </div>
                </div>
                <div class="profile-body">
                    <div class="profile-field">
                        <label>{{ translate('Your Email') }}</label>
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="{{ translate('Your Email')}}" name="email" value="{{ Auth::user()->email }}" />
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary verify-btn new-email-verification">
                                    <span class="d-none loading">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>{{ translate('Sending Email...') }}
                                    </span>
                                    <span class="default">{{ translate('Verify') }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary profile-action">{{ translate('Update Email')}}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('modal')
    @include('frontend.'.get_setting('homepage_select').'.partials.address_modal')
@endsection

@section('script')
    <script type="text/javascript">
        $('.new-email-verification').on('click', function() {
            $(this).find('.loading').removeClass('d-none');
            $(this).find('.default').addClass('d-none');
            var email = $("input[name=email]").val();

            $.post('{{ route('user.new.verify') }}', {_token:'{{ csrf_token() }}', email: email}, function(data){
                data = JSON.parse(data);
                $('.default').removeClass('d-none');
                $('.loading').addClass('d-none');
                if(data.status == 2)
                    AIZ.plugins.notify('warning', data.message);
                else if(data.status == 1)
                    AIZ.plugins.notify('success', data.message);
                else
                    AIZ.plugins.notify('danger', data.message);
            });
        });
    </script>

    @if (get_setting('google_map') == 1)
        @include('frontend.'.get_setting('homepage_select').'.partials.google_map')
    @endif
@endsection
