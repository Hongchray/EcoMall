@extends('frontend.layouts.app')
@section('content')

    <!-- Sliders -->
<style>


    #homeCarousel .carousel-inner {
        position: relative;
    }

    #homeCarousel .carousel-item {
        transition: opacity 0.8s ease-in-out;
    }

    #homeCarousel .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }




    /* Indicators */
    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.5);
        border: none;
        margin: 0 6px;
        transition: all 0.3s ease;
    }

    .carousel-indicators .active {
        width: 26px;
        border-radius: 10px;
        background-color: #fff;
    }

    /* Nav arrows */
    .carousel-control-prev,
    .carousel-control-next {
        width: 40px;
        height: 40px;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0,0,0,0.4);
        border-radius: 50%;
        opacity: 0;
        transition: 0.3s;
    }

    #homeCarousel:hover .carousel-control-prev,
    #homeCarousel:hover .carousel-control-next {
        opacity: 1;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-size: 60% 60%;
    }

    .btn-glass {
        background-color: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.6);
        color: #fff;
        transition: all 0.25s ease;
    }

    .btn-glass:hover {
        background-color: #fff;
        color: #000;
        border-color: #fff;
    }
    .hero-wrapper {
        height: 400px;
        gap: 12px;
    }

    /* LEFT SIDE */
    .hero-left {
        width: 75%;
        height: 400px; /* desktop */
        border-radius: 15px;
        overflow: hidden;
    }

    .hero-right img,
    .hero-left img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-right .hero-box {
        height: 195px; /* desktop (2 boxes stacked feel) */
    }
    /* RIGHT SIDE */
    .hero-right {
        width: 25%;
        height: 100%;
        display: flex;
        gap: 12px;
        flex-direction: column;
        /* background-color: gray; */
    }

    /* RIGHT BOX */
    .hero-box {
        flex: 1;
        border-radius: 15px;
        overflow: hidden;
    }


    .hero-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .scroll-cards {
        scrollbar-width: none; /* Firefox */
         gap: 12px; /* exact spacing */
    }

    .scroll-cards::-webkit-scrollbar {
        display: none; /* Chrome */
    }

    .card-item {
        min-width: 260px;
        flex: 0 0 auto;
    }


    @media (min-width: 768px) and (max-width: 991px) {

        .hero-wrapper {
            height: 550px;
            flex-direction: column !important;
            gap: 16px;
        }

        /* BIG SLIDER */
        .hero-left {
            width: 100%;
            height: 325px;
        }

        /* RIGHT BANNERS */
        .hero-right {
            width: 100%;
            height: 225px;
            flex-direction: row;
            gap: 16px;
        }

        .hero-right .hero-box {
            height: 100%;
        }
    }


    @media (max-width: 767px) {

        .hero-wrapper {
            height: 300px;
            flex-direction: column !important;
            gap: 12px;
        }

        .hero-left {
            width: 100%;
            height: 170px;
            border-radius: 14px;
        }

        .hero-right {
            width: 100%;
            height: 130px;
            flex-direction: row;
            gap: 12px;
        }

        .hero-right .hero-box {
            height: 100%;
            border-radius: 14px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            display: none;
        }
    }


</style>
    <div class="home-banner-area mb-3 " style="padding: 12px">
        <div class="container mt-4">

            <div class="hero-wrapper d-flex flex-column flex-lg-row gap-4 ">

                <!-- LEFT -->
                <div class="hero-left bg-light shadow-sm">

                    <div id="homeCarousel"
                        class="carousel slide carousel-fade h-100"
                        data-bs-ride="carousel"
                        data-bs-interval="5000"
                        data-bs-pause="hover"
                        data-bs-wrap="true">

                        <div class="carousel-indicators" style="bottom: 12px;">
                            @foreach ($banners as $key => $banner)
                                <button type="button"
                                    data-bs-target="#homeCarousel"
                                    data-bs-slide-to="{{ $key }}"
                                    class="{{ $key == 0 ? 'active' : '' }}">
                                </button>
                            @endforeach
                        </div>

                        <div class="carousel-inner h-100">

                            @forelse ($banners as $key => $banner)
                                <div class="carousel-item h-100 {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ $banner->image }}"
                                        class="d-block w-100 h-100"
                                        style="object-fit: cover;"
                                        alt="banner">
                                </div>
                            @empty
                                <div class="carousel-item active h-100">
                                    <img src="https://via.placeholder.com/1200x400?text=No+Banner"
                                        class="d-block w-100 h-100"
                                        style="object-fit: cover;">
                                </div>
                            @endforelse

                        </div>

                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#homeCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button"
                            data-bs-target="#homeCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="hero-right d-flex">

                    <div class="hero-box bg-warning shadow-sm">
                        <a href="#">
                            <img src="https://media.istockphoto.com/id/2009037625/vector/best-seller-banner-template-on-the-abstract-pop-art-sunburst-background-vector-illustration.jpg"
                                alt="image 1">
                        </a>
                    </div>

                    <div class="hero-box bg-warning shadow-sm">
                        <a href="#">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTH2QSabe9ESh22w-_HPGk4j3KcnQWZO3Hc3Q&s"
                                alt="image 2">
                        </a>
                    </div>

                </div>

            </div>
            <div class="container-fluid mt-3 p-0">

                <!-- scroll wrapper -->
                <div class="scroll-cards d-flex d-lg-none overflow-auto pb-2">

                    <!-- Card -->
                    <div class="card-item">
                        <div class="d-flex align-items-center border rounded-3 shadow-sm bg-white h-100 p-3">
                            <img src="/icons/delivery-bike.png"
                                class="me-3 flex-shrink-0" style="width:45px;">

                            <div class="ml-2">
                                <h6 class="mb-1 fw-bold ecm-benefit-title">
                                    {{ translate('Fast Delivery') }}
                                </h6>

                                <small class="text-muted ecm-benefit-text">
                                    {{ translate('phnom_penh_nationwide') }}
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="d-flex align-items-center border rounded-3 shadow-sm bg-white h-100 p-3">
                            <img src="/icons/quality-assurance.png"
                                class="me-3 flex-shrink-0" style="width:45px;">
                            <div class="ml-2">
                                <h6 class="mb-1 fw-bold">{{ translate('Quality Assured') }}</h6>
                                <small class="text-muted">{{ translate('Certified products only') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="d-flex align-items-center border rounded-3 shadow-sm bg-white h-100 p-3">
                            <img src="/icons/best-price.png"
                                class="me-3 flex-shrink-0" style="width:45px;">
                            <div class="ml-2">
                                <h6 class="mb-1 fw-bold">{{ translate('Best Prices') }}</h6>
                                <small class="text-muted">{{ translate('Wholesale & retail rates') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="d-flex align-items-center border rounded-3 shadow-sm bg-white h-100 p-3">
                            <img src="/icons/telephone.png"
                                class="me-3 flex-shrink-0" style="width:45px;">
                            <div class="ml-2">
                                <h6 class="mb-1 fw-bold">{{ translate('24/7 Support') }}</h6>
                                <small class="text-muted">{{ translate('078 333 016') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- normal grid for desktop -->
                <div class="row g-3 d-none d-lg-flex">

                    <div class="col-lg-3">
                        <div class="d-flex align-items-center g-2 border rounded-3 shadow-sm bg-white h-100 p-3">
                            <img src="/icons/delivery-bike.png"
                                class="me-3 flex-shrink-0" style="width:45px;">
                            <div class="ml-2">
                                <h6 class="mb-1 fw-bold ecm-benefit-title">
                                    {{ translate('Fast Delivery') }}
                                </h6>
                                <small class="text-muted ecm-benefit-text">{{ translate('phnom_penh_nationwide') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="d-flex align-items-center border rounded-3 shadow-sm bg-white h-100 p-3">
                            <img src="/icons/quality-assurance.png"
                                class="me-3 flex-shrink-0" style="width:45px;">
                            <div class="ml-2">
                                <h6 class="mb-1 fw-bold ecm-benefit-title">{{ translate('quality_assured') }}</h6>
                                <small class="text-muted ecm-benefit-text">{{ translate('certified_products_only') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="d-flex align-items-center border rounded-3 shadow-sm bg-white h-100 p-3">
                            <img src="/icons/best-price.png"
                                class="me-3 flex-shrink-0" style="width:45px;">
                            <div class="ml-2">
                                <h6 class="mb-1 fw-bold ecm-benefit-title">{{ translate('best_prices') }}</h6>
                                <small class="text-muted ecm-benefit-text">{{ translate('wholesale_retail_rates') }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="d-flex align-items-center border rounded-3 shadow-sm bg-white h-100 p-3">
                            <img src="/icons/telephone.png"
                                class="me-3 flex-shrink-0" style="width:45px;">
                            <div class="ml-2">
                                <h6 class="mb-1 fw-bold ecm-benefit-title">{{ translate('24_7_support') }}</h6>
                                <small class="text-muted ecm-benefit-text">{{ translate('support_phone_078333016') }}</small>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            

            @foreach($featured_categories as $category)

                <!-- ================= MOBILE ================= -->
                <div class="d-block d-md-none bg-light rounded-4 p-3 mt-3 shadow-sm">

                    <!-- Title -->
                    <p class="fw-bold mb-3" style="font-size: 15px">
                        {{ $category->getTranslation('name') }}
                    </p>

                    <div class="d-flex gap-3 align-items-center">

                        <!-- LEFT 30% -->
                        <div style="width: 30%;" class="">
                            <div class="position-relative">
                                <img src="{{ $category->icon ?? 'https://via.placeholder.com/200' }}"
                                    class="rounded-3"
                                    style="width: 60px; height: 60px; object-fit: cover;">
                            </div>
                        </div>

                        <!-- RIGHT 70% -->
                        <div style="width: 70%; overflow-x: auto; -webkit-overflow-scrolling: touch;">

                            <div class="d-flex flex-column flex-wrap justify-content-start align-content-start"
                                style="height: 170px; gap: 10px;">

                                @foreach($category->subcategories as $index => $sub)

                                    @if($index < 12)

                                        <div style="min-width: 90px; text-align: center;">

                                            <a href="{{ url('/category/' . $category->slug . '/' . $sub->slug) }}"
                                            class="text-decoration-none text-dark d-block">

                                                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-1"
                                                    style="width: 50px; height: 50px;">

                                                    <img src="{{ $sub->image ?? 'https://via.placeholder.com/40' }}"
                                                        style="width: 30px; height: 30px; object-fit: contain;">
                                                </div>

                                                <small class="fw-semibold d-block text-truncate">
                                                    {{ $sub->getTranslation('name') }}
                                                </small>

                                            </a>

                                        </div>

                                    @endif

                                @endforeach

                            </div>

                        </div>

                    </div>

                    <!-- View all -->
                    <div class="text-end mt-2">
                        <a href="{{ url('/category/' . $category->slug) }}"
                        class="small text-primary text-decoration-none">
                            {{ translate('View All') }} →
                        </a>
                    </div>

                </div>


                <!-- ================= DESKTOP ================= -->
                <div class="d-none d-md-block card mb-3 border-0 shadow-sm overflow-hidden mt-4 rounded-3">

                    <div class="row g-3">

                        <!-- LEFT SIDE -->
                        <div class="col-md-3 bg-dark text-white d-flex flex-column justify-content-between">

                            <div class="p-3">
                                <img src="{{ $category->icon ?? 'https://via.placeholder.com/80' }}"
                                    class="mb-3 rounded"
                                    style="width: 60px; height: 60px; object-fit: cover;">

                                <h5 class="fw-bold">
                                    {{ $category->getTranslation('name') }}
                                </h5>

                                <small class="text-light fs-14">
                                   {{ $category->getTranslation('meta_description') }}
                                </small>
                            </div>

                            <div class="p-3 pt-0">
                                <a href="{{ url('/category/' . $category->slug) }}"
                                class="btn btn-sm rounded-pill btn-light">
                                 {{ translate('View All') }} →
                                </a>
                            </div>

                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-md-9 p-3"
                            style="background: linear-gradient(90deg, #3aa0d8, #4fb3e6);">

                            <div class="d-flex flex-wrap gap-4">

                                @forelse($category->subcategories as $sub)
                                    <div class="text-center text-white" style="width: 120px;">

                                        <a href="{{ url('/category/' . $category->slug . '/' . $sub->slug) }}"
                                        class="text-decoration-none text-white">

                                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2"
                                                style="width: 60px; height: 60px;">

                                                <img src="{{ $sub->image ?? 'https://via.placeholder.com/40' }}"
                                                    style="width: 35px; height: 35px; object-fit: contain;">
                                            </div>

                                            <p class="fw-semibold mb-0" style="font-size: 14px;">
                                                {{ $sub->getTranslation('name') }}
                                            </p>

                                        </a>

                                    </div>
                                @empty
                                    <p class="text-white">No subcategories found</p>
                                @endforelse

                            </div>

                        </div>

                    </div>
                </div>

            @endforeach

        </div>
    </div>





    @php

        $flash_deal = get_featured_flash_deal();

    @endphp

    @if ($flash_deal != null)

        <section class="mb-2 mb-md-3 mt-2 mt-md-3" id="flash_deal">

            <div class="container">

                <!-- Top Section -->

                <div class="d-flex flex-wrap mb-2 mb-md-3 align-items-baseline justify-content-between">

                    <!-- Title -->

                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">

                        <span class="d-inline-block">{{ translate('Flash Sale') }}</span>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="24" viewBox="0 0 16 24"

                            class="ml-3">

                            <path id="Path_28795" data-name="Path 28795"

                                d="M30.953,13.695a.474.474,0,0,0-.424-.25h-4.9l3.917-7.81a.423.423,0,0,0-.028-.428.477.477,0,0,0-.4-.207H21.588a.473.473,0,0,0-.429.263L15.041,18.151a.423.423,0,0,0,.034.423.478.478,0,0,0,.4.2h4.593l-2.229,9.683a.438.438,0,0,0,.259.5.489.489,0,0,0,.571-.127L30.9,14.164a.425.425,0,0,0,.054-.469Z"

                                transform="translate(-15 -5)" fill="#fcc201" />

                        </svg>

                    </h3>

                    <!-- Links -->

                    <div>

                        <div class="text-dark d-flex align-items-center mb-0">

                            <a href="{{ route('flash-deals') }}"

                                class="fs-10 fs-md-12 fw-700 text-reset has-transition opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary mr-3">{{ translate('View All Flash Sale') }}</a>

                            <span class=" border-left border-soft-light border-width-2 pl-3">

                                <a href="{{ route('flash-deal-details', $flash_deal->slug) }}"

                                    class="fs-10 fs-md-12 fw-700 text-reset has-transition opacity-60 hov-opacity-100 hov-text-primary animate-underline-primary">{{ translate('View All Products from This Flash Sale') }}</a>

                            </span>

                        </div>

                    </div>

                </div>



                <!-- Countdown for small device -->

                <div class="bg-white mb-3 d-md-none">

                    <div class="aiz-count-down-circle" end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>

                </div>



                <div class="row gutters-5 gutters-md-16">

                    <!-- Flash Deals Baner & Countdown -->

                    <div class="col-xxl-4 col-lg-5 col-6 h-200px h-md-400px h-lg-475px">

                        <div class="h-100 w-100 w-xl-auto"

                            style="background-image: url('{{ uploaded_asset($flash_deal->banner) }}'); background-size: cover; background-position: center center;">

                            <div class="py-5 px-md-3 px-xl-5 d-none d-md-block">

                                <div class="bg-white">

                                    <div class="aiz-count-down-circle"

                                        end-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Flash Deals Products -->

                    <div class="col-xxl-8 col-lg-7 col-6">

                        @php

                            $flash_deal_products = get_flash_deal_products($flash_deal->id);

                        @endphp

                        <div class="aiz-carousel border-top @if (count($flash_deal_products) > 8) border-right @endif arrow-inactive-none arrow-x-0"

                            data-items="5" data-xxl-items="5" data-xl-items="3.5" data-lg-items="3" data-md-items="2"

                            data-sm-items="2.5" data-xs-items="2" data-arrows="true" data-dots="false">

                            @php

                                $init = 0;

                                $end = 1;

                            @endphp

                            @for ($i = 0; $i < 5; $i++)

                                <div class="carousel-box  @if ($i == 0) border-left @endif">

                                    @foreach ($flash_deal_products as $key => $flash_deal_product)

                                        @if ($key >= $init && $key <= $end)



                                            @if ($flash_deal_product->product != null && $flash_deal_product->product->published != 0)

                                                @php

                                                    $product_url = route('product', $flash_deal_product->product->slug);

                                                    if ($flash_deal_product->product->auction_product == 1) {

                                                        $product_url = route('auction-product', $flash_deal_product->product->slug);

                                                    }

                                                @endphp

                                                <div

                                                    class="h-100px h-md-200px h-lg-auto flash-deal-item position-relative text-center border-bottom @if ($i != 4) border-right @endif has-transition hov-shadow-out z-1">

                                                    <a href="{{ $product_url }}"

                                                        class="d-block py-md-3 overflow-hidden hov-scale-img"

                                                        title="{{ $flash_deal_product->product->getTranslation('name') }}">

                                                        <!-- Image -->

                                                        <img src="{{ get_image($flash_deal_product->product->thumbnail) }}"

                                                            class="lazyload h-60px h-md-100px h-lg-140px mw-100 mx-auto has-transition"

                                                            alt="{{ $flash_deal_product->product->getTranslation('name') }}"

                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">

                                                        <!-- Price -->

                                                        <div

                                                            class="fs-10 fs-md-14 mt-md-3 text-center h-md-48px has-transition overflow-hidden pt-md-4 flash-deal-price">

                                                            <span

                                                                class="d-block text-primary fw-700">{{ home_discounted_base_price($flash_deal_product->product) }}</span>

                                                            @if (home_base_price($flash_deal_product->product) != home_discounted_base_price($flash_deal_product->product))

                                                                <del

                                                                    class="d-block fw-400 text-secondary">{{ home_base_price($flash_deal_product->product) }}</del>

                                                            @endif

                                                        </div>

                                                    </a>

                                                </div>

                                            @endif

                                        @endif

                                    @endforeach



                                    @php

                                        $init += 2;

                                        $end += 2;

                                    @endphp

                                </div>

                            @endfor

                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif



    <!-- Banner section 1 -->

<!--     @if (get_setting('home_banner1_images') != null)

        <div class="mb-2 mb-md-3 mt-2 mt-md-3">

            <div class="container">

                @php

                    $banner_1_imags = json_decode(get_setting('home_banner1_images'));

                    $data_md = count($banner_1_imags) >= 2 ? 2 : 1;

                @endphp

                <div class="w-100">

                    <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"

                        data-items="{{ count($banner_1_imags) }}" data-xxl-items="{{ count($banner_1_imags) }}"

                        data-xl-items="{{ count($banner_1_imags) }}" data-lg-items="{{ $data_md }}"

                        data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"

                        data-dots="false">

                        @foreach ($banner_1_imags as $key => $value)

                            <div class="carousel-box overflow-hidden hov-scale-img">

                                <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}"

                                    class="d-block text-reset overflow-hidden">

                                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"

                                        data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"

                                        class="img-fluid lazyload w-100 has-transition"

                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">

                                </a>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    @endif -->

    <!-- New Products -->
    <div id="section_newest"></div>

    <!-- Best Selling  -->
    <div id="section_best_selling"></div>

    @include('frontend.partials.category_product_sections')

    <!-- Featured Products -->
    <div id="section_featured"></div>

    <!-- Banner Section 2 -->

<!--     @if (get_setting('home_banner2_images') != null)

        <div class="mb-2 mb-md-3 mt-2 mt-md-3">

            <div class="container">

                @php

                    $banner_2_imags = json_decode(get_setting('home_banner2_images'));

                    $data_md = count($banner_2_imags) >= 2 ? 2 : 1;

                @endphp

                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"

                    data-items="{{ count($banner_2_imags) }}" data-xxl-items="{{ count($banner_2_imags) }}"

                    data-xl-items="{{ count($banner_2_imags) }}" data-lg-items="{{ $data_md }}"

                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"

                    data-dots="false">

                    @foreach ($banner_2_imags as $key => $value)

                        <div class="carousel-box overflow-hidden hov-scale-img">

                            <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}"

                                class="d-block text-reset overflow-hidden">

                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"

                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"

                                    class="img-fluid lazyload w-100 has-transition"

                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">

                            </a>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    @endif -->

    <!-- Banner Section 3 -->

    @if (get_setting('home_banner3_images') != null)

        <div class="mb-2 mb-md-3 mt-2 mt-md-3">

            <div class="container">

                @php

                    $banner_3_imags = json_decode(get_setting('home_banner3_images'));

                    $data_md = count($banner_3_imags) >= 2 ? 2 : 1;

                @endphp

                <div class="aiz-carousel gutters-16 overflow-hidden arrow-inactive-none arrow-dark arrow-x-15"

                    data-items="{{ count($banner_3_imags) }}" data-xxl-items="{{ count($banner_3_imags) }}"

                    data-xl-items="{{ count($banner_3_imags) }}" data-lg-items="{{ $data_md }}"

                    data-md-items="{{ $data_md }}" data-sm-items="1" data-xs-items="1" data-arrows="true"

                    data-dots="false">

                    @foreach ($banner_3_imags as $key => $value)

                        <div class="carousel-box overflow-hidden hov-scale-img">

                            <a href="{{ json_decode(get_setting('home_banner3_links'), true)[$key] }}"

                                class="d-block text-reset overflow-hidden">

                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"

                                    data-src="{{ uploaded_asset($value) }}" alt="{{ env('APP_NAME') }} promo"

                                    class="img-fluid lazyload w-100 has-transition"

                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">

                            </a>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    @endif



    <!-- Auction Product -->

    @if (addon_is_activated('auction'))

        <div id="auction_products">



        </div>

    @endif



    <!-- Cupon -->

    @if (get_setting('coupon_system') == 1)

        <div class="mb-2 mb-md-3 mt-2 mt-md-3"

            style="background-color: {{ get_setting('cupon_background_color', '#292933') }}">

            <div class="container">

                <div class="row py-5">

                    <div class="col-xl-8 text-center text-xl-left">

                        <div class="d-lg-flex">

                            <div class="mb-3 mb-lg-0">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"

                                    width="109.602" height="93.34" viewBox="0 0 109.602 93.34">

                                    <defs>

                                        <clipPath id="clip-pathcup">

                                            <path id="Union_10" data-name="Union 10" d="M12263,13778v-15h64v-41h12v56Z"

                                                transform="translate(-11966 -8442.865)" fill="none" stroke="#fff"

                                                stroke-width="2" />

                                        </clipPath>

                                    </defs>

                                    <g id="Group_24326" data-name="Group 24326"

                                        transform="translate(-274.201 -5254.611)">

                                        <g id="Mask_Group_23" data-name="Mask Group 23"

                                            transform="translate(-3652.459 1785.452) rotate(-45)"

                                            clip-path="url(#clip-pathcup)">

                                            <g id="Group_24322" data-name="Group 24322"

                                                transform="translate(207 18.136)">

                                                <g id="Subtraction_167" data-name="Subtraction 167"

                                                    transform="translate(-12177 -8458)" fill="none">

                                                    <path

                                                        d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"

                                                        stroke="none" />

                                                    <path

                                                        d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"

                                                        stroke="none" fill="#fff" />

                                                </g>

                                            </g>

                                        </g>

                                        <g id="Group_24321" data-name="Group 24321"

                                            transform="translate(-3514.477 1653.317) rotate(-45)">

                                            <g id="Subtraction_167-2" data-name="Subtraction 167"

                                                transform="translate(-12177 -8458)" fill="none">

                                                <path

                                                    d="M12335,13770h-56a8.009,8.009,0,0,1-8-8v-8a8,8,0,0,0,0-16v-8a8.009,8.009,0,0,1,8-8h56a8.009,8.009,0,0,1,8,8v8a8,8,0,0,0,0,16v8A8.009,8.009,0,0,1,12335,13770Z"

                                                    stroke="none" />

                                                <path

                                                    d="M 12335.0009765625 13768.0009765625 C 12338.3095703125 13768.0009765625 12341.0009765625 13765.30859375 12341.0009765625 13762 L 12341.0009765625 13755.798828125 C 12336.4423828125 13754.8701171875 12333.0009765625 13750.8291015625 12333.0009765625 13746 C 12333.0009765625 13741.171875 12336.4423828125 13737.130859375 12341.0009765625 13736.201171875 L 12341.0009765625 13729.9990234375 C 12341.0009765625 13726.6904296875 12338.3095703125 13723.9990234375 12335.0009765625 13723.9990234375 L 12278.9990234375 13723.9990234375 C 12275.6904296875 13723.9990234375 12272.9990234375 13726.6904296875 12272.9990234375 13729.9990234375 L 12272.9990234375 13736.201171875 C 12277.5576171875 13737.1298828125 12280.9990234375 13741.1708984375 12280.9990234375 13746 C 12280.9990234375 13750.828125 12277.5576171875 13754.869140625 12272.9990234375 13755.798828125 L 12272.9990234375 13762 C 12272.9990234375 13765.30859375 12275.6904296875 13768.0009765625 12278.9990234375 13768.0009765625 L 12335.0009765625 13768.0009765625 M 12335.0009765625 13770.0009765625 L 12278.9990234375 13770.0009765625 C 12274.587890625 13770.0009765625 12270.9990234375 13766.412109375 12270.9990234375 13762 L 12270.9990234375 13754 C 12275.4111328125 13753.9990234375 12278.9990234375 13750.4111328125 12278.9990234375 13746 C 12278.9990234375 13741.5888671875 12275.41015625 13738 12270.9990234375 13738 L 12270.9990234375 13729.9990234375 C 12270.9990234375 13725.587890625 12274.587890625 13721.9990234375 12278.9990234375 13721.9990234375 L 12335.0009765625 13721.9990234375 C 12339.412109375 13721.9990234375 12343.0009765625 13725.587890625 12343.0009765625 13729.9990234375 L 12343.0009765625 13738 C 12338.5888671875 13738.0009765625 12335.0009765625 13741.5888671875 12335.0009765625 13746 C 12335.0009765625 13750.4111328125 12338.58984375 13754 12343.0009765625 13754 L 12343.0009765625 13762 C 12343.0009765625 13766.412109375 12339.412109375 13770.0009765625 12335.0009765625 13770.0009765625 Z"

                                                    stroke="none" fill="#fff" />

                                            </g>

                                            <g id="Group_24325" data-name="Group 24325">

                                                <rect id="Rectangle_18578" data-name="Rectangle 18578" width="8"

                                                    height="2" transform="translate(120 5287)" fill="#fff" />

                                                <rect id="Rectangle_18579" data-name="Rectangle 18579" width="8"

                                                    height="2" transform="translate(132 5287)" fill="#fff" />

                                                <rect id="Rectangle_18581" data-name="Rectangle 18581" width="8"

                                                    height="2" transform="translate(144 5287)" fill="#fff" />

                                                <rect id="Rectangle_18580" data-name="Rectangle 18580" width="8"

                                                    height="2" transform="translate(108 5287)" fill="#fff" />

                                            </g>

                                        </g>

                                    </g>

                                </svg>

                            </div>

                            <div class="ml-lg-3">

                                <h5 class="fs-36 fw-400 text-white mb-3">{{ translate(get_setting('cupon_title')) }}</h5>

                                <h5 class="fs-20 fw-400 text-gray">{{ translate(get_setting('cupon_subtitle')) }}</h5>

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-4 text-center text-xl-right mt-4">

                        <a href="{{ route('coupons.all') }}"

                            class="btn text-white hov-bg-white hov-text-dark border border-width-2 fs-16 px-4"

                            style="border-radius: 28px;background: rgba(255, 255, 255, 0.2);box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.16);">{{ translate('View All Coupons') }}</a>

                    </div>

                </div>

            </div>

        </div>

    @endif



    <!-- Classified Product -->

    @if (get_setting('classified_product') == 1)

        @php

            $classified_products = get_home_page_classified_products(6);

        @endphp

        @if (count($classified_products) > 0)

            <section class="mb-2 mb-md-3 mt-2 mt-md-3">

                <div class="container">

                    <!-- Top Section -->

                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">

                        <!-- Title -->

                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">

                            <span class="">{{ translate('Classified Ads') }}</span>

                        </h3>

                        <!-- Links -->

                        <div class="d-flex">

                            <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"

                                href="{{ route('customer.products') }}">{{ translate('View All Products') }}</a>

                        </div>

                    </div>

                    <!-- Banner -->

                    @if (get_setting('classified_banner_image') != null || get_setting('classified_banner_image_small') != null)

                        <div class="mb-3 overflow-hidden hov-scale-img d-none d-md-block">

                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"

                                data-src="{{ uploaded_asset(get_setting('classified_banner_image')) }}"

                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"

                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">

                        </div>

                        <div class="mb-3 overflow-hidden hov-scale-img d-md-none">

                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"

                                data-src="{{ get_setting('classified_banner_image_small') != null ? uploaded_asset(get_setting('classified_banner_image_small')) : uploaded_asset(get_setting('classified_banner_image')) }}"

                                alt="{{ env('APP_NAME') }} promo" class="lazyload img-fit h-100 has-transition"

                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">

                        </div>

                    @endif

                    <!-- Products Section -->

                    <div class="bg-white">

                        <div class="row no-gutters border-top border-left">

                            @foreach ($classified_products as $key => $classified_product)

                                <div

                                    class="col-xl-4 col-md-6 border-right border-bottom has-transition hov-shadow-out z-1">

                                    <div class="aiz-card-box p-2 has-transition bg-white">

                                        <div class="row hov-scale-img">

                                            <div class="col-4 col-md-5 mb-3 mb-md-0">

                                                <a href="{{ route('customer.product', $classified_product->slug) }}"

                                                    class="d-block overflow-hidden h-auto h-md-150px text-center">

                                                    <img class="img-fluid lazyload mx-auto has-transition"

                                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"

                                                        data-src="{{ isset($classified_product->thumbnail->file_name) ? my_asset($classified_product->thumbnail->file_name) : static_asset('assets/img/placeholder.jpg') }}"

                                                        alt="{{ $classified_product->getTranslation('name') }}"

                                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">

                                                </a>

                                            </div>

                                            <div class="col">

                                                <h3

                                                    class="fw-400 fs-14 text-dark text-truncate-2 lh-1-4 mb-3 h-35px d-none d-sm-block">

                                                    <a href="{{ route('customer.product', $classified_product->slug) }}"

                                                        class="d-block text-reset hov-text-primary">{{ $classified_product->getTranslation('name') }}</a>

                                                </h3>

                                                <div class="fs-14 mb-3">

                                                    <span

                                                        class="text-secondary">{{ $classified_product->user ? $classified_product->user->name : '' }}</span><br>

                                                    <span

                                                        class="fw-700 text-primary">{{ single_price($classified_product->unit_price) }}</span>

                                                </div>

                                                @if ($classified_product->conditon == 'new')

                                                    <span

                                                        class="badge badge-inline badge-soft-info fs-13 fw-700 p-3 text-info"

                                                        style="border-radius: 20px;">{{ translate('New') }}</span>

                                                @elseif($classified_product->conditon == 'used')

                                                    <span

                                                        class="badge badge-inline badge-soft-danger fs-13 fw-700 p-3 text-danger"

                                                        style="border-radius: 20px;">{{ translate('Used') }}</span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </section>

        @endif

    @endif



    <!-- Top Sellers -->

    @if (false && get_setting('vendor_system_activation') == 1)

        @php

            $best_selers = get_best_sellers(5);

        @endphp

        @if (count($best_selers) > 0)

        <section class="mb-2 mb-md-3 mt-2 mt-md-3">

            <div class="container">

                <!-- Top Section -->

                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">

                    <!-- Title -->

                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">

                        <span class="pb-3">{{ translate('Top Sellers') }}</span>

                    </h3>

                    <!-- Links -->

                    <div class="d-flex">

                        <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"

                            href="{{ route('sellers') }}">{{ translate('View All Sellers') }}</a>

                    </div>

                </div>

                <!-- Sellers Section -->

                <div class="aiz-carousel arrow-x-0 arrow-inactive-none" data-items="5" data-xxl-items="5"

                    data-xl-items="4" data-lg-items="3.4" data-md-items="2.5" data-sm-items="2" data-xs-items="1.4"

                    data-arrows="true" data-dots="false">

                    @foreach ($best_selers as $key => $seller)

                        @if ($seller->user != null)

                            <div

                                class="carousel-box h-100 position-relative text-center border-right border-top border-bottom @if ($key == 0) border-left @endif has-transition hov-animate-outline">

                                <div class="position-relative px-3" style="padding-top: 2rem; padding-bottom:2rem;">

                                    <!-- Shop logo & Verification Status -->

                                    <div class="position-relative mx-auto size-100px size-md-120px">

                                        <a href="{{ route('shop.visit', $seller->slug) }}"

                                            class="d-flex mx-auto justify-content-center align-item-center size-100px size-md-120px border overflow-hidden hov-scale-img"

                                            tabindex="0"

                                            style="border: 1px solid #e5e5e5; border-radius: 50%; box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.06);">

                                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"

                                                data-src="{{ uploaded_asset($seller->logo) }}" alt="{{ $seller->name }}"

                                                class="img-fit lazyload has-transition"

                                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">

                                        </a>

                                        <div class="absolute-top-right z-1 mr-md-2 mt-1 rounded-content bg-white">

                                            @if ($seller->verification_status == 1)

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.001" height="24"

                                                    viewBox="0 0 24.001 24">

                                                    <g id="Group_25929" data-name="Group 25929"

                                                        transform="translate(-480 -345)">

                                                        <circle id="Ellipse_637" data-name="Ellipse 637" cx="12"

                                                            cy="12" r="12" transform="translate(480 345)"

                                                            fill="#fff" />

                                                        <g id="Group_25927" data-name="Group 25927"

                                                            transform="translate(480 345)">

                                                            <path id="Union_5" data-name="Union 5"

                                                                d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"

                                                                transform="translate(0 0)" fill="#3490f3" />

                                                        </g>

                                                    </g>

                                                </svg>

                                            @else

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24.001" height="24"

                                                    viewBox="0 0 24.001 24">

                                                    <g id="Group_25929" data-name="Group 25929"

                                                        transform="translate(-480 -345)">

                                                        <circle id="Ellipse_637" data-name="Ellipse 637" cx="12"

                                                            cy="12" r="12" transform="translate(480 345)"

                                                            fill="#fff" />

                                                        <g id="Group_25927" data-name="Group 25927"

                                                            transform="translate(480 345)">

                                                            <path id="Union_5" data-name="Union 5"

                                                                d="M0,12A12,12,0,1,1,12,24,12,12,0,0,1,0,12Zm1.2,0A10.8,10.8,0,1,0,12,1.2,10.812,10.812,0,0,0,1.2,12Zm1.2,0A9.6,9.6,0,1,1,12,21.6,9.611,9.611,0,0,1,2.4,12Zm5.115-1.244a1.083,1.083,0,0,0,0,1.529l3.059,3.059a1.081,1.081,0,0,0,1.529,0l5.1-5.1a1.084,1.084,0,0,0,0-1.53,1.081,1.081,0,0,0-1.529,0L11.339,13.05,9.045,10.756a1.082,1.082,0,0,0-1.53,0Z"

                                                                transform="translate(0 0)" fill="red" />

                                                        </g>

                                                    </g>

                                                </svg>

                                            @endif

                                        </div>

                                    </div>

                                    <!-- Shop name -->

                                    <h2 class="fs-14 fw-700 text-dark text-truncate-2 h-40px mt-3 mt-md-4 mb-0 mb-md-3">

                                        <a href="{{ route('shop.visit', $seller->slug) }}"

                                            class="text-reset hov-text-primary" tabindex="0">{{ $seller->name }}</a>

                                    </h2>

                                    <!-- Shop Rating -->

                                    <div class="rating rating-mr-1 text-dark mb-3">

                                        {{ renderStarRating($seller->rating) }}

                                        <span class="opacity-60 fs-14">({{ $seller->num_of_reviews }}

                                            {{ translate('Reviews') }})</span>

                                    </div>

                                    <!-- Visit Button -->

                                    <a href="{{ route('shop.visit', $seller->slug) }}" class="btn-visit">

                                        <span class="circle" aria-hidden="true">

                                            <span class="icon arrow"></span>

                                        </span>

                                        <span class="button-text">{{ translate('Visit Store') }}</span>

                                    </a>

                                </div>

                            </div>

                        @endif

                    @endforeach

                </div>

            </div>

        </section>

        @endif

    @endif



    <!-- Top Brands -->

    @if (get_setting('top_brands') != null)

        <section class="mb-2 mb-md-3 mt-2 mt-md-3">

            <div class="container">

                <!-- Top Section -->

                <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">

                    <!-- Title -->

                    <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">{{ translate('Top Brands') }}</h3>

                    <!-- Links -->

                    <div class="d-flex">

                        <a class="text-blue fs-10 fs-md-12 fw-700 hov-text-primary animate-underline-primary"

                            href="{{ route('brands.all') }}">{{ translate('View All Brands') }}</a>

                    </div>

                </div>

                <!-- Brands Section -->

                <div class="bg-white px-3">

                    <div

                        class="row row-cols-xxl-6 row-cols-xl-6 row-cols-lg-4 row-cols-md-4 row-cols-3 gutters-16 border-top border-left">

                        @php

                            $top_brands = json_decode(get_setting('top_brands'));

                            $brands = get_brands($top_brands);

                        @endphp

                        @foreach ($brands as $brand)

                            <div

                                class="col text-center border-right border-bottom hov-scale-img has-transition hov-shadow-out z-1">

                                <a href="{{ route('products.brand', $brand->slug) }}" class="d-block p-sm-3">

                                    <img src="{{ isset($brand->brandLogo->file_name) ? my_asset($brand->brandLogo->file_name) : static_asset('assets/img/placeholder.jpg') }}"

                                        class="lazyload h-md-100px mx-auto has-transition p-2 p-sm-4 mw-100"

                                        alt="{{ $brand->getTranslation('name') }}"

                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">

                                    <p class="text-center text-dark fs-12 fs-md-14 fw-700 mt-2">

                                        {{ $brand->getTranslation('name') }}

                                    </p>

                                </a>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </section>

    @endif



@endsection



