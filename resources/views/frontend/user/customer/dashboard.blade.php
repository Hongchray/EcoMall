@extends('frontend.layouts.user_panel')

@section('panel_content')
    @php
        $cart = get_user_cart() ?? collect();
        $total_ordered_products = get_user_total_ordered_products() ?? 0;
        $wishlists = get_user_wishlist() ?? collect();
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

        .ecm-dashboard-card {
            background: #fff;
            border: 1px solid #e8edf5;
            border-radius: 8px;
            box-shadow: 0 14px 35px rgba(31, 41, 55, 0.07);
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

        .ecm-dashboard-user-icon,
        .ecm-dashboard-icon {
            align-items: center;
            border-radius: 8px;
            display: inline-flex;
            justify-content: center;
        }

        .ecm-dashboard-user-icon {
            background: linear-gradient(135deg, #2563eb, #14b8a6);
            color: #fff;
            flex: 0 0 54px;
            font-size: 28px;
            height: 54px;
            width: 54px;
        }

        .ecm-dashboard-hero {
            background: linear-gradient(135deg, #2563eb 0%, #0f766e 100%);
            border-radius: 8px;
            box-shadow: 0 18px 45px rgba(37, 99, 235, 0.2);
            min-height: 220px;
            overflow: hidden;
            position: relative;
        }

        .ecm-dashboard-hero:before,
        .ecm-dashboard-hero:after {
            border-radius: 999px;
            content: "";
            position: absolute;
        }

        .ecm-dashboard-hero:before {
            background: rgba(255, 255, 255, 0.12);
            height: 260px;
            right: -80px;
            top: -90px;
            width: 260px;
        }

        .ecm-dashboard-hero:after {
            background: rgba(255, 255, 255, 0.1);
            bottom: -65px;
            height: 130px;
            right: 125px;
            width: 130px;
        }

        .ecm-dashboard-wallet-bg {
            background-image: url('{{ static_asset("assets/img/wallet-bg.png") }}');
            background-position: center;
            background-size: cover;
        }

        .ecm-dashboard-hero-content {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 220px;
            position: relative;
            z-index: 1;
        }

        .ecm-dashboard-eyebrow {
            color: rgba(255, 255, 255, 0.72);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .ecm-dashboard-value {
            color: #fff;
            font-size: 32px;
            font-weight: 800;
            line-height: 1.15;
        }

        .ecm-dashboard-action {
            border-radius: 6px;
            font-weight: 700;
        }

        .ecm-dashboard-muted {
            color: #7d8592;
        }

        .ecm-dashboard-stat {
            border-radius: 8px;
            box-shadow: 0 14px 35px rgba(31, 41, 55, 0.07);
            color: #fff;
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
            min-height: 170px;
            overflow: hidden;
            padding: 24px;
            position: relative;
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
            background: #3d9bd3;
        }

        .ecm-dashboard-stat-secondary {
            background: linear-gradient(135deg, #0f766e, #14b8a6);
        }

        .ecm-dashboard-icon {
            flex: 0 0 46px;
            font-size: 23px;
            height: 46px;
            width: 46px;
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
            align-items: center;
            border-bottom: 1px solid #eef2f7;
            display: flex;
            padding: 21px 0;
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
            gap: 18px;
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }

        .ecm-dashboard-product {
            background: #f8fbfe;
            border: 1.5px solid #e3f3fb;
            border-radius: 14px;
            height: 100%;
            margin-top: 8px;
            overflow: hidden;
            padding: 16px 14px 14px;
            position: relative;
            transition: box-shadow .25s ease, transform .25s ease, border-color .25s ease;
        }

        .ecm-dashboard-product:hover {
            border-color: #3c9bd3;
            box-shadow: 0 10px 36px rgba(60, 155, 211, 0.18);
            transform: translateY(-4px);
        }

        .ecm-dashboard-product-top {
            align-items: flex-start;
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            min-height: 32px;
        }

        .ecm-dashboard-product-badge {
            background: #3c9bd3;
            border: 1px solid #3c9bd3;
            border-radius: 999px;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            line-height: 1.2;
            max-width: calc(100% - 42px);
            overflow: hidden;
            padding: 4px 10px;
            text-overflow: ellipsis;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .ecm-dashboard-product-delete {
            align-items: center;
            background: #fff;
            border: 2px solid #f1b5b5;
            border-radius: 50%;
            color: #dc2626;
            display: inline-flex;
            flex: 0 0 32px;
            font-size: 18px;
            height: 32px;
            justify-content: center;
            line-height: 1;
            text-decoration: none;
            transition: background-color .2s ease, border-color .2s ease, color .2s ease;
            width: 32px;
        }

        .ecm-dashboard-product-delete:hover,
        .ecm-dashboard-product-delete:focus {
            background: #dc2626;
            border-color: #dc2626;
            color: #fff;
            text-decoration: none;
        }

        .ecm-dashboard-product-image {
            align-items: center;
            background: #fff;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            margin: 0 auto 18px;
            max-width: 126px;
            overflow: hidden;
            text-decoration: none;
            width: 72%;
            aspect-ratio: 1 / 1;
        }

        .ecm-dashboard-product-image img {
            height: 100%;
            object-fit: contain;
            padding: 8px;
            transition: transform .3s ease;
            width: 100%;
        }

        .ecm-dashboard-product:hover .ecm-dashboard-product-image img {
            transform: scale(1.08);
        }

        .ecm-dashboard-product-content {
            background: #fff;
            border-radius: 0 0 12px 12px;
            border-top: 1px solid #e3f3fb;
            margin: 0 -14px -14px;
            padding: 16px 14px 14px;
        }

        .ecm-dashboard-product-name {
            color: #111;
            display: -webkit-box;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.35;
            margin: 0 4px 10px;
            min-height: 40px;
            overflow: hidden;
            text-decoration: none;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .ecm-dashboard-product-name:hover,
        .ecm-dashboard-product-name:focus {
            color: #227eb8;
            text-decoration: none;
        }

        .ecm-dashboard-product-price {
            color: #2d9add;
            display: block;
            font-size: 14px;
            font-weight: 800;
            margin: 0 4px 14px;
        }

        .ecm-dashboard-product-action {
            align-items: center;
            background: #f0f8fd;
            border: 0;
            border-radius: 5px;
            color: #3d98d1;
            display: inline-flex;
            font-size: 13px;
            font-weight: 800;
            gap: 8px;
            justify-content: center;
            line-height: 1.2;
            min-height: 40px;
            opacity: 0;
            text-align: center;
            text-decoration: none;
            transform: translateY(8px);
            transition: opacity .2s ease, transform .2s ease, background-color .2s ease, color .2s ease;
            width: 100%;
        }

        .ecm-dashboard-product:hover .ecm-dashboard-product-action {
            opacity: 1;
            transform: translateY(0);
        }

        .ecm-dashboard-product-action:hover,
        .ecm-dashboard-product-action:focus {
            background: #3d98d1;
            color: #fff;
            text-decoration: none;
        }

        .ecm-dashboard-product-action i {
            font-size: 20px;
            line-height: 1;
        }

        .ecm-dashboard-empty {
            background: linear-gradient(180deg, #fff, #f8fafc);
        }

        .ecm-dashboard-note {
            background: #f8fbfe;
            border: 1.5px solid #e3f3fb;
            border-radius: 14px;
            padding: 18px;
        }

        .ecm-dashboard-note-icon {
            align-items: center;
            background: #3c9bd3;
            border-radius: 8px;
            color: #fff;
            display: inline-flex;
            flex: 0 0 42px;
            font-size: 22px;
            height: 42px;
            justify-content: center;
            width: 42px;
        }

        .ecm-dashboard-note-link {
            align-items: center;
            background: #fff;
            border: 1px solid #e3f3fb;
            border-radius: 5px;
            color: #3d98d1;
            display: inline-flex;
            font-size: 13px;
            font-weight: 800;
            justify-content: center;
            min-height: 38px;
            padding: 8px 12px;
            text-decoration: none;
            transition: background-color .2s ease, color .2s ease, border-color .2s ease;
        }

        .ecm-dashboard-note-link:hover,
        .ecm-dashboard-note-link:focus {
            background: #3d98d1;
            border-color: #3d98d1;
            color: #fff;
            text-decoration: none;
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
                gap: 12px;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .ecm-dashboard-product-image {
                width: 76%;
            }

            .ecm-dashboard-product-action {
                opacity: 1;
                transform: translateY(0);
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
                        <div class="fs-18 fw-700 text-primary">{{ translate('customer_dashboard') }}</div>
                        <h1 class="h4 fw-800 mb-0 text-dark">{{ translate('welcome') }}, {{ Auth::user()->name }}</h1>
                    </div>
                </div>
                <a href="{{ route('purchase_history.index') }}" class="btn btn-primary ecm-dashboard-action px-4 mt-3 mt-sm-0">
                    <i class="las la-receipt fs-18 mr-1"></i>
                    {{ translate('my_order') }}
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
                                    <div class="fs-20 opacity-70">{{ translate('Total Expenditure') }}</div>
                                    <div class="fs-22 fw-800">{{ single_price(get_user_total_expenditure()) }}</div>
                                </div>
                            </div>
                            <a  href="{{ route('purchase_history.index') }}" class="text-white fs-16 fw-700">
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

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="ecm-dashboard-card p-4 h-100">
                    <div class="ecm-dashboard-note h-100">
                        <div class="d-flex align-items-start mb-3">
                            <span class="ecm-dashboard-note-icon">
                                <i class="las la-headset"></i>
                            </span>
                            <div class="ml-3">
                                <h6 class="fw-800 fs-16 mb-1 text-dark">{{ translate('need_help_or_updates') }}</h6>
                                <p class="fs-14 ecm-dashboard-muted mb-0">{{ translate('dashboard_help_text') }}</p>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap" style="gap: 10px;">
                            <a href="{{ route('followed_seller') }}" class="ecm-dashboard-note-link">
                                <i class="las la-store mr-1"></i>
                                {{ translate('Followed Sellers') }}
                            </a>
                            @if (get_setting('conversation_system') == 1)
                                <a href="{{ route('conversations.index') }}" class="ecm-dashboard-note-link">
                                    <i class="las la-comments mr-1"></i>
                                    {{ translate('Conversations') }}
                                </a>
                            @endif
                            <a href="{{ route('support_ticket.index') }}" class="ecm-dashboard-note-link">
                                <i class="las la-life-ring mr-1"></i>
                                {{ translate('Support Ticket') }}
                            </a>
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
                            <li class="fs-14 fw-400 pb-1"><span>{{ $default_address->state->getTranslation('name') }},</span></li>
                            <li class="fs-14 fw-400 pb-1"><span>{{ $default_address->country->name }}.</span></li>
                            <li class="fs-14 fw-400 pb-1"><span>{{ $default_address->phone }}</span></li>
                        </ul>
                    @else
                        <div class="bg-soft-light p-4 text-center mb-4">
                            <i class="las la-map-marked-alt fs-36 text-primary mb-2"></i>
                            <p class="mb-0 fs-14 ecm-dashboard-muted">{{ translate('no_default_address_found') }}</p>
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
                        @php
                            $wishlist_product_image = filter_var($wishlist->product->thumbnail_img, FILTER_VALIDATE_URL)
                                ? $wishlist->product->thumbnail_img
                                : uploaded_asset($wishlist->product->thumbnail_img);
                            $wishlist_placeholder_image = static_asset('assets/img/placeholder.jpg');
                        @endphp
                        <div class="ecm-dashboard-product" id="wishlist_{{ $wishlist->id }}">
                            <div class="ecm-dashboard-product-top">
                                <span class="ecm-dashboard-product-badge">{{ translate('Wishlist') }}</span>
                                <a href="javascript:void(0)" class="ecm-dashboard-product-delete"
                                    onclick="removeFromWishlist({{ $wishlist->id }})"
                                    data-toggle="tooltip" data-title="{{ translate('Remove from wishlist') }}" data-placement="left"
                                    aria-label="{{ translate('Remove from wishlist') }}">
                                    <i class="la la-trash"></i>
                                </a>
                            </div>

                            <a href="{{ route('product', $wishlist->product->slug) }}" class="ecm-dashboard-product-image" title="{{ $wishlist->product->getTranslation('name') }}">
                                <img src="{{ $wishlist_placeholder_image }}" data-src="{{ $wishlist_product_image ?: $wishlist_placeholder_image }}" class="lazyload"
                                    alt="{{ $wishlist->product->getTranslation('name') }}"
                                    title="{{ $wishlist->product->getTranslation('name') }}"
                                    onerror="this.onerror=null;this.src='{{ $wishlist_placeholder_image }}';">
                            </a>

                            <div class="ecm-dashboard-product-content">
                                <a href="{{ route('product', $wishlist->product->slug) }}" class="ecm-dashboard-product-name"
                                    title="{{ $wishlist->product->getTranslation('name') }}">{{ $wishlist->product->getTranslation('name') }}</a>

                                <span class="ecm-dashboard-product-price">{{ home_discounted_base_price($wishlist->product) }}</span>

                                <a class="ecm-dashboard-product-action" href="javascript:void(0)"
                                    onclick="showAddToCartModal({{ $wishlist->product->id }})">
                                    <i class="las la-shopping-cart"></i>
                                    <span>{{ translate('Add to Cart') }}</span>
                                </a>
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
    @include('frontend.'.get_setting('homepage_select').'.partials.wallet_modal')
    <script type="text/javascript">
        function show_wallet_modal() {
            $('#wallet_modal').modal('show');
        }
    </script>

    @include('frontend.'.get_setting('homepage_select').'.partials.address_modal')
@endsection

@section('script')
    @if (get_setting('google_map') == 1)
        @include('frontend.'.get_setting('homepage_select').'.partials.google_map')
    @endif
@endsection
