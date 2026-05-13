@extends('frontend.layouts.app')

@section('content')
    @php
        $total_children = $categories->sum(function ($category) {
            return $category->childrenCategories->count();
        });

        $category_image_url = function ($category) {
            $image = $category->banner ?: $category->icon;

            if ($image == null) {
                return static_asset('assets/img/placeholder.jpg');
            }

            return filter_var($image, FILTER_VALIDATE_URL) ? $image : uploaded_asset($image);
        };
    @endphp

<style>
        .ec-categories-page {
            background: #f5f9fc;
        }

        .ec-categories-hero {
            padding: 34px 0 26px;
            border-bottom: 1px solid #dceef8;
            background:
                linear-gradient(135deg, rgba(60, 155, 211, 0.12), rgba(255, 255, 255, 0) 48%),
                #ffffff;
        }

        .ec-categories-breadcrumb {
            margin: 0 0 12px;
            padding: 0;
            background: transparent;
        }

        .ec-categories-breadcrumb .breadcrumb-item,
        .ec-categories-breadcrumb a {
            color: #6f7d89;
            font-size: 13px;
            font-weight: 600;
        }

        .ec-categories-breadcrumb .active {
            color: #17212b;
        }

        .ec-categories-title {
            margin: 0;
            color: #17212b;
            font-size: 32px;
            font-weight: 800;
            line-height: 1.2;
        }

        .ec-categories-summary {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .ec-categories-stat {
            min-width: 116px;
            padding: 12px 14px;
            border: 1px solid #dceef8;
            border-radius: 8px;
            background: #f8fbfe;
            text-align: center;
        }

        .ec-categories-stat strong {
            display: block;
            color: #3c9bd3;
            font-size: 22px;
            font-weight: 800;
            line-height: 1;
        }

        .ec-categories-stat span {
            display: block;
            margin-top: 6px;
            color: #6f7d89;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .ec-categories-list {
            padding: 28px 0 54px;
        }

        .ec-category-card {
            height: 100%;
            overflow: hidden;
            border: 1px solid #dceef8;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 12px 28px rgba(34, 126, 184, 0.08);
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .ec-category-card:hover {
            border-color: #3c9bd3;
            box-shadow: 0 16px 34px rgba(34, 126, 184, 0.14);
            transform: translateY(-2px);
        }

        .ec-category-card__head {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px;
            border-bottom: 1px solid #edf5f9;
            background: linear-gradient(135deg, rgba(60, 155, 211, 0.08), rgba(255, 255, 255, 0));
        }

        .ec-category-card__image {
            width: 72px;
            height: 72px;
            flex: 0 0 72px;
            padding: 8px;
            border: 1px solid #dceef8;
            border-radius: 8px;
            background: #ffffff;
            object-fit: contain;
        }

        .ec-category-card__title {
            min-width: 0;
            margin: 0;
            color: #17212b;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.3;
        }

        .ec-category-card__title a:hover {
            color: #217fb8 !important;
            text-decoration: none;
        }

        .ec-category-card__count {
            display: inline-flex;
            align-items: center;
            min-height: 24px;
            margin-top: 8px;
            padding: 3px 10px;
            border-radius: 999px;
            background: #eef8fd;
            color: #217fb8;
            font-size: 12px;
            font-weight: 800;
        }

        .ec-category-card__body {
            padding: 16px;
        }

        .ec-subcategory-block {
            margin-bottom: 18px;
        }

        .ec-subcategory-block:last-child {
            margin-bottom: 0;
        }

        .ec-subcategory-title {
            margin: 0 0 10px;
            color: #17212b;
            font-size: 14px;
            font-weight: 800;
            line-height: 1.35;
        }

        .ec-subcategory-title a:hover {
            color: #217fb8 !important;
            text-decoration: none;
        }

        .ec-subcategory-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 0;
        }

        .ec-subcategory-list.less .ec-subcategory-item:nth-child(n+6) {
            display: none;
        }

        .ec-subcategory-link {
            display: inline-flex;
            align-items: center;
            max-width: 100%;
            min-height: 30px;
            padding: 6px 10px;
            border: 1px solid #e4f2fa;
            border-radius: 999px;
            background: #f8fbfe;
            color: #425b6f;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.25;
        }

        .ec-subcategory-link:hover {
            border-color: #3c9bd3;
            background: #eef8fd;
            color: #217fb8;
            text-decoration: none;
        }

        .ec-category-empty {
            margin: 0;
            color: #7f8b95;
            font-size: 13px;
            font-weight: 600;
        }

        .ec-category-toggle {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 10px;
            color: #217fb8;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .ec-category-toggle:hover {
            color: #145f8d;
            text-decoration: none;
        }

        .ec-category-card__footer {
            padding: 0 16px 16px;
        }

        .ec-category-card__view {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #3c9bd3;
            font-size: 13px;
            font-weight: 800;
        }

        .ec-category-card__view:hover {
            color: #217fb8;
            text-decoration: none;
        }

        @media (max-width: 767.98px) {
            .ec-categories-hero {
                padding: 24px 0 20px;
            }

            .ec-categories-title {
                font-size: 26px;
            }

            .ec-categories-summary {
                justify-content: flex-start;
                margin-top: 18px;
            }

            .ec-categories-stat {
                flex: 1 1 0;
                min-width: 0;
            }

            .ec-category-card__head {
                padding: 14px;
            }

            .ec-category-card__image {
                width: 62px;
                height: 62px;
                flex-basis: 62px;
            }

            .ec-category-card__title {
                font-size: 16px;
            }
        }
</style>

    <main class="ec-categories-page">
        <section class="ec-categories-hero">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <ul class="breadcrumb ec-categories-breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">{{ translate('Home') }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ translate('All Categories') }}
                            </li>
                        </ul>
                        <h1 class="ec-categories-title">{{ translate('All Categories') }}</h1>
                    </div>
                    <div class="col-lg-5">
                        <div class="ec-categories-summary">
                            <div class="ec-categories-stat">
                                <strong>{{ $categories->count() }}</strong>
                                <span>{{ translate('Categories') }}</span>
                            </div>
                            <div class="ec-categories-stat">
                                <strong>{{ $total_children }}</strong>
                                <span>{{ translate('Sections') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ec-categories-list">
            <div class="container">
                <div class="row gutters-16">
                    @foreach ($categories as $category)
                        <div class="col-xl-4 col-md-6 mb-4">
                            <article class="ec-category-card">
                                <div class="ec-category-card__head">
                                    <img src="{{ $category_image_url($category) }}"
                                        alt="{{ $category->getTranslation('name') }}"
                                        class="ec-category-card__image"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    <div class="min-w-0">
                                        <h2 class="ec-category-card__title">
                                            <a href="{{ route('products.category', $category->slug) }}" class="text-reset">
                                                {{ $category->getTranslation('name') }}
                                            </a>
                                        </h2>
                                        <span class="ec-category-card__count">
                                            {{ $category->childrenCategories->count() }} {{ translate('Sections') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="ec-category-card__body">
                                    @forelse ($category->childrenCategories as $child_category)
                                        <div class="ec-subcategory-block">
                                            <h3 class="ec-subcategory-title">
                                                <a href="{{ route('products.category', $child_category->slug) }}" class="text-reset">
                                                    {{ $child_category->getTranslation('name') }}
                                                </a>
                                            </h3>

                                            @if ($child_category->childrenCategories->count() > 0)
                                                <ul class="ec-subcategory-list list-unstyled has-transition @if ($child_category->childrenCategories->count() > 5) less @endif">
                                                    @foreach ($child_category->childrenCategories as $second_level_category)
                                                        <li class="ec-subcategory-item">
                                                            <a class="ec-subcategory-link"
                                                                href="{{ route('products.category', $second_level_category->slug) }}">
                                                                {{ $second_level_category->getTranslation('name') }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                @if ($child_category->childrenCategories->count() > 5)
                                                    <a href="javascript:void(0)"
                                                        class="ec-category-toggle show-hide-cetegoty">
                                                        {{ translate('More') }} <i class="las la-angle-down"></i>
                                                    </a>
                                                @endif
                                            @else
                                                <p class="ec-category-empty">{{ translate('Browse all products in this section') }}</p>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="ec-category-empty">{{ translate('Browse all products in this category') }}</p>
                                    @endforelse
                                </div>

                                <div class="ec-category-card__footer">
                                    <a href="{{ route('products.category', $category->slug) }}" class="ec-category-card__view">
                                        {{ translate('View Category') }} <i class="las la-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script>
        $('.show-hide-cetegoty').on('click', function() {
            var el = $(this).siblings('ul');
            if (el.hasClass('less')) {
                el.removeClass('less');
                $(this).html('{{ translate('Less') }} <i class="las la-angle-up"></i>');
            } else {
                el.addClass('less');
                $(this).html('{{ translate('More') }} <i class="las la-angle-down"></i>');
            }
        });
    </script>
@endsection
