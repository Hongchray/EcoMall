@if (isset($home_section_categories) && count($home_section_categories) > 0)
    @foreach ($home_section_categories as $section_category)
        @php
            $section_products = filter_products(
                \App\Models\Product::where(function ($query) use ($section_category) {
                    $query->where('category_id', $section_category->id)
                        ->orWhereHas('categories', function ($category_query) use ($section_category) {
                            $category_query->where('categories.id', $section_category->id);
                        });
                })->latest()
            )->limit(12)->get();
            $section_id = 'section_category_' . $section_category->id;
            $section_name = $section_category->getTranslation('name');
        @endphp

        @if (count($section_products) > 0)
            <section class="mb-2 mb-md-3 mt-2 mt-md-3">
                <div class="container">
                    <div class="d-flex mb-2 mb-md-3 align-items-baseline justify-content-between">
                        <h3 class="fs-16 fs-md-20 fw-700 mb-2 mb-sm-0">
                            <span>{{ $section_name }}</span>
                        </h3>
                        <div class="d-flex align-items-center">
                            <a type="button" class="arrow-prev slide-arrow link-disable text-secondary mr-2" onclick="clickToSlide('slick-prev','{{ $section_id }}')"><i class="las la-angle-left fs-20 fw-600"></i></a>
                            <a class="text-blue fs-12 fw-700 hov-text-primary mx-2" href="{{ route('products.category', $section_category->slug) }}">{{ translate('View All') }}</a>
                            <a type="button" class="arrow-next slide-arrow text-secondary ml-2" onclick="clickToSlide('slick-next','{{ $section_id }}')"><i class="las la-angle-right fs-20 fw-600"></i></a>
                        </div>
                    </div>

                    <div id="{{ $section_id }}" class="px-sm-3">
                        <div class="aiz-carousel arrow-none sm-gutters-16" data-items="6" data-xl-items="5" data-lg-items="4" data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows="true" data-infinite="false">
                            @foreach ($section_products as $product)
                                <div class="carousel-box px-3 position-relative has-transition">
                                    @include('frontend.partials.product_box_1', ['product' => $product])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach
@endif
