@extends('frontend.layouts.app')



@section('meta_title'){{ $detailedProduct->meta_title }}@stop



@section('meta_description'){{ $detailedProduct->meta_description }}@stop



@section('meta_keywords'){{ $detailedProduct->tags }}@stop



@section('meta')

    @php

        $availability = "out of stock";

        $qty = 0;

        if($detailedProduct->variant_product) {

            foreach ($detailedProduct->stocks as $key => $stock) {

                $qty += $stock->qty;

            }

        }

        else {

            $qty = optional($detailedProduct->stocks->first())->qty;

        }

        if($qty > 0){

            $availability = "in stock";

        }

    @endphp

    <!-- Schema.org markup for Google+ -->

    <meta itemprop="name" content="{{ $detailedProduct->meta_title }}">

    <meta itemprop="description" content="{{ $detailedProduct->meta_description }}">

    <meta itemprop="image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">



    <!-- Twitter Card data -->

    <meta name="twitter:card" content="product">

    <meta name="twitter:site" content="@publisher_handle">

    <meta name="twitter:title" content="{{ $detailedProduct->meta_title }}">

    <meta name="twitter:description" content="{{ $detailedProduct->meta_description }}">

    <meta name="twitter:creator" content="@author_handle">

    <meta name="twitter:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}">

    <meta name="twitter:data1" content="{{ single_price($detailedProduct->unit_price) }}">

    <meta name="twitter:label1" content="Price">



    <!-- Open Graph data -->

    <meta property="og:title" content="{{ $detailedProduct->meta_title }}" />

    <meta property="og:type" content="og:product" />

    <meta property="og:url" content="{{ route('product', $detailedProduct->slug) }}" />

    <meta property="og:image" content="{{ uploaded_asset($detailedProduct->meta_img) }}" />

    <meta property="og:description" content="{{ $detailedProduct->meta_description }}" />

    <meta property="og:site_name" content="{{ get_setting('meta_title') }}" />

    <meta property="og:price:amount" content="{{ single_price($detailedProduct->unit_price) }}" />

    <meta property="product:brand" content="{{ $detailedProduct->brand ? $detailedProduct->brand->name : env('APP_NAME') }}">

    <meta property="product:availability" content="{{ $availability }}">

    <meta property="product:condition" content="new">

    <meta property="product:price:amount" content="{{ number_format($detailedProduct->unit_price, 2) }}">

    <meta property="product:retailer_item_id" content="{{ $detailedProduct->slug }}">

    <meta property="product:price:currency"

        content="{{ get_system_default_currency()->code }}" />

    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">

@endsection



@section('content')

<style>
    /* ── Taobao-style 2-column layout ── */
    .pd-wrap {
        display: grid;
        grid-template-columns: 480px 1fr;
        grid-template-areas:
            "gallery right"
            "tabs    right";
        gap: 14px;
        align-items: start;
        padding-bottom: 40px;
    }

    .pd-gallery-block { grid-area: gallery; min-width: 0; }
    .pd-tabs-block { grid-area: tabs; min-width: 0; }

    /* RIGHT — sticky: follows scroll but never goes below its column */
    .pd-right {
        grid-area: right;
        position: sticky;
        top: 120px;        /* clears the fixed header + nav (~110px) */
        align-self: start; /* essential: don't stretch to left-col height */
        min-width: 0;
    }

    /* Shop / seller bar at top of left */
    .pd-shopbar {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        margin-bottom: 14px;
        background: #fff;
        border: 1px solid #dceef8;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(34,126,184,.07);
    }
    .pd-shopbar__ico {
        width: 40px; height: 40px; flex: 0 0 40px;
        border-radius: 8px;
        background: linear-gradient(120deg,#3c9bd3,#5bb8ef);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 700; font-size: 15px;
    }
    .pd-shopbar__name { font-weight: 700; font-size: 14px; color: #17212b; }
    .pd-shopbar__sub  { font-size: 12px; color: #7b8494; margin-top: 2px; }
    .pd-shopbar__btns { margin-left: auto; display: flex; gap: 8px; }
    .pd-shopbar__btn  {
        border: 1px solid #dceef8; border-radius: 20px;
        padding: 6px 16px; font-size: 12px; font-weight: 600;
        color: #3c9bd3; background: #fff; cursor: pointer; white-space: nowrap;
        transition: background .2s, border-color .2s, color .2s;
    }
    .pd-shopbar__btn:hover { background: #eef8fd; border-color: #3c9bd3; }

    /* Tab nav (sticky inside left col) */
    .pd-tabnav {
        position: sticky;
        top: 0;
        z-index: 20;
        display: flex;
        background: #fff;
        border: 1px solid #dceef8;
        border-radius: 12px 12px 0 0;
        border-bottom: none;
        overflow-x: auto;
    }
    .pd-tab {
        padding: 13px 20px;
        font-size: 14px; font-weight: 600;
        color: #6f7d89; cursor: pointer;
        border-bottom: 2px solid transparent;
        white-space: nowrap;
        transition: color .2s, border-color .2s;
    }
    .pd-tab.active, .pd-tab:hover { color: #3c9bd3; border-bottom-color: #3c9bd3; }

    /* Panel that holds all tab content */
    .pd-panel {
        background: #fff;
        border: 1px solid #dceef8;
        border-top: none;
        border-radius: 0 0 12px 12px;
        padding: 0 24px 24px;
    }
    .pd-pane {
        padding: 24px 0;
        border-top: 1px solid #edf5f9;
        scroll-margin-top: 56px;
    }
    .pd-pane:first-child { border-top: none; }

    .pd-sec-h {
        font-size: 15px; font-weight: 700;
        padding-left: 10px;
        border-left: 3px solid #3c9bd3;
        margin-bottom: 18px;
        color: #17212b;
    }

    /* Detail images stacked (Taobao 图文详情 style) */
    .pd-dstack { display: flex; flex-direction: column; align-items: center; }
    .pd-dimg   { width: 100%; }
    .pd-dimg img { width: 100%; display: block; }

    /* Recommendation grids */
    .pd-rec-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
    }

    @media (max-width: 1199px) {
        .pd-wrap { grid-template-columns: 1fr 360px; }
    }
    @media (max-width: 991px) {
        .pd-wrap {
            grid-template-columns: 1fr;
            grid-template-areas:
                "gallery"
                "right"
                "tabs";
        }
        .pd-right { position: static; }
        .pd-rec-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 575px) {
        .pd-rec-grid { grid-template-columns: repeat(2, 1fr); }
        .pd-shopbar { flex-wrap: wrap; }
        .pd-shopbar__btns { margin-left: 0; }
        .pd-tab { padding: 11px 14px; font-size: 13px; }
    }
</style>

    <section class="pt-3 pb-2">
        <div class="container">

            @if ($detailedProduct->auction_product)

                {{-- ── Auction layout: simple stacked ── --}}
                <div class="bg-white rounded p-3 mb-4">
                    <div class="row">
                        <div class="col-lg-5 mb-4">
                            @include('frontend.product_details.image_gallery')
                        </div>
                        <div class="col-lg-7">
                            @include('frontend.product_details.details')
                        </div>
                    </div>
                </div>
                @include('frontend.product_details.review_section')
                @include('frontend.product_details.description')
                @include('frontend.product_details.product_queries')

            @else

                {{-- ── Taobao 2-column layout ── --}}
                <div class="pd-wrap">

                    {{-- Seller / Shop bar + Gallery --}}
                    <div class="pd-gallery-block">
                        @if ($detailedProduct->added_by == 'seller' && $detailedProduct->user->shop != null && get_setting('vendor_system_activation') == 1)
                            <div class="pd-shopbar">
                                <div class="pd-shopbar__ico">
                                    {{ strtoupper(substr($detailedProduct->user->shop->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="pd-shopbar__name">{{ $detailedProduct->user->shop->name }}</div>
                                    <div class="pd-shopbar__sub">
                                        <span class="text-warning">{{ renderStarRating($detailedProduct->user->shop->rating) }}</span>
                                        &nbsp;{{ $detailedProduct->user->shop->num_of_reviews }} {{ translate('reviews') }}
                                    </div>
                                </div>
                                <div class="pd-shopbar__btns">
                                    <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="pd-shopbar__btn">
                                        🏬 {{ translate('Visit Store') }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            @include('frontend.product_details.image_gallery')
                        </div>
                    </div>

                    {{-- RIGHT: sticky details + buy panel --}}
                    <div class="pd-right">
                        @include('frontend.product_details.details')

                        {{-- Seller info card (desktop only, inside sticky right) --}}
                        <div class="d-none d-lg-block mt-3">
                            @include('frontend.product_details.seller_info')
                            @include('frontend.product_details.top_selling_products')
                        </div>
                    </div>

                    {{-- Tab nav + scrollable panel --}}
                    <div class="pd-tabs-block">
                        <div class="pd-tabnav" id="pd-tabnav">
                            <div class="pd-tab active" onclick="scrollToPdPane('pd-reviews')">{{ translate('Reviews') }}</div>
                            <div class="pd-tab" onclick="scrollToPdPane('pd-description')">{{ translate('Description') }}</div>
                            @if ($detailedProduct->imageDetails->count() > 0)
                                <div class="pd-tab" onclick="scrollToPdPane('pd-detail-images')">{{ translate('Product Details') }}</div>
                            @endif
                        </div>

                        <div class="pd-panel">

                            {{-- Reviews --}}
                            <div class="pd-pane" id="pd-reviews">
                                @include('frontend.product_details.review_section')
                            </div>

                            {{-- Description --}}
                            <div class="pd-pane" id="pd-description">
                                @include('frontend.product_details.description')
                            </div>

                            {{-- Detail images (图文详情) --}}
                            @if ($detailedProduct->imageDetails->count() > 0)
                                <div class="pd-pane" id="pd-detail-images">
                                    <div class="pd-sec-h">{{ translate('Product Details') }}</div>
                                    <div class="pd-dstack">
                                        @foreach ($detailedProduct->imageDetails as $detail)
                                            <div class="pd-dimg">
                                                <img src="{{ uploaded_asset($detail->upload_id) }}"
                                                    alt="{{ $detailedProduct->getTranslation('name') }}"
                                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Product Query --}}
                            <div class="pd-pane">
                                @include('frontend.product_details.product_queries')
                            </div>

                        </div>
                    </div>

                </div>{{-- /.pd-wrap --}}

                {{-- Related products — separate full-width section, not sticky, not nested in tabs --}}
                <div class="mt-4" id="pd-related">
                    @include('frontend.product_details.related_products')
                </div>

                {{-- Top Selling Products — mobile only, shown after Related products --}}
                <div class="mt-4 d-lg-none">
                    @include('frontend.product_details.top_selling_products')
                </div>

            @endif

        </div>
    </section>

<script>
    function scrollToPdPane(id) {
        var el = document.getElementById(id);
        if (!el) return;
        var navH = document.getElementById('pd-tabnav') ? document.getElementById('pd-tabnav').offsetHeight : 0;
        var top = el.getBoundingClientRect().top + window.pageYOffset - navH - 10;
        window.scrollTo({ top: top, behavior: 'smooth' });

        // update active tab
        document.querySelectorAll('.pd-tab').forEach(function(t) { t.classList.remove('active'); });
        event.currentTarget.classList.add('active');
    }
</script>

@endsection



@section('modal')

    <!-- Image Modal -->

    <div class="modal fade" id="image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">

            <div class="modal-content position-relative">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="p-4">

                    <div class="size-300px size-lg-450px">

                        <img class="img-fit h-100 lazyload"

                            src="{{ static_asset('assets/img/placeholder.jpg') }}"

                            data-src=""

                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- Chat Modal -->

    <div class="modal fade" id="chat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">

            <div class="modal-content position-relative">

                <div class="modal-header">

                    <h5 class="modal-title fw-600 h5">{{ translate('Any query about this product') }}</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <form class="" action="{{ route('conversations.store') }}" method="POST"

                    enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">

                    <div class="modal-body gry-bg px-3 pt-3">

                        <div class="form-group">

                            <input type="text" class="form-control mb-3 rounded-0" name="title"

                                value="{{ $detailedProduct->name }}" placeholder="{{ translate('Product Name') }}"

                                required>

                        </div>

                        <div class="form-group">

                            <textarea class="form-control rounded-0" rows="8" name="message" required

                                placeholder="{{ translate('Your Question') }}">{{ route('product', $detailedProduct->slug) }}</textarea>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-outline-primary fw-600 rounded-0"

                            data-dismiss="modal">{{ translate('Cancel') }}</button>

                        <button type="submit" class="btn btn-primary fw-600 rounded-0 w-100px">{{ translate('Send') }}</button>

                    </div>

                </form>

            </div>

        </div>

    </div>



    <!-- Bid Modal -->

    @if($detailedProduct->auction_product == 1)

        @php

            $highest_bid = $detailedProduct->bids->max('amount');

            $min_bid_amount = $highest_bid != null ? $highest_bid+1 : $detailedProduct->starting_bid;

        @endphp

        <div class="modal fade" id="bid_for_detail_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">{{ translate('Bid For Product') }} <small>({{ translate('Min Bid Amount: ').$min_bid_amount }})</small> </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        </button>

                    </div>

                    <div class="modal-body">

                        <form class="form-horizontal" action="{{ route('auction_product_bids.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" name="product_id" value="{{ $detailedProduct->id }}">

                            <div class="form-group">

                                <label class="form-label">

                                    {{translate('Place Bid Price')}}

                                    <span class="text-danger">*</span>

                                </label>

                                <div class="form-group">

                                    <input type="number" step="0.01" class="form-control form-control-sm" name="amount" min="{{ $min_bid_amount }}" placeholder="{{ translate('Enter Amount') }}" required>

                                </div>

                            </div>

                            <div class="form-group text-right">

                                <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ translate('Submit') }}</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    @endif



    <!-- Product Review Modal -->

    <div class="modal fade" id="product-review-modal">

        <div class="modal-dialog modal-dialog-centered ec-review-modal-dialog">

            <div class="modal-content" id="product-review-modal-content">



            </div>

        </div>

    </div>

@endsection



@section('script')

    <script type="text/javascript">

        $(document).ready(function() {

            getVariantPrice();

        });



        function CopyToClipboard(e) {

            var url = $(e).data('url');

            var $temp = $("<input>");

            $("body").append($temp);

            $temp.val(url).select();

            try {

                document.execCommand("copy");

                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');

            } catch (err) {

                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');

            }

            $temp.remove();

            // if (document.selection) {

            //     var range = document.body.createTextRange();

            //     range.moveToElementText(document.getElementById(containerid));

            //     range.select().createTextRange();

            //     document.execCommand("Copy");



            // } else if (window.getSelection) {

            //     var range = document.createRange();

            //     document.getElementById(containerid).style.display = "block";

            //     range.selectNode(document.getElementById(containerid));

            //     window.getSelection().addRange(range);

            //     document.execCommand("Copy");

            //     document.getElementById(containerid).style.display = "none";



            // }

            // AIZ.plugins.notify('success', 'Copied');

        }



        function show_chat_modal() {

            @if (Auth::check())

                $('#chat_modal').modal('show');

            @else

                $('#login_modal').modal('show');

            @endif

        }



        // Pagination using ajax

        $(window).on('hashchange', function() {

            if(window.history.pushState) {

                window.history.pushState('', '/', window.location.pathname);

            } else {

                window.location.hash = '';

            }

        });



        $(document).ready(function() {

            $(document).on('click', '.product-queries-pagination .pagination a', function(e) {

                getPaginateData($(this).attr('href').split('page=')[1], 'query', 'queries-area');

                e.preventDefault();

            });

        });



        $(document).ready(function() {

            $(document).on('click', '.product-reviews-pagination .pagination a', function(e) {

                getPaginateData($(this).attr('href').split('page=')[1], 'review', 'reviews-area');

                e.preventDefault();

            });

        });



        function getPaginateData(page, type, section) {

            $.ajax({

                url: '?page=' + page,

                dataType: 'json',

                data: {type: type},

            }).done(function(data) {

                $('.'+section).html(data);

                location.hash = page;

            }).fail(function() {

                alert('Something went worng! Data could not be loaded.');

            });

        }

        // Pagination end



        function showImage(photo) {

            $('#image_modal img').attr('src', photo);

            $('#image_modal img').attr('data-src', photo);

            $('#image_modal').modal('show');

        }



        function bid_modal(){

            @if (isCustomer() || isSeller())

                $('#bid_for_detail_product').modal('show');

          	@elseif (isAdmin())

                AIZ.plugins.notify('warning', '{{ translate("Sorry, Only customers & Sellers can Bid.") }}');

            @else

                $('#login_modal').modal('show');

            @endif

        }



        function product_review(product_id) {

            @if (isCustomer())

                @if ($review_status == 1)

                    $.post('{{ route('product_review_modal') }}', {

                        _token: '{{ @csrf_token() }}',

                        product_id: product_id

                    }, function(data) {

                        $('#product-review-modal-content').html(data);

                        $('#product-review-modal').modal('show', {

                            backdrop: 'static'

                        });

                        AIZ.extra.inputRating();

                    });

                @else

                    AIZ.plugins.notify('warning', '{{ translate("Sorry, You need to buy this product to give review.") }}');

                @endif

            @elseif (Auth::check() && !isCustomer())

                AIZ.plugins.notify('warning', '{{ translate("Sorry, Only customers can give review.") }}');

            @else

                $('#login_modal').modal('show');

            @endif

        }

    </script>

@endsection

