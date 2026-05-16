<style>
    .ecm-cart-page {
        color: #111827;
    }

    .ecm-cart-shell {
        background: #fff;
        border: 1px solid #e3edf7;
        border-radius: 8px;
        box-shadow: 0 18px 45px rgba(31, 41, 55, 0.08);
        overflow: hidden;
    }

    .ecm-cart-heading {
        align-items: center;
        background: linear-gradient(135deg, #f8fbfe, #eef7fd);
        border-bottom: 1px solid #e3edf7;
        display: flex;
        justify-content: space-between;
        padding: 22px 26px;
    }

    .ecm-cart-heading h2 {
        font-size: 22px;
        font-weight: 800;
        margin: 0;
    }

    .ecm-cart-badge {
        background: #e7f4fb;
        border-radius: 999px;
        color: #2e94d0;
        font-size: 12px;
        font-weight: 800;
        padding: 7px 12px;
    }

    .ecm-cart-table-head {
        color: #8b94a3;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .06em;
        padding: 18px 26px;
        text-transform: uppercase;
    }

    .ecm-cart-list {
        padding: 0 26px;
    }

    .ecm-cart-row {
        border-color: #edf2f7 !important;
        padding: 22px 0;
    }

    .ecm-cart-thumb {
        align-items: center;
        background: #f3f7fb;
        border: 1px solid #e6edf5;
        border-radius: 8px;
        display: inline-flex;
        flex: 0 0 78px;
        height: 78px;
        justify-content: center;
        overflow: hidden;
        width: 78px;
        
    }

    .ecm-cart-thumb img {
        height: 100%;
        object-fit: contain;
        padding: 8px;
        width: 100%;
    }

    .ecm-cart-name {
        color: #111827;
        display: block;
        font-size: 14px;
        font-weight: 700;
        line-height: 1.45;
        min-width: 0;
        overflow-wrap: anywhere;
        word-break: break-word;
    }

    .ecm-cart-mobile-label {
        color: #8b94a3;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .05em;
        text-transform: uppercase;
    }

    .ecm-cart-qty.aiz-plus-minus {
        align-items: center !important;
        background: #f8fbfe;
        border: 1px solid #e3edf7;
        border-radius: 999px;
        flex-direction: row !important;
        height: 38px;
        padding: 3px;
        width: 116px;
    }

    .ecm-cart-qty .btn {
        background: #fff;
        border: 0;
        box-shadow: 0 4px 12px rgba(31, 41, 55, 0.08);
        color: #2e94d0;
        height: 30px;
        min-width: 30px;
        width: 30px;
    }

    .ecm-cart-qty .input-number {
        background: transparent;
        color: #111827;
        font-weight: 800;
        height: 30px;
        min-width: 36px;
        padding: 0 !important;
        text-align: center !important;
    }

    .ecm-cart-price {
        color: #111827;
        font-size: 14px;
        font-weight: 800;
    }

    .ecm-cart-total-price {
        color: #2e94d0;
        font-size: 16px;
        font-weight: 900;
    }

    .ecm-cart-remove {
        align-items: center;
        background: #e7f4fb;
        border-radius: 999px;
        color: #2e94d0;
        display: inline-flex;
        height: 38px;
        justify-content: center;
        transition: background-color .2s ease, color .2s ease;
        width: 38px;
    }

    .ecm-cart-remove:hover,
    .ecm-cart-remove:focus {
        background: #227eb8;
        color: #fff;
        text-decoration: none;
    }

    .ecm-cart-footer {
        background: #f8fbfe;
        border-top: 1px solid #e3edf7;
        padding: 22px 26px 24px;
    }

    .ecm-cart-subtotal {
        align-items: center;
        border-bottom: 1px solid #e3edf7;
        display: flex;
        justify-content: space-between;
        margin-bottom: 22px;
        padding-bottom: 18px;
    }

    .ecm-cart-subtotal span {
        color: #7d8592;
        font-size: 14px;
        font-weight: 700;
    }

    .ecm-cart-subtotal strong {
        color: #111827;
        font-size: 22px;
        font-weight: 900;
    }

    .ecm-cart-return {
        color: #2e94d0;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
    }

    .ecm-cart-return:hover,
    .ecm-cart-return:focus {
        color: #227eb8;
        text-decoration: none;
    }

    .ecm-cart-checkout {
        background: #2e94d0;
        border: 0;
        border-radius: 6px;
        box-shadow: 0 12px 24px rgba(46, 148, 208, 0.22);
        color: #fff;
        font-size: 14px;
        font-weight: 800;
        min-height: 46px;
        padding: 12px 24px;
    }

    .ecm-cart-checkout:hover,
    .ecm-cart-checkout:focus {
        background: #227eb8;
        color: #fff;
    }

    .ecm-cart-empty {
        background: #fff;
        border: 1px solid #e3edf7;
        border-radius: 8px;
        box-shadow: 0 18px 45px rgba(31, 41, 55, 0.08);
        padding: 56px 24px;
        text-align: center;
    }

    .ecm-cart-empty-icon {
        align-items: center;
        background: #e7f4fb;
        border-radius: 999px;
        color: #2e94d0;
        display: inline-flex;
        font-size: 44px;
        height: 92px;
        justify-content: center;
        margin-bottom: 18px;
        width: 92px;
    }

    @media (max-width: 767.98px) {
        .ecm-cart-page {
            max-width: 430px;
            padding-left: 16px;
            padding-right: 16px;
        }

        .ecm-cart-page > .row {
            margin-left: 0;
            margin-right: 0;
        }

        .ecm-cart-page > .row > [class*="col-"] {
            padding-left: 0;
            padding-right: 0;
        }

        .ecm-cart-heading,
        .ecm-cart-table-head,
        .ecm-cart-list,
        .ecm-cart-footer {
            padding-left: 14px;
            padding-right: 14px;
        }

        .ecm-cart-shell {
            border-radius: 10px;
            box-shadow: 0 10px 26px rgba(15, 23, 42, 0.07);
        }

        .ecm-cart-heading {
            padding-bottom: 18px;
            padding-top: 18px;
        }

        .ecm-cart-heading h2 {
            font-size: 20px;
        }

        .ecm-cart-row {
            background: #fff;
            border: 1px solid #e3edf7 !important;
            border-radius: 10px;
            box-shadow: 0 8px 18px rgba(15, 23, 42, 0.04);
            margin: 0 auto 14px;
            max-width: 100%;
            padding: 16px !important;
            position: relative;
        }

        .ecm-cart-row > .row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            column-gap: 16px;
            margin-left: 0;
            margin-right: 0;
            row-gap: 15px;
        }

        .ecm-cart-row > .row > [class*="col-"] {
            max-width: none;
            padding-left: 0;
            padding-right: 0;
            width: auto;
        }

        .ecm-cart-product-cell {
            grid-column: 1 / -1;
            min-width: 0;
            padding-right: 46px !important;
        }

        .ecm-cart-thumb {
            flex: 0 0 74px;
            height: 74px;
            margin-right: 14px !important;
            width: 74px;
        }

        .ecm-cart-name {
            flex: 1 1 auto;
            font-size: 15px;
            line-height: 1.35;
        }

        .ecm-cart-qty-cell,
        .ecm-cart-price-cell,
        .ecm-cart-tax-cell,
        .ecm-cart-total-cell,
        .ecm-cart-remove-cell {
            margin-top: 0 !important;
        }

        .ecm-cart-total-cell {
            align-self: center;
        }

        .ecm-cart-remove-cell {
            margin-top: 0 !important;
            position: absolute;
            right: 14px;
            text-align: right !important;
            top: 14px;
        }

        .ecm-cart-qty.aiz-plus-minus {
            height: 38px;
            width: 112px;
        }

        .ecm-cart-remove {
            border: 1px solid #d7edf8;
            box-shadow: 0 6px 14px rgba(46, 148, 208, 0.12);
            height: 34px;
            width: 34px;
        }

        .ecm-cart-subtotal {
            background: #fff;
            border: 1px solid #e3edf7;
            border-radius: 8px;
            margin-bottom: 18px;
            padding: 16px;
        }

        .ecm-cart-footer {
            padding-bottom: 82px;
        }

        .ecm-cart-checkout {
            border-radius: 8px;
            width: 100%;
        }
    }
</style>

<div class="container ecm-cart-page">
    @if( $carts && count($carts) > 0 )
        <div class="row">
            <div class="col-xxl-8 col-xl-10 mx-auto">
                <div class="ecm-cart-shell text-left">
                    <div class="ecm-cart-heading">
                        <h2>{{ translate('My Cart') }}</h2>
                        <span class="ecm-cart-badge">{{ count($carts) }} {{ translate('Items') }}</span>
                    </div>

                    <div class="row gutters-5 d-none d-lg-flex ecm-cart-table-head">
                        <div class="col-md-2">{{ translate('Qty')}}</div>
                        <div class="col-md-5">{{ translate('Product')}}</div>
                        <div class="col">{{ translate('Price')}}</div>
                        <div class="col">{{ translate('Tax')}}</div>
                        <div class="col">{{ translate('Total')}}</div>
                        <div class="col-auto">{{ translate('Remove')}}</div>
                    </div>

                    <ul class="list-group list-group-flush ecm-cart-list">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($carts as $key => $cartItem)
                            @php
                                $product = get_single_product($cartItem['product_id']);
                                $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                                $total = $total + cart_product_price($cartItem, $product, false) * $cartItem['quantity'];
                                $product_name_with_choice = $product->getTranslation('name');
                                if ($cartItem['variation'] != null) {
                                    $product_name_with_choice = $product->getTranslation('name').' - '.$cartItem['variation'];
                                }
                                $cart_product_image = filter_var($product->thumbnail_img, FILTER_VALIDATE_URL)
                                    ? $product->thumbnail_img
                                    : uploaded_asset($product->thumbnail_img);
                                $cart_placeholder_image = static_asset('assets/img/placeholder.jpg');
                            @endphp
                            <li class="list-group-item ecm-cart-row px-0">
                                <div class="row gutters-10 align-items-center">
                                    <div class="col-md-2 col-5 order-2 order-md-0 mt-3 mt-md-0 ecm-cart-qty-cell">
                                        <span class="ecm-cart-mobile-label d-block d-md-none mb-1">{{ translate('Qty')}}</span>
                                        @if ($cartItem['digital'] != 1 && $product->auction_product == 0)
                                            <div class="d-flex ecm-cart-qty aiz-plus-minus mr-2 ml-0">
                                                <button class="btn col-auto btn-icon btn-sm btn-circle" type="button" data-type="minus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                    <i class="las la-minus"></i>
                                                </button>
                                                <input type="number" name="quantity[{{ $cartItem['id'] }}]" class="col border-0 flex-grow-1 fs-14 input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="{{ $product->min_qty }}" max="{{ $product_stock->qty }}" onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                                <button class="btn col-auto btn-icon btn-sm btn-circle" type="button" data-type="plus" data-field="quantity[{{ $cartItem['id'] }}]">
                                                    <i class="las la-plus"></i>
                                                </button>
                                            </div>
                                        @elseif($product->auction_product == 1)
                                            <span class="fw-700 fs-14">1</span>
                                        @endif
                                    </div>

                                    <div class="col-md-5 col-12 d-flex align-items-center order-1 order-md-0 ecm-cart-product-cell">
                                        <span class="ecm-cart-thumb mr-3">
                                            <img src="{{ $cart_placeholder_image }}"
                                                data-src="{{ $cart_product_image ?: $cart_placeholder_image }}"
                                                class="img-fit lazyload"
                                                alt="{{ $product->getTranslation('name')  }}"
                                                title="{{ $product->getTranslation('name')  }}"
                                                onerror="this.onerror=null;this.src='{{ $cart_placeholder_image }}';">
                                        </span>
                                        <span class="ecm-cart-name">{{ $product_name_with_choice }}</span>
                                    </div>

                                    <div class="col-md col-4 order-3 order-md-0 mt-3 mt-md-0 ecm-cart-price-cell">
                                        <span class="ecm-cart-mobile-label d-block d-md-none mb-1">{{ translate('Price')}}</span>
                                        <span class="ecm-cart-price">{{ cart_product_price($cartItem, $product, true, false) }}</span>
                                    </div>

                                    <div class="col-md col-4 order-4 order-md-0 mt-3 mt-md-0 ecm-cart-tax-cell">
                                        <span class="ecm-cart-mobile-label d-block d-md-none mb-1">{{ translate('Tax')}}</span>
                                        <span class="ecm-cart-price">{{ cart_product_tax($cartItem, $product) }}</span>
                                    </div>

                                    <div class="col-md col-4 order-5 order-md-0 mt-3 mt-md-0 ecm-cart-total-cell">
                                        <span class="ecm-cart-mobile-label d-block d-md-none mb-1">{{ translate('Total')}}</span>
                                        <span class="ecm-cart-total-price">{{ single_price(cart_product_price($cartItem, $product, false) * $cartItem['quantity']) }}</span>
                                    </div>

                                    <div class="col-md-auto col-7 order-6 order-md-0 text-right mt-3 mt-md-0 ecm-cart-remove-cell">
                                        <a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $cartItem['id'] }})" class="ecm-cart-remove" aria-label="{{ translate('Remove')}}">
                                            <i class="las la-trash fs-16"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="ecm-cart-footer">
                        <div class="ecm-cart-subtotal">
                            <span>{{translate('Subtotal')}}</span>
                            <strong>{{ single_price($total) }}</strong>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-6 text-center text-md-left order-1 order-md-0 mt-3 mt-md-0">
                                <a href="{{ route('home') }}" class="ecm-cart-return">
                                    <i class="las la-arrow-left fs-16"></i>
                                    {{ translate('Return to shop')}}
                                </a>
                            </div>
                            <div class="col-md-6 text-center text-md-right">
                                @if(Auth::check())
                                    <a href="{{ route('checkout.shipping_info') }}" class="btn ecm-cart-checkout">
                                        {{ translate('Continue to Shipping')}}
                                    </a>
                                @else
                                    <button class="btn ecm-cart-checkout" onclick="showLoginModal()">{{ translate('Continue to Shipping')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="ecm-cart-empty">
                    <span class="ecm-cart-empty-icon">
                        <i class="las la-shopping-cart"></i>
                    </span>
                    <h3 class="h4 fw-800 mb-2">{{translate('Your Cart is empty')}}</h3>
                    <a href="{{ route('home') }}" class="btn ecm-cart-checkout mt-3">{{ translate('Return to shop')}}</a>
                </div>
            </div>
        </div>
    @endif
</div>

<script type="text/javascript">
    AIZ.extra.plusMinus();
</script>
