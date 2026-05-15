@extends('frontend.layouts.user_panel')

@section('panel_content')
    <style>
        .ecm-page-panel{background:#fff;border:1px solid #edf2f7;border-radius:20px;padding:24px}
        .ecm-page-title{font-size:18px;font-weight:800;margin:0;color:#1e293b}
        .ecm-seller-grid{display:grid;gap:18px;grid-template-columns:repeat(4,minmax(0,1fr))}
        .ecm-seller-card{background:#f8fbfe;border:1.5px solid #e3f3fb;border-radius:14px;padding:18px;text-align:center;transition:box-shadow .25s ease,transform .25s ease,border-color .25s ease}
        .ecm-seller-card:hover{border-color:#3c9bd3;box-shadow:0 10px 36px rgba(60,155,211,.18);transform:translateY(-4px)}
        .ecm-seller-logo{align-items:center;background:#fff;border-radius:50%;display:flex;height:118px;justify-content:center;margin:0 auto 16px;overflow:hidden;width:118px;box-shadow:0 12px 28px rgba(15,23,42,.08)}
        .ecm-seller-logo img{height:100%;object-fit:cover;width:100%;transition:transform .3s ease}
        .ecm-seller-card:hover .ecm-seller-logo img{transform:scale(1.08)}
        .ecm-seller-name{color:#111;display:-webkit-box;font-size:15px;font-weight:800;line-height:1.35;min-height:40px;overflow:hidden;text-decoration:none;-webkit-box-orient:vertical;-webkit-line-clamp:2}
        .ecm-seller-name:hover{color:#227eb8;text-decoration:none}
        .ecm-seller-rating{color:#64748b;font-size:13px;min-height:24px}
        .ecm-seller-actions{display:grid;gap:10px;margin-top:16px}
        .ecm-seller-visit,.ecm-seller-unfollow{align-items:center;border-radius:5px;display:inline-flex;font-size:13px;font-weight:800;justify-content:center;min-height:40px;text-decoration:none;transition:.2s ease}
        .ecm-seller-visit{background:#f0f8fd;color:#3d98d1}
        .ecm-seller-visit:hover{background:#3d98d1;color:#fff;text-decoration:none}
        .ecm-seller-unfollow{background:#fff1f2;color:#dc2626}
        .ecm-seller-unfollow:hover{background:#dc2626;color:#fff;text-decoration:none}
        .ecm-empty{background:linear-gradient(180deg,#fff,#f8fafc);border:1px solid #edf2f7;border-radius:14px;padding:54px 24px;text-align:center}
        .ecm-empty img{height:auto;max-width:180px}
        .ecm-empty-title{color:#1e293b;font-size:18px;font-weight:800;margin:18px 0 0}
        @media(max-width:1199.98px){.ecm-seller-grid{grid-template-columns:repeat(3,minmax(0,1fr))}}
        @media(max-width:767.98px){.ecm-seller-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.ecm-page-panel{padding:20px}}
        @media(max-width:420px){.ecm-seller-grid{grid-template-columns:1fr}}
    </style>

    <div class="ecm-page-panel">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h1 class="ecm-page-title">{{ translate('Followed Sellers') }}</h1>
        </div>

        @if (count($followed_sellers) > 0)
            <div class="ecm-seller-grid mb-4">
                @foreach ($followed_sellers as $key => $followed_seller)
                    @if($followed_seller->shop != null)
                        <div class="ecm-seller-card" id="followed_seller_{{ $followed_seller->shop->id }}">
                            <a href="{{ route('shop.visit', $followed_seller->shop->slug) }}" class="ecm-seller-logo">
                                <img src="{{ static_asset('assets/img/placeholder-rect.jpg') }}"
                                     data-src="{{ uploaded_asset($followed_seller->shop->logo) }}"
                                     alt="{{ $followed_seller->shop->name }}"
                                     class="lazyload"
                                     onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                            </a>
                            <a href="{{ route('shop.visit', $followed_seller->shop->slug) }}" class="ecm-seller-name">{{ $followed_seller->shop->name }}</a>
                            <div class="rating rating-md rating-space ecm-seller-rating mt-2">
                                {{ renderStarRating($followed_seller->shop->rating) }}
                                <span class="ml-1">({{ $followed_seller->shop->num_of_reviews }} {{ translate('reviews') }})</span>
                            </div>
                            <div class="ecm-seller-actions">
                                <a href="{{ route('shop.visit', $followed_seller->shop->slug) }}" class="ecm-seller-visit">{{ translate('Visit Store') }}</a>
                                <a href="{{ route('followed_seller.remove', ['id'=>$followed_seller->shop->id]) }}" class="ecm-seller-unfollow">{{ translate('Unfollow This Seller') }}</a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="ecm-empty mb-4">
                <img src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                <h5 class="ecm-empty-title">{{ translate("There isn't anything added yet")}}</h5>
            </div>
        @endif

        <div class="aiz-pagination">
            {{ $followed_sellers->links() }}
        </div>
    </div>
@endsection
