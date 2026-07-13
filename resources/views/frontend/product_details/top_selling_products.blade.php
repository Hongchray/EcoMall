<style>
    .ts-section {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e8f4fb;
    }

    .ts-section__head {
        display: flex;
        align-items: center;
        padding: 10px 14px;
        border-bottom: 1px solid #edf5f9;
        background: #f4faff;
    }

    .ts-section__title {
        font-size: 13px;
        font-weight: 700;
        color: #17212b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ts-section__title::before {
        content: '';
        display: block;
        width: 3px;
        height: 13px;
        background: #3c9bd3;
        border-radius: 2px;
        flex-shrink: 0;
    }

    .ts-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
        padding: 10px;
        
    }

    /* Compact card overrides for this narrow sidebar */
    .ts-grid .ec-product-card {
        padding: 8px 6px 6px;
        margin-top: 0;
        border-radius: 10px;
    }
    .ts-grid .ec-product-card__top { min-height: 20px; margin-bottom: 4px; }
    .ts-grid .ec-product-card__badge { padding: 2px 6px; font-size: 8px; border-radius: 999px; }
    .ts-grid .ec-product-card__wishlist { width: 20px; height: 20px; flex: 0 0 20px; font-size: 12px; border-width: 1px; }
    .ts-grid .ec-product-card__image-wrap { width: 90%; max-width: 70px; margin-bottom: 8px; border-radius: 8px; }
    .ts-grid .ec-product-card__image { padding: 2px; }
    .ts-grid .ec-product-card__content { margin: 0 -6px -6px; padding: 8px 6px 6px; border-radius: 0 0 8px 8px; }
    .ts-grid .ec-product-card__name { min-height: 28px; margin: 0 2px 4px; font-size: 11px; -webkit-line-clamp: 2; }
    .ts-grid .ec-product-card__rating { min-height: 14px; margin: 0 2px 4px; font-size: 9px; gap: 3px; }
    .ts-grid .ec-product-card__price-row { min-height: auto; margin: 0 2px 6px; gap: 4px; }
    .ts-grid .ec-product-card__price-value { font-size: 12px; }
    .ts-grid .ec-product-card__unit { font-size: 9px; }
    .ts-grid .ec-product-card__compare { width: 20px; height: 20px; flex: 0 0 20px; font-size: 12px; }
    .ts-grid .ec-product-card__action { min-height: 26px; font-size: 10px; gap: 4px; border-radius: 4px; }
    .ts-grid .ec-product-card__action i { font-size: 13px; }

    @media (max-width: 575px) {
        .ts-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="ts-section">
    <div class="ts-section__head">
        <h3 class="ts-section__title">{{ translate('Top Selling Products') }}</h3>
    </div>
    <div class="ts-grid">
        @foreach ($top_selling_products as $key => $top_product)
            @include('frontend.partials.product_box_1', ['product' => $top_product])
        @endforeach
    </div>
</div>
