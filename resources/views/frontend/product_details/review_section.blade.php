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
        margin: 24px 24px 28px;
        padding: 26px 30px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 18px 28px;
        border: 1px solid #cfe9fb;
        border-radius: 14px;
        background: linear-gradient(135deg, #eef9ff 0%, #f7fcff 100%);
        box-shadow: 0 10px 28px rgba(60, 155, 211, 0.08);
    }

    .ec-review-summary__score {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 18px;
        min-width: 0;
        flex: 1 1 260px;
    }

    .ec-review-summary__value-wrap {
        display: flex;
        align-items: baseline;
        gap: 6px;
        flex-shrink: 0;
    }

    .ec-review-summary__value {
        color: #0b2540;
        font-size: 44px;
        font-weight: 800;
        line-height: 1;
    }

    .ec-review-summary__text {
        color: #7b8a9a;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .ec-review-summary__divider {
        width: 1px;
        align-self: stretch;
        background: #cfe9fb;
        flex-shrink: 0;
    }

    .ec-review-summary__meta {
        display: flex;
        flex-direction: column;
        gap: 6px;
        min-width: 0;
    }

    .ec-review-summary .rating {
        display: inline-flex;
        align-items: center;
        font-size: 18px;
        color: #ff9f0a;
    }

    .ec-review-summary__count {
        color: #52616f;
        font-size: 13px;
        font-weight: 500;
    }

    .ec-review-summary__button {
        flex: 1 1 200px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        max-width: 260px;
        padding: 14px 24px;
        border: 0;
        border-radius: 8px;
        background: #3498d3;
        box-shadow: 0 8px 20px rgba(52, 152, 211, 0.32);
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        text-align: center;
        white-space: nowrap;
        transition: background .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    .ec-review-summary__button i {
        font-size: 18px;
    }

    .ec-review-summary__button:hover,
    .ec-review-summary__button:focus {
        background: #2387c4;
        color: #fff;
        text-decoration: none;
        box-shadow: 0 10px 24px rgba(52, 152, 211, 0.4);
        transform: translateY(-2px);
    }

    @media (max-width: 767.98px) {
        .ec-review-panel__header {
            padding: 16px;
        }

        .ec-review-summary {
            margin: 16px 16px 22px;
            padding: 20px;
            flex-direction: column;
            align-items: stretch;
            gap: 18px;
        }

        .ec-review-summary__score {
            gap: 16px;
        }

        .ec-review-summary__value {
            font-size: 38px;
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
    <div>
        <div class="ec-review-summary">
            <div class="ec-review-summary__score">
                @php
                    $total = $detailedProduct->reviews->where('status', 1)->count();
                @endphp
                <div class="ec-review-summary__value-wrap">
                    <span class="ec-review-summary__value">{{ number_format((float) $detailedProduct->rating, 1) }}</span>
                    <span class="ec-review-summary__text">{{ translate('out of 5.0') }}</span>
                </div>
                <span class="ec-review-summary__divider"></span>
                <div class="ec-review-summary__meta">
                    <span class="rating rating-mr-1">
                        {{ renderStarRating($detailedProduct->rating) }}
                    </span>
                    <span class="ec-review-summary__count">{{ $total }} {{ translate('reviews') }}</span>
                </div>
            </div>
            <a href="javascript:void(0);" onclick="product_review('{{ $detailedProduct->id }}')"
                class="ec-review-summary__button">
                <i class="las la-star"></i>
                {{ translate('Rate this Product') }}
            </a>
        </div>
    </div>
    <!-- Reviews -->
    @include('frontend.product_details.reviews')
</div>
