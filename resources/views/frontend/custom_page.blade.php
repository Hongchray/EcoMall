@extends('frontend.layouts.app')

@section('meta_title'){{ $page->meta_title }}@stop

@section('meta_description'){{ $page->meta_description }}@stop

@section('meta_keywords'){{ $page->tags }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $page->meta_title }}">
    <meta itemprop="description" content="{{ $page->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($page->meta_image) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="website">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $page->meta_title }}">
    <meta name="twitter:description" content="{{ $page->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($page->meta_image) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $page->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ URL($page->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($page->meta_image) }}" />
    <meta property="og:description" content="{{ $page->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')
@if ($page->slug == 'about-us')
    <style>
        .ecm-about-page {
            background: #f6f9fb;
            padding: 30px 0 48px;
        }

        .ecm-about-hero {
            display: grid;
            grid-template-columns: minmax(0, 1.35fr) minmax(280px, 0.65fr);
            gap: 28px;
            align-items: stretch;
            margin-bottom: 24px;
        }

        .ecm-about-hero-main,
        .ecm-about-hero-side,
        .ecm-about-content {
            background: #ffffff;
            border: 1px solid #e2ebf0;
            border-radius: 8px;
            box-shadow: 0 12px 28px rgba(21, 63, 92, 0.08);
        }

        .ecm-about-hero-main {
            padding: 34px;
        }

        .ecm-about-kicker {
            margin-bottom: 10px;
            color: #2687b8;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .ecm-about-hero h1 {
            max-width: 760px;
            margin: 0;
            color: #102f44;
            font-size: 38px;
            font-weight: 800;
            line-height: 1.18;
        }

        .ecm-about-hero p {
            max-width: 680px;
            margin: 14px 0 0;
            color: #5d7080;
            font-size: 15px;
            line-height: 1.7;
        }

        .ecm-about-breadcrumb {
            margin-top: 26px;
            font-size: 13px;
        }

        .ecm-about-hero-side {
            display: grid;
            align-content: center;
            gap: 14px;
            padding: 24px;
        }

        .ecm-about-stat {
            padding: 16px;
            background: #f7fbfd;
            border: 1px solid #e2ebf0;
            border-radius: 8px;
        }

        .ecm-about-stat strong {
            display: block;
            color: #102f44;
            font-size: 22px;
            font-weight: 800;
            line-height: 1.1;
        }

        .ecm-about-stat span {
            display: block;
            margin-top: 6px;
            color: #607383;
            font-size: 13px;
            font-weight: 600;
        }

        .ecm-about-content {
            padding: 30px;
            color: #354b5a;
            font-size: 15px;
            line-height: 1.8;
        }

        .ecm-about-content h1,
        .ecm-about-content h2,
        .ecm-about-content h3,
        .ecm-about-content h4 {
            color: #102f44;
            font-weight: 800;
        }

        .ecm-about-content img,
        .ecm-about-content iframe {
            max-width: 100%;
            border-radius: 8px;
        }

        @media (max-width: 991.98px) {
            .ecm-about-hero {
                grid-template-columns: 1fr;
            }

            .ecm-about-hero h1 {
                font-size: 30px;
            }
        }

        @media (max-width: 575.98px) {
            .ecm-about-page {
                padding-top: 18px;
            }

            .ecm-about-hero-main,
            .ecm-about-hero-side,
            .ecm-about-content {
                padding: 20px;
            }

            .ecm-about-hero h1 {
                font-size: 25px;
            }
        }
    </style>

    <section class="ecm-about-page">
        <div class="container">
            <div class="ecm-about-hero">
                <div class="ecm-about-hero-main">
                    <div class="ecm-about-kicker">{{ translate('About EcoMall') }}</div>
                    <h1>{{ $page->getTranslation('title') }}</h1>
                    <p>{{ $page->meta_description }}</p>
                    <ul class="breadcrumb bg-transparent p-0 mb-0 ecm-about-breadcrumb">
                        <li class="breadcrumb-item has-transition opacity-70 hov-opacity-100">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            {{ $page->getTranslation('title') }}
                        </li>
                    </ul>
                </div>
                <div class="ecm-about-hero-side">
                    <div class="ecm-about-stat">
                        <strong>{{ translate('Trusted') }}</strong>
                        <span>{{ translate('Marketplace experience') }}</span>
                    </div>
                    <div class="ecm-about-stat">
                        <strong>{{ translate('Simple') }}</strong>
                        <span>{{ translate('Shopping for everyday needs') }}</span>
                    </div>
                    <div class="ecm-about-stat">
                        <strong>{{ translate('Connected') }}</strong>
                        <span>{{ translate('Customers, sellers, and products') }}</span>
                    </div>
                </div>
            </div>

            <div class="ecm-about-content overflow-hidden mw-100 text-left">
                @php echo $page->getTranslation('content'); @endphp
            </div>
        </div>
    </section>
@else
    <section class="pt-4 mb-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="fw-600 h4">{{ $page->getTranslation('title') }}</h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item has-transition opacity-50 hov-opacity-100">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            "{{ $page->title }}"
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="mb-4">
    	<div class="container">
            <div class="p-4 bg-white rounded shadow-sm overflow-hidden mw-100 text-left">
    		    @php echo $page->getTranslation('content'); @endphp
            </div>
    	</div>
    </section>
@endif
@endsection
