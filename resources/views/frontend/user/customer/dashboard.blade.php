@extends('frontend.layouts.user_panel')

@section('panel_content')
    @php
        $cart = get_user_cart();
        $total_ordered_products = get_user_total_ordered_products();
        $wishlists = get_user_wishlist();
        $default_address = null;

        if (Auth::user()->addresses != null) {
            $default_address = Auth::user()->addresses->where('set_default', 1)->first();
        }
    @endphp

    <style>
        .ecm-dashboard {
            color: #1f2937;
        }

        .ecm-dashboard a:hover {
            text-decoration: none;
        }

        .ecm-dashboard-topbar {
            background: #fff;
            border: 1px solid #e8edf5;
            border-radius: 8px;
            box-shadow: 0 14px 35px rgba(31, 41, 55, 0.06);
            overflow: hidden;
            position: relative;
        }

        .ecm-dashboard-topbar:after {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.14), rgba(20, 184, 166, 0.12));
            border-radius: 999px;
            content: "";
            height: 180px;
            position: absolute;
            right: -70px;
            top: -95px;
            width: 180px;
        }

        .ecm-dashboard-user-icon {
            align-items: center;
            background: linear-gradient(135deg, #2563eb, #14b8a6);
            border-radius: 8px;
            color: #fff;
            display: inline-flex;
            flex: 0 0 54px;
            font-size: 28px;
            height: 54px;
            justify-content: center;
            width: 54px;
        }

        .ecm-dashboard-card {
            background: #fff;
            border: 1px solid #e8edf5;
            border-radius: 8px;
            box-shadow: 0 14px 35px rgba(31, 41, 55, 0.07);
        }

        .ecm-dashboard-hero {
            background: linear-gradient(135deg, #2563eb 0%, #0f766e 100%);
            border-radius: 8px;
            overflow: hidden;
            min-height: 220px;
            position: relative;
            box-shadow: 0 18px 45px rgba(37, 99, 235, 0.2);
        }

        .ecm-dashboard-hero:before,
        .ecm-dashboard-hero:after {
            content: "";
            position: absolute;
            border-radius: 999px;
        }

        .ecm-dashboard-hero:before {
            background: rgba(255, 255, 255, 0.12);
            width: 260px;
            height: 260px;
            right: -80px;
            top: -90px;
        }

        .ecm-dashboard-hero:after {
            background: rgba(255, 255, 255, 0.1);
            width: 130px;
            height: 130px;
            right: 125px;
            bottom: -65px;
        }

        .ecm-dashboard-wallet-bg {
            background-image: url('{{ static_asset("assets/img/wallet-bg.png") }}');
            background-size: cover;
            background-position: center;
        }

        .ecm-dashboard-hero-content {
            position: relative;
            z-index: 1;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .ecm-dashboard-eyebrow {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.72);
        }

        .ecm-dashboard-value {
            font-size: 32px;
            font-weight: 800;
            line-height: 1.15;
            color: #fff;
        }

        .ecm-dashboard-muted {
            color: #7d8592;
        }

        .ecm-dashboard-action {
            border-radius: 6px;
            font-weight: 700;
        }

        .ecm-dashboard-stat {
            height: 100%;
            padding: 24px;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 170px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 14px 35px rgba(31, 41, 55, 0.07);
        }

        .ecm-dashboard-stat:after {
            background: rgba(255, 255, 255, 0.12);
            border-radius: 999px;
            bottom: -70px;
            content: "";
            height: 150px;
            position: absolute;
            right: -45px;
            width: 150px;
        }

        .ecm-dashboard-stat-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
        }

        .ecm-dashboard-stat-secondary {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
            color: #fff;
        }

        .ecm-dashboard-icon {
            width: 46px;
            height: 46px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            flex: 0 0 46px;
        }

        .ecm-dashboard-icon-light {
            background: rgba(255, 255, 255, 0.16);
            color: #fff;
        }

        .ecm-dashboard-icon-cart {
            background: #dbeafe;
            color: #2563eb;
        }

        .ecm-dashboard-icon-wishlist {
            background: #fce7f3;
            color: #db2777;
        }

        .ecm-dashboard-icon-order {
            background: #ccfbf1;
            color: #0f766e;
        }

        .ecm-dashboard-count-row {
            display: flex;
            align-items: center;
            padding: 21px 0;
            border-bottom: 1px solid #eef2f7;
            transition: transform .18s ease;
        }

        .ecm-dashboard-count-row:hover {
            transform: translateX(3px);
        }

        .ecm-dashboard-count-row:last-child {
            border-bottom: 0;
        }

        .ecm-dashboard-section-title {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 0;
        }

        .ecm-dashboard-address-list li {
            color: #4b5563;
            line-height: 1.55;
        }

        .ecm-dashboard-product-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 16px;
        }

        .ecm-dashboard-product {
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .ecm-dashboard-product:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 42px rgba(31, 41, 55, 0.12);
        }

        .ecm-dashboard-product-image {
            height: 170px;
            background: linear-gradient(180deg, #f8fafc, #eef2f7);
            position: relative;
        }

        .ecm-dashboard-empty {
            background: linear-gradient(180deg, #fff, #f8fafc);
        }

        .ecm-dashboard-product-action {
            opacity: 0;
            transition: opacity .2s ease;
        }

        .ecm-dashboard-product:hover .ecm-dashboard-product-action {
            opacity: 1;
        }

        @media (max-width: 1199.98px) {
            .ecm-dashboard-product-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        @media (max-width: 991.98px) {
            .ecm-dashboard-product-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .ecm-dashboard-value {
                font-size: 26px;
            }

            .ecm-dashboard-stat {
                min-height: 150px;
            }

            .ecm-dashboard-product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .ecm-dashboard-product-image {
                height: 140px;
            }

            .ecm-dashboard-product-action {
                opacity: 1;
            }
        }
    </style>

    <div class="ecm-dashboard">
        <div class="ecm-dashboard-topbar p-4 mb-4">
            <div class="position-relative d-flex flex-wrap align-items-center justify-content-between" style="z-index: 1;">
                <div class="d-flex align-items-center pr-3">
                    <span class="ecm-dashboard-user-icon">
                        <i class="las la-user"></i>
                    </span>
                    <div class="ml-3">
                        <div class="fs-13 fw-700 text-primary">{{ translate('Customer Dashboard') }}</div>
                        <h1 class="h4 fw-800 mb-0 text-dark">{{ translate('Welcome') }}, {{ Auth::user()->name }}</h1>
                    </div>
                </div>
                <a href="{{ route('purchase_history.index') }}" class="btn btn-primary ecm-dashboard-action px-4 mt-3 mt-sm-0">
                    <i class="las la-receipt fs-18 mr-1"></i>
                    {{ translate('My Orders') }}
                </a>
            </div>
        </div>

        <div class="row gutters-16">
            @if (get_setting('wallet_system') == 1)
                <div class="col-xl-8 col-md-6 mb-4">
                    <div class="ecm-dashboard-hero ecm-dashboard-wallet-bg h-100">
                        <div class="ecm-dashboard-hero-content p-4 p-md-5">
                            <div>
                                <div class="ecm-dashboard-eyebrow mb-2">{{ translate('Wallet Balance') }}</div>
                                <div class="ecm-dashboard-value">{{ single_price(Auth::user()->balance) }}</div>
                            </div>
                            <div>
                                @php
                                    $last_recharge = get_user_last_wallet_recharge();
                                @endphp
                                <div class="d-flex flex-wrap align-items-end justify-content-between">
                                    <div class="text-white pr-3 mb-3 mb-sm-0">
                                        <div class="fs-13 opacity-70">{{ translate('Last Recharge') }}</div>
                                        <div class="fs-18 fw-700">
                                            {{ $last_recharge ? single_price($last_recharge->amount) : 0 }}
                                        </div>
                                        <div class="fs-12 opacity-70">
                                            {{ $last_recharge ? date('d.m.Y', strtotime($last_recharge->created_at)) : translate('No recharge yet') }}
                                        </div>
                                    </div>
                                    <button class="btn btn-light ecm-dashboard-action px-4 py-3" onclick="show_wallet_modal()">
                                        <i class="las la-plus fs-18 mr-2"></i>
                                        {{ translate('Recharge Wallet') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col mb-4">
                <div class="row h-100 gutters-16 @if(get_setting('wallet_system') != 1 && addon_is_activated('club_point')) row-cols-md-2 @endif row-cols-1">
                    <div class="col mb-4 mb-md-0">
                        <div class="ecm-dashboard-stat ecm-dashboard-stat-primary">
                            <div class="d-flex align-items-center">
                                <span class="ecm-dashboard-icon ecm-dashboard-icon-light">
                                    <i class="las la-receipt"></i>
                                </span>
                                <div class="ml-3">
                                    <div class="fs-13 opacity-70">{{ translate('Total Expenditure') }}</div>
                                    <div class="fs-22 fw-800">{{ single_price(get_user_total_expenditure()) }}</div>
                                </div>
                            </div>
                            <a href="{{ route('purchase_history.index') }}" class="text-white fs-13 fw-700">
                                {{ translate('View Order History') }}
                                <i class="las la-angle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    @if (addon_is_activated('club_point'))
                        <div class="col">
                            <div class="ecm-dashboard-stat ecm-dashboard-stat-secondary">
                                <div class="d-flex align-items-center">
                                    <span class="ecm-dashboard-icon ecm-dashboard-icon-light">
                                        <i class="las la-gem"></i>
                                    </span>
                                    <div class="ml-3">
                                        <div class="fs-13 opacity-70">{{ translate('Total Club Points') }}</div>
                                        <div class="fs-22 fw-800">{{ get_user_total_club_point() }}</div>
                                    </div>
                                </div>
                                <a href="{{ route('earnng_point_for_user') }}" class="text-white fs-13 fw-700">
                                    {{ translate('Convert Club Points') }}
                                    <i class="las la-angle-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row gutters-16">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="ecm-dashboard-card px-4 h-100">
                    <div class="ecm-dashboard-count-row">
                        <span class="ecm-dashboard-icon ecm-dashboard-icon-cart">
                            <i class="las la-shopping-cart"></i>
                        </span>
                        <div class="ml-3">
                            <div class="fs-24 fw-800 text-dark">{{ count($cart) > 0 ? sprintf("%02d", count($cart)) : 0 }}</div>
                            <div class="fs-14 ecm-dashboard-muted">{{ translate('Products in Cart') }}</div>
                        </div>
                    </div>

                    <div class="ecm-dashboard-count-row">
                        <span class="ecm-dashboard-icon ecm-dashboard-icon-wishlist">
                            <i class="lar la-heart"></i>
                        </span>
                        <div class="ml-3">
                            <div class="fs-24 fw-800 text-dark">{{ count(Auth::user()->wishlists) > 0 ? sprintf("%02d", count(Auth::user()->wishlists)) : 0 }}</div>
                            <div class="fs-14 ecm-dashboard-muted">{{ translate('Products in Wishlist') }}</div>
                        </div>
                    </div>

                    <div class="ecm-dashboard-count-row">
                        <span class="ecm-dashboard-icon ecm-dashboard-icon-order">
                            <i class="las la-box"></i>
                        </span>
                        <div class="ml-3">
                            <div class="fs-24 fw-800 text-dark">{{ $total_ordered_products > 0 ? sprintf("%02d", $total_ordered_products) : 0 }}</div>
                            <div class="fs-14 ecm-dashboard-muted">{{ translate('Total Products Ordered') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            @if (get_setting('classified_product'))
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="ecm-dashboard-card p-4 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="fw-800 fs-16 mb-0 text-dark">{{ translate('Purchased Package') }}</h6>
                            <span class="ecm-dashboard-icon ecm-dashboard-icon-order">
                                <i class="las la-crown"></i>
                            </span>
                        </div>
                        @php
                            $customer_package = get_single_customer_package(Auth::user()->customer_package_id);
                        @endphp
                        @if($customer_package != null)
                            <img src="{{ uploaded_asset($customer_package->logo) }}" class="img-fluid mb-4 h-70px"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                            <p class="fs-14 fw-700 mb-3 text-primary">{{ translate('Current Package') }}: {{ $customer_package->getTranslation('name') }}</p>
                            <p class="mb-2 d-flex justify-content-between">
                                <span class="ecm-dashboard-muted">{{ translate('Product Upload') }}</span>
                                <span class="fw-700">{{ $customer_package->product_upload }} {{ translate('Times')}}</span>
                            </p>
                            <p class="mb-4 d-flex justify-content-between">
                                <span class="ecm-dashboard-muted">{{ translate('Product Upload Remains') }}</span>
                                <span class="fw-700">{{ Auth::user()->remaining_uploads }} {{ translate('Times')}}</span>
                            </p>
                        @else
                            <span class="fs-14 fw-700 d-block mb-4 text-primary">{{translate('Package Not Found')}}</span>
                        @endif
                        <a href="{{ route('customer_packages_list_show') }}" class="btn btn-primary btn-block ecm-dashboard-action fs-14 py-3">{{ translate('Upgrade Package') }}</a>
                    </div>
                </div>
            @endif

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="ecm-dashboard-card p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="fw-800 fs-16 mb-0 text-dark">{{ translate('Default Shipping Address') }}</h6>
                        <span class="ecm-dashboard-icon ecm-dashboard-icon-wishlist">
                            <i class="las la-map-marker-alt"></i>
                        </span>
                    </div>

                    @if($default_address != null)
                        <ul class="list-unstyled ecm-dashboard-address-list mb-4">
                            <li class="fs-14 fw-400 pb-1"><span>{{ $default_address->address }},</span></li>
                            <li class="fs-14 fw-400 pb-1"><span>{{ $default_address->postal_code }} - {{ $default_address->city->name }},</span></li>
                            <li class="fs-14 fw-400 pb-1"><span>{{ $default_address->state->name }},</span></li>
                            <li class="fs-14 fw-400 pb-1"><span>{{ $default_address->country->name }}.</span></li>
                            <li class="fs-14 fw-400 pb-1"><span>{{ $default_address->phone }}</span></li>
                        </ul>
                    @else
                        <div class="bg-soft-light p-4 text-center mb-4">
                            <i class="las la-map-marked-alt fs-36 text-primary mb-2"></i>
                            <p class="mb-0 fs-14 ecm-dashboard-muted">{{ translate('No default address found') }}</p>
                        </div>
                    @endif

                    <button class="btn btn-primary btn-block ecm-dashboard-action fs-14 py-3" onclick="add_new_address()">
                        <i class="la la-plus fs-18 mr-2"></i>
                        {{ translate('Add New Address') }}
                    </button>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3 mt-2">
            <h3 class="ecm-dashboard-section-title text-dark">{{ translate('My Wishlist')}}</h3>
            <a class="text-primary fs-13 fw-700 hov-text-primary animate-underline-primary" href="{{ route('wishlists.index') }}">
                {{ translate('View All') }}
                <i class="las la-angle-right ml-1"></i>
            </a>
        </div>

        @if (count($wishlists) > 0)
            <div class="ecm-dashboard-product-grid mb-4">
                @foreach($wishlists->take(5) as $key => $wishlist)
                    @if ($wishlist->product != null)
                        <div class="ecm-dashboard-card ecm-dashboard-product" id="wishlist_{{ $wishlist->id }}">
                            <div class="ecm-dashboard-product-image img-fit overflow-hidden">
                                <a href="{{ route('product', $wishlist->product->slug) }}" class="d-block h-100">
                                    <img src="{{ uploaded_asset($wishlist->product->thumbnail_img) }}" class="lazyload mx-auto img-fit"
                                        title="{{ $wishlist->product->getTranslation('name') }}">
                                </a>
                                <div class="absolute-top-right aiz-p-hov-icon ecm-dashboard-product-action">
                                    <a href="javascript:void(0)" onclick="removeFromWishlist({{ $wishlist->id }})" data-toggle="tooltip" data-title="{{ translate('Remove from wishlist') }}" data-placement="left">
                                        <i class="la la-trash"></i>
                                    </a>
                                </div>
                                <a class="cart-btn absolute-bottom-left w-100 h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex justify-content-center align-items-center ecm-dashboard-product-action"
                                    href="javascript:void(0)" onclick="showAddToCartModal({{ $wishlist->product->id }})">{{ translate('Add to Cart') }}</a>
                            </div>
                            <div class="p-3">
                                <h5 class="fs-14 mb-0 lh-1-5 fw-600 text-truncate-2 mb-3">
                                    <a href="{{ route('product', $wishlist->product->slug) }}" class="text-reset hov-text-primary"
                                        title="{{ $wishlist->product->getTranslation('name') }}">{{ $wishlist->product->getTranslation('name') }}</a>
                                </h5>
                                <div class="fs-14">
                                    <span class="fw-700 text-primary">{{ home_discounted_base_price($wishlist->product) }}</span>
                                    @if(home_base_price($wishlist->product) != home_discounted_base_price($wishlist->product))
                                        <del class="opacity-60 ml-1">{{ home_base_price($wishlist->product) }}</del>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="ecm-dashboard-card ecm-dashboard-empty text-center p-5 mb-4">
                <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                <h5 class="mb-0 h5 mt-3">{{ translate("There isn't anything added yet")}}</h5>
            </div>
        @endif
    </div>
@endsection

@section('modal')
    <!-- Wallet Recharge Modal -->
    @include('frontend.'.get_setting('homepage_select').'.partials.wallet_modal')
    <script type="text/javascript">
        function show_wallet_modal() {
            $('#wallet_modal').modal('show');
        }
    </script>
    
    <!-- Address modal Modal -->
    @include('frontend.'.get_setting('homepage_select').'.partials.address_modal')
@endsection

@section('script')
    @if (get_setting('google_map') == 1)
        @include('frontend.'.get_setting('homepage_select').'.partials.google_map')
    @endif
@endsection
