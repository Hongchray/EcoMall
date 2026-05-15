@extends('frontend.layouts.user_panel')

@section('panel_content')
<style>
.wishlist-card-modern {
    background: #fff;
    border: 1px solid #e9eef5;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    padding: 12px;
}

.wishlist-card-modern:hover {
    border-color: #0d6efd;
    box-shadow: 0 8px 25px rgba(13, 110, 253, 0.12);
    transform: translateY(-2px);
}


/* image */
.wishlist-img-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 180px;
    background: #f8fafc;
    border-radius: 12px;
    overflow: hidden;
}

.wishlist-img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
}

/* remove button */
.wishlist-remove-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    border: none;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 2;
}

/* body */
.wishlist-body {
    padding-top: 10px;
    text-align: left;
}

/* title */
.wishlist-title {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 6px;
    line-height: 1.4;
    height: 40px;
    overflow: hidden;
}

.wishlist-title a {
    color: #222;
    text-decoration: none;
}

/* price */
.wishlist-price {
    display: flex;
    gap: 6px;
    align-items: center;
    margin-bottom: 10px;
}

.price-main {
    font-weight: 700;
    color: #0d6efd;
}

.price-old {
    font-size: 12px;
    opacity: 0.6;
}

/* button */
.wishlist-cart-btn {
    width: 100%;
    border: none;
    background: #0d6efd;
    color: #fff;
    padding: 10px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    transition: 0.2s;
}

.wishlist-cart-btn:hover {
    background: #0b5ed7;
}
    </style>
    <div class="row gutters-16">
        <!-- Wallet summary -->
        @if (get_setting('wallet_system') == 1)
        <div class="col-xl-8 col-md-6 mb-4">
            <div class="h-100" style="background-image: url('{{ static_asset("assets/img/wallet-bg.png") }}'); background-size: cover; background-position: center center;">
                <div class="p-4 h-100 w-100 w-xl-50">
                    <p class="fs-14 fw-400 text-gray mb-3">{{ translate('Wallet Balance') }}</p>
                    <h1 class="fs-30 fw-700 text-white ">{{ single_price(Auth::user()->balance) }}</h1>
                    <hr class="border border-dashed border-white opacity-40 ml-0 mt-4 mb-4">
                    @php
                        $last_recharge = get_user_last_wallet_recharge();
                    @endphp
                    <p class="fs-14 fw-400 text-gray mb-1">{{ translate('Last Recharge') }} <strong>{{ $last_recharge ? date('d.m.Y', strtotime($last_recharge->created_at)) : '' }}</strong></p>
                    <h3 class="fs-20 fw-700 text-white ">{{ $last_recharge ? single_price($last_recharge->amount) : 0 }}</h3>
                    <button class="btn btn-block border border-soft-light hov-bg-dark text-white mt-5 py-3" onclick="show_wallet_modal()" style="border-radius: 30px; background: rgba(255, 255, 255, 0.1);">
                        <i class="la la-plus fs-18 fw-700 mr-2"></i>
                        {{ translate('Recharge Wallet') }}
                    </button>
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

        <!-- Purchased Package -->
        @if (get_setting('classified_product'))
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="p-4 border h-100">
                <h6 class="fw-700 mb-3 text-dark">{{ translate('Purchased Package') }}</h6>
                @php
                    $customer_package = get_single_customer_package(Auth::user()->customer_package_id);
                @endphp
                @if($customer_package != null)
                    <img src="{{ uploaded_asset($customer_package->logo) }}" class="img-fluid mb-4 h-70px" 
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                    <p class="fs-14 fw-700 mb-3 text-primary">{{ translate('Current Package') }}: {{ $customer_package->getTranslation('name') }}</p>
                    <p class="mb-2 d-flex justify-content-between">
                        <span class="text-secondary">{{ translate('Product Upload') }}</span>
                        <span class="fw-700">{{ $customer_package->product_upload }} {{ translate('Times')}}</span>
                    </p>
                    <p class="mb-3 d-flex justify-content-between">
                        <span class="text-secondary">{{ translate('Product Upload Remains') }}</span>
                        <span class="fw-700">{{ Auth::user()->remaining_uploads }} {{ translate('Times')}}</span>
                    </p>
                @else
                    <span class="fs-14 fw-700 mb-4 text-primary">{{translate('Package Not Found')}}</span>
                @endif
                <a href="{{ route('customer_packages_list_show') }}" class="btn btn-primary btn-block fs-14 fw-500" style="border-radius: 25px;">{{ translate('Upgrade Package') }}</a>
            </div>
        </div>
        @endif
        
        <!-- Default Shipping Address -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="p-4 border h-100">
                <h6 class="fw-700 mb-3 text-dark">{{ translate('Default Shipping Address') }}</h6>
                @if(Auth::user()->addresses != null)
                    @php
                        $address = Auth::user()->addresses->where('set_default', 1)->first();
                    @endphp
                    @if($address != null)
                        <ul class="list-unstyled mb-5">
                            <li class="fs-14 fw-400 text-derk pb-1"><span>{{ $address->address }},</span></li>
                            <li class="fs-14 fw-400 text-derk pb-1"><span>{{ $address->postal_code }} - {{ $address->city->name }},</span></li>
                            <li class="fs-14 fw-400 text-derk pb-1"><span>{{ $address->state->name }},</span></li>
                            <li class="fs-14 fw-400 text-derk pb-1"><span>{{ $address->country->name }}.</span></li>
                            <li class="fs-14 fw-400 text-derk pb-1"><span>{{ $address->phone }}</span></li>
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
        <div class="col-6 text-right">
            <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary" href="{{ route('wishlists.index') }}">{{ translate('View All') }}</a>
        </div>
    </div>
    @php
        $wishlists = get_user_wishlist();
    @endphp
    @if (count($wishlists) > 0)
        <div class="row row-cols-xxl-5 row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 gutters-16 border-top border-left mx-1 mx-md-0 mb-4">
            @foreach($wishlists->take(5) as $key => $wishlist)
                @if ($wishlist->product != null)
                    <div class="aiz-card-box col py-3 text-center border-right border-bottom has-transition hov-shadow-out z-1" id="wishlist_{{ $wishlist->id }}">
                        <div class="position-relative h-140px h-md-200px img-fit overflow-hidden mb-3">
                            <!-- Image -->
                            <a href="{{ route('product', $wishlist->product->slug) }}" class="d-block h-100">
                                <img src="{{ uploaded_asset($wishlist->product->thumbnail_img) }}" class="lazyload mx-auto img-fit"
                                    title="{{ $wishlist->product->getTranslation('name') }}">
                            </a>
                            <!-- Remove from wishlisht -->
                            <div class="absolute-top-right aiz-p-hov-icon">
                                <a href="javascript:void(0)" onclick="removeFromWishlist({{ $wishlist->id }})" data-toggle="tooltip" data-title="{{ translate('Remove from wishlist') }}" data-placement="left">
                                    <i class="la la-trash"></i>
                                </a>
                            </div>
                            <!-- add to cart -->
                            <a class="cart-btn absolute-bottom-left w-100 h-35px aiz-p-hov-icon text-white fs-13 fw-700 d-flex justify-content-center align-items-center" 
                                href="javascript:void(0)" onclick="showAddToCartModal({{ $wishlist->product->id }})">{{ translate('Add to Cart') }}</a>
                        </div>
                        <!-- Product Name -->
                        <h5 class="fs-14 mb-0 lh-1-5 fw-400 text-truncate-2 mb-3">
                            <a href="{{ route('product', $wishlist->product->slug) }}" class="text-reset hov-text-primary"
                                title="{{ $wishlist->product->getTranslation('name') }}">{{ $wishlist->product->getTranslation('name') }}</a>
                        </h5>
                        <!-- Price -->
                        <div class="fs-14">
                            <span class="fw-600 text-primary">{{ home_discounted_base_price($wishlist->product) }}</span>
                            @if(home_base_price($wishlist->product) != home_discounted_base_price($wishlist->product))
                                <del class="opacity-60 ml-1">{{ home_base_price($wishlist->product) }}</del>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="row">
            <div class="col">
                <div class="text-center bg-white p-4 border">
                    <img class="mw-100 h-200px" src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                    <h5 class="mb-0 h5 mt-3">{{ translate("There isn't anything added yet")}}</h5>
                </div>
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
