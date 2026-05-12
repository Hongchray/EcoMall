<style>
    .ec-top-selling {
        margin-bottom: 24px;
        overflow: hidden;
        border: 1px solid #dceef8;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 14px 36px rgba(34, 126, 184, 0.08);
    }

    .ec-top-selling__head {
        padding: 18px 18px 14px;
        border-bottom: 1px solid #edf5f9;
        background: linear-gradient(135deg, rgba(60, 155, 211, 0.1), rgba(255, 255, 255, 0));
    }

    .ec-top-selling__title {
        margin: 0;
        color: #17212b;
        font-size: 16px;
        font-weight: 800;
        line-height: 1.25;
    }

    .ec-top-selling__body {
        padding: 8px 12px 14px;
    }

    .ec-top-selling__item {
        padding: 10px 0 !important;
        background: transparent;
    }

    .ec-top-selling__card {
        min-height: 98px;
        padding: 10px;
        border: 1px solid transparent;
        border-radius: 12px;
        background: #ffffff;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    .ec-top-selling__card:hover {
        border-color: #dceef8;
        box-shadow: 0 10px 24px rgba(60, 155, 211, 0.14);
        transform: translateY(-2px);
    }

    .ec-top-selling__image-link {
        width: 82px;
        height: 82px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 10px;
        background: #f8fbfe;
    }

    .ec-top-selling__image {
        width: 100%;
        height: 100% !important;
        padding: 8px;
        object-fit: contain;
        transition: transform .25s ease;
    }

    .ec-top-selling__card:hover .ec-top-selling__image {
        transform: scale(1.08);
    }

    .ec-top-selling__name {
        margin-bottom: 10px;
        color: #17212b;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.35;
    }

    .ec-top-selling__name a:hover {
        color: #217fb8 !important;
        text-decoration: none;
    }

    .ec-top-selling__price {
        color: #3c9bd3 !important;
        font-size: 14px;
        font-weight: 800;
    }

    .ec-top-selling__old-price {
        color: #9aa7b2;
        font-size: 12px !important;
    }

    @media (max-width: 991.98px) {
        .ec-top-selling__image-link {
            width: 96px;
            height: 96px;
        }
    }
</style>

<div class="ec-top-selling">
    <div class="ec-top-selling__head">
        <h3 class="ec-top-selling__title">{{ translate('Top Selling Products') }}</h3>
    </div>
    <div class="ec-top-selling__body">
        <ul class="list-group list-group-flush">
            @foreach (get_best_selling_products(6, $detailedProduct->user_id) as $key => $top_product)
                @php
                    $top_product_image = filter_var($top_product->thumbnail_img, FILTER_VALIDATE_URL)
                        ? $top_product->thumbnail_img
                        : uploaded_asset($top_product->thumbnail_img);
                @endphp
                <li class="ec-top-selling__item list-group-item border-0">
                    <div class="ec-top-selling__card row gutters-10 align-items-center">
                        <div class="col-xl-4 col-lg-6 col-4">
                            <!-- Image -->
                            <a href="{{ route('product', $top_product->slug) }}"
                                class="ec-top-selling__image-link text-reset">
                                <img class="ec-top-selling__image img-fit lazyload"
                                    src="{{ $top_product_image }}"
                                    data-src="{{ $top_product_image }}"
                                    alt="{{ $top_product->getTranslation('name') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                            </a>
                        </div>
                        <div class="col text-left">
                            <!-- Product name -->
                            <div class="d-lg-none d-xl-block mb-3">
                                <h4 class="ec-top-selling__name text-truncate-2">
                                    <a href="{{ route('product', $top_product->slug) }}"
                                        class="d-block text-reset hov-text-primary">{{ $top_product->getTranslation('name') }}</a>
                                </h4>
                            </div>
                            <div class="">
                                <!-- Price -->
                                <span class="ec-top-selling__price">{{ home_discounted_base_price($top_product) }}</span>
                                <!-- Home Price -->
                                @if(home_price($top_product) != home_discounted_price($top_product))
                                <del class="ec-top-selling__old-price fw-700 opacity-60 ml-1 ml-lg-0 ml-xl-1">
                                    {{ home_price($top_product) }}
                                </del>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
