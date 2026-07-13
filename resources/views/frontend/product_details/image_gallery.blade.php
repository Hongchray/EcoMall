<style>
    .ec-gallery-panel {
        position: sticky;
        top: 20px;
        z-index: 3;
        padding: 8px;
        border: 1px solid #dceef8;
        border-radius: 14px;
        background:
            linear-gradient(145deg, rgba(60, 155, 211, 0.1), rgba(255, 255, 255, 0) 38%),
            #ffffff;
        box-shadow: 0 16px 46px rgba(34, 126, 184, 0.1);
    }

    .ec-gallery-main {
        position: relative;
        overflow: hidden;
        border: 1px solid #e4f2fa;
        border-radius: 12px;
        background: #f8fbfe;
    }

    .ec-gallery-main::before {
        content: "";
        position: absolute;
        inset: 12px;
        border-radius: 14px;
        border: 1px solid rgba(60, 155, 211, 0.08);
        pointer-events: none;
        z-index: 1;
    }

    .ec-gallery-main .carousel-box {
        display: flex !important;
        align-items: center;
        justify-content: center;
        padding: 10px;
        background: #ffffff;
    }

    .ec-gallery-main img {
        width: 100% !important;
        height: 260px !important;
        object-fit: contain;
        filter: drop-shadow(0 6px 12px rgba(23, 33, 43, 0.08));
        transition: transform .28s ease, filter .28s ease;
    }

    .ec-gallery-main .carousel-box:hover img {
        transform: scale(1.035);
        filter: drop-shadow(0 22px 30px rgba(23, 33, 43, 0.16));
    }

    .ec-gallery-main .slick-arrow {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #ffffff !important;
        border: 1px solid #dceef8;
        box-shadow: 0 8px 18px rgba(34, 126, 184, 0.16);
    }

    .ec-gallery-thumbs {
        margin-top: 14px;
        padding: 10px 4px;
    }

    .ec-gallery-thumbs .carousel-box {
        padding: 3px;
    }

    .ec-gallery-thumbs img {
        width: 66px !important;
        height: 66px !important;
        padding: 7px !important;
        border: 1px solid #dceef8 !important;
        border-radius: 12px;
        background: #ffffff;
        object-fit: contain;
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    .ec-gallery-thumbs .slick-current img,
    .ec-gallery-thumbs img:hover {
        border-color: #3c9bd3 !important;
        box-shadow: 0 8px 18px rgba(60, 155, 211, 0.2);
        transform: translateY(-2px);
    }

    @media (max-width: 991.98px) {
        .ec-gallery-panel {
            position: relative;
            top: auto;
        }
    }

    @media (max-width: 575.98px) {
        .ec-gallery-panel {
            padding: 14px;
            border-radius: 14px;
        }

        .ec-gallery-main {
            border-radius: 12px;
        }

        .ec-gallery-main .carousel-box {
            min-height: 310px;
            padding: 20px;
        }

        .ec-gallery-main img {
            max-height: 280px;
        }
    }
</style>

<div class="ec-gallery-panel">
    @php
        $photos = [];
        $thumbnail_image = null;
    @endphp
    @if ($detailedProduct->photos != null)
        @php
            $photos = array_filter(explode(',', $detailedProduct->photos));
        @endphp
    @endif
    @if ($detailedProduct->thumbnail_img != null)
        @php
            $thumbnail_image = filter_var($detailedProduct->thumbnail_img, FILTER_VALIDATE_URL)
                ? $detailedProduct->thumbnail_img
                : uploaded_asset($detailedProduct->thumbnail_img);
        @endphp
    @endif
    <!-- Gallery Images -->
    <div class="col-12">
        <div class="aiz-carousel product-gallery arrow-inactive-transparent arrow-lg-none ec-gallery-main"
            data-nav-for='.product-gallery-thumb' data-fade='true' data-arrows='true'>
            @if ($thumbnail_image != null)
                <div class="carousel-box img-zoom rounded-0">
                    <img class="img-fluid h-auto lazyload mx-auto"
                        alt="{{ $detailedProduct->getTranslation('name') }}"
                        src="{{ $thumbnail_image }}" data-src="{{ $thumbnail_image }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
            @endif

            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $key => $stock)
                    @if ($stock->image != null)
                        @php
                            $stock_image = filter_var($stock->image, FILTER_VALIDATE_URL)
                                ? $stock->image
                                : uploaded_asset($stock->image);
                        @endphp
                        <div class="carousel-box img-zoom rounded-0">
                            <img class="img-fluid h-auto lazyload mx-auto"
                                alt="{{ $detailedProduct->getTranslation('name') }}"
                                src="{{ $stock_image }}"
                                data-src="{{ $stock_image }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                    @endif
                @endforeach
            @endif

            @foreach ($photos as $key => $photo)
                @php
                    $photo_image = filter_var($photo, FILTER_VALIDATE_URL)
                        ? $photo
                        : uploaded_asset($photo);
                @endphp
                <div class="carousel-box img-zoom rounded-0">
                    <img class="img-fluid h-auto lazyload mx-auto"
                        alt="{{ $detailedProduct->getTranslation('name') }}"
                        src="{{ $photo_image }}" data-src="{{ $photo_image }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
            @endforeach


        </div>
    </div>
    <!-- Thumbnail Images -->
    <div class="col-12 mt-3 d-none d-lg-block">
        <div class="aiz-carousel half-outside-arrow product-gallery-thumb ec-gallery-thumbs" data-items='7' data-nav-for='.product-gallery'
            data-focus-select='true' data-arrows='true' data-vertical='false' data-auto-height='true'>
            @if ($thumbnail_image != null)
                <div class="carousel-box c-pointer rounded-0">
                    <img class="lazyload mw-100 size-60px mx-auto border p-1"
                        alt="{{ $detailedProduct->getTranslation('name') }}"
                        src="{{ $thumbnail_image }}" data-src="{{ $thumbnail_image }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
            @endif

            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $key => $stock)
                    @if ($stock->image != null)
                        @php
                            $stock_thumb = filter_var($stock->image, FILTER_VALIDATE_URL)
                                ? $stock->image
                                : uploaded_asset($stock->image);
                        @endphp
                        <div class="carousel-box c-pointer rounded-0" data-variation="{{ $stock->variant }}">
                            <img class="lazyload mw-100 size-60px mx-auto border p-1"
                                alt="{{ $detailedProduct->getTranslation('name') }}"
                                src="{{ $stock_thumb }}"
                                data-src="{{ $stock_thumb }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                    @endif
                @endforeach
            @endif

            @foreach ($photos as $key => $photo)
                @php
                    $photo_thumb = filter_var($photo, FILTER_VALIDATE_URL)
                        ? $photo
                        : uploaded_asset($photo);
                @endphp
                <div class="carousel-box c-pointer rounded-0">
                    <img class="lazyload mw-100 size-60px mx-auto border p-1"
                        alt="{{ $detailedProduct->getTranslation('name') }}"
                        src="{{ $photo_thumb }}" data-src="{{ $photo_thumb }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
            @endforeach


        </div>
    </div>


</div>
