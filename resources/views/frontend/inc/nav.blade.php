        <!-- Top Bar Banner -->
        @php
            $topbar_banner = get_setting('topbar_banner');

            $topbar_banner_medium = get_setting('topbar_banner_medium');

            $topbar_banner_small = get_setting('topbar_banner_small');

            $topbar_banner_asset = uploaded_asset($topbar_banner);

            $header_menu_settings = \App\Models\BusinessSetting::whereIn('type', ['header_menu_labels', 'header_menu_links'])
                ->pluck('value', 'type');
            $header_menu_labels = json_decode($header_menu_settings['header_menu_labels'] ?? '[]', true) ?: [];
            $header_menu_links = json_decode($header_menu_settings['header_menu_links'] ?? '[]', true) ?: [];
            $resolve_header_menu_link = function ($label, $link) {
                $label_slug = strtolower(trim($label));
                $link = trim($link ?: '#');
                $is_placeholder_link = $link == '#' || $link == '' || str_contains($link, 'domain.com');

                if ($label_slug == 'about ecomall' || $label_slug == 'about eco mall' || $label_slug == 'about') {
                    return route('custom-pages.show_custom_page', 'about-us');
                }
                if (($label_slug == 'blog' || $label_slug == 'blogs' || $label_slug == 'news' || $label_slug == 'new') && $is_placeholder_link) {
                    return route('blog');
                }

                return $link;
            };
            $translate_header_menu_label = function ($label) {
                $label = trim($label);
                $label_slug = strtolower($label);

                if ($label_slug == 'home') {
                    return translate('Home');
                }
                if ($label_slug == 'category' || $label_slug == 'categories') {
                    return translate('Category');
                }
                if ($label_slug == 'about ecomall' || $label_slug == 'about eco mall' || $label_slug == 'about') {
                    return translate('About ECO MALL');
                }
                if ($label_slug == 'new' || $label_slug == 'news' || $label_slug == 'blog' || $label_slug == 'blogs') {
                    return translate('News');
                }

                return translate($label);
            };

        @endphp

        @if ($topbar_banner != null)

            <div class="position-relative top-banner removable-session z-1035 d-none" data-key="top-banner"

                data-value="removed">

                <a href="{{ get_setting('topbar_banner_link') }}" class="d-block text-reset h-40px h-lg-60px">

                    <!-- For Large device -->

                    <img src="{{ $topbar_banner_asset }}" class="d-none d-xl-block img-fit h-100" alt="{{ translate('topbar_banner') }}">

                    <!-- For Medium device -->

                    <img src="{{ $topbar_banner_medium != null ? uploaded_asset($topbar_banner_medium) : $topbar_banner_asset }}"

                        class="d-none d-md-block d-xl-none img-fit h-100" alt="{{ translate('topbar_banner') }}">

                    <!-- For Small device -->

                    <img src="{{ $topbar_banner_small != null ? uploaded_asset($topbar_banner_small) : $topbar_banner_asset }}"

                        class="d-md-none img-fit h-100" alt="{{ translate('topbar_banner') }}">

                </a>

                <button class="btn text-white h-100 absolute-top-right set-session" data-key="top-banner"

                    data-value="removed" data-toggle="remove-parent" data-parent=".top-banner">
                    <i class="la la-close la-2x"></i>
                </button>

            </div>

        @endif

    <!-- -- address -->
    <div class="text-white text-center py-2" style="background-color: #2e86c1;">
        <p class="mb-0 font-weight-500 fs-16">
            🚚{{ translate('free_delivery_phnom_penh') }}
        </p>
    </div>

        <!-- Top Bar language -->
    <div class="top-navbar bg-white z-1035 h-35px h-sm-auto">
        <header class="@if (get_setting('header_stikcy') == 'on') sticky-top @endif z-1020 bg-white">

            <!-- Search Bar -->

            <div class="position-relative logo-bar-area ecm-logo-bar border-bottom border-md-nonea z-1025">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <!-- top menu sidebar button -->
                        <button type="button" class="btn d-xl-none mr-3 mr-sm-4 p-0 active" data-toggle="class-toggle"

                            data-target=".aiz-top-menu-sidebar">

                            <svg id="Component_43_1" data-name="Component 43 – 1" xmlns="http://www.w3.org/2000/svg"

                                width="16" height="16" viewBox="0 0 16 16">

                                <rect id="Rectangle_19062" data-name="Rectangle 19062" width="16" height="2"

                                    transform="translate(0 7)" fill="#919199" />

                                <rect id="Rectangle_19063" data-name="Rectangle 19063" width="16" height="2"

                                    fill="#919199" />

                                <rect id="Rectangle_19064" data-name="Rectangle 19064" width="16" height="2"

                                    transform="translate(0 14)" fill="#919199" />

                            </svg>
                        </button>

                        <!-- Header Logo -->

                        <div class="col-auto pl-0 pr-3 d-flex align-items-center ecm-logo-wrap">

                            <a class="d-block py-5px mr-3 ml-0 ecm-logo-link" href="{{ route('home') }}">

                                @php

                                    $header_logo = get_setting('header_logo');

                                @endphp

                                @if ($header_logo != null)

                                    <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}"

                                        class="mw-100 h-30px h-md-40px ecm-header-logo-img" height="40">

                                @else

                                    <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}"

                                        class="mw-100 h-30px h-md-40px ecm-header-logo-img" height="40">

                                @endif

                            </a>

                        </div>

                        <!-- Search field -->
                        <div class="flex-grow-1 front-header-search ecm-header-search d-flex align-items-center bg-white mx-xl-5">

                            <div class="position-relative flex-grow-1 px-3 px-xl-0 ecm-header-search-inner">

                                <form action="{{ route('search') }}" method="GET" class="stop-propagation">

                                    <div class="d-flex position-relative align-items-center">

                                        <div class="d-xl-none" data-toggle="class-toggle"

                                            data-target=".front-header-search">

                                            <button class="btn px-2" type="button"><i

                                                    class="la la-2x la-long-arrow-left"></i></button>

                                        </div>

                                        <div class="search-input-box ecm-search-input-box">

                                            <input type="text"

                                                class="border border-soft-light form-control fs-14 hov-animate-outline ecm-search-input"

                                                id="search" name="keyword"

                                                @isset($query)

                                                value="{{ $query }}"

                                            @endisset

                                                placeholder="{{ translate('Search product, pipes, fittings...') }}" autocomplete="off">
                                                <!-- image icon -->
                                            <img src="{{ static_asset('icons/icon-search.png') }}" alt="{{ translate('Search') }}"
                                                class="ecm-search-icon" width="15" height="15">

                                        </div>

                                    </div>

                                </form>

                                <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100"
                                    style="min-height: 200px">

                                    <div class="search-preloader absolute-top-center">

                                        <div class="dot-loader">

                                            <div></div>

                                            <div></div>

                                            <div></div>

                                        </div>

                                    </div>

                                    <div class="search-nothing d-none p-3 text-center fs-16">



                                    </div>

                                    <div id="search-content" class="text-left">
                                    </div>

                                </div>

                            </div>

                    
                        <!-- Compare -->

                        <!-- <div class="d-none d-lg-block ml-3 mr-0">

                            <div class="" id="compare">

                                @include('frontend.'.get_setting('homepage_select').'.partials.compare')

                            </div>

                        </div> -->

                        <!-- <div class="d-none d-xl-block ml-auto mr-0">

                            @auth

                                <span

                                    class="d-flex align-items-center nav-user-info py-20px @if (isAdmin()) ml-5 @endif"

                                    id="nav-user-info">

                                

                                    <span

                                        class="size-40px rounded-circle overflow-hidden border border-transparent nav-user-img">

                                        @if ($user->avatar_original != null)

                                            <img src="{{ $user_avatar }}"

                                                class="img-fit h-100" alt="{{ translate('avatar') }}"

                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">

                                        @else

                                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="image" alt="{{ translate('avatar') }}"

                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">

                                        @endif

                                    </span>

                                

                                    <h4 class="h5 fs-14 fw-700 text-dark ml-2 mb-0">{{ $user->name }}</h4>

                                </span>

                            @else

                            

                                <span class="d-flex align-items-center nav-user-info ml-3">

                        

                                    <span

                                        class="size-40px rounded-circle overflow-hidden border d-flex align-items-center justify-content-center nav-user-img">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="19.902" height="20.012"

                                            viewBox="0 0 19.902 20.012">

                                            <path id="fe2df171891038b33e9624c27e96e367"

                                                d="M15.71,12.71a6,6,0,1,0-7.42,0,10,10,0,0,0-6.22,8.18,1.006,1.006,0,1,0,2,.22,8,8,0,0,1,15.9,0,1,1,0,0,0,1,.89h.11a1,1,0,0,0,.88-1.1,10,10,0,0,0-6.25-8.19ZM12,12a4,4,0,1,1,4-4A4,4,0,0,1,12,12Z"

                                                transform="translate(-2.064 -1.995)" fill="#91919b" />

                                        </svg>

                                    </span>

                                    <a href="{{ route('user.login') }}"

                                        class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block border-right border-soft-light border-width-2 pr-2 ml-3">{{ translate('Login') }}</a>

                                    <a href="{{ route('user.registration') }}"

                                        class="text-reset opacity-60 hov-opacity-100 hov-text-primary fs-12 d-inline-block py-2 pl-2">{{ translate('Registration') }}</a>

                                </span>

                            @endauth

                        </div> -->

                        <!--  language -->
                    </div>
                    @php
                            $active_languages = get_all_active_language();
                            $current_language = $system_language ?: $active_languages->first();
                            $language_toggle_codes = [
                                'en' => 'EN',
                                'kh' => 'KH',
                                'cn' => 'CN',
                                'zh' => 'CN',
                            ];
                            $language_option_codes = [
                                'en' => 'US',
                                'kh' => 'KH',
                                'cn' => 'CN',
                                'zh' => 'CN',
                            ];
                            $language_names = [
                                'en' => 'English',
                                'kh' => 'ភាសាខ្មែរ',
                                'cn' => '中文',
                                'zh' => '中文',
                            ];
                        @endphp

                        @if ($active_languages->count() > 0 && $current_language != null)
                            <div class="dropdown ecm-language-switcher" id="lang-change">
                                <button class="ecm-language-toggle" type="button" data-toggle="dropdown"
                                    data-display="static" aria-haspopup="true" aria-expanded="false">
                                    <i class="las la-globe"></i>
                                    <span>{{ $language_toggle_codes[$current_language->code] ?? strtoupper($current_language->code) }}</span>
                                    <i class="las la-angle-down"></i>
                                </button>

                                <ul class="dropdown-menu ecm-language-menu">
                                    @foreach ($active_languages as $language)
                                        <li>
                                            <a href="javascript:void(0)" data-flag="{{ $language->code }}"
                                                class="ecm-language-option @if ($current_language->code == $language->code) active @endif">
                                                <span class="ecm-language-code">{{ $language_option_codes[$language->code] ?? strtoupper($language->code) }}</span>
                                                <span class="ecm-language-name">{{ $language_names[$language->code] ?? $language->name }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif



                        <div class="ecm-header-actions d-none d-xl-flex align-items-center">
                            <div class="ecm-header-action ecm-header-wishlist" id="wishlist">
                                @include('frontend.'.get_setting('homepage_select').'.partials.wishlist')
                            </div>

                            <div class="ecm-header-action ecm-header-compare" id="compare">
                                @include('frontend.'.get_setting('homepage_select').'.partials.compare')
                            </div>

                            <!-- notification -->

                            @if (!isAdmin())
                                <div class="dropdown ecm-header-action ecm-header-notification">
                                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);"
                                        role="button" aria-haspopup="false" aria-expanded="false">
                                        <span class="position-relative d-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14.668" height="16"
                                                viewBox="0 0 14.668 16">
                                                <path
                                                    d="M8.333,16A3.34,3.34,0,0,0,11,14.667H5.666A3.34,3.34,0,0,0,8.333,16ZM15.06,9.78a2.457,2.457,0,0,1-.727-1.747V6a6,6,0,1,0-12,0V8.033A2.457,2.457,0,0,1,1.606,9.78,2.083,2.083,0,0,0,3.08,13.333H13.586A2.083,2.083,0,0,0,15.06,9.78Z"
                                                    transform="translate(-0.999)" fill="#91919b" />
                                            </svg>

                                            @auth
                                                <span class="nav-box-text ecm-notification-count">
                                                    {{ count($user->unreadNotifications) }}
                                                </span>
                                            @endauth
                                        </span>
                                        <span class="ecm-header-action-label">{{ translate('Notification') }}</span>
                                    </a>

                                    @auth
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg py-0 ecm-notification-menu">
                                            <div class="ecm-notification-header">
                                                <div>
                                                    <span class="ecm-notification-eyebrow">{{ translate('Account') }}</span>
                                                    <h6 class="mb-0">{{ translate('Notifications') }}</h6>
                                                </div>
                                                <span class="ecm-notification-total">
                                                    {{ count($user->unreadNotifications) }}
                                                </span>
                                            </div>
                                            <div class="ecm-notification-list c-scrollbar-light overflow-auto">
                                                <ul class="list-group list-group-flush mb-0">
                                                    @forelse($user->unreadNotifications as $notification)
                                                        <li class="list-group-item ecm-notification-item">
                                                            @if ($notification->type == 'App\Notifications\OrderNotification')
                                                                @if ($user->user_type == 'customer')
                                                                    <a href="{{ route('purchase_history.details', encrypt($notification->data['order_id'])) }}"
                                                                        class="ecm-notification-link">
                                                                        <span class="ecm-notification-icon">
                                                                            <i class="las la-shopping-bag"></i>
                                                                        </span>
                                                                        <span class="ecm-notification-content">
                                                                            <span class="ecm-notification-title">
                                                                                {{ translate('Order code: ') }}{{ $notification->data['order_code'] }}
                                                                            </span>
                                                                            <span class="ecm-notification-message">
                                                                                {{ translate('has been ' . ucfirst(str_replace('_', ' ', $notification->data['status']))) }}
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                @elseif ($user->user_type == 'seller')
                                                                    <a href="{{ route('seller.orders.show', encrypt($notification->data['order_id'])) }}"
                                                                        class="ecm-notification-link">
                                                                        <span class="ecm-notification-icon">
                                                                            <i class="las la-shopping-bag"></i>
                                                                        </span>
                                                                        <span class="ecm-notification-content">
                                                                            <span class="ecm-notification-title">
                                                                                {{ translate('Order code: ') }}{{ $notification->data['order_code'] }}
                                                                            </span>
                                                                            <span class="ecm-notification-message">
                                                                                {{ translate('has been ' . ucfirst(str_replace('_', ' ', $notification->data['status']))) }}
                                                                            </span>
                                                                        </span>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </li>
                                                    @empty
                                                        <li class="list-group-item ecm-notification-empty">
                                                            <div>
                                                                <i class="las la-bell-slash"></i>
                                                                {{ translate('No notification found') }}
                                                            </div>
                                                        </li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                            <div class="ecm-notification-footer">
                                                <a href="{{ route('all-notifications') }}">
                                                    {{ translate('View All Notifications') }}
                                                </a>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            @endif
                                <!-- button cart -->

                            <div class="nav-cart-box dropdown ecm-header-action ecm-header-cart" id="cart_items">
                                @include('frontend.'.get_setting('homepage_select').'.partials.cart')
                            </div>
                        </div>
                        
                            <!-- button login and logout -->
                        <div class="ecm-header-auth d-none d-xl-flex align-items-center">
                            @auth
                                <a href="{{ route('dashboard') }}" class="ecm-auth-login">
                                    <span class="ecm-auth-login-icon">
                                        @if ($user->avatar_original != null)
                                            <img src="{{ uploaded_asset($user->avatar_original) }}" alt="{{ translate('avatar') }}"
                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                        @else
                                            <img src="{{ static_asset('assets/img/avatar-place.png') }}" alt="{{ translate('avatar') }}">
                                        @endif
                                    </span>
                                    <span>{{ $user->name }}</span>
                                </a>
                                <a href="{{ route('logout') }}" class="ecm-auth-register">
                                    {{ translate('Logout') }}
                                </a>
                            @else
                                <a href="{{ route('user.login') }}" class="ecm-auth-login">
                                    <span class="ecm-auth-login-icon">
                                        <i class="las la-user"></i>
                                    </span>
                                    <span>{{ translate('Login') }}</span>
                                </a>
                                <a href="{{ route('user.registration') }}" class="ecm-auth-register">
                                    {{ translate('Register') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>


                <!-- Loged in user Menus -->

                <div class="hover-user-top-menu position-absolute top-100 left-0 right-0 z-3">

                    <div class="container">

                        <div class="position-static float-right">

                            <div class="aiz-user-top-menu bg-white rounded-0 border-top shadow-sm" style="width:220px;">

                                <ul class="list-unstyled no-scrollbar mb-0 text-left">

                                    @if (isAdmin())

                                        <li class="user-top-nav-element border border-top-0" data-id="1">

                                            <a href="{{ route('admin.dashboard') }}"

                                                class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"

                                                    viewBox="0 0 16 16">

                                                    <path id="Path_2916" data-name="Path 2916"

                                                        d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z"

                                                        fill="#b5b5c0" />

                                                </svg>

                                                <span

                                                    class="user-top-menu-name has-transition ml-3">{{ translate('Dashboard') }}</span>

                                            </a>

                                        </li>

                                    @else

                                        <li class="user-top-nav-element border border-top-0" data-id="1">

                                            <a href="{{ route('dashboard') }}"

                                                class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"

                                                    viewBox="0 0 16 16">

                                                    <path id="Path_2916" data-name="Path 2916"

                                                        d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z"

                                                        fill="#b5b5c0" />

                                                </svg>

                                                <span

                                                    class="user-top-menu-name has-transition ml-3">{{ translate('Dashboard') }}</span>

                                            </a>

                                        </li>

                                    @endif



                                    @if (isCustomer())

                                        <li class="user-top-nav-element border border-top-0" data-id="1">

                                            <a href="{{ route('purchase_history.index') }}"

                                                class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"

                                                    viewBox="0 0 16 16">

                                                    <g id="Group_25261" data-name="Group 25261"

                                                        transform="translate(-27.466 -542.963)">

                                                        <path id="Path_2953" data-name="Path 2953"

                                                            d="M14.5,5.963h-4a1.5,1.5,0,0,0,0,3h4a1.5,1.5,0,0,0,0-3m0,2h-4a.5.5,0,0,1,0-1h4a.5.5,0,0,1,0,1"

                                                            transform="translate(22.966 537)" fill="#b5b5bf" />

                                                        <path id="Path_2954" data-name="Path 2954"

                                                            d="M12.991,8.963a.5.5,0,0,1,0-1H13.5a2.5,2.5,0,0,1,2.5,2.5v10a2.5,2.5,0,0,1-2.5,2.5H2.5a2.5,2.5,0,0,1-2.5-2.5v-10a2.5,2.5,0,0,1,2.5-2.5h.509a.5.5,0,0,1,0,1H2.5a1.5,1.5,0,0,0-1.5,1.5v10a1.5,1.5,0,0,0,1.5,1.5h11a1.5,1.5,0,0,0,1.5-1.5v-10a1.5,1.5,0,0,0-1.5-1.5Z"

                                                            transform="translate(27.466 536)" fill="#b5b5bf" />

                                                        <path id="Path_2955" data-name="Path 2955"

                                                            d="M7.5,15.963h1a.5.5,0,0,1,.5.5v1a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1-.5-.5v-1a.5.5,0,0,1,.5-.5"

                                                            transform="translate(23.966 532)" fill="#b5b5bf" />

                                                        <path id="Path_2956" data-name="Path 2956"

                                                            d="M7.5,21.963h1a.5.5,0,0,1,.5.5v1a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1-.5-.5v-1a.5.5,0,0,1,.5-.5"

                                                            transform="translate(23.966 529)" fill="#b5b5bf" />

                                                        <path id="Path_2957" data-name="Path 2957"

                                                            d="M7.5,27.963h1a.5.5,0,0,1,.5.5v1a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1-.5-.5v-1a.5.5,0,0,1,.5-.5"

                                                            transform="translate(23.966 526)" fill="#b5b5bf" />

                                                        <path id="Path_2958" data-name="Path 2958"

                                                            d="M13.5,16.963h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"

                                                            transform="translate(20.966 531.5)" fill="#b5b5bf" />

                                                        <path id="Path_2959" data-name="Path 2959"

                                                            d="M13.5,22.963h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"

                                                            transform="translate(20.966 528.5)" fill="#b5b5bf" />

                                                        <path id="Path_2960" data-name="Path 2960"

                                                            d="M13.5,28.963h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"

                                                            transform="translate(20.966 525.5)" fill="#b5b5bf" />

                                                    </g>

                                                </svg>

                                                <span

                                                    class="user-top-menu-name has-transition ml-3">{{ translate('Purchase History') }}</span>

                                            </a>

                                        </li>

                                        <li class="user-top-nav-element border border-top-0" data-id="1">

                                            <a href="{{ route('digital_purchase_history.index') }}"

                                                class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16.001" height="16"

                                                    viewBox="0 0 16.001 16">

                                                    <g id="Group_25262" data-name="Group 25262"

                                                        transform="translate(-1388.154 -562.604)">

                                                        <path id="Path_2963" data-name="Path 2963"

                                                            d="M77.864,98.69V92.1a.5.5,0,1,0-1,0V98.69l-1.437-1.437a.5.5,0,0,0-.707.707l1.851,1.852a1,1,0,0,0,.707.293h.172a1,1,0,0,0,.707-.293l1.851-1.852a.5.5,0,0,0-.7-.713Z"

                                                            transform="translate(1318.79 478.5)" fill="#b5b5bf" />

                                                        <path id="Path_2964" data-name="Path 2964"

                                                            d="M67.155,88.6a3,3,0,0,1-.474-5.963q-.009-.089-.015-.179a5.5,5.5,0,0,1,10.977-.718,3.5,3.5,0,0,1-.989,6.859h-1.5a.5.5,0,0,1,0-1l1.5,0a2.5,2.5,0,0,0,.417-4.967.5.5,0,0,1-.417-.5,4.5,4.5,0,1,0-8.908.866.512.512,0,0,1,.009.121.5.5,0,0,1-.52.479,2,2,0,1,0-.162,4l.081,0h2a.5.5,0,0,1,0,1Z"

                                                            transform="translate(1324 486)" fill="#b5b5bf" />

                                                    </g>

                                                </svg>

                                                <span

                                                    class="user-top-menu-name has-transition ml-3">{{ translate('Downloads') }}</span>

                                            </a>

                                        </li>

                                        @if (get_setting('conversation_system') == 1)

                                            <li class="user-top-nav-element border border-top-0" data-id="1">

                                                <a href="{{ route('conversations.index') }}"

                                                    class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"

                                                        viewBox="0 0 16 16">

                                                        <g id="Group_25263" data-name="Group 25263"

                                                            transform="translate(1053.151 256.688)">

                                                            <path id="Path_3012" data-name="Path 3012"

                                                                d="M134.849,88.312h-8a2,2,0,0,0-2,2v5a2,2,0,0,0,2,2v3l2.4-3h5.6a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2m1,7a1,1,0,0,1-1,1h-8a1,1,0,0,1-1-1v-5a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1Z"

                                                                transform="translate(-1178 -341)" fill="#b5b5bf" />

                                                            <path id="Path_3013" data-name="Path 3013"

                                                                d="M134.849,81.312h8a1,1,0,0,1,1,1v5a1,1,0,0,1-1,1h-.5a.5.5,0,0,0,0,1h.5a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2h-8a2,2,0,0,0-2,2v.5a.5.5,0,0,0,1,0v-.5a1,1,0,0,1,1-1"

                                                                transform="translate(-1182 -337)" fill="#b5b5bf" />

                                                            <path id="Path_3014" data-name="Path 3014"

                                                                d="M131.349,93.312h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"

                                                                transform="translate(-1181 -343.5)" fill="#b5b5bf" />

                                                            <path id="Path_3015" data-name="Path 3015"

                                                                d="M131.349,99.312h5a.5.5,0,1,1,0,1h-5a.5.5,0,1,1,0-1"

                                                                transform="translate(-1181 -346.5)" fill="#b5b5bf" />

                                                        </g>

                                                    </svg>

                                                    <span

                                                        class="user-top-menu-name has-transition ml-3">{{ translate('Conversations') }}</span>

                                                </a>

                                            </li>

                                        @endif



                                        @if (get_setting('wallet_system') == 1)

                                            <li class="user-top-nav-element border border-top-0" data-id="1">

                                                <a href="{{ route('wallet.index') }}"

                                                    class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">

                                                    <svg xmlns="http://www.w3.org/2000/svg"

                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="16"

                                                        height="16" viewBox="0 0 16 16">

                                                        <defs>

                                                            <clipPath id="clip-path1">

                                                                <rect id="Rectangle_1386" data-name="Rectangle 1386"

                                                                    width="16" height="16" fill="#b5b5bf" />

                                                            </clipPath>

                                                        </defs>

                                                        <g id="Group_8102" data-name="Group 8102"

                                                            clip-path="url(#clip-path1)">

                                                            <path id="Path_2936" data-name="Path 2936"

                                                                d="M13.5,4H13V2.5A2.5,2.5,0,0,0,10.5,0h-8A2.5,2.5,0,0,0,0,2.5v11A2.5,2.5,0,0,0,2.5,16h11A2.5,2.5,0,0,0,16,13.5v-7A2.5,2.5,0,0,0,13.5,4M2.5,1h8A1.5,1.5,0,0,1,12,2.5V4H2.5a1.5,1.5,0,0,1,0-3M15,11H10a1,1,0,0,1,0-2h5Zm0-3H10a2,2,0,0,0,0,4h5v1.5A1.5,1.5,0,0,1,13.5,15H2.5A1.5,1.5,0,0,1,1,13.5v-9A2.5,2.5,0,0,0,2.5,5h11A1.5,1.5,0,0,1,15,6.5Z"

                                                                fill="#b5b5bf" />

                                                        </g>

                                                    </svg>

                                                    <span

                                                        class="user-top-menu-name has-transition ml-3">{{ translate('My Wallet') }}</span>

                                                </a>

                                            </li>

                                        @endif

                                        <li class="user-top-nav-element border border-top-0" data-id="1">

                                            <a href="{{ route('support_ticket.index') }}"

                                                class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16.001"

                                                    viewBox="0 0 16 16.001">

                                                    <g id="Group_25259" data-name="Group 25259"

                                                        transform="translate(-316 -1066)">

                                                        <path id="Subtraction_184" data-name="Subtraction 184"

                                                            d="M16427.109,902H16420a8.015,8.015,0,1,1,8-8,8.278,8.278,0,0,1-1.422,4.535l1.244,2.132a.81.81,0,0,1,0,.891A.791.791,0,0,1,16427.109,902ZM16420,887a7,7,0,1,0,0,14h6.283c.275,0,.414,0,.549-.111s-.209-.574-.34-.748l0,0-.018-.022-1.064-1.6A6.829,6.829,0,0,0,16427,894a6.964,6.964,0,0,0-7-7Z"

                                                            transform="translate(-16096 180)" fill="#b5b5bf" />

                                                        <path id="Union_12" data-name="Union 12"

                                                            d="M16414,895a1,1,0,1,1,1,1A1,1,0,0,1,16414,895Zm.5-2.5V891h.5a2,2,0,1,0-2-2h-1a3,3,0,1,1,3.5,2.958v.54a.5.5,0,1,1-1,0Zm-2.5-3.5h1a.5.5,0,1,1-1,0Z"

                                                            transform="translate(-16090.998 183.001)" fill="#b5b5bf" />

                                                    </g>

                                                </svg>

                                                <span

                                                    class="user-top-menu-name has-transition ml-3">{{ translate('Support Ticket') }}</span>

                                            </a>

                                        </li>

                                    @endif

                                    <li class="user-top-nav-element border border-top-0" data-id="1">

                                        <a href="{{ route('logout') }}"

                                            class="text-truncate text-dark px-4 fs-14 d-flex align-items-center hov-column-gap-1">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15.999"

                                                viewBox="0 0 16 15.999">

                                                <g id="Group_25503" data-name="Group 25503"

                                                    transform="translate(-24.002 -377)">

                                                    <g id="Group_25265" data-name="Group 25265"

                                                        transform="translate(-216.534 -160)">

                                                        <path id="Subtraction_192" data-name="Subtraction 192"

                                                            d="M12052.535,2920a8,8,0,0,1-4.569-14.567l.721.72a7,7,0,1,0,7.7,0l.721-.72a8,8,0,0,1-4.567,14.567Z"

                                                            transform="translate(-11803.999 -2367)" fill="#d43533" />

                                                    </g>

                                                    <rect id="Rectangle_19022" data-name="Rectangle 19022" width="1"

                                                        height="8" rx="0.5" transform="translate(31.5 377)"

                                                        fill="#d43533" />

                                                </g>

                                            </svg>

                                            <span

                                                class="user-top-menu-name text-primary has-transition ml-3">{{ translate('Logout') }}</span>

                                        </a>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- Menu Bar -->

            <div class="d-none d-xl-block position-relative bg-primary h-50px">

                <div class="container h-100">

                    <div class="d-flex h-100">

                        <!-- Header Menus -->

                        @php

                            $nav_txt_color = ((get_setting('header_nav_menu_text') == 'light') ||  (get_setting('header_nav_menu_text') == null)) ? 'text-white' : 'text-dark';

                        @endphp

                        <div class="ml-xl-4 w-100 overflow-hidden">

                            <div class="d-flex align-items-center justify-content-center justify-content-xl-start h-100">

                                <ul class="list-inline mb-0 pl-0 hor-swipe c-scrollbar-light">

                                    @if (!empty($header_menu_labels))

                                        @foreach ($header_menu_labels as $key => $value)

                                            @php
                                                $is_category_menu = strtolower(trim($value)) == 'category';
                                                $header_menu_link = $is_category_menu ? 'javascript:void(0);' : $resolve_header_menu_link($value, $header_menu_links[$key] ?? '#');
                                            @endphp

                                            <li class="list-inline-item mr-0 animate-underline-white">

                                                <a href="{{ $header_menu_link }}"
                                                    @if ($is_category_menu) id="category-menu-bar" @endif

                                                    class="fs-16 px-3 py-3 d-inline-block fw-700 {{ $nav_txt_color }} header_menu_links hov-bg-black-10

                                                @if ($header_menu_link != '#' && url()->current() == $header_menu_link) active @endif">

                                                    {{ $translate_header_menu_label($value) }}
                                                    @if ($is_category_menu)
                                                        <i class="las la-angle-down ml-1 has-transition" id="category-menu-bar-icon"></i>
                                                    @endif

                                                </a>

                                            </li>

                                        @endforeach

                                    @endif

                                </ul>

                            </div>

                        </div> 

                    </div>

                </div>

                <!-- Categoty Menus -->

                <div class="hover-category-menu position-absolute w-100 top-100 left-0 right-0 z-3 d-none"

                    id="click-category-menu">

                    <div class="container">

                        <div class="d-flex position-relative">

                            <div class="position-static ecm-category-menu-panel">

                                @include('frontend.'.get_setting("homepage_select").'.partials.category_menu')

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </header>



        <!-- Top Menu Sidebar -->

    <div class="aiz-top-menu-sidebar collapse-sidebar-wrap sidebar-xl sidebar-left d-xl-none z-1035">
            <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle"
                data-target=".aiz-top-menu-sidebar" data-same=".hide-top-menu-bar"></div>
            <div class="collapse-sidebar c-scrollbar-light text-left ecm-mobile-sidebar">
                <button type="button" class="btn btn-sm p-4 hide-top-menu-bar ecm-mobile-sidebar-close" data-toggle="class-toggle"
                    data-target=".aiz-top-menu-sidebar">
                    <i class="las la-times la-2x text-primary"></i>
                </button>
                @auth
                    <a href="{{ isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="ecm-mobile-sidebar-head ecm-mobile-account-head">
                        <span class="size-40px rounded-circle overflow-hidden border border-transparent nav-user-img">
                            @if ($user->avatar_original != null)
                                <img src="{{ $user_avatar }}" class="img-fit h-100" alt="{{ translate('avatar') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                            @else
                                <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="image" alt="{{ translate('avatar') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                            @endif
                        </span>
                        <div class="ecm-mobile-brand-copy">
                            <strong>{{ $user->name }}</strong>
                            <small>{{ translate('My Account') }}</small>
                        </div>
                    </a>
                @else
                    <div class="ecm-mobile-sidebar-head">
                        <a href="{{ route('home') }}" class="ecm-mobile-brand-logo">
                            @if ($header_logo != null)
                                <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}">
                            @else
                                <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}">
                            @endif
                        </a>
    
                    </div>

                    <div class="ecm-mobile-auth-actions">
                        <a href="{{ route('user.login') }}" class="ecm-mobile-auth-btn ecm-mobile-login-btn">
                            <i class="las la-user"></i> {{ translate('Login') }}
                        </a>

                        <a href="{{ route('user.registration') }}" class="ecm-mobile-auth-btn ecm-mobile-register-btn">
                            {{ translate('Register') }}
                        </a>
                    </div>

                @endauth

                <div class="ecm-mobile-section-title">{{ translate('Main Menu') }}</div>

                <ul class="mb-0 pl-0 pb-2 ecm-mobile-menu-list">

                    @php
                        $mobile_notification_count = Auth::check() ? count(Auth::user()->unreadNotifications) : 0;
                        $mobile_wishlist_count = Auth::check() ? Auth::user()->wishlists()->count() : 0;
                        $mobile_cart_count = isset($carts) ? count($carts) : 0;
                        $mobile_compare_count = Session::has('compare') ? count(Session::get('compare')) : 0;
                        $mobile_header_menu_labels = $header_menu_labels;
                        $mobile_header_menu_links = $header_menu_links;
                    @endphp

                    @foreach ($mobile_header_menu_labels as $key => $value)
                        @php
                            $mobile_menu_label = trim($value);
                            $mobile_menu_slug = strtolower($mobile_menu_label);
                            $is_mobile_category_menu = $mobile_menu_slug == 'category' || $mobile_menu_slug == 'categories';
                            $mobile_header_menu_link = $is_mobile_category_menu ? 'javascript:void(0);' : $resolve_header_menu_link($mobile_menu_label, $mobile_header_menu_links[$key] ?? '#');
                            $mobile_menu_item_class = 'ecm-mobile-db-item';
                            $mobile_menu_icon_class = 'la-circle';

                            if ($mobile_menu_slug == 'home') {
                                $mobile_menu_item_class .= ' ecm-mobile-home-item';
                                $mobile_menu_icon_class = 'la-home';
                            } elseif ($is_mobile_category_menu) {
                                $mobile_menu_item_class .= ' ecm-mobile-category-item';
                                $mobile_menu_icon_class = 'la-list-ul';
                            } elseif (str_contains($mobile_menu_slug, 'ecomall')) {
                                $mobile_menu_item_class .= ' ecm-mobile-about-ecomall-item';
                                $mobile_menu_icon_class = 'la-info-circle';
                            } elseif (str_contains($mobile_menu_slug, 'about')) {
                                $mobile_menu_item_class .= ' ecm-mobile-about-item';
                                $mobile_menu_icon_class = 'la-info';
                            } elseif ($mobile_menu_slug == 'new' || $mobile_menu_slug == 'news') {
                                $mobile_menu_item_class .= ' ecm-mobile-news-item';
                                $mobile_menu_icon_class = 'la-newspaper';
                            }
                        @endphp

                        <li class="mr-0 {{ $mobile_menu_item_class }}">
                            <a href="{{ $mobile_header_menu_link }}"
                                class="@if ($is_mobile_category_menu) js-mobile-category-toggle @endif fs-13 px-3 py-3 w-100 d-flex align-items-center @if ($is_mobile_category_menu) justify-content-between @endif fw-700 text-dark header_menu_links @if (!$is_mobile_category_menu && $mobile_header_menu_link != '#' && url()->current() == $mobile_header_menu_link) active @endif">
                                <span class="ecm-mobile-row-icon">
                                    @if ($mobile_menu_slug == 'home')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                            <path d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z" fill="currentColor" />
                                        </svg>
                                    @elseif ($is_mobile_category_menu)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                            <path d="M5,0H0V5A2,2,0,0,0,2,7H5A2,2,0,0,0,7,5V2A2,2,0,0,0,5,0M6,5A1,1,0,0,1,5,6H2A1,1,0,0,1,1,5V1H5A1,1,0,0,1,6,2Z" fill="currentColor" />
                                            <path d="M13,9H10a2,2,0,0,0-2,2v3a2,2,0,0,0,2,2h5V11a2,2,0,0,0-2-2m1,6H10a1,1,0,0,1-1-1V11a1,1,0,0,1,1-1h3a1,1,0,0,1,1,1Z" fill="currentColor" />
                                            <path d="M11.5,0A3.5,3.5,0,1,0,15,3.5,3.5,3.5,0,0,0,11.5,0m0,6A2.5,2.5,0,1,1,14,3.5,2.5,2.5,0,0,1,11.5,6" fill="currentColor" />
                                            <path d="M3.5,9A3.5,3.5,0,1,0,7,12.5,3.5,3.5,0,0,0,3.5,9m0,6A2.5,2.5,0,1,1,6,12.5,2.5,2.5,0,0,1,3.5,15" fill="currentColor" />
                                        </svg>
                                    @else
                                        <i class="las {{ $mobile_menu_icon_class }}"></i>
                                    @endif
                                </span>
                                <span class="ecm-mobile-link-label">{{ $translate_header_menu_label($value) }}</span>
                                @if ($is_mobile_category_menu)
                                    <i class="las la-angle-down mobile-category-arrow has-transition"></i>
                                @endif
                            </a>

                            @if ($is_mobile_category_menu)
                                <ul class="list-unstyled mobile-category-dropdown mb-0" style="display: none;">
                                    @foreach (\App\Models\Category::with('subcategories')->where('parent_id', 0)->orderBy('order_level', 'desc')->get() as $category)
                                        @php
                                            $category_icon = $category->icon ?: static_asset('assets/img/placeholder.jpg');
                                        @endphp
                                        <li>
                                            <a href="{{ route('products.category', $category->slug) }}"
                                                class="mobile-category-parent d-flex align-items-center text-dark">
                                                <img src="{{ $category_icon }}" alt="{{ $category->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                <span>{{ $category->getTranslation('name') }}</span>
                                            </a>

                                            @if ($category->subcategories->count())
                                                <ul class="list-unstyled mobile-subcategory-list mb-1">
                                                    @foreach ($category->subcategories as $subcategory)
                                                        @php
                                                            $subcategory_image = $subcategory->image ?: static_asset('assets/img/placeholder.jpg');
                                                        @endphp
                                                        <li>
                                                            <a href="{{ route('products.subcategory', [$category->slug, $subcategory->slug]) }}"
                                                                class="mobile-subcategory-link d-flex align-items-center text-dark">
                                                                <img src="{{ $subcategory_image }}" alt="{{ $subcategory->name }}"
                                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                                                <span>{{ $subcategory->name }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach

                </ul>

                <div class="ecm-mobile-section-title">{{ translate('Models') }}</div>

                <ul class="mb-0 pl-0 pb-2 ecm-mobile-menu-list ecm-mobile-model-list">
                    <li class="mr-0 ecm-mobile-wishlist-item">
                        <a href="{{ Auth::check() ? route('wishlists.index') : route('user.login') }}"
                            class="fs-13 px-3 py-3 w-100 d-flex align-items-center justify-content-between fw-700 text-dark header_menu_links">
                            <span class="ecm-mobile-row-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14.4" viewBox="0 0 16 14.4">
                                    <g transform="translate(-3.05 -4.178)">
                                        <path d="M11.3,5.507l-.247.246L10.8,5.506A4.538,4.538,0,1,0,4.38,11.919l.247.247,6.422,6.412,6.422-6.412.247-.247A4.538,4.538,0,1,0,11.3,5.507Z" fill="#919199"/>
                                    </g>
                                </svg>
                            </span>
                            <span class="ecm-mobile-link-label">{{ translate('Wishlist') }}</span>
                            <span class="ecm-mobile-count-badge">{{ $mobile_wishlist_count }}</span>
                        </a>
                    </li>

                    <li class="mr-0 ecm-mobile-notification-item">
                        <a href="{{ Auth::check() ? route('all-notifications') : route('user.login') }}"
                            class="fs-13 px-3 py-3 w-100 d-flex align-items-center justify-content-between fw-700 text-dark header_menu_links">
                            <span class="ecm-mobile-row-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14.668" height="16" viewBox="0 0 14.668 16">
                                    <path d="M8.333,16A3.34,3.34,0,0,0,11,14.667H5.666A3.34,3.34,0,0,0,8.333,16ZM15.06,9.78a2.457,2.457,0,0,1-.727-1.747V6a6,6,0,1,0-12,0V8.033A2.457,2.457,0,0,1,1.606,9.78,2.083,2.083,0,0,0,3.08,13.333H13.586A2.083,2.083,0,0,0,15.06,9.78Z" transform="translate(-0.999)" fill="#91919b" />
                                </svg>
                            </span>
                            <span class="ecm-mobile-link-label">{{ translate('Notification') }}</span>
                            <span class="ecm-mobile-count-badge">{{ $mobile_notification_count }}</span>
                        </a>
                    </li>

                    <li class="mr-0 ecm-mobile-compare-item">
                        <a href="{{ route('compare') }}"
                            class="fs-13 px-3 py-3 w-100 d-flex align-items-center justify-content-between fw-700 text-dark header_menu_links">
                            <span class="ecm-mobile-row-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                    <path d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z" transform="translate(-2.037 -2.038)" fill="#919199"/>
                                </svg>
                            </span>
                            <span class="ecm-mobile-link-label">{{ translate('Compare') }}</span>
                            <span class="ecm-mobile-count-badge" id="compare_items_sidenav">{{ $mobile_compare_count }}</span>
                        </a>
                    </li>

                    <li class="mr-0 ecm-mobile-cart-item">
                        <a href="{{ route('cart') }}"
                            class="fs-13 px-3 py-3 w-100 d-flex align-items-center justify-content-between fw-700 text-dark header_menu_links">
                            <span class="ecm-mobile-row-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="18.8" viewBox="0 0 24 20.562">
                                    <g transform="translate(-33.276 -101)">
                                        <path d="M34.034,102.519H38.2l-.732-.557c.122.37.243.739.365,1.112q.441,1.333.879,2.666.528,1.6,1.058,3.211.46,1.394.917,2.788c.149.451.291.9.446,1.352l.008.02a.76.76,0,0,0,1.466-.4c-.122-.37-.243-.739-.365-1.112q-.441-1.333-.879-2.666-.528-1.607-1.058-3.213-.46-1.394-.917-2.788c-.149-.451-.289-.9-.446-1.352l-.008-.02a.783.783,0,0,0-.732-.557H34.037a.76.76,0,0,0,0,1.519Z" fill="#919199"/>
                                        <circle cx="1.724" cy="1.724" r="1.724" transform="translate(49.612 117.606)" fill="#919199"/>
                                        <circle cx="1.724" cy="1.724" r="1.724" transform="translate(40.884 117.606)" fill="#919199"/>
                                        <path d="M287.2,258l-3.074,7.926H272.313L269.7,258Z" transform="translate(-230.437 -153.024)" fill="#919199"/>
                                    </g>
                                </svg>
                            </span>
                            <span class="ecm-mobile-link-label">{{ translate('Cart') }}</span>
                            <span class="ecm-mobile-count-badge">{{ $mobile_cart_count }}</span>
                        </a>
                    </li>
                </ul>

                @php
                    $mobile_active_languages = get_all_active_language();
                    $mobile_current_language = $system_language ?: $mobile_active_languages->first();
                    $mobile_language_codes = [
                        'en' => 'US',
                        'kh' => 'KH',
                        'cn' => 'CN',
                        'zh' => 'CN',
                    ];
                    $mobile_language_names = [
                        'en' => 'English',
                        'kh' => 'ខ្មែរ',
                        'cn' => '中文',
                        'zh' => '中文',
                    ];
                @endphp

                @if ($mobile_active_languages->count() > 0 && $mobile_current_language != null)
                    <div class="ecm-mobile-language-section">
                        <div class="ecm-mobile-section-title">{{ translate('Language') }}</div>
                        <div class="ecm-mobile-language-grid">
                            @foreach ($mobile_active_languages->take(3) as $language)
                                <a href="javascript:void(0)"
                                    data-flag="{{ $language->code }}"
                                    class="js-language-change ecm-mobile-language-card @if ($mobile_current_language->code == $language->code) active @endif">
                                    <strong>{{ $mobile_language_codes[$language->code] ?? strtoupper($language->code) }}</strong>
                                    <span>{{ $mobile_language_names[$language->code] ?? $language->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @auth
                    <div class="ecm-mobile-logout-wrap">
                        <a href="{{ route('logout') }}" class="ecm-mobile-logout-btn">
                            <i class="las la-sign-out-alt"></i> {{ translate('Logout') }}
                        </a>
                    </div>
                @endauth

                <br>

                <br>

            </div>

        </div>



        <!-- Modal -->

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div id="order-details-modal-body"> </div>
                </div>
            </div>
        </div>



        @section('script')

            <script type="text/javascript">

                function show_order_details(order_id) {

                    $('#order-details-modal-body').html(null);



                    if (!$('#modal-size').hasClass('modal-lg')) {

                        $('#modal-size').addClass('modal-lg');

                    }



                    $.post('{{ route('orders.details') }}', {

                        _token: AIZ.data.csrf,

                        order_id: order_id

                    }, function(data) {

                        $('#order-details-modal-body').html(data);

                        $('#order_details').modal();

                        $('.c-preloader').hide();

                        AIZ.plugins.bootstrapSelect('refresh');

                    });

                }

            </script>

        @endsection

<!-- ================================================ -->
 
