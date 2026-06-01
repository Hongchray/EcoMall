@if ($detailedProduct->added_by == 'seller' && $detailedProduct->user->shop != null)
    <style>
        .ec-seller-card {
            margin-bottom: 24px;
            padding: 26px 24px 24px;
            border: 1px solid #dcecf6;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 12px 34px rgba(29, 78, 111, .06);
        }

        .ec-seller-card__label {
            margin-bottom: 18px;
            color: #6b7280;
            font-size: 14px;
        }

        .ec-seller-card__main {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .ec-seller-card__avatar {
            width: 72px;
            height: 72px;
            flex: 0 0 72px;
            display: block;
            border: 1px solid #e8eef5;
            border-radius: 50%;
            overflow: hidden;
            background: #f3f5f7;
        }

        .ec-seller-card__avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .ec-seller-card__body {
            min-width: 0;
            flex: 1;
        }

        .ec-seller-card__name {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #071429;
            font-size: 15px;
            font-weight: 800;
            text-decoration: none;
        }

        .ec-seller-card__name:hover {
            color: #227eb8;
            text-decoration: none;
        }

        .ec-seller-card__address {
            margin-top: 4px;
            color: #7b8494;
            font-size: 12px;
        }

        .ec-seller-card__rating {
            margin-top: 8px;
        }

        .ec-seller-card__rating .rating {
            display: inline-flex;
            color: #f5a400;
            font-size: 16px;
        }

        .ec-seller-card__reviews {
            margin-top: 2px;
            color: #7b8494;
            font-size: 12px;
        }

        .ec-seller-card__social {
            margin-top: 16px;
        }

        .ec-seller-card__social .social a {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f4f8fb;
            color: #536173;
        }

        .ec-seller-card__button {
            margin-top: 20px;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #3498d3;
            border-radius: 6px;
            background: #fff;
            color: #2d8fd0;
            font-size: 14px;
            font-weight: 800;
            transition: background .2s ease, color .2s ease, transform .2s ease;
        }

        .ec-seller-card__button:hover,
        .ec-seller-card__button:focus {
            background: #3498d3;
            color: #fff;
            text-decoration: none;
            transform: translateY(-1px);
        }
    </style>

    <div class="ec-seller-card">
        <div class="ec-seller-card__label">{{ translate('Seller') }}</div>
        <div class="ec-seller-card__main">
                <!-- Shop Logo -->
                @if ($detailedProduct->added_by == 'seller' && get_setting('vendor_system_activation') == 1)
                <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}" class="ec-seller-card__avatar">
                    <img class="lazyload"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ uploaded_asset($detailedProduct->user->shop->logo) }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </a>
                @endif
                <!-- Shop Name & Verification status -->
                <div class="ec-seller-card__body">
                    <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                        class="ec-seller-card__name">
                        {{ $detailedProduct->user->shop->name }}
                        @if ($detailedProduct->user->shop->verification_status == 1)
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="17.5" height="17.5" viewBox="0 0 17.5 17.5">
                                    <g id="Group_25616" data-name="Group 25616" transform="translate(-537.249 -1042.75)">
                                        <path id="Union_5" data-name="Union 5" d="M0,8.75A8.75,8.75,0,1,1,8.75,17.5,8.75,8.75,0,0,1,0,8.75Zm.876,0A7.875,7.875,0,1,0,8.75.875,7.883,7.883,0,0,0,.876,8.75Zm.875,0a7,7,0,1,1,7,7A7.008,7.008,0,0,1,1.751,8.751Zm3.73-.907a.789.789,0,0,0,0,1.115l2.23,2.23a.788.788,0,0,0,1.115,0l3.717-3.717a.789.789,0,0,0,0-1.115.788.788,0,0,0-1.115,0l-3.16,3.16L6.6,7.844a.788.788,0,0,0-1.115,0Z" transform="translate(537.249 1042.75)" fill="#3490f3"/>
                                    </g>
                                </svg>
                            </span>
                        @else
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="17.5" height="17.5" viewBox="0 0 17.5 17.5">
                                    <g id="Group_25616" data-name="Group 25616" transform="translate(-537.249 -1042.75)">
                                        <path id="Union_5" data-name="Union 5" d="M0,8.75A8.75,8.75,0,1,1,8.75,17.5,8.75,8.75,0,0,1,0,8.75Zm.876,0A7.875,7.875,0,1,0,8.75.875,7.883,7.883,0,0,0,.876,8.75Zm.875,0a7,7,0,1,1,7,7A7.008,7.008,0,0,1,1.751,8.751Zm3.73-.907a.789.789,0,0,0,0,1.115l2.23,2.23a.788.788,0,0,0,1.115,0l3.717-3.717a.789.789,0,0,0,0-1.115.788.788,0,0,0-1.115,0l-3.16,3.16L6.6,7.844a.788.788,0,0,0-1.115,0Z" transform="translate(537.249 1042.75)" fill="red"/>
                                    </g>
                                </svg>
                            </span>
                        @endif
                    </a>
                    @if ($detailedProduct->user->shop->address)
                        <div class="ec-seller-card__address">{{ $detailedProduct->user->shop->address }}</div>
                    @endif
                    <!-- Rating -->
                    <div class="ec-seller-card__rating">
                        <div class="rating rating-mr-1">
                            {{ renderStarRating($detailedProduct->user->shop->rating) }}
                        </div>
                        <div class="ec-seller-card__reviews">
                            ({{ $detailedProduct->user->shop->num_of_reviews }}
                            {{ translate('customer reviews') }})
                        </div>
                    </div>
                </div>
        </div>
            <!-- Social Links -->
            @if ($detailedProduct->user->shop->facebook || $detailedProduct->user->shop->google || $detailedProduct->user->shop->twitter || $detailedProduct->user->shop->youtube)
                <div class="ec-seller-card__social">
                    <ul class="social list-inline mb-0">
                        @if ($detailedProduct->user->shop->facebook)
                        <li class="list-inline-item mr-2 mb-2">
                            <a href="{{ $detailedProduct->user->shop->facebook }}" class="facebook"
                                target="_blank">
                                <i class="lab la-facebook-f opacity-60"></i>
                            </a>
                        </li>
                        @endif
                        @if ($detailedProduct->user->shop->instagram)
                        <li class="list-inline-item mr-2 mb-2">
                            <a href="{{ $detailedProduct->user->shop->instagram }}" class="instagram"
                                target="_blank">
                                <i class="lab la-instagram opacity-60"></i>
                            </a>
                        </li>
                        @endif
                        @if ($detailedProduct->user->shop->google)
                        <li class="list-inline-item mr-2 mb-2">
                            <a href="{{ $detailedProduct->user->shop->google }}" class="google"
                                target="_blank">
                                <i class="lab la-google opacity-60"></i>
                            </a>
                        </li>
                        @endif
                        @if ($detailedProduct->user->shop->twitter)
                        <li class="list-inline-item mr-2 mb-2">
                            <a href="{{ $detailedProduct->user->shop->twitter }}" class="twitter"
                                target="_blank">
                                <i class="lab la-twitter opacity-60"></i>
                            </a>
                        </li>
                        @endif
                        @if ($detailedProduct->user->shop->youtube)
                        <li class="list-inline-item">
                            <a href="{{ $detailedProduct->user->shop->youtube }}" class="youtube"
                                target="_blank">
                                <i class="lab la-youtube opacity-60"></i>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            @endif
            <!-- shop link button -->
            <a href="{{ route('shop.visit', $detailedProduct->user->shop->slug) }}"
                class="ec-seller-card__button">{{ translate('Visit Store') }}</a>
    </div>
@endif
