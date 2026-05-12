<style>
    /* ══════════════════════════════════════════════════════
   PRODUCT PAGE — Buttons & Seller Bar
   ══════════════════════════════════════════════════════ */

/* ── Shared tokens ───────────────────────────────────── */
:root {
    --ease-spring:     cubic-bezier(0.34, 1.56, 0.64, 1);
    --ease-out-smooth: cubic-bezier(0.22, 1, 0.36, 1);
    --ease-in-out:     cubic-bezier(0.65, 0, 0.35, 1);
    --amber:           #f3af3d;
    --amber-dark:      #e8a030;
    --amber-text:      #412402;
    --amber-glow:      rgba(243, 175, 61, 0.28);
}


/* ══════════════════════════════════════════════════════
   PRODUCT INQUIRY BUTTON
   ══════════════════════════════════════════════════════ */

.btn-inquiry {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 20px 9px 14px;
    border-radius: 999px;
    background: var(--amber);
    color: var(--amber-text);
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    white-space: nowrap;
    -webkit-font-smoothing: antialiased;
    will-change: transform, box-shadow;
    transform: translateY(0) scale(1);
    box-shadow: 0 2px 8px rgba(243, 175, 61, 0.28), 0 1px 2px rgba(0, 0, 0, 0.06);
    transition:
        background  0.25s var(--ease-out-smooth),
        box-shadow  0.25s var(--ease-out-smooth),
        color       0.20s var(--ease-out-smooth),
        transform   0.35s var(--ease-spring);
}

.btn-inquiry:hover {
    background: var(--amber-dark);
    box-shadow: 0 6px 20px rgba(243, 175, 61, 0.42), 0 2px 6px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px) scale(1.01);
    color: var(--amber-text);
    text-decoration: none;
}

.btn-inquiry:active {
    transform: translateY(0) scale(0.97);
    box-shadow: 0 1px 4px rgba(243, 175, 61, 0.22);
    transition:
        transform   0.12s var(--ease-in-out),
        box-shadow  0.12s var(--ease-in-out);
}

.btn-inquiry__icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: rgba(65, 36, 2, 0.12);
    flex-shrink: 0;
    will-change: transform;
    transition: transform 0.35s var(--ease-spring);
}

.btn-inquiry:hover .btn-inquiry__icon {
    transform: rotate(-12deg) scale(1.1);
}

.btn-inquiry:active .btn-inquiry__icon {
    transform: scale(0.92);
    transition: transform 0.1s var(--ease-in-out);
}


/* ══════════════════════════════════════════════════════
   WISHLIST & COMPARE BUTTONS
   ══════════════════════════════════════════════════════ */

.product-action-group {
    display: flex;
    align-items: center;
    gap: 4px;
    flex-wrap: wrap;
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 16px;
    border-radius: 999px;
    background: transparent;
    border: 1px solid rgba(0, 0, 0, 0.15);
    color: #555;
    font-size: 13.5px;
    font-weight: 500;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
    -webkit-font-smoothing: antialiased;
    will-change: transform, background, border-color;
    transform: translateY(0) scale(1);
    transition:
        background    0.25s var(--ease-out-smooth),
        border-color  0.25s var(--ease-out-smooth),
        color         0.25s var(--ease-out-smooth),
        box-shadow    0.25s var(--ease-out-smooth),
        transform     0.35s var(--ease-spring);
}

.btn-action:hover {
    background: #fff7ec;
    border-color: var(--amber);
    color: #7a4a00;
    text-decoration: none;
    transform: translateY(-2px) scale(1.01);
    box-shadow: 0 4px 12px rgba(243, 175, 61, 0.18);
}

.btn-action:active {
    transform: translateY(0) scale(0.97);
    box-shadow: none;
    transition:
        transform   0.1s var(--ease-in-out),
        box-shadow  0.1s var(--ease-in-out);
}

.btn-action__icon {
    display: inline-flex;
    align-items: center;
    flex-shrink: 0;
    opacity: 0.65;
    will-change: transform, opacity;
    transform: scale(1);
    transition:
        opacity   0.25s var(--ease-out-smooth),
        transform 0.35s var(--ease-spring);
}

.btn-action:hover .btn-action__icon {
    opacity: 1;
    transform: scale(1.18);
}

.btn-action:active .btn-action__icon {
    transform: scale(0.9);
    transition: transform 0.1s var(--ease-in-out);
}

.btn-action-divider {
    width: 1px;
    height: 22px;
    background: rgba(0, 0, 0, 0.12);
    margin: 0 6px;
    flex-shrink: 0;
}


/* ══════════════════════════════════════════════════════
   SELLER BAR
   ══════════════════════════════════════════════════════ */

.seller-bar {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 16px;
    flex-wrap: wrap;
    padding: 14px 0;
}

.seller-bar__info {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.seller-bar__label {
    font-size: 13px;
    font-weight: 400;
    color: #999;
    white-space: nowrap;
}

.seller-bar__name {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 14px;
    font-weight: 600;
    color: #222;
    text-decoration: none;
    will-change: color, transform;
    transform: translateX(0);
    transition:
        color     0.25s var(--ease-out-smooth),
        transform 0.35s var(--ease-spring);
}

.seller-bar__name:hover {
    color: var(--amber-dark);
    text-decoration: none;
    transform: translateX(2px);
}

.seller-bar__name--inhouse {
    cursor: default;
    pointer-events: none;
    color: #444;
}

.seller-bar__avatar {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: rgba(243, 175, 61, 0.15);
    color: #a06800;
    font-size: 11px;
    font-weight: 700;
    flex-shrink: 0;
    will-change: transform, background;
    transition:
        background 0.25s var(--ease-out-smooth),
        transform  0.35s var(--ease-spring);
}

.seller-bar__name:hover .seller-bar__avatar {
    background: rgba(243, 175, 61, 0.28);
    transform: scale(1.12);
}

.seller-bar__avatar--inhouse {
    background: rgba(100, 100, 100, 0.10);
    color: #777;
}

.seller-bar__chevron {
    opacity: 0;
    will-change: opacity, transform;
    transform: translateX(-4px);
    transition:
        opacity   0.22s var(--ease-out-smooth),
        transform 0.35s var(--ease-spring);
}

.seller-bar__name:hover .seller-bar__chevron {
    opacity: 1;
    transform: translateX(0);
}

.seller-bar__divider {
    height: 1px;
    background: linear-gradient(to right, rgba(243, 175, 61, 0.18), rgba(0, 0, 0, 0.06), transparent);
    margin: 0;
}


/* ══════════════════════════════════════════════════════
   MESSAGE SELLER BUTTON
   ══════════════════════════════════════════════════════ */

.btn-message {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px 8px 12px;
    border-radius: 999px;
    background: transparent;
    border: 1px solid rgba(243, 175, 61, 0.45);
    color: #666;
    font-size: 13.5px;
    font-weight: 500;
    cursor: pointer;
    white-space: nowrap;
    -webkit-font-smoothing: antialiased;
    will-change: transform, background, border-color, box-shadow;
    transform: translateY(0) scale(1);
    transition:
        background    0.25s var(--ease-out-smooth),
        border-color  0.25s var(--ease-out-smooth),
        color         0.25s var(--ease-out-smooth),
        box-shadow    0.25s var(--ease-out-smooth),
        transform     0.35s var(--ease-spring);
}

.btn-message:hover {
    background: #fff8ed;
    border-color: var(--amber);
    color: #7a4a00;
    box-shadow: 0 4px 14px var(--amber-glow);
    transform: translateY(-2px) scale(1.01);
}

.btn-message:active {
    transform: translateY(0) scale(0.97);
    box-shadow: none;
    transition:
        transform   0.1s var(--ease-in-out),
        box-shadow  0.1s var(--ease-in-out);
}

.btn-message__icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: rgba(243, 175, 61, 0.12);
    flex-shrink: 0;
    will-change: transform, background;
    transition:
        background 0.25s var(--ease-out-smooth),
        transform  0.35s var(--ease-spring);
}

.btn-message:hover .btn-message__icon {
    background: rgba(243, 175, 61, 0.22);
    transform: scale(1.15) rotate(-8deg);
}

.btn-message:active .btn-message__icon {
    transform: scale(0.9);
    transition: transform 0.1s var(--ease-in-out);
}


/* ══════════════════════════════════════════════════════
   DARK MODE
   ══════════════════════════════════════════════════════ */

@media (prefers-color-scheme: dark) {

    .btn-inquiry {
        box-shadow: 0 2px 12px rgba(243, 175, 61, 0.22), 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    .btn-inquiry:hover {
        box-shadow: 0 6px 22px rgba(243, 175, 61, 0.35), 0 2px 8px rgba(0, 0, 0, 0.35);
    }

    .btn-action {
        border-color: rgba(255, 255, 255, 0.18);
        color: #ccc;
    }

    .btn-action:hover {
        background: rgba(243, 175, 61, 0.10);
        border-color: var(--amber);
        color: var(--amber);
        box-shadow: 0 4px 14px rgba(243, 175, 61, 0.12);
    }

    .btn-action-divider {
        background: rgba(255, 255, 255, 0.15);
    }

    .seller-bar__label {
        color: #666;
    }

    .seller-bar__name {
        color: #e0e0e0;
    }

    .seller-bar__name:hover {
        color: var(--amber);
    }

    .seller-bar__avatar {
        color: var(--amber);
    }

    .seller-bar__divider {
        background: linear-gradient(to right, rgba(243, 175, 61, 0.12), rgba(255, 255, 255, 0.05), transparent);
    }

    .btn-message {
        border-color: rgba(243, 175, 61, 0.3);
        color: #aaa;
    }

    .btn-message:hover {
        background: rgba(243, 175, 61, 0.08);
        border-color: var(--amber);
        color: var(--amber);
    }
}


/* ══════════════════════════════════════════════════════
   REDUCED MOTION
   ══════════════════════════════════════════════════════ */

@media (prefers-reduced-motion: reduce) {
    .btn-inquiry,
    .btn-inquiry__icon,
    .btn-action,
    .btn-action__icon,
    .seller-bar__name,
    .seller-bar__avatar,
    .seller-bar__chevron,
    .btn-message,
    .btn-message__icon {
        transition:
            background    0.15s ease,
            border-color  0.15s ease,
            color         0.15s ease,
            opacity       0.15s ease !important;
        transform: none !important;
        will-change: auto !important;
    }
}


/* ══════════════════════════════════════════════════════
   RESPONSIVE
   ══════════════════════════════════════════════════════ */

@media (max-width: 576px) {

    .btn-inquiry {
        font-size: 13px;
        padding: 8px 16px 8px 12px;
    }

    .btn-action {
        font-size: 12.5px;
        padding: 7px 13px;
    }

    .product-action-group {
        gap: 6px;
    }

    .btn-action-divider {
        display: none;
    }

    .seller-bar {
        gap: 12px;
    }

    .seller-bar__name {
        font-size: 13.5px;
    }

    .btn-message {
        font-size: 13px;
        padding: 7px 14px 7px 10px;
    }
}

.ec-detail-panel {
    --ec-blue: #3c9bd3;
    --ec-blue-dark: #217fb8;
    --ec-blue-soft: #eef8fd;
    --ec-border: #dceef8;
    --ec-text: #17212b;
    --ec-muted: #6f7d89;
    position: relative;
    padding: 26px;
    border: 1px solid var(--ec-border);
    border-radius: 18px;
    background:
        linear-gradient(135deg, rgba(60, 155, 211, 0.08), rgba(255, 255, 255, 0) 42%),
        #ffffff;
    box-shadow: 0 16px 46px rgba(34, 126, 184, 0.1);
}

.ec-detail-title {
    margin: 0 0 14px;
    color: var(--ec-text) !important;
    font-size: 27px;
    font-weight: 800;
    line-height: 1.25;
    letter-spacing: 0;
}

.ec-detail-meta {
    gap: 8px 14px;
    margin-bottom: 16px !important;
}

.ec-detail-meta small,
.ec-detail-meta span {
    color: var(--ec-muted);
}

.ec-detail-actions-row {
    gap: 10px 0;
    margin-bottom: 14px;
}

.ec-detail-actions-row .col,
.ec-detail-actions-row [class*="col-"] {
    padding-left: 0;
    padding-right: 10px;
}

.ec-detail-panel .btn-inquiry {
    background: var(--ec-blue);
    color: #fff;
    box-shadow: 0 9px 20px rgba(60, 155, 211, 0.24);
}

.ec-detail-panel .btn-inquiry:hover {
    background: var(--ec-blue-dark);
    color: #fff;
    box-shadow: 0 12px 28px rgba(60, 155, 211, 0.3);
}

.ec-detail-panel .btn-inquiry__icon {
    background: rgba(255, 255, 255, 0.18);
}

.ec-detail-panel .btn-action,
.ec-detail-panel .btn-message {
    border-color: var(--ec-border);
    background: #fff;
    color: #44515d;
}

.ec-detail-panel .btn-action:hover,
.ec-detail-panel .btn-message:hover {
    border-color: var(--ec-blue);
    background: var(--ec-blue-soft);
    color: var(--ec-blue-dark);
    box-shadow: 0 8px 18px rgba(60, 155, 211, 0.16);
}

.ec-brand-line,
.seller-bar,
.ec-detail-panel > .row.no-gutters,
.ec-buy-form > .row.no-gutters,
.ec-share-row {
    padding: 14px 0;
    margin-bottom: 0 !important;
    border-top: 1px solid #edf5f9;
}

.ec-brand-line {
    gap: 10px;
}

.ec-brand-line .text-secondary,
.seller-bar__label,
.ec-detail-panel > .row.no-gutters .text-secondary,
.ec-buy-form > .row.no-gutters .text-secondary,
.ec-share-row .text-secondary {
    width: auto !important;
    min-width: 112px;
    color: var(--ec-muted) !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    letter-spacing: 0;
}

.ec-brand-line a,
.seller-bar__name {
    color: var(--ec-text);
}

.seller-bar {
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.seller-bar__divider {
    display: none;
}

.ec-detail-panel .fs-16.fw-700,
.ec-detail-panel .h3.fw-600 {
    color: var(--ec-blue) !important;
    font-size: 28px !important;
    line-height: 1.15;
}

.ec-detail-panel del {
    color: #9aa7b2;
    font-size: 15px !important;
}

.ec-detail-panel .bg-danger.fs-11,
.ec-detail-panel .bg-secondary-base {
    border-radius: 999px;
}

.ec-buy-form {
    padding-top: 2px;
}

.ec-buy-form .aiz-megabox-elem {
    min-height: 40px;
    border: 1px solid var(--ec-border) !important;
    border-radius: 8px !important;
    background: #fff;
    color: var(--ec-text);
    font-weight: 700;
    transition: border-color .2s ease, background .2s ease, color .2s ease, box-shadow .2s ease;
}

.ec-buy-form .aiz-megabox input:checked + .aiz-megabox-elem {
    border-color: var(--ec-blue) !important;
    background: var(--ec-blue-soft);
    color: var(--ec-blue-dark);
    box-shadow: 0 0 0 3px rgba(60, 155, 211, 0.12);
}

.ec-buy-form .aiz-plus-minus {
    width: 142px !important;
    overflow: hidden;
    border: 1px solid var(--ec-border);
    border-radius: 10px;
    background: #fff;
}

.ec-buy-form .aiz-plus-minus .btn {
    height: 42px;
    border: 0;
    background: var(--ec-blue-soft) !important;
    color: var(--ec-blue-dark);
}

.ec-buy-form .input-number {
    height: 42px;
    color: var(--ec-text);
    font-weight: 800;
}

.ec-contact-card {
    margin-top: 16px;
    padding: 15px 16px;
    border: 1px solid var(--ec-border);
    border-radius: 14px;
    background: #f8fbfe;
}

.ec-contact-card__title {
    margin-bottom: 8px;
    color: var(--ec-text);
    font-size: 14px;
    font-weight: 800;
}

.ec-contact-card__phone {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 0;
}

.ec-contact-card__phone span {
    display: inline-flex;
    align-items: center;
    min-height: 34px;
    padding: 7px 12px;
    border-radius: 999px;
    background: #fff;
    color: var(--ec-blue-dark);
    font-size: 13px;
    font-weight: 700;
}

.ec-purchase-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.ec-purchase-actions .btn {
    min-height: 46px;
    border: 0;
    border-radius: 8px !important;
    padding: 12px 22px;
    box-shadow: 0 10px 22px rgba(23, 33, 43, 0.1);
}

.ec-btn-cart {
    background: var(--ec-blue) !important;
}

.ec-btn-cart:hover {
    background: var(--ec-blue-dark) !important;
}

.ec-btn-buy {
    background: #f3af3d !important;
    color: #2d1a00 !important;
}

.ec-btn-buy:hover {
    background: #e7a02d !important;
}

.ec-share-row {
    align-items: center;
    margin-top: 18px !important;
}

@media (max-width: 767.98px) {
    .ec-detail-panel {
        padding: 20px 16px;
        border-radius: 14px;
    }

    .ec-detail-title {
        font-size: 22px;
    }

    .ec-detail-actions-row .col,
    .ec-detail-actions-row [class*="col-"] {
        padding-right: 0;
    }

    .ec-brand-line .text-secondary,
    .seller-bar__label,
    .ec-detail-panel > .row.no-gutters .text-secondary,
    .ec-buy-form > .row.no-gutters .text-secondary,
    .ec-share-row .text-secondary {
        min-width: 100%;
        margin-bottom: 8px;
    }

    .ec-detail-panel .fs-16.fw-700,
    .ec-detail-panel .h3.fw-600 {
        font-size: 24px !important;
    }

    .ec-purchase-actions .btn {
        width: 100%;
        margin-right: 0 !important;
    }
}
</style>
<div class="text-left ec-detail-panel">

    <!-- Product Name -->

    <h2 class="fs20 fw-700 text-dark ec-detail-title">

        {{ $detailedProduct->getTranslation('name') }}

    </h2>



    <div class="row align-items-center mb-1 ec-detail-meta">

        <!-- Review -->

        @if ($detailedProduct->auction_product != 1)

            <div class="col-12">

                @php

                    $total = 0;

                    $total += $detailedProduct->reviews->count();

                @endphp

{{--                 <span class="rating rating-mr-1">
                    {{ renderStarRating($detailedProduct->rating) }}
                </span> --}}

{{--                 <span class="ml-1 opacity-50 fs-14">({{ $total }}
                    {{ translate('reviews') }})
                </span> --}}

            </div>

        @endif

        <!-- Estimate Shipping Time -->

        @if ($detailedProduct->est_shipping_days)

            <div class="col-auto fs-14 mt-1">

                <small class="mr-1 opacity-50 fs-14">{{ translate('Estimate Shipping Time') }}:</small>

                <span class="fw-500">{{ $detailedProduct->est_shipping_days }} {{ translate('Days') }}</span>

            </div>

        @endif

        <!-- In stock -->

        @if ($detailedProduct->digital == 1)

            <div class="col-12 mt-1">

                <span class="badge badge-md badge-inline badge-pill badge-success">{{ translate('In stock') }}</span>

            </div>

        @endif

    </div>

  <div class="row align-items-center ec-detail-actions-row">
 
    @if(get_setting('product_query_activation') == 1)
        <!-- Ask about this product -->
        <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 mb-3">
            <a href="javascript:void(0);" onclick="goToView('product_query')" class="btn-inquiry">
                <span class="btn-inquiry__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32" aria-hidden="true">
                        <circle cx="16" cy="16" r="14.5" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M13.5,12.5 C13.5,10.567 14.567,9.5 16,9.5 C17.433,9.5 18.5,10.567 18.5,12 C18.5,13.8 17,15 16.2,15.8 L16,16 C15.724,16.276 15.5,16.724 15.5,17.2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="16" cy="21.5" r="1.4" fill="currentColor"/>
                    </svg>
                </span>
                <span>{{ translate('Product Inquiry') }}</span>
            </a>
        </div>
    @endif
 
    <div class="col mb-2">
        @if ($detailedProduct->auction_product != 1)
            <div class="product-action-group">
                <!-- Add to wishlist button -->
                <a href="javascript:void(0)"
                   onclick="addToWishList({{ $detailedProduct->id }})"
                   class="btn-action"
                   aria-label="{{ translate('Add to Wishlist') }}">
                    <span class="btn-action__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                        </svg>
                    </span>
                    <span>{{ translate('Add to Wishlist') }}</span>
                </a>
 
                <div class="btn-action-divider" aria-hidden="true"></div>
 
                <!-- Add to compare button -->
                <a href="javascript:void(0)"
                   onclick="addToCompare({{ $detailedProduct->id }})"
                   class="btn-action"
                   aria-label="{{ translate('Add to Compare') }}">
                    <span class="btn-action__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="16 3 21 3 21 8"/>
                            <line x1="4" y1="20" x2="21" y2="3"/>
                            <polyline points="21 16 21 21 16 21"/>
                            <line x1="15" y1="15" x2="21" y2="21"/>
                        </svg>
                    </span>
                    <span>{{ translate('Add to Compare') }}</span>
                </a>
            </div>
        @endif
    </div>

</div>
    <!-- Brand Logo & Name -->

    @if ($detailedProduct->brand != null)

        <div class="d-flex flex-wrap align-items-center mb-2 ec-brand-line">

            <span class="text-secondary fs-14 fw-400 mr-4 w-50px">{{ translate('Brand') }}</span><br>

            <a href="{{ route('products.brand', $detailedProduct->brand->slug) }}"

                class="text-reset hov-text-primary fs-14 fw-700">{{ $detailedProduct->brand->name }}</a>

        </div>

    @endif

    <!-- Seller Info -->

    <div class="seller-bar">
 
    <div class="seller-bar__info">
 
        <!-- Shop Name -->
        @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
            <span class="seller-bar__label">{{ translate('Sold by') }}</span>
            <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
               class="seller-bar__name">
                <span class="seller-bar__avatar">
                    {{ strtoupper(substr($detailedProduct->user->shop->name, 0, 1)) }}
                </span>
                {{ $detailedProduct->user->shop->name }}
                <svg class="seller-bar__chevron" xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </a>
        @else
            <span class="seller-bar__label">{{ translate('Sold by') }}</span>
            <span class="seller-bar__name seller-bar__name--inhouse">
                <span class="seller-bar__avatar seller-bar__avatar--inhouse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </span>
                {{ translate('Inhouse Product') }}
            </span>
        @endif
 
    </div>
 
    <!-- Message Seller -->
    @if (get_setting('conversation_system') == 1)
        <button class="btn-message" onclick="show_chat_modal()" aria-label="{{ translate('Message Seller') }}">
            <span class="btn-message__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M2 2.5A1.5 1.5 0 0 1 3.5 1h9A1.5 1.5 0 0 1 14 2.5v7A1.5 1.5 0 0 1 12.5 11H9.6l-2.4 3v-3H3.5A1.5 1.5 0 0 1 2 9.5v-7Z" stroke="#f3af3d" stroke-width="1.2" stroke-linejoin="round"/>
                    <line x1="5" y1="5.5" x2="11" y2="5.5" stroke="#f3af3d" stroke-width="1.2" stroke-linecap="round"/>
                    <line x1="5" y1="8" x2="9" y2="8" stroke="#f3af3d" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
            </span>
            <span>{{ translate('Message Seller') }}</span>
        </button>
    @endif
 
</div>
 
<div class="seller-bar__divider" role="separator"></div>



    <!-- For auction product -->

    @if ($detailedProduct->auction_product)

        <div class="row no-gutters mb-3">

            <div class="col-sm-2">

                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Auction Will End') }}</div>

            </div>

            <div class="col-sm-10">

                @if ($detailedProduct->auction_end_date > strtotime('now'))

                    <div class="aiz-count-down align-items-center"

                        data-date="{{ date('Y/m/d H:i:s', $detailedProduct->auction_end_date) }}"></div>

                @else

                    <p>{{ translate('Ended') }}</p>

                @endif



            </div>

        </div>



        <div class="row no-gutters mb-3">

            <div class="col-sm-2">

                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Starting Bid') }}</div>

            </div>

            <div class="col-sm-10">

                <span class="opacity-50 fs-20">

                    {{ single_price($detailedProduct->starting_bid) }}

                </span>

                @if ($detailedProduct->unit != null)

                    <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>

                @endif

            </div>

        </div>



        @if (Auth::check() &&

                Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first() != null)

            <div class="row no-gutters mb-3">

                <div class="col-sm-2">

                    <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('My Bidded Amount') }}</div>

                </div>

                <div class="col-sm-10">

                    <span class="opacity-50 fs-20">

                        {{ single_price(Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first()->amount) }}

                    </span>

                </div>

            </div>

            <hr>

        @endif



        @php $highest_bid = $detailedProduct->bids->max('amount'); @endphp

        <div class="row no-gutters my-2 mb-3">

            <div class="col-sm-2">

                <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Highest Bid') }}</div>

            </div>

            <div class="col-sm-10">

                <strong class="h3 fw-600 text-primary">

                    @if ($highest_bid != null)

                        {{ single_price($highest_bid) }}

                    @endif

                </strong>

            </div>

        </div>

    @else

        <!-- Without auction product -->

        @if ($detailedProduct->wholesale_product == 1)

            <!-- Wholesale -->

            <table class="table mb-3">

                <thead>

                    <tr>

                        <th class="border-top-0">{{ translate('Min Qty') }}</th>

                        <th class="border-top-0">{{ translate('Max Qty') }}</th>

                        <th class="border-top-0">{{ translate('Unit Price') }}</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($detailedProduct->stocks->first()->wholesalePrices as $wholesalePrice)

                        <tr>

                            <td>{{ $wholesalePrice->min_qty }}</td>

                            <td>{{ $wholesalePrice->max_qty }}</td>

                            <td>{{ single_price($wholesalePrice->price) }}</td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <!-- Without Wholesale -->

            @if (home_price($detailedProduct) != home_discounted_price($detailedProduct))

                <div class="row no-gutters mb-3">

                    <div class="col-sm-2">

                        <div class="text-secondary fs-14 fw-400">{{ translate('Price') }}</div>

                    </div>

                    <div class="col-sm-10">

                        <div class="d-flex align-items-center">

                            <!-- Discount Price -->

                            <strong class="fs-16 fw-700 text-danger">

                                {{ home_discounted_price($detailedProduct) }}

                            </strong>

                            <!-- Home Price -->

                            <del class="fs-14 opacity-60 ml-2">

                                {{ home_price($detailedProduct) }}

                            </del>

                            <!-- Unit -->

                            @if ($detailedProduct->unit != null)

                                <span class="opacity-70 ml-1">/{{ $detailedProduct->getTranslation('unit') }}</span>

                            @endif

                            <!-- Discount percentage -->

                            @if (discount_in_percentage($detailedProduct) > 0)

                                <span class="bg-danger ml-2 fs-11 fw-700 text-white w-35px text-center p-1"

                                    style="padding-top:2px;padding-bottom:2px;">-{{ discount_in_percentage($detailedProduct) }}%</span>

                            @endif

                            <!-- Club Point -->

                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)

                                <div class="ml-2 bg-secondary-base d-flex justify-content-center align-items-center px-3 py-1"

                                    style="width: fit-content;">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"

                                        viewBox="0 0 12 12">

                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">

                                            <circle id="Ellipse_39" data-name="Ellipse 39" cx="6"

                                                cy="6" r="6" transform="translate(973 633)"

                                                fill="#fff" />

                                            <g id="Group_23920" data-name="Group 23920"

                                                transform="translate(973 633)">

                                                <path id="Path_28698" data-name="Path 28698"

                                                    d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"

                                                    fill="#f3af3d" />

                                                <path id="Path_28699" data-name="Path 28699"

                                                    d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"

                                                    fill="#f3af3d" opacity="0.5" />

                                                <path id="Path_28700" data-name="Path 28700"

                                                    d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"

                                                    fill="#f3af3d" />

                                            </g>

                                        </g>

                                    </svg>

                                    <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:

                                        {{ $detailedProduct->earn_point }}</small>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @else

                <div class="row no-gutters mb-3">

                    <div class="col-sm-2">

                        <div class="text-secondary fs-14 fw-400">{{ translate('Price') }}</div>

                    </div>

                    <div class="col-sm-10">

                        <div class="d-flex align-items-center">

                            <!-- Discount Price -->

                            <strong class="fs-16 fw-700 text-primary">

                                {{ home_discounted_price($detailedProduct) }}

                            </strong>

                            <!-- Unit -->

                            @if ($detailedProduct->unit != null)

                                <span class="opacity-70">/{{ $detailedProduct->getTranslation('unit') }}</span>

                            @endif

                            <!-- Club Point -->

                            @if (addon_is_activated('club_point') && $detailedProduct->earn_point > 0)

                                <div class="ml-2 bg-secondary-base d-flex justify-content-center align-items-center px-3 py-1"

                                    style="width: fit-content;">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"

                                        viewBox="0 0 12 12">

                                        <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">

                                            <circle id="Ellipse_39" data-name="Ellipse 39" cx="6"

                                                cy="6" r="6" transform="translate(973 633)"

                                                fill="#fff" />

                                            <g id="Group_23920" data-name="Group 23920"

                                                transform="translate(973 633)">

                                                <path id="Path_28698" data-name="Path 28698"

                                                    d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)"

                                                    fill="#f3af3d" />

                                                <path id="Path_28699" data-name="Path 28699"

                                                    d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)"

                                                    fill="#f3af3d" opacity="0.5" />

                                                <path id="Path_28700" data-name="Path 28700"

                                                    d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)"

                                                    fill="#f3af3d" />

                                            </g>

                                        </g>

                                    </svg>

                                    <small class="fs-11 fw-500 text-white ml-2">{{ translate('Club Point') }}:

                                        {{ $detailedProduct->earn_point }}</small>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endif

        @endif

    @endif



    @if ($detailedProduct->auction_product != 1)

        <form id="option-choice-form" class="ec-buy-form">

            @csrf

            <input type="hidden" name="id" value="{{ $detailedProduct->id }}">



            @if ($detailedProduct->digital == 0)

                <!-- Choice Options -->

                @if ($detailedProduct->choice_options != null)

                    @foreach (json_decode($detailedProduct->choice_options) as $key => $choice)

                        <div class="row no-gutters mb-3">

                            <div class="col-sm-2">

                                <div class="text-secondary fs-14 fw-400 mt-2 ">

                                    {{ get_single_attribute_name($choice->attribute_id) }}

                                </div>

                            </div>

                            <div class="col-sm-10">

                                <div class="aiz-radio-inline">

                                    @foreach ($choice->values as $key => $value)

                                        <label class="aiz-megabox pl-0 mr-2 mb-1">

                                            <input type="radio" name="attribute_id_{{ $choice->attribute_id }}"

                                                value="{{ $value }}"

                                                @if ($key == 0) checked @endif>

                                            <span

                                                class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center py-1 px-3">

                                                {{ $value }}

                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    @endforeach

                @endif



                <!-- Color Options -->

                @if ($detailedProduct->colors != null && count(json_decode($detailedProduct->colors)) > 0)

                    <div class="row no-gutters mb-3">

                        <div class="col-sm-2">

                            <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Color') }}</div>

                        </div>

                        <div class="col-sm-10">

                            <div class="aiz-radio-inline">

                                @foreach (json_decode($detailedProduct->colors) as $key => $color)

                                    <label class="aiz-megabox pl-0 mr-2 mb-0" data-toggle="tooltip"

                                        data-title="{{ get_single_color_name($color) }}">

                                        <input type="radio" name="color"

                                            value="{{ get_single_color_name($color) }}"

                                            @if ($key == 0) checked @endif>

                                        <span

                                            class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center p-1">

                                            <span class="size-25px d-inline-block rounded"

                                                style="background: {{ $color }};"></span>

                                        </span>

                                    </label>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif



                <!-- Quantity + Add to cart -->

                <div class="row no-gutters mb-2">

                    <div class="col-sm-2">

                        <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Quantity') }}</div>

                    </div>

                    <div class="col-sm-10">

                        <div class="product-quantity d-flex align-items-center">

                            <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">

                                <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button"

                                    data-type="minus" data-field="quantity" disabled="">

                                    <i class="las la-minus"></i>

                                </button>

                                <input type="number" name="quantity"

                                    class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1"

                                    value="{{ $detailedProduct->min_qty }}" min="{{ $detailedProduct->min_qty }}"

                                    max="10" lang="en">

                                <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button"

                                    data-type="plus" data-field="quantity">

                                    <i class="las la-plus"></i>

                                </button>

                            </div>

                            @php

                                $qty = 0;

                                foreach ($detailedProduct->stocks as $key => $stock) {

                                    $qty += $stock->qty;

                                }

                            @endphp

                            <div class="avialable-amount opacity-60">

                                @if ($detailedProduct->stock_visibility_state == 'quantity')

                                    (<span id="available-quantity">{{ $qty }}</span>

                                    {{ translate('available') }})

                                @elseif($detailedProduct->stock_visibility_state == 'text' && $qty >= 1)

                                    (<span id="available-quantity">{{ translate('In Stock') }}</span>)

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @else

                <!-- Quantity -->

                <input type="hidden" name="quantity" value="1">

            @endif



            <!-- Total Price -->

            <div class="row no-gutters pb-2 d-none" id="chosen_price_div">

                <div class="col-sm-2">

                    <div class="text-secondary fs-14 fw-400 mt-1">{{ translate('Total Price') }}</div>

                </div>

                <div class="col-sm-10">

                    <div class="product-price">

                        <strong id="chosen_price" class="fs-20 fw-700 text-danger">



                        </strong>

                    </div>

                </div>

            </div>
            <div class="ec-contact-card">
                <div class="ec-contact-card__title">{{ translate('Contact Information') }}</div>
                <p class="ec-contact-card__phone">
                    <span>(+855) 78 333 016</span>
                    <span>(+855) 70 333 013</span>
                </p>
            </div>


        </form>

    @endif



    @if ($detailedProduct->auction_product)

        @php

            $highest_bid = $detailedProduct->bids->max('amount');

            $min_bid_amount = $highest_bid != null ? $highest_bid + 1 : $detailedProduct->starting_bid;

        @endphp

        @if ($detailedProduct->auction_end_date >= strtotime('now'))

            <div class="mt-4 ec-purchase-actions">

                @if (Auth::check() && $detailedProduct->user_id == Auth::user()->id)

                    <span

                        class="badge badge-inline badge-danger">{{ translate('Seller cannot Place Bid to His Own Product') }}</span>

                @else

                    <button type="button" class="btn btn-primary buy-now fw-600 min-w-150px rounded-0 ec-btn-cart"

                        onclick="bid_modal()">

                        <i class="las la-gavel"></i>

                        @if (Auth::check() &&

                                Auth::user()->product_bids->where('product_id', $detailedProduct->id)->first() != null)

                            {{ translate('Change Bid') }}

                        @else

                            {{ translate('Place Bid') }}

                        @endif

                    </button>

                @endif

            </div>

        @endif

    @else

        <!-- Add to cart & Buy now Buttons -->

        <div class="mt-3 ec-purchase-actions">

            @if ($detailedProduct->digital == 0)

                @if ($detailedProduct->external_link != null)

                    <a type="button" class="btn btn-primary buy-now fw-600 add-to-cart px-4 rounded-0 ec-btn-cart"

                        href="{{ $detailedProduct->external_link }}">

                        <i class="la la-share"></i> {{ translate($detailedProduct->external_link_btn) }}

                    </a>

                @else

                    <button type="button"

                        class="btn bg-warning mr-2 add-to-cart fw-600 min-w-150px rounded-0 text-white ec-btn-cart"

                        @if (Auth::check()) onclick="addToCart()" @else onclick="showLoginModal()" @endif>

                        <i class="las la-shopping-bag"></i> {{ translate('Add to cart') }}

                    </button>

                    <button type="button" class="btn bg-danger text-white buy-now fw-600 add-to-cart min-w-150px rounded-0 ec-btn-buy"

                        @if (Auth::check()) onclick="buyNow()" @else onclick="showLoginModal()" @endif>

                        <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}

                    </button>

                @endif

                <button type="button" class="btn btn-secondary out-of-stock fw-600 d-none" disabled>

                    <i class="la la-cart-arrow-down"></i> {{ translate('Out of Stock') }}

                </button>

            @elseif ($detailedProduct->digital == 1)

                <button type="button"

                    class="btn btn-secondary-base mr-2 add-to-cart fw-600 min-w-150px rounded-0 text-white ec-btn-cart"

                    @if (Auth::check()) onclick="addToCart()" @else onclick="showLoginModal()" @endif>

                    <i class="las la-shopping-bag"></i> {{ translate('Add to cart') }}

                </button>

                <button type="button" class="btn btn-primary buy-now fw-600 add-to-cart min-w-150px rounded-0 ec-btn-buy"

                    @if (Auth::check()) onclick="buyNow()" @else onclick="showLoginModal()" @endif>

                    <i class="la la-shopping-cart"></i> {{ translate('Buy Now') }}

                </button>

            @endif

        </div>



        <!-- Promote Link -->

        <div class="d-table width-100 mt-3">

            <div class="d-table-cell">

                @if (Auth::check() &&

                        addon_is_activated('affiliate_system') &&

                        get_affliate_option_status() &&

                        Auth::user()->affiliate_user != null &&

                        Auth::user()->affiliate_user->status)

                    @php

                        if (Auth::check()) {

                            if (Auth::user()->referral_code == null) {

                                Auth::user()->referral_code = substr(Auth::user()->id . Str::random(10), 0, 10);

                                Auth::user()->save();

                            }

                            $referral_code = Auth::user()->referral_code;

                            $referral_code_url = URL::to('/product') . '/' . $detailedProduct->slug . "?product_referral_code=$referral_code";

                        }

                    @endphp

                    <div>

                        <button type="button" id="ref-cpurl-btn" class="btn btn-secondary w-200px rounded-0"

                            data-attrcpy="{{ translate('Copied') }}" onclick="CopyToClipboard(this)"

                            data-url="{{ $referral_code_url }}">{{ translate('Copy the Promote Link') }}</button>

                    </div>

                @endif

            </div>

        </div>

        <!-- Refund -->

        @php

            $refund_sticker = get_setting('refund_sticker');

        @endphp

        @if (addon_is_activated('refund_request'))

            <div class="row no-gutters mt-3">

                <div class="col-sm-2">

                    <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Refund') }}</div>

                </div>

                <div class="col-sm-10">

                    @if ($detailedProduct->refundable == 1)

                        <a href="{{ route('returnpolicy') }}" target="_blank">

                            @if ($refund_sticker != null)

                                <img src="{{ uploaded_asset($refund_sticker) }}" height="36">

                            @else

                                <img src="{{ static_asset('assets/img/refund-sticker.jpg') }}" height="36">

                            @endif

                        </a>

                        <a href="{{ route('returnpolicy') }}" class="text-blue hov-text-primary fs-14 ml-3"

                            target="_blank">{{ translate('View Policy') }}</a>

                    @else

                        <div class="text-dark fs-14 fw-400 mt-2">{{ translate('Not Applicable') }}</div>

                    @endif

                </div>

            </div>

        @endif



        <!-- Seller Guarantees -->

        @if ($detailedProduct->digital == 1)

            @if ($detailedProduct->added_by == 'seller')

                <div class="row no-gutters mt-3">

                    <div class="col-2">

                        <div class="text-secondary fs-14 fw-400">{{ translate('Seller Guarantees') }}</div>

                    </div>

                    <div class="col-10">

                        @if ($detailedProduct->user->shop->verification_status == 1)

                            <span class="text-success fs-14 fw-700">{{ translate('Verified seller') }}</span>

                        @else

                            <span class="text-danger fs-14 fw-700">{{ translate('Non verified seller') }}</span>

                        @endif

                    </div>

                </div>

            @endif

        @endif

    @endif



    <!-- Share -->

    <div class="row no-gutters mt-4 ec-share-row">

        <div class="col-sm-2">

            <div class="text-secondary fs-14 fw-400 mt-2">{{ translate('Share') }}</div>

        </div>

        <div class="col-sm-10">

            <div class="aiz-share"></div>

        </div>

    </div>

</div>

