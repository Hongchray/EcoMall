<style>
.ec-product-card {
    position: relative;
    height: 100%;
    padding: 16px 14px 14px;
    background: #f8fbfe;
    border: 1.5px solid #E3F3FB;
    border-radius: 14px;
    overflow: hidden;
    outline: 0;
    transition: box-shadow 0.25s ease, transform 0.25s ease, border-color 0.25s ease;
    margin-top: 20px;
}

.ec-product-card:hover {
    box-shadow: 0 10px 36px rgba(60, 155, 211, 0.18);
    transform: translateY(-4px);
    border-color: #3c9bd3;
}

.carousel-box.ec-product-card-host { border: 0 !important; }
.carousel-box.ec-product-card-host::before,
.carousel-box.ec-product-card-host::after { display: none !important; }

.ec-product-card__top {
    min-height: 30px;
    margin-bottom: 6px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}

.ec-product-card__badge {
    max-width: calc(100% - 40px);
    padding: 3px 10px;
    border-radius: 999px;
    border: 1px solid #E3F3FB;
    background: #3c9bd3;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: 0;
    text-transform: uppercase;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.ec-product-card__badge--wholesale {
    background: #455a64;
    border-color: #607d8b;
}

.ec-product-card__badge--discount {
    background: #3c9bd3;
    border-color: #E3F3FB;
}

.ec-product-card__wishlist {
    width: 32px;
    height: 32px;
    flex: 0 0 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #8193a3;
    border-radius: 50%;
    background: #fff;
    color: #425b6f;
    font-size: 20px;
    line-height: 1;
    text-decoration: none;
    transition: background-color .2s ease, border-color .2s ease, color .2s ease;
}

.ec-product-card__wishlist:hover,
.ec-product-card__wishlist:focus {
    background: #3c9bd3;
    border-color: #3c9bd3;
    color: #fff;
    text-decoration: none;
}

.ec-product-card__compare {
    width: 32px;
    height: 32px;
    flex: 0 0 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #8193a3;
    border-radius: 50%;
    background: #fff;
    color: #425b6f;
    line-height: 1;
    text-decoration: none;
    transition: background-color .2s ease, border-color .2s ease, color .2s ease;
}

.ec-product-card__compare:hover,
.ec-product-card__compare:focus {
    background: #3c9bd3;
    border-color: #3c9bd3;
    color: #fff;
    text-decoration: none;
}

.ec-product-card__icons {
    display: flex;
    gap: 6px;
}

.ec-product-card__image-wrap {
    width: 72%;
    max-width: 126px;
    aspect-ratio: 1 / 1;
    margin: 0 auto 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    text-decoration: none;
    border-radius: 10px;
    overflow: hidden;
}

.ec-product-card__image {
    width: 100%;
    height: 100%;
    padding: 8px;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.ec-product-card:hover .ec-product-card__image {
    transform: scale(1.08);
}

.ec-product-card__content {
    margin: 0 -14px -14px;
    padding: 16px 14px 14px;
    background: #ffffff;
    border-top: 1px solid #E3F3FB;
    border-radius: 0 0 12px 12px;
}

.ec-product-card__name {
    min-height: 38px;
    margin: 0 4px 5px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    color: #111;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.35;
    text-decoration: none;
    text-align: center;
}

.ec-product-card__name:hover,
.ec-product-card__name:focus {
    color: #227eb8;
    text-decoration: none;
}

.ec-product-card__price-row {
    min-height: 20px;
    margin: 0 4px 16px;
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 6px;
    line-height: 1.2;
}

.ec-product-card__price-original {
    color: #999;
    font-size: 12px;
    font-weight: 400;
    text-decoration: line-through;
}

.ec-product-card__price {
    color: #2d9add;
    font-size: 14px;
    font-weight: 700;
}

.ec-product-card__action {
    width: 100%;
    min-height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    border: 0;
    border-radius: 5px;
    background: #F0F8FD;
    color: #3D98D1;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.2;
    text-align: center;
    text-decoration: none;
    transition: background-color .2s ease, color .2s ease;
    cursor: pointer;
}

.ec-product-card__action:hover,
.ec-product-card__action:focus {
    background: #3D98D1;
    color: #fff;
    text-decoration: none;
}

.ec-product-card__action i {
    font-size: 20px;
    line-height: 1;
}

@media (max-width: 575.98px) {
    .ec-product-card { padding: 14px 12px 12px; }
    .ec-product-card__image-wrap { width: 76%; margin-bottom: 14px; }
    .ec-product-card__content { margin: 0 -12px -12px; padding: 14px 12px 12px; }
    .ec-product-card__action { min-height: 38px; font-size: 12px; }
}
</style>

@php
    $cart_added = [];
    $product_url = route('product', $product->slug);
    if ($product->auction_product == 1) {
        $product_url = route('auction-product', $product->slug);
    }
@endphp

@once
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.carousel-box > .ec-product-card').forEach(function (card) {
                card.parentElement.classList.add('ec-product-card-host');
            });
        });
    </script>
@endonce

<div class="ec-product-card">

    {{-- Top row: badge(s) + action icons --}}
    <div class="ec-product-card__top">
        <div>
            {{-- Discount badge --}}
            @if (discount_in_percentage($product) > 0)
                <span class="ec-product-card__badge ec-product-card__badge--discount">
                    -{{ discount_in_percentage($product) }}%
                </span>
            @endif
            {{-- Wholesale badge --}}
            @if ($product->wholesale_product)
                <span class="ec-product-card__badge ec-product-card__badge--wholesale">
                    {{ translate('Wholesale') }}
                </span>
            @endif
        </div>

        {{-- Wishlist & Compare icons (non-auction only) --}}
        @if ($product->auction_product == 0)
            <div class="ec-product-card__icons">
                <a href="javascript:void(0)" class="ec-product-card__wishlist"
                    onclick="addToWishList({{ $product->id }})"
                    data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left"
                    aria-label="{{ translate('Add to wishlist') }}">
                    <i class="las la-heart"></i>
                </a>
                <a href="javascript:void(0)" class="ec-product-card__compare"
                    onclick="addToCompare({{ $product->id }})"
                    data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left"
                    aria-label="{{ translate('Add to compare') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 16 16">
                        <path d="M18.037,5.547v.8a.8.8,0,0,1-.8.8H7.221a.4.4,0,0,0-.4.4V9.216a.642.642,0,0,1-1.1.454L2.456,6.4a.643.643,0,0,1,0-.909L5.723,2.227a.642.642,0,0,1,1.1.454V4.342a.4.4,0,0,0,.4.4H17.234a.8.8,0,0,1,.8.8Zm-3.685,4.86a.642.642,0,0,0-1.1.454v1.661a.4.4,0,0,1-.4.4H2.84a.8.8,0,0,0-.8.8v.8a.8.8,0,0,0,.8.8H12.854a.4.4,0,0,1,.4.4V17.4a.642.642,0,0,0,1.1.454l3.267-3.268a.643.643,0,0,0,0-.909Z"
                            transform="translate(-2.037 -2.038)" fill="currentColor"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>

    {{-- Product image --}}
    <a href="{{ $product_url }}" class="ec-product-card__image-wrap" title="{{ $product->getTranslation('name') }}">
        <img class="lazyload ec-product-card__image"
            src="{{ $product->photos ?? get_image($product->thumbnail_img) }}"
            alt="{{ $product->getTranslation('name') }}"
            title="{{ $product->getTranslation('name') }}"
            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
    </a>

    {{-- Bottom content panel --}}
    <div class="ec-product-card__content">

        {{-- Product name --}}
        <a href="{{ $product_url }}" class="ec-product-card__name"
            title="{{ $product->getTranslation('name') }}">
            {{ $product->getTranslation('name') }}
        </a>

        {{-- Price row --}}
        <div class="ec-product-card__price-row">
            @if ($product->auction_product == 0)
                @if (home_base_price($product) != home_discounted_base_price($product))
                    <del class="ec-product-card__price-original">{{ home_base_price($product) }}</del>
                @endif
                <span class="ec-product-card__price">{{ home_discounted_base_price($product) }}</span>
            @else
                <span class="ec-product-card__price">{{ single_price($product->starting_bid) }}</span>
            @endif
        </div>

        {{-- CTA button --}}
        @if ($product->auction_product == 0)
            @php
                $carts = get_user_cart();
                if (count($carts) > 0) {
                    $cart_added = $carts->pluck('product_id')->toArray();
                }
            @endphp
            <a class="ec-product-card__action @if (in_array($product->id, $cart_added)) active @endif"
                href="javascript:void(0)"
                onclick="showAddToCartModal({{ $product->id }})">
                <i class="las la-shopping-cart"></i>
                <span>{{ translate('Add to Cart') }}</span>
            </a>

        @elseif (
            $product->auction_product == 1 &&
            $product->auction_start_date <= strtotime('now') &&
            $product->auction_end_date >= strtotime('now'))
            @php
                $carts = get_user_cart();
                if (count($carts) > 0) {
                    $cart_added = $carts->pluck('product_id')->toArray();
                }
                $highest_bid = $product->bids->max('amount');
                $min_bid_amount = $highest_bid != null ? $highest_bid + 1 : $product->starting_bid;
            @endphp
            <a class="ec-product-card__action @if (in_array($product->id, $cart_added)) active @endif"
                href="javascript:void(0)"
                onclick="bid_single_modal({{ $product->id }}, {{ $min_bid_amount }})">
                <i class="las la-gavel"></i>
                <span>{{ translate('Place Bid') }}</span>
            </a>
        @endif

    </div>
</div>
