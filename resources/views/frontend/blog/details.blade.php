@extends('frontend.layouts.app')

@section('meta_title'){{ $blog->meta_title }}@stop

@section('meta_description'){{ $blog->meta_description }}@stop

@section('meta_keywords'){{ $blog->meta_keywords }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $blog->meta_title }}">
    <meta itemprop="description" content="{{ $blog->meta_description }}">
    <meta itemprop="image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ $blog->meta_title }}">
    <meta name="twitter:description" content="{{ $blog->meta_description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ uploaded_asset($blog->meta_img) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $blog->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('blog.details', $blog->slug) }}" />
    <meta property="og:image" content="{{ uploaded_asset($blog->meta_img) }}" />
    <meta property="og:description" content="{{ $blog->meta_description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
@endsection

@section('content')

<section class="ecm-news-page ecm-news-detail-page pb-5">
    <div class="container">
        <div class="ecm-news-hero ecm-news-detail-hero">
            <div>
                <div class="ecm-news-kicker">{{ translate('EcoMall News') }}</div>
                <h1>{{ $blog->title }}</h1>
                <div class="ecm-news-meta">
                    <span>{{ date('M d, Y',strtotime($blog->created_at)) }}</span>
                    @if($blog->category != null)
                        <span>{{ $blog->category->category_name }}</span>
                    @endif
                </div>
            </div>
            <div class="aiz-share"></div>
        </div>

        <div class="row gutters-16 justify-content-center">

            <!-- Blog Details -->
            <div class="col-xxl-7 col-lg-8">
                <div class="ecm-news-article mb-4">
                    <!-- Image -->
                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                        data-src="{{ uploaded_asset($blog->banner) }}"
                        alt="{{ $blog->title }}"
                        class="ecm-news-article-img img-fluid lazyload w-100">
                    <!-- Description -->
                    <div class="ecm-news-article-body mb-4 overflow-hidden">
                        {!! $blog->description !!}
                    </div>
                    <!-- Facebook Comment -->
                    @if (get_setting('facebook_comment') == 1)
                    <div class="mb-4">
                        <div class="fb-comments" data-href="{{ route("blog",$blog->slug) }}" data-width="" data-numposts="5"></div>
                    </div>
                    @endif
                </div>
            </div>

            
            <!-- recent posts -->
            <div class="col-xxl-3 col-lg-4">
                <div class="ecm-news-side-card">
                    <h3>{{ translate('Recent Posts') }}</h3>
                    <div class="row">
                        @foreach($recent_blogs as $recent_blog)
                        <div class="col-lg-12 col-sm-6 mb-3 hov-scale-img">
                            <div class="ecm-news-recent-item">
                                <div>
                                    <a href="{{ url("blog").'/'. $recent_blog->slug }}" class="ecm-news-recent-img text-reset d-block overflow-hidden">
                                        <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                            data-src="{{ uploaded_asset($recent_blog->banner) }}"
                                            alt="{{ $recent_blog->title }}"
                                            class="img-fit lazyload h-100 has-transition">
                                        </a>
                                </div>
                                <div>
                                    <h2 class="ecm-news-recent-title text-truncate-2">
                                        <a href="{{ url("blog").'/'. $recent_blog->slug }}" class="text-reset hov-text-primary" title="{{ $recent_blog->title }}">
                                            {{ $recent_blog->title }}
                                        </a>
                                    </h2>
                                    <div class="ecm-news-meta ecm-news-meta-small">
                                        <span>{{ date('M d, Y',strtotime($recent_blog->created_at)) }}</span>
                                        @if($recent_blog->category != null)
                                            <span>{{ $recent_blog->category->category_name }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection


@section('script')
    @if (get_setting('facebook_comment') == 1)
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId={{ env('FACEBOOK_APP_ID') }}&autoLogAppEvents=1" nonce="ji6tXwgZ"></script>
    @endif
@endsection
