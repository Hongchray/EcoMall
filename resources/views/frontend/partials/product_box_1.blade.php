<style>
.ec-product-card {
    position: relative;
    height: 100%;
    padding: 16px 14px 14px;
    background: #f8fbfe;
    border: 1.5px solid #E3F3FB; /* default light border */
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
    gap: 4px;
    line-height: 1.2;
  }

  .ec-product-card__price {
    color: #2d9add;
    font-size: 14px;
    font-weight: 700;
  }

  .ec-product-card__unit {
    color: #222;
    font-size: 11px;
    font-weight: 400;
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

  .bg{
    background-color: #111;
    width: 304px;
    height: 34px;
  }
</style>

@php
    $product_url = route('product', $product->slug);
    if ($product->auction_product == 1) {
        $product_url = route('auction-product', $product->slug);
    }

    $product_name = $product->getTranslation('name');
    $product_image = $product->thumbnail != null
        ? my_asset($product->thumbnail->file_name)
        : static_asset('assets/img/placeholder.jpg');
    $placeholder_image = static_asset('assets/img/placeholder.jpg');
    $discount_percentage = discount_in_percentage($product);
    $cart_onclick = auth()->check()
        ? 'showAddToCartModal(' . $product->id . ')'
        : 'showLoginModal()';
    $wishlist_onclick = 'addToWishList(' . $product->id . ')';
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
        <div class="ec-product-card__top">
            <span class="ec-product-card__badge">
                @if ($discount_percentage > 0)
                    -{{ $discount_percentage }}%
                @elseif ($product->wholesale_product)
                    {{ translate('Wholesale') }}
                @else
                    {{ translate('Popular') }}
                @endif
            </span>

            @if ($product->auction_product == 0)
                <a href="javascript:void(0)" class="ec-product-card__wishlist"
                    onclick="{{ $wishlist_onclick }}"
                    data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left"
                    aria-label="{{ translate('Add to wishlist') }}">
                    <i class="las la-heart"></i>
                </a>
            @endif
        </div>


    <a href="{{ $product_url }}" class="ec-product-card__image-wrap" title="{{ $product_name }}">
        <img class="lazyload ec-product-card__image"
            src="{{ $product_image }}"
            alt="{{ $product_name }}" title="{{ $product_name }}"
            data-fallback-image="{{ $placeholder_image }}"
            onerror="this.onerror=null;this.src=this.dataset.fallbackImage;">
    </a>

    <div class="ec-product-card__content">
        <a href="{{ $product_url }}" class="ec-product-card__name" title="{{ $product_name }}">
            {{ $product_name }}
        </a>

        <div class="ec-product-card__price-row">
            @if ($product->auction_product == 0)
                <span class="ec-product-card__price">{{ home_discounted_base_price($product) }}</span>
                <span class="ec-product-card__unit">/ {{ translate('pc') }}</span>
            @else
                <span class="ec-product-card__price">{{ single_price($product->starting_bid) }}</span>
            @endif
        </div>

        @if ($product->auction_product == 0)
            <a class="ec-product-card__action" href="javascript:void(0)"
                onclick="{{ $cart_onclick }}">
                   <img src="{{ asset('icons/cartBeforehover.png') }}" alt="Add to Cart"  class="w-20px" >
                <span>{{ translate('Add to Cart') }}</span>
            </a>
        @elseif ($product->auction_start_date <= strtotime('now') && $product->auction_end_date >= strtotime('now'))
            @php
                $highest_bid = $product->bids->max('amount');
                $min_bid_amount = $highest_bid != null ? $highest_bid + 1 : $product->starting_bid;
                $bid_onclick = 'bid_single_modal(' . $product->id . ', ' . $min_bid_amount . ')';
            @endphp
            <a class="ec-product-card__action" href="javascript:void(0)" onclick="{{ $bid_onclick }}">
                <i class="las la-gavel"></i>
                <span>{{ translate('Place Bid') }}</span>
            </a>
        @else
            <a class="ec-product-card__action" href="{{ $product_url }}">
                <span>{{ translate('View Details') }}</span>
            </a>
        @endif
    </div>
</div>
