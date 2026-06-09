<style>
    .ec-added-modal {
        padding: 28px 24px 24px;
        background: #ffffff;
    }

    .ec-added-success {
        margin-bottom: 22px;
        text-align: center;
    }

    .ec-added-success__icon {
        width: 62px;
        height: 62px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        border-radius: 50%;
        background: #eef8fd;
        color: #3c9bd3;
        box-shadow: 0 10px 24px rgba(60, 155, 211, 0.18);
    }

    .ec-added-success__title {
        margin: 0;
        color: #17212b;
        font-size: 24px;
        font-weight: 800;
        line-height: 1.25;
    }

    .ec-added-product {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 22px;
        padding: 14px;
        border: 1px solid #dceef8;
        border-radius: 14px;
        background: #f8fbfe;
    }

    .ec-added-product__image {
        width: 92px;
        height: 92px;
        flex: 0 0 92px;
        padding: 8px;
        border-radius: 12px;
        background: #ffffff;
        object-fit: contain;
    }

    .ec-added-product__name {
        margin: 0 0 10px;
        color: #17212b;
        font-size: 15px;
        font-weight: 800;
        line-height: 1.35;
    }

    .ec-added-product__meta {
        display: flex;
        align-items: baseline;
        gap: 12px;
    }

    .ec-added-product__label {
        color: #6f7d89;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .ec-added-product__price {
        color: #3c9bd3;
        font-size: 18px;
        font-weight: 800;
    }

    .ec-added-related {
        margin-bottom: 22px;
        overflow: hidden;
        border: 1px solid #dceef8;
        border-radius: 14px;
        background: #ffffff;
    }

    .ec-added-related__head {
        padding: 16px 18px 12px;
        border-bottom: 1px solid #edf5f9;
        background: linear-gradient(135deg, rgba(60, 155, 211, 0.08), rgba(255, 255, 255, 0));
    }

    .ec-added-related__title {
        margin: 0;
        color: #17212b;
        font-size: 16px;
        font-weight: 800;
    }

    .ec-added-related__body {
        padding: 14px;
    }

    .ec-added-card {
        height: 100%;
        overflow: hidden;
        border: 1px solid #e4f2fa;
        border-radius: 12px;
        background: #ffffff;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    .ec-added-card:hover {
        border-color: #3c9bd3;
        box-shadow: 0 12px 24px rgba(60, 155, 211, 0.14);
        transform: translateY(-2px);
    }

    .ec-added-card__image-wrap {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fbfe;
    }

    .ec-added-card__image {
        width: 100%;
        height: 100% !important;
        padding: 16px;
        object-fit: contain;
        transition: transform .25s ease;
    }

    .ec-added-card:hover .ec-added-card__image {
        transform: scale(1.06);
    }

    .ec-added-card__content {
        min-height: 108px;
        padding: 12px;
        text-align: center;
        border-top: 1px solid #edf5f9;
    }

    .ec-added-card__name {
        height: 39px;
        margin: 0;
        color: #17212b;
        font-size: 13px;
        font-weight: 700;
        line-height: 1.45;
    }

    .ec-added-card__name a:hover {
        color: #217fb8 !important;
        text-decoration: none;
    }

    .ec-added-card__price {
        margin-top: 10px;
        color: #3c9bd3;
        font-size: 14px;
        font-weight: 800;
    }

    .ec-added-actions {
        gap: 10px 0;
    }

    .ec-added-actions .btn {
        min-height: 48px;
        border: 0;
        border-radius: 8px !important;
        font-weight: 800;
        box-shadow: 0 10px 22px rgba(23, 33, 43, 0.1);
    }

    .ec-added-actions__back {
        background: #eef8fd !important;
        color: #217fb8 !important;
    }

    .ec-added-actions__checkout {
        background: #3c9bd3 !important;
        color: #fff !important;
    }

    @media (max-width: 575.98px) {
        .ec-added-modal {
            padding: 22px 14px 16px;
        }

        .ec-added-success__title {
            font-size: 20px;
        }

        .ec-added-product {
            align-items: flex-start;
        }

        .ec-added-product__image {
            width: 78px;
            height: 78px;
            flex-basis: 78px;
        }

        .ec-added-related__body {
            padding: 10px;
        }
    }
</style>

@php
    $product_image_url = function ($image) {
        return filter_var($image, FILTER_VALIDATE_URL)
            ? $image
            : uploaded_asset($image);
    };
@endphp

<div class="modal-body ec-added-modal c-scrollbar-light">
    <!-- Item added to your cart -->
    <div class="ec-added-success">
        <span class="ec-added-success__icon">
            <i class="las la-check fs-30"></i>
        </span>
        <h3 class="ec-added-success__title">{{ translate('Item added to your cart!')}}</h3>
    </div>

    <!-- Product Info -->
    <div class="ec-added-product media">
        <img src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ $product_image_url($product->thumbnail_img) }}"
            class="ec-added-product__image mr-0 lazyload img-fit" alt="{{ $product->getTranslation('name') }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
        <div class="media-body text-left">
            <h6 class="ec-added-product__name text-truncate-2">
                {{  $product->getTranslation('name')  }}
            </h6>
            <div class="ec-added-product__meta">
                <span class="ec-added-product__label">{{ translate('Price')}}</span>
                <strong class="ec-added-product__price">
                    {{ single_price(cart_product_price($cart, $product, false) * $cart->quantity) }}
                    {{-- {{ single_price(($cart->price + $cart->tax) * $cart->quantity) }} --}}
                </strong>
            </div>
        </div>
    </div>

    <!-- Related product -->
    <div class="ec-added-related">
        <div class="ec-added-related__head">
            <h3 class="ec-added-related__title">{{ translate('Frequently Bought Together')}}</h3>
        </div>
        <div class="ec-added-related__body">
            <div class="aiz-carousel gutters-5 half-outside-arrow" data-items="2" data-xl-items="3" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                @foreach (get_related_products($product) as $key => $related_product)
                <div class="carousel-box">
                    <div class="ec-added-card aiz-card-box my-2 has-transition">
                        <div class="ec-added-card__image-wrap">
                            <a href="{{ route('product', $related_product->slug) }}" class="d-block">
                                <img class="ec-added-card__image img-fit lazyload mx-auto has-transition"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ $product_image_url($related_product->thumbnail_img) }}"
                                    alt="{{ $related_product->getTranslation('name') }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                            </a>
                        </div>
                        <div class="ec-added-card__content">
                            <h3 class="ec-added-card__name text-truncate-2">
                                <a href="{{ route('product', $related_product->slug) }}" class="d-block text-reset hov-text-primary">{{ $related_product->getTranslation('name') }}</a>
                            </h3>
                            <div class="ec-added-card__price">
                                <span>{{ home_discounted_base_price($related_product) }}</span>
                                @if(home_base_price($related_product) != home_discounted_base_price($related_product))
                                    <del class="fw-600 opacity-50 ml-1">{{ home_base_price($related_product) }}</del>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Back to shopping & Checkout buttons -->
    <div class="ec-added-actions row gutters-5">
        <div class="col-sm-6">
            <button type="button" class="js-back-to-shopping ec-added-actions__back btn btn-warning mb-3 mb-sm-0 btn-block rounded-0 text-white" data-dismiss="modal">{{ translate('Back to shopping')}}</button>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('cart') }}" class="ec-added-actions__checkout btn btn-primary mb-3 mb-sm-0 btn-block rounded-0">{{ translate('Proceed to Checkout')}}</a>
        </div>
        
    </div>
</div>
