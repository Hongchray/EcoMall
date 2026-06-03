<style>
    .ec-related-products {
        overflow: hidden;
        border: 1px solid #dceef8;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 14px 36px rgba(34, 126, 184, 0.08);
    }

    .ec-related-products__head {
        padding: 18px 20px 14px;
        border-bottom: 1px solid #edf5f9;
        background: linear-gradient(135deg, rgba(60, 155, 211, 0.08), rgba(255, 255, 255, 0));
    }

    .ec-related-products__title {
        margin: 0;
        color: #17212b;
        font-size: 18px;
        font-weight: 800;
        line-height: 1.25;
    }

    .ec-related-products__body {
        padding: 18px 18px 22px;
    }

    .ec-related-products__carousel .carousel-box {
        padding: 4px 8px;
    }

    .ec-related-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid #e4f2fa;
        border-radius: 14px;
        background: #ffffff;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    .ec-related-card:hover {
        border-color: #3c9bd3;
        box-shadow: 0 14px 28px rgba(60, 155, 211, 0.16);
        transform: translateY(-3px);
    }

    .ec-related-card__image-wrap {
        height: 170px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fbfe;
    }

    .ec-related-card__image {
        width: 100%;
        height: 100% !important;
        padding: 18px;
        object-fit: contain;
        transition: transform .28s ease;
    }

    .ec-related-card:hover .ec-related-card__image {
        transform: scale(1.08);
    }

    .ec-related-card__content {
        min-height: 122px;
        padding: 14px 14px 16px;
        border-top: 1px solid #edf5f9;
    }

    .ec-related-card__name {
        height: 42px;
        margin: 0;
        color: #17212b;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.45;
    }

    .ec-related-card__name a:hover {
        color: #217fb8 !important;
        text-decoration: none;
    }

    .ec-related-card__price-row {
        margin-top: 12px;
    }

    .ec-related-card__price {
        color: #3c9bd3 !important;
        font-size: 15px;
        font-weight: 800;
    }

    .ec-related-card__old-price {
        color: #9aa7b2;
        font-size: 12px;
        font-weight: 700;
    }

    @media (max-width: 575.98px) {
        .ec-related-products__head {
            padding: 16px 14px 12px;
        }

        .ec-related-products__body {
            padding: 14px 10px 18px;
        }

        .ec-related-card__image-wrap {
            height: 140px;
        }

        .ec-related-card__content {
            min-height: 116px;
            padding: 12px;
        }
    }
</style>

<div class="ec-related-products">
    <div class="ec-related-products__head">
        <h3 class="ec-related-products__title">{{ translate('Related products') }}</h3>
    </div>
    <div class="ec-related-products__body">
        <div class="aiz-carousel gutters-5 half-outside-arrow ec-related-products__carousel" data-items="5" data-xl-items="3"
            data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2"
            data-arrows='true' data-infinite='true'>
            @foreach ($related_products as $key => $related_product)
                @php
                    $related_product_image = filter_var($related_product->thumbnail_img, FILTER_VALIDATE_URL)
                        ? $related_product->thumbnail_img
                        : uploaded_asset($related_product->thumbnail_img);
                @endphp
                <div class="carousel-box">
                    <div class="ec-related-card aiz-card-box my-2 has-transition">
                        <div class="ec-related-card__image-wrap">
                            <a href="{{ route('product', $related_product->slug) }}"
                                class="d-block">
                                <img class="ec-related-card__image img-fit lazyload mx-auto has-transition"
                                    src="{{ $related_product_image }}"
                                    data-src="{{ $related_product_image }}"
                                    alt="{{ $related_product->getTranslation('name') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                            </a>
                        </div>
                        <div class="ec-related-card__content text-center">
                            <h3 class="ec-related-card__name text-truncate-2">
                                <a href="{{ route('product', $related_product->slug) }}"
                                    class="d-block text-reset hov-text-primary">{{ $related_product->getTranslation('name') }}</a>
                            </h3>
                            <div class="ec-related-card__price-row">
                                <span class="ec-related-card__price">{{ home_discounted_base_price($related_product) }}</span>
                                @if (home_base_price($related_product) != home_discounted_base_price($related_product))
                                    <del
                                        class="ec-related-card__old-price opacity-60 ml-1">{{ home_base_price($related_product) }}</del>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
