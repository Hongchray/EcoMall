@php
    $compare_layout = Auth::check() ? 'frontend.layouts.user_panel' : 'frontend.layouts.app';
    $compare_section = Auth::check() ? 'panel_content' : 'content';
@endphp

@extends($compare_layout)

@section($compare_section)
    <style>
        .compare-page {
            padding: 0;
        }

        .compare-page.is-storefront {
            padding: 24px 0 40px;
        }

        .compare-panel {
            background: #fff;
            border: 1px solid #edf2f7;
            border-radius: 20px;
            overflow: hidden;
        }

        .compare-header {
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            gap: 16px;
            justify-content: space-between;
            padding: 24px;
        }

        .compare-title {
            color: #1e293b;
            font-size: 24px;
            font-weight: 800;
            margin: 0;
        }

        .compare-reset {
            align-items: center;
            background: #eff6ff;
            border-radius: 12px;
            color: #0d6efd;
            display: inline-flex;
            font-size: 13px;
            font-weight: 800;
            justify-content: center;
            min-height: 40px;
            padding: 10px 16px;
            text-decoration: none;
            transition: .2s ease;
            white-space: nowrap;
        }

        .compare-reset:hover {
            background: #0d6efd;
            color: #fff;
            text-decoration: none;
        }

        .compare-grid {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            padding: 24px;
        }

        .compare-card {
            background: #f8fbfe;
            border: 1.5px solid #e3f3fb;
            border-radius: 14px;
            overflow: hidden;
            padding: 16px 14px 14px;
            transition: box-shadow .25s ease, transform .25s ease, border-color .25s ease;
        }

        .compare-card:hover {
            border-color: #3c9bd3;
            box-shadow: 0 10px 36px rgba(60, 155, 211, 0.18);
            transform: translateY(-4px);
        }

        .compare-badge {
            background: #3c9bd3;
            border-radius: 999px;
            color: #fff;
            display: inline-flex;
            font-size: 10px;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 12px;
            padding: 4px 10px;
            text-transform: uppercase;
        }

        .compare-image {
            align-items: center;
            aspect-ratio: 1 / 1;
            background: #fff;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            margin: 0 auto 18px;
            max-width: 180px;
            overflow: hidden;
            text-decoration: none;
            width: 72%;
        }

        .compare-image img {
            height: 100%;
            object-fit: contain;
            padding: 10px;
            transition: transform .3s ease;
            width: 100%;
        }

        .compare-card:hover .compare-image img {
            transform: scale(1.08);
        }

        .compare-content {
            background: #fff;
            border-radius: 0 0 12px 12px;
            border-top: 1px solid #e3f3fb;
            margin: 0 -14px -14px;
            padding: 16px 14px 14px;
        }

        .compare-name {
            color: #111;
            display: -webkit-box;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.35;
            margin: 0 4px 14px;
            min-height: 40px;
            overflow: hidden;
            text-decoration: none;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .compare-name:hover,
        .compare-name:focus {
            color: #227eb8;
            text-decoration: none;
        }

        .compare-price {
            color: #2d9add;
            display: block;
            font-size: 15px;
            font-weight: 800;
            margin: 0 4px 14px;
        }

        .compare-price del {
            color: #94a3b8;
            font-size: 13px;
            font-weight: 600;
        }

        .compare-meta {
            border-top: 1px solid #f1f5f9;
            display: grid;
            gap: 10px;
            padding: 14px 4px;
        }

        .compare-meta-row {
            align-items: flex-start;
            display: flex;
            gap: 12px;
            justify-content: space-between;
        }

        .compare-meta-label {
            color: #64748b;
            flex: 0 0 auto;
            font-size: 12px;
            font-weight: 700;
        }

        .compare-meta-value {
            color: #1e293b;
            font-size: 13px;
            font-weight: 700;
            min-width: 0;
            text-align: right;
        }

        .compare-action {
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
            min-height: 42px;
            text-align: center;
            transition: background-color .2s ease, color .2s ease;
            width: 100%;
        }

        .compare-action:hover,
        .compare-action:focus {
            background: #3d98d1;
            color: #fff;
        }

        .compare-action i {
            font-size: 20px;
            line-height: 1;
        }

        .compare-empty {
            padding: 54px 24px;
            text-align: center;
        }

        .compare-empty img {
            max-width: 180px;
            height: auto;
        }

        .compare-empty-title {
            color: #1e293b;
            font-size: 18px;
            font-weight: 800;
            margin: 18px 0 0;
        }

        @media (max-width: 991.98px) {
            .compare-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .compare-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 20px;
            }

            .compare-grid {
                grid-template-columns: 1fr;
                padding: 20px;
            }

            .compare-reset {
                width: 100%;
            }
        }
    </style>

    <section class="compare-page {{ Auth::check() ? '' : 'is-storefront' }}">
        <div class="container text-left">
            <div class="compare-panel">
                <div class="compare-header">
                    <h1 class="compare-title">{{ translate('Compare Products')}}</h1>
                    <a href="{{ route('compare.reset') }}" class="compare-reset">
                        <i class="las la-redo-alt mr-1"></i>
                        {{ translate('Reset Compare List')}}
                    </a>
                </div>

                @if(Session::has('compare') && count(Session::get('compare')) > 0)
                    <div class="compare-grid">
                        @foreach (Session::get('compare') as $key => $item)
                            @php
                                $product = get_single_product($item);
                                $compare_placeholder_image = static_asset('assets/img/placeholder.jpg');
                                $compare_product_image = $product
                                    ? (filter_var($product->thumbnail_img, FILTER_VALIDATE_URL) ? $product->thumbnail_img : uploaded_asset($product->thumbnail_img))
                                    : $compare_placeholder_image;
                            @endphp
                            @if ($product)
                                <div class="compare-card">
                                    <span class="compare-badge">{{ translate('Compare')}}</span>

                                    <a href="{{ route('product', $product->slug) }}" class="compare-image" title="{{ $product->getTranslation('name') }}">
                                        <img src="{{ $compare_placeholder_image }}"
                                             data-src="{{ $compare_product_image ?: $compare_placeholder_image }}"
                                             class="lazyload"
                                             alt="{{ $product->getTranslation('name') }}"
                                             title="{{ $product->getTranslation('name') }}"
                                             onerror="this.onerror=null;this.src='{{ $compare_placeholder_image }}';">
                                    </a>

                                    <div class="compare-content">
                                        <a class="compare-name" href="{{ route('product', $product->slug) }}" title="{{ $product->getTranslation('name') }}">
                                            {{ $product->getTranslation('name') }}
                                        </a>

                                        <span class="compare-price">
                                            @if(home_base_price($product) != home_discounted_base_price($product))
                                                <del class="mr-1">{{ home_base_price($product) }}</del>
                                            @endif
                                            {{ home_discounted_base_price($product) }}
                                        </span>

                                        <div class="compare-meta">
                                            <div class="compare-meta-row">
                                                <span class="compare-meta-label">{{ translate('Category')}}</span>
                                                <span class="compare-meta-value">
                                                    @if ($product->main_category != null)
                                                        {{ $product->main_category->getTranslation('name') }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </div>

                                            <div class="compare-meta-row">
                                                <span class="compare-meta-label">{{ translate('Brand')}}</span>
                                                <span class="compare-meta-value">
                                                    @if ($product->brand != null)
                                                        {{ $product->brand->getTranslation('name') }}
                                                    @else
                                                        -
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        <button type="button" class="compare-action" onclick="showAddToCartModal({{ $item }})">
                                            <i class="las la-shopping-cart"></i>
                                            <span>{{ translate('Add to cart')}}</span>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="compare-empty">
                        <img src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                        <h5 class="compare-empty-title">{{ translate('Your comparison list is empty')}}</h5>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
