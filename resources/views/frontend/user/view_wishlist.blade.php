@extends('frontend.layouts.user_panel')

@section('panel_content')
    <style>
        .ecm-dashboard-section-title {
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 0;
        }

        .ecm-dashboard-product-grid {
            display: grid;
            gap: 18px;
            grid-template-columns: repeat(5, minmax(0, 1fr));
        }

        .ecm-dashboard-product {
            background: #f8fbfe;
            border: 1.5px solid #e3f3fb;
            border-radius: 14px;
            height: 100%;
            margin-top: 8px;
            overflow: hidden;
            padding: 16px 14px 14px;
            position: relative;
            transition: box-shadow .25s ease, transform .25s ease, border-color .25s ease;
        }

        .ecm-dashboard-product:hover {
            border-color: #3c9bd3;
            box-shadow: 0 10px 36px rgba(60, 155, 211, 0.18);
            transform: translateY(-4px);
        }

        .ecm-dashboard-product-top {
            align-items: flex-start;
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            min-height: 32px;
        }

        .ecm-dashboard-product-badge {
            background: #3c9bd3;
            border: 1px solid #3c9bd3;
            border-radius: 999px;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            line-height: 1.2;
            max-width: calc(100% - 42px);
            overflow: hidden;
            padding: 4px 10px;
            text-overflow: ellipsis;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .ecm-dashboard-product-delete {
            align-items: center;
            background: #fff;
            border: 2px solid #f1b5b5;
            border-radius: 50%;
            color: #dc2626;
            display: inline-flex;
            flex: 0 0 32px;
            font-size: 18px;
            height: 32px;
            justify-content: center;
            line-height: 1;
            text-decoration: none;
            transition: background-color .2s ease, border-color .2s ease, color .2s ease;
            width: 32px;
        }

        .ecm-dashboard-product-delete:hover,
        .ecm-dashboard-product-delete:focus {
            background: #dc2626;
            border-color: #dc2626;
            color: #fff;
            text-decoration: none;
        }

        .ecm-dashboard-product-image {
            align-items: center;
            background: #fff;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            margin: 0 auto 18px;
            max-width: 126px;
            overflow: hidden;
            text-decoration: none;
            width: 72%;
            aspect-ratio: 1 / 1;
        }

        .ecm-dashboard-product-image img {
            height: 100%;
            object-fit: contain;
            padding: 8px;
            transition: transform .3s ease;
            width: 100%;
        }

        .ecm-dashboard-product:hover .ecm-dashboard-product-image img {
            transform: scale(1.08);
        }

        .ecm-dashboard-product-content {
            background: #fff;
            border-radius: 0 0 12px 12px;
            border-top: 1px solid #e3f3fb;
            margin: 0 -14px -14px;
            padding: 16px 14px 14px;
        }

        .ecm-dashboard-product-name {
            color: #111;
            display: -webkit-box;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.35;
            margin: 0 4px 10px;
            min-height: 40px;
            overflow: hidden;
            text-decoration: none;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .ecm-dashboard-product-name:hover,
        .ecm-dashboard-product-name:focus {
            color: #227eb8;
            text-decoration: none;
        }

        .ecm-dashboard-product-price {
            color: #2d9add;
            display: block;
            font-size: 14px;
            font-weight: 800;
            margin: 0 4px 14px;
        }

        .ecm-dashboard-product-action {
            align-items: center;
            background: #f0f8fd;
            border: 0;
            border-radius: 5px;
            color: #3d98d1;
            display: inline-flex;
            font-size: 13px;
            font-weight: 800;
            gap: 8px;
            justify-content: center;
            line-height: 1.2;
            min-height: 40px;
            opacity: 0;
            text-align: center;
            text-decoration: none;
            transform: translateY(8px);
            transition: opacity .2s ease, transform .2s ease, background-color .2s ease, color .2s ease;
            width: 100%;
        }

        .ecm-dashboard-product:hover .ecm-dashboard-product-action {
            opacity: 1;
            transform: translateY(0);
        }

        .ecm-dashboard-product-action:hover,
        .ecm-dashboard-product-action:focus {
            background: #3d98d1;
            color: #fff;
            text-decoration: none;
        }

        .ecm-dashboard-product-action i {
            font-size: 20px;
            line-height: 1;
        }

        .ecm-dashboard-empty {
            background: linear-gradient(180deg, #fff, #f8fafc);
            border: 1px solid #edf2f7;
            border-radius: 14px;
        }

        .wishlist-page-panel {
            background: #fff;
            border: 1px solid #edf2f7;
            border-radius: 20px;
            padding: 24px;
        }

        .wishlist-page-empty {
            padding: 54px 24px;
            text-align: center;
        }

        .wishlist-page-empty img {
            max-width: 180px;
            height: auto;
        }

        .wishlist-page-empty-title {
            margin: 18px 0 0;
            color: #1e293b;
            font-size: 18px;
            font-weight: 700;
        }

        @media (max-width: 1199.98px) {
            .ecm-dashboard-product-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        @media (max-width: 991.98px) {
            .ecm-dashboard-product-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .wishlist-page-panel {
                padding: 20px;
            }

            .ecm-dashboard-product-grid {
                gap: 12px;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .ecm-dashboard-product-image {
                width: 76%;
            }

            .ecm-dashboard-product-action {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="wishlist-page-panel">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 class="ecm-dashboard-section-title text-dark">{{ translate('My Wishlist')}}</h3>
        </div>

        @if (count($wishlists) > 0)
            <div class="ecm-dashboard-product-grid mb-4">
                @foreach($wishlists as $key => $wishlist)
                    @if ($wishlist->product != null)
                        @php
                            $wishlist_product_image = filter_var($wishlist->product->thumbnail_img, FILTER_VALIDATE_URL)
                                ? $wishlist->product->thumbnail_img
                                : uploaded_asset($wishlist->product->thumbnail_img);
                            $wishlist_placeholder_image = static_asset('assets/img/placeholder.jpg');
                        @endphp
                        <div class="ecm-dashboard-product" id="wishlist_{{ $wishlist->id }}">
                            <div class="ecm-dashboard-product-top">
                                <span class="ecm-dashboard-product-badge">{{ translate('Wishlist') }}</span>
                                <a href="javascript:void(0)" class="ecm-dashboard-product-delete"
                                    onclick="removeFromWishlist({{ $wishlist->id }})"
                                    data-toggle="tooltip" data-title="{{ translate('Remove from wishlist') }}" data-placement="left"
                                    aria-label="{{ translate('Remove from wishlist') }}">
                                    <i class="la la-trash"></i>
                                </a>
                            </div>

                            <a href="{{ route('product', $wishlist->product->slug) }}" class="ecm-dashboard-product-image" title="{{ $wishlist->product->getTranslation('name') }}">
                                <img src="{{ $wishlist_placeholder_image }}" data-src="{{ $wishlist_product_image ?: $wishlist_placeholder_image }}" class="lazyload"
                                    alt="{{ $wishlist->product->getTranslation('name') }}"
                                    title="{{ $wishlist->product->getTranslation('name') }}"
                                    onerror="this.onerror=null;this.src='{{ $wishlist_placeholder_image }}';">
                            </a>

                            <div class="ecm-dashboard-product-content">
                                <a href="{{ route('product', $wishlist->product->slug) }}" class="ecm-dashboard-product-name"
                                    title="{{ $wishlist->product->getTranslation('name') }}">{{ $wishlist->product->getTranslation('name') }}</a>

                                <span class="ecm-dashboard-product-price">{{ home_discounted_base_price($wishlist->product) }}</span>

                                <a class="ecm-dashboard-product-action" href="javascript:void(0)"
                                    onclick="showAddToCartModal({{ $wishlist->product->id }})">
                                    <i class="las la-shopping-cart"></i>
                                    <span>{{ translate('Add to Cart') }}</span>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="ecm-dashboard-empty wishlist-page-empty mb-4">
                <img src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                <h5 class="wishlist-page-empty-title">{{ translate("There isn't anything added yet")}}</h5>
            </div>
        @endif

        <div>
            <div class="aiz-pagination">
                {{ $wishlists->links() }}
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- add To Cart Modal -->
    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                AIZ.plugins.notify('success', '{{ translate("Item has been renoved from wishlist") }}');
            })
        }
    </script>
@endsection
