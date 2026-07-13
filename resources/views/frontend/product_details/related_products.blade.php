<style>
    .rel-section {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e8f4fb;
    }

    .rel-section__head {
        display: flex;
        align-items: center;
        padding: 10px 14px;
        border-bottom: 1px solid #edf5f9;
        background: #f4faff;
    }

    .rel-section__title {
        font-size: 13px;
        font-weight: 700;
        color: #17212b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rel-section__title::before {
        content: '';
        display: block;
        width: 3px;
        height: 13px;
        background: #3c9bd3;
        border-radius: 2px;
        flex-shrink: 0;
    }

    .rel-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 12px;
        padding: 12px;
    }

    /* Slightly tighter card so more fit per row, but keep it readable */
    .rel-grid .ec-product-card {
        padding: 12px 10px 10px;
        margin-top: 0;
        border-radius: 10px;
    }
    .rel-grid .ec-product-card__image-wrap { width: 85%; max-width: 110px; }

    @media (max-width: 575px) {
        .rel-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="rel-section">
    <div class="rel-section__head">
        <h3 class="rel-section__title">{{ translate('Related products') }}</h3>
    </div>
    <div class="rel-grid">
        @foreach ($related_products as $related_product)
            @include('frontend.partials.product_box_1', ['product' => $related_product])
        @endforeach
    </div>
</div>
