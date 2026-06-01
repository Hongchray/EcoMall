<style>
    .ec-review-panel {
        border: 1px solid #dcecf6;
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
    }

    .ec-review-panel__header {
        padding: 18px 24px;
        border-bottom: 1px solid #edf5fa;
    }

    .ec-review-summary {
        margin: 0 24px 28px;
        padding: 24px 26px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        border: 1px solid #35a3e2;
        border-radius: 10px;
        background: #eef9ff;
    }

    .ec-review-summary__score {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        min-width: 0;
    }

    .ec-review-summary__value {
        color: #071429;
        font-size: 38px;
        font-weight: 700;
        line-height: 1;
    }

    .ec-review-summary__text {
        color: #263345;
        font-size: 14px;
    }

    .ec-review-summary .rating {
        display: inline-flex;
        align-items: center;
        font-size: 18px;
    }

    .ec-review-summary__count {
        color: #263345;
        font-size: 14px;
    }

    .ec-review-summary__button {
        min-width: 260px;
        padding: 14px 22px;
        border: 0;
        border-radius: 6px;
        background: #3498d3;
        color: #fff;
        font-weight: 700;
        text-align: center;
        transition: background .2s ease, transform .2s ease;
    }

    .ec-review-summary__button:hover,
    .ec-review-summary__button:focus {
        background: #2387c4;
        color: #fff;
        text-decoration: none;
        transform: translateY(-1px);
    }

    @media (max-width: 767.98px) {
        .ec-review-panel__header {
            padding: 16px;
        }

        .ec-review-summary {
            margin: 0 16px 22px;
            padding: 18px;
            align-items: stretch;
            flex-direction: column;
        }

        .ec-review-summary__button {
            width: 100%;
            min-width: 0;
        }
    }
</style>

<div class="ec-review-panel mb-4">
    <div class="ec-review-panel__header">
        <h3 class="fs-16 fw-700 mb-0">{{ translate('Reviews & Ratings') }}</h3>
    </div>
    <!-- Rating -->
    <div class="pt-4">
        <div class="ec-review-summary">
            <div class="ec-review-summary__score">
                @php
                    $total = $detailedProduct->reviews->where('status', 1)->count();
                @endphp
                <span class="ec-review-summary__value">{{ number_format((float) $detailedProduct->rating, 1) }}</span>
                <span class="ec-review-summary__text">{{ translate('out of 5.0') }}</span>
                <span class="rating rating-mr-1">
                    {{ renderStarRating($detailedProduct->rating) }}
                </span>
                <span class="ec-review-summary__count">({{ $total }} {{ translate('reviews') }})</span>
            </div>
            <a href="javascript:void(0);" onclick="product_review('{{ $detailedProduct->id }}')"
                class="ec-review-summary__button">
                {{ translate('Rate this Product') }}
            </a>
        </div>
    </div>
    <!-- Reviews -->
    @include('frontend.product_details.reviews')
</div>
