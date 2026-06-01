@extends('frontend.layouts.app')

@section('content')
    <section class="ecm-news-page pb-5">
        <div class="container">
            <div class="ecm-news-hero">
                <div>
                    <div class="ecm-news-kicker">{{ translate('EcoMall News') }}</div>
                    <h1>{{ translate('News') }}</h1>
                    <p>{{ translate('Latest updates, stories, and helpful articles from EcoMall.') }}</p>
                </div>
                <ul class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item has-transition">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">{{ translate('News') }}</li>
                </ul>
            </div>

            <div class="row gutters-16">
                <div class="col-xl-9 order-xl-1">
                    <div class="d-xl-none mb-3 text-right">
                        <button type="button" class="btn ecm-news-filter-btn" data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                            <i class="la la-filter"></i>
                            <span>{{ translate('Filters') }}</span>
                        </button>
                    </div>

                    <div class="ecm-news-grid">
                        @foreach($blogs as $blog)
                            <article class="ecm-news-card hov-scale-img">
                                <a href="{{ url("blog").'/'. $blog->slug }}" class="ecm-news-card-img text-reset d-block overflow-hidden">
                                    <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                        data-src="{{ uploaded_asset($blog->banner) }}"
                                        alt="{{ $blog->title }}"
                                        class="img-fit lazyload h-100 has-transition">
                                </a>
                                <div class="ecm-news-card-body">
                                    <div class="ecm-news-meta">
                                        <span>{{ date('M d, Y',strtotime($blog->created_at)) }}</span>
                                        @if($blog->category != null)
                                            <span>{{ $blog->category->category_name }}</span>
                                        @endif
                                    </div>
                                    <h2 class="ecm-news-card-title text-truncate-2">
                                        <a href="{{ url("blog").'/'. $blog->slug }}" class="text-reset hov-text-primary" title="{{ $blog->title }}">
                                            {{ $blog->title }}
                                        </a>
                                    </h2>
                                    <p class="ecm-news-card-copy text-truncate-3" title="{{ $blog->short_description }}">
                                        {{ $blog->short_description }}
                                    </p>
                                    <a href="{{ url("blog").'/'. $blog->slug }}" class="ecm-news-read-link">
                                        {{ translate('Read Full Blog') }}
                                        <i class="las la-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="aiz-pagination mt-4">
                        {{ $blogs->links() }}
                    </div>
                </div>

                <div class="col-xl-3">
                    <form class="mb-4" id="search-form" action="" method="GET">
                        <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                            <div class="overlay overlay-fixed dark c-pointer" data-toggle="class-toggle" data-target=".aiz-filter-sidebar" data-same=".filter-sidebar-thumb"></div>
                            <div class="collapse-sidebar c-scrollbar-light text-left" style="overflow-y: auto;">
                                <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                                    <h3 class="h6 mb-0 fw-600">{{ translate('Filters') }}</h3>
                                    <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb" data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                                        <i class="las la-times la-2x"></i>
                                    </button>
                                </div>

                                <div class="ecm-news-side-card mb-3 mt-3 mx-3 mt-xl-0 mx-xl-0">
                                    <h3>{{ translate('search') }}</h3>
                                    <div class="input-group w-100 ecm-news-search">
                                        <input type="text" class="fs-14 flex-grow-1" name="search" value="{{ $search }}" placeholder="{{ translate('search') }}" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit">
                                                <i class="la la-search la-flip-horizontal"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="ecm-news-side-card mb-3 mx-3 mx-xl-0">
                                    <h3>{{ translate('Categories') }}</h3>
                                    <div class="aiz-checkbox-list">
                                        @foreach (get_all_blog_categories() as $category)
                                            <label class="aiz-checkbox ecm-news-checkbox">
                                                <input
                                                    type="checkbox"
                                                    name="selected_categories[]"
                                                    value="{{ $category->slug }}" @if (in_array($category->slug, $selected_categories)) checked @endif
                                                    onchange="filter()"
                                                >
                                                <span class="aiz-square-check"></span>
                                                <span class="fs-14 fw-400 text-dark has-transition hov-text-primary">{{ $category->category_name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="ecm-news-side-card">
                        <h3>{{ translate('Recent Posts') }}</h3>
                        <div class="row">
                            @foreach($recent_blogs as $recent_blog)
                                <div class="col-xl-12 col-lg-4 col-sm-6 mb-3 hov-scale-img">
                                    <div class="ecm-news-recent-item">
                                        <a href="{{ url("blog").'/'. $recent_blog->slug }}" class="ecm-news-recent-img text-reset d-block overflow-hidden">
                                            <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                                data-src="{{ uploaded_asset($recent_blog->banner) }}"
                                                alt="{{ $recent_blog->title }}"
                                                class="img-fit lazyload h-100 has-transition">
                                        </a>
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
    <script type="text/javascript">
        function filter(){
            $('#search-form').submit();
        }
    </script>
@endsection
