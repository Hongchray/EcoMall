<style>
    #addToCart .modal-dialog {
        max-width: 940px;
    }

    #addToCart .modal-content {
        overflow: hidden;
        border: 0;
        border-radius: 18px;
        box-shadow: 0 26px 70px rgba(15, 34, 48, 0.28);
    }

    #addToCart .close {
        top: 18px !important;
        right: 18px !important;
        width: 38px !important;
        height: 38px !important;
        margin: 0 !important;
        background: #eef3f7 !important;
        color: #50616f;
        opacity: 1;
        transition: background-color .2s ease, color .2s ease, transform .2s ease;
    }

    #addToCart .close:hover,
    #addToCart .close:focus {
        background: #3c9bd3 !important;
        color: #fff;
        transform: rotate(90deg);
    }

    .ec-cart-modal {
        padding: 24px;
        background: #ffffff;
    }

    .ec-cart-modal__grid {
        align-items: stretch;
    }

    .ec-cart-gallery {
        height: 100%;
        padding: 16px;
        border: 1px solid #dceef8;
        border-radius: 16px;
        background:
            linear-gradient(145deg, rgba(60, 155, 211, 0.1), rgba(255, 255, 255, 0) 40%),
            #f8fbfe;
    }

    .ec-cart-gallery__main {
        overflow: hidden;
        border: 1px solid #e4f2fa;
        border-radius: 14px;
        background: #ffffff;
    }

    .ec-cart-gallery__main .carousel-box {
        min-height: 360px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        padding: 24px;
        background: radial-gradient(circle at 50% 45%, #fff 0, #fff 40%, #f8fbfe 100%);
    }

    .ec-cart-gallery__main img {
        max-height: 320px;
        width: auto;
        object-fit: contain;
        filter: drop-shadow(0 16px 22px rgba(23, 33, 43, 0.12));
    }

    .ec-cart-gallery__thumbs {
        padding-right: 10px;
    }

    .ec-cart-gallery__thumbs .carousel-box {
        margin-bottom: 8px;
        overflow: hidden;
        border: 1px solid #dceef8 !important;
        border-radius: 10px !important;
        background: #ffffff;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .ec-cart-gallery__thumbs .slick-current,
    .ec-cart-gallery__thumbs .carousel-box:hover {
        border-color: #3c9bd3 !important;
        box-shadow: 0 8px 18px rgba(60, 155, 211, 0.18);
    }

    .ec-cart-gallery__thumbs img {
        width: 64px !important;
        height: 64px !important;
        padding: 7px;
        object-fit: contain;
    }

    .ec-cart-info {
        height: 100%;
        padding: 20px;
        border: 1px solid #dceef8;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 14px 34px rgba(34, 126, 184, 0.08);
    }

    .ec-cart-info__title {
        margin: 0;
        color: #17212b !important;
        font-size: 22px !important;
        font-weight: 800 !important;
        line-height: 1.3;
    }

    .ec-cart-row {
        padding: 14px 0;
        margin-top: 0 !important;
        border-top: 1px solid #edf5f9;
    }

    .ec-cart-row:first-of-type {
        margin-top: 16px !important;
    }

    .ec-cart-label {
        color: #6f7d89 !important;
        font-size: 12px !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: 0;
    }

    .ec-cart-price {
        color: #3c9bd3 !important;
        font-size: 24px !important;
        font-weight: 800 !important;
        line-height: 1.15;
    }

    .ec-cart-old-price {
        color: #9aa7b2;
        font-size: 14px !important;
    }

    .ec-cart-discount {
        display: inline-flex;
        align-items: center;
        min-height: 24px;
        border-radius: 999px;
        background: #3c9bd3 !important;
    }

    .ec-cart-club {
        border-radius: 999px;
        background: #f3af3d !important;
    }

    .ec-cart-form .aiz-megabox-elem {
        min-height: 40px;
        border: 1px solid #dceef8 !important;
        border-radius: 8px !important;
        background: #fff;
        color: #17212b;
        font-weight: 700;
        transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
    }

    .ec-cart-form .aiz-megabox input:checked + .aiz-megabox-elem {
        border-color: #3c9bd3 !important;
        background: #eef8fd;
        color: #217fb8;
        box-shadow: 0 0 0 3px rgba(60, 155, 211, 0.12);
    }

    .ec-cart-form .aiz-plus-minus {
        width: 142px !important;
        overflow: hidden;
        border: 1px solid #dceef8;
        border-radius: 10px;
        background: #fff;
    }

    .ec-cart-form .aiz-plus-minus .btn {
        height: 42px;
        border: 0;
        background: #eef8fd !important;
        color: #217fb8;
    }

    .ec-cart-form .input-number {
        height: 42px;
        color: #17212b;
        font-weight: 800;
    }

    .ec-cart-action {
        margin-top: 18px !important;
        padding-top: 16px;
        border-top: 1px solid #edf5f9;
    }

    .ec-cart-action .btn {
        min-height: 48px;
        border: 0;
        border-radius: 8px !important;
        padding: 12px 24px;
        background: #3c9bd3 !important;
        color: #fff !important;
        font-weight: 800;
        box-shadow: 0 10px 22px rgba(60, 155, 211, 0.24);
    }

    .ec-cart-action .btn:hover {
        background: #217fb8 !important;
    }

    .ec-cart-action .btn-secondary {
        background: #7f8b95 !important;
    }

    @media (max-width: 991.98px) {
        .ec-cart-info {
            margin-top: 18px;
        }
    }

    @media (max-width: 575.98px) {
        #addToCart .modal-dialog {
            margin: 10px;
        }

        #addToCart .modal-content {
            max-height: calc(100vh - 20px);
            border-radius: 14px;
        }

        #addToCart .close {
            top: 12px !important;
            right: 12px !important;
            width: 34px !important;
            height: 34px !important;
            z-index: 5;
        }

        .ec-cart-modal {
            max-height: calc(100vh - 20px);
            overflow-y: auto;
            padding: 12px;
        }

        .ec-cart-gallery {
            display: block;
            height: auto;
            padding: 10px;
            border-radius: 14px;
        }

        .ec-cart-gallery > .col,
        .ec-cart-gallery > .col-auto {
            width: 100%;
            max-width: 100%;
            padding-right: 5px;
            padding-left: 5px;
        }

        .ec-cart-gallery__main .carousel-box {
            min-height: 220px;
            padding: 14px;
        }

        .ec-cart-gallery__main img {
            max-width: 100%;
            max-height: 190px;
        }

        .ec-cart-gallery__thumbs {
            display: none !important;
        }

        .ec-cart-info {
            margin-top: 14px;
            padding: 14px;
            border-radius: 14px;
        }

        .ec-cart-info__title {
            font-size: 18px !important;
        }

        .ec-cart-price {
            font-size: 21px !important;
        }

        .ec-cart-row {
            padding: 12px 0;
        }

        .ec-cart-row .col-3,
        .ec-cart-row .col-9 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .ec-cart-label {
            margin-bottom: 8px;
        }

        .ec-cart-action .btn {
            width: 100%;
        }
    }
</style>

<div class="modal-body ec-cart-modal c-scrollbar-light">
    <div class="row ec-cart-modal__grid">
        <!-- Product Image gallery -->
        <div class="col-lg-6">
            <div class="ec-cart-gallery row gutters-10 flex-row-reverse">
                @php
                    $photos = array_filter(explode(',', $product->photos ?? ''));

                    if (count($photos) == 0 && $product->thumbnail_img != null) {
                        $photos = [$product->thumbnail_img];
                    }

                    $product_image_url = function ($image) {
                        return filter_var($image, FILTER_VALIDATE_URL)
                            ? $image
                            : uploaded_asset($image);
                    };
                @endphp
                <div class="col">
                    <div class="aiz-carousel product-gallery ec-cart-gallery__main" data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true'>
                        @foreach ($photos as $key => $photo)
                        <div class="carousel-box img-zoom rounded-0">
                            <img class="img-fluid lazyload"

                                src="{{ static_asset('assets/img/placeholder.jpg') }}"

                                data-src="{{ $product_image_url($photo) }}"
                                alt="{{ $product->getTranslation('name') }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                        @endforeach
                        @foreach ($product->stocks as $key => $stock)
                            @if ($stock->image != null)
                                <div class="carousel-box img-zoom rounded-0">
                                    <img class="img-fluid lazyload"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ $product_image_url($stock->image) }}"
                                        alt="{{ $product->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-auto w-90px">
                    <div class="aiz-carousel carousel-thumb product-gallery-thumb ec-cart-gallery__thumbs" data-items='5' data-nav-for='.product-gallery' data-vertical='true' data-focus-select='true'>
                        @foreach ($photos as $key => $photo)
                        <div class="carousel-box c-pointer border rounded-0">
                            <img class="lazyload mw-100 size-60px mx-auto"
                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ $product_image_url($photo) }}"
                                alt="{{ $product->getTranslation('name') }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                        @endforeach
                        @foreach ($product->stocks as $key => $stock)
                            @if ($stock->image != null)
                                <div class="carousel-box c-pointer border rounded-0" data-variation="{{ $stock->variant }}">
                                    <img class="lazyload mw-100 size-50px mx-auto"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ $product_image_url($stock->image) }}"
                                        alt="{{ $product->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6">
            <div class="ec-cart-info text-left">
                <!-- Product name -->
                <h2 class="ec-cart-info__title mb-2 fs-16 fw-700 text-dark">
                    {{  $product->getTranslation('name')  }}
                </h2>

                <!-- Product Price & Club Point -->
                @if(home_price($product) != home_discounted_price($product))
                    <div class="ec-cart-row row no-gutters mt-3">
                        <div class="col-3">
                            <div class="ec-cart-label text-secondary fs-14 fw-400">{{ translate('Price')}}</div>
                        </div>
                        <div class="col-9">
                            <div class="">
                                <strong class="ec-cart-price fs-16 fw-700 text-primary">
                                    {{ home_discounted_price($product) }}
                                </strong>
                                <del class="ec-cart-old-price fs-14 opacity-60 ml-2">
                                    {{ home_price($product) }}
                                </del>
                                @if($product->unit != null)
                                    <span class="opacity-70 ml-1">/{{ $product->getTranslation('unit') }}</span>
                                @endif
                                @if(discount_in_percentage($product) > 0)
                                    <span class="ec-cart-discount bg-primary ml-2 fs-11 fw-700 text-white text-center px-2" style="padding-top:2px;padding-bottom:2px;">-{{discount_in_percentage($product)}}%</span>
                                @endif
                            </div>

                            <!-- Club Point -->
                            @if (addon_is_activated('club_point') && $product->earn_point > 0)
                            <div class="ec-cart-club mt-2 bg-warning d-flex justify-content-center align-items-center px-3 py-1" style="width: fit-content;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                    <g id="Group_23922" data-name="Group 23922" transform="translate(-973 -633)">
                                      <circle id="Ellipse_39" data-name="Ellipse 39" cx="6" cy="6" r="6" transform="translate(973 633)" fill="#fff"/>
                                      <g id="Group_23920" data-name="Group 23920" transform="translate(973 633)">
                                        <path id="Path_28698" data-name="Path 28698" d="M7.667,3H4.333L3,5,6,9,9,5Z" transform="translate(0 0)" fill="#f3af3d"/>
                                        <path id="Path_28699" data-name="Path 28699" d="M5.33,3h-1L3,5,6,9,4.331,5Z" transform="translate(0 0)" fill="#f3af3d" opacity="0.5"/>
                                        <path id="Path_28700" data-name="Path 28700" d="M12.666,3h1L15,5,12,9l1.664-4Z" transform="translate(-5.995 0)" fill="#f3af3d"/>
                                      </g>
                                    </g>
                                </svg>
                                <small class="fs-11 fw-500 text-white ml-2">{{  translate('Club Point') }}: {{ $product->earn_point }}</small>
                            </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="ec-cart-row row no-gutters mt-3">
                        <div class="col-3">
                            <div class="ec-cart-label text-secondary fs-14 fw-400">{{ translate('Price')}}</div>
                        </div>
                        <div class="col-9">
                            <div class="">
                                <strong class="ec-cart-price fs-16 fw-700 text-primary">
                                    {{ home_discounted_price($product) }}
                                </strong>
                                @if ($product->unit != null)
                                    <span class="opacity-70">/{{ $product->unit }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @php
                    $qty = 0;
                    foreach ($product->stocks as $key => $stock) {
                        $qty += $stock->qty;
                    }
                    $is_out_of_stock = $product->digital != 1 && $qty < $product->min_qty;
                @endphp

                <!-- Product Choice options form -->
                <form id="option-choice-form" class="ec-cart-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    @if($product->digital !=1)
                        @php
                            $choice_options = json_decode($product->choice_options ?? '[]') ?: [];
                        @endphp
                        <!-- Product Choice options -->
                        @if (count($choice_options) > 0)
                            @foreach ($choice_options as $key => $choice)

                                <div class="ec-cart-row row no-gutters mt-3">
                                    <div class="col-3">
                                        <div class="ec-cart-label text-secondary fs-14 fw-400 mt-2 ">{{ $choice->attribute_id ? translate(get_single_attribute_name($choice->attribute_id)) : translate('Option') }}</div>
                                    </div>
                                    <div class="col-9">
                                        <div class="aiz-radio-inline">
                                            @foreach ($choice->values as $key => $value)
                                            <label class="aiz-megabox pl-0 mr-2 mb-0">
                                                <input
                                                    type="radio"
                                                    name="attribute_id_{{ $choice->attribute_id ?? $key }}"
                                                    value="{{ $value }}"
                                                    @if($key == 0) checked @endif
                                                >
                                                <span class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center py-1 px-3">
                                                    {{ $value }}
                                                </span>
                                            </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        @endif

                        <!-- Color -->
                        @if ($product->colors && count(json_decode($product->colors)) > 0)
                            <div class="ec-cart-row row no-gutters mt-3">
                                <div class="col-3">
                                    <div class="ec-cart-label text-secondary fs-14 fw-400 mt-2">{{ translate('Color')}}</div>
                                </div>
                                <div class="col-9">
                                    <div class="aiz-radio-inline">
                                        @foreach (json_decode($product->colors) as $key => $color)
                                        <label class="aiz-megabox pl-0 mr-2 mb-0" data-toggle="tooltip" data-title="{{ get_single_color_name($color) }}">
                                            <input
                                                type="radio"
                                                name="color"
                                                value="{{ get_single_color_name($color) }}"
                                                @if($key == 0) checked @endif
                                            >
                                            <span class="aiz-megabox-elem rounded-0 d-flex align-items-center justify-content-center p-1">
                                                <span class="size-25px d-inline-block rounded" style="background: {{ $color }};"></span>
                                            </span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Quantity -->
                        <div class="ec-cart-row row no-gutters mt-3">
                            <div class="col-3">
                                <div class="ec-cart-label text-secondary fs-14 fw-400 mt-2">{{ translate('Quantity')}}</div>
                            </div>
                            <div class="col-9">
                                <div class="product-quantity d-flex align-items-center">
                                    <div class="row no-gutters align-items-center aiz-plus-minus mr-3" style="width: 130px;">
                                        <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button" data-type="minus" data-field="quantity" disabled="">
                                            <i class="las la-minus"></i>
                                        </button>
                                        <input type="number" name="quantity" class="col border-0 text-center flex-grow-1 fs-16 input-number" placeholder="1" value="{{ min($product->min_qty, max($qty, 1)) }}" min="{{ $product->min_qty }}" max="{{ max($qty, 1) }}" lang="en" @if($is_out_of_stock) readonly @endif>
                                        <button class="btn col-auto btn-icon btn-sm btn-light rounded-0" type="button" data-type="plus" data-field="quantity">
                                            <i class="las la-plus"></i>
                                        </button>
                                    </div>
                                    <div class="avialable-amount opacity-60">
                                        @if($product->stock_visibility_state == 'quantity')
                                        (<span id="available-quantity">{{ $qty }}</span> {{ translate('available')}})
                                        @elseif($product->stock_visibility_state == 'text' && $qty >= 1)
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
                    <div class="ec-cart-row row no-gutters mt-3 pb-3 d-none" id="chosen_price_div">
                        <div class="col-3">
                            <div class="ec-cart-label text-secondary fs-14 fw-400 mt-1">{{ translate('Total Price')}}</div>
                        </div>
                        <div class="col-9">
                            <div class="product-price">
                                <strong id="chosen_price" class="fs-20 fw-700 text-primary">

                                </strong>
                            </div>
                        </div>
                    </div>

                </form>

                <!-- Add to cart -->
                <div class="ec-cart-action mt-3">
                    @if ($product->digital == 1)
                        <button type="button" class="btn btn-primary rounded-0 buy-now fw-600 add-to-cart" onclick="addToCart()">
                            <i class="la la-shopping-cart"></i>
                            <span class="d-none d-md-inline-block">{{ translate('Add to cart')}}</span>
                        </button>
                    @elseif($qty > 0)
                        @if ($product->external_link != null)
                            <a type="button" class="btn btn-soft-primary rounded-0 mr-2 add-to-cart fw-600" href="{{ $product->external_link }}">
                                <i class="las la-share"></i>
                                <span class="d-none d-md-inline-block">{{ translate($product->external_link_btn)}}</span>
                            </a>
                        @else
                            <button type="button" class="btn btn-primary rounded-0 buy-now fw-600 add-to-cart" onclick="addToCart()">
                                <i class="la la-shopping-cart"></i>
                                <span class="d-none d-md-inline-block">{{ translate('Add to cart')}}</span>
                            </button>
                        @endif
                    @endif
                    <button type="button" class="btn btn-secondary rounded-0 out-of-stock fw-600 d-none" disabled>
                        <i class="la la-cart-arrow-down"></i>{{ translate('Out of Stock')}}
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#option-choice-form input').on('change', function () {
        getVariantPrice();
    });
</script>
