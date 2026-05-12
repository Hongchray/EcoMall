{{-- EcoMall\resources\views\frontend\category_listing.blade.php --}}

@extends('frontend.layouts.app')

@php
    $meta_title       = $category->meta_title;
    $meta_description = $category->meta_description;
@endphp

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('content')
<section class="mb-4 pt-4">
    <div class="container sm-px-0 pt-2">
        <form id="search-form"
            action="{{ route('products.category', $category->slug) }}"
            method="GET">

            {{-- Keep subcategory when form submits (price, sort, attributes) --}}
            @if(request('subcategory'))
                <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">
            @endif
            <div class="row">

                {{-- SIDEBAR --}}
                <div class="col-xl-3">
                    <div class="aiz-filter-sidebar collapse-sidebar-wrap sidebar-xl sidebar-right z-1035">
                        <div class="overlay overlay-fixed dark c-pointer"
                            data-toggle="class-toggle"
                            data-target=".aiz-filter-sidebar"
                            data-same=".filter-sidebar-thumb">
                        </div>
                        <div class="collapse-sidebar c-scrollbar-light text-left">

                            <div class="d-flex d-xl-none justify-content-between align-items-center pl-3 border-bottom">
                                <h3 class="h6 mb-0 fw-600">{{ translate('Filters') }}</h3>
                                <button type="button" class="btn btn-sm p-2 filter-sidebar-thumb"
                                    data-toggle="class-toggle" data-target=".aiz-filter-sidebar">
                                    <i class="las la-times la-2x"></i>
                                </button>
                            </div>

                            {{-- Subcategories in Sidebar --}}
                            <div class="bg-white border mb-3">
                                <div class="fs-16 fw-700 p-3">
                                    <a href="#collapse_sub"
                                        class="dropdown-toggle filter-section text-dark d-flex align-items-center justify-content-between"
                                        data-toggle="collapse">
                                        {{ translate('Subcategories') }}
                                    </a>
                                </div>
                               <div class="collapse show" id="collapse_sub">
                                    <ul class="p-3 mb-0 list-unstyled">

                                        <li class="mb-3">
                                            <a class="text-reset fs-14 fw-600 hov-text-primary"
                                                href="{{ route('search') }}">
                                                <i class="las la-angle-left"></i>
                                                {{ translate('All Categories') }}
                                            </a>
                                        </li>

                                        <li class="mb-3 fw-600 text-dark fs-14">
                                            {{ $category->getTranslation('name') }}
                                        </li>

                                        @foreach ($category->subcategories as $sub)
                                            <li class="ml-4 mb-3">

                                                <a href="{{ route('products.category', $category->slug) }}?{{ http_build_query(array_merge(request()->query(), ['subcategory' => $sub->slug])) }}"
                                                    class="fs-14 hov-text-primary {{ request('subcategory') == $sub->slug ? 'text-primary fw-700' : 'text-reset' }}">

                                                    @if(request('subcategory') == $sub->slug)
                                                        <i class="las la-angle-right"></i>
                                                    @endif

                                                    {{ $sub->name }}
                                                </a>

                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>

                            {{-- Price Range --}}
                            <div class="bg-white border mb-3">
                                <div class="fs-16 fw-700 p-3">{{ translate('Price range') }}</div>
                                <div class="p-3 mr-3">
                                    @php $product_count = get_products_count() @endphp
                                    <div class="aiz-range-slider">
                                        <div id="input-slider-range"
                                            data-range-value-min="@if($product_count < 1) 0 @else {{ get_product_min_unit_price() }} @endif"
                                            data-range-value-max="@if($product_count < 1) 0 @else {{ get_product_max_unit_price() }} @endif">
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6">
                                                <span class="range-slider-value value-low fs-14 fw-600 opacity-70"
                                                    data-range-value-low="{{ $min_price ?? $products->min('unit_price') ?? 0 }}"
                                                    id="input-slider-range-value-low"></span>
                                            </div>
                                            <div class="col-6 text-right">
                                                <span class="range-slider-value value-high fs-14 fw-600 opacity-70"
                                                    data-range-value-high="{{ $max_price ?? $products->max('unit_price') ?? 0 }}"
                                                    id="input-slider-range-value-high"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="min_price" value="">
                                <input type="hidden" name="max_price" value="">
                            </div>

                            {{-- Attributes --}}
                            @foreach ($attributes as $attribute)
                                <div class="bg-white border mb-3">
                                    <div class="fs-16 fw-700 p-3">
                                        <a href="#"
                                            class="dropdown-toggle text-dark filter-section collapsed d-flex align-items-center justify-content-between"
                                            data-toggle="collapse"
                                            data-target="#collapse_{{ str_replace(' ', '_', $attribute->name) }}">
                                            {{ $attribute->getTranslation('name') }}
                                        </a>
                                    </div>
                                    @php
                                        $show = '';
                                        foreach ($attribute->attribute_values as $av) {
                                            if (in_array($av->value, $selected_attribute_values)) {
                                                $show = 'show';
                                            }
                                        }
                                    @endphp
                                    <div class="collapse {{ $show }}"
                                        id="collapse_{{ str_replace(' ', '_', $attribute->name) }}">
                                        <div class="p-3 aiz-checkbox-list">
                                            @foreach ($attribute->attribute_values as $av)
                                                <label class="aiz-checkbox mb-3">
                                                    <input type="checkbox"
                                                        name="selected_attribute_values[]"
                                                        value="{{ $av->value }}"
                                                        @if(in_array($av->value, $selected_attribute_values)) checked @endif
                                                        onchange="filter()">
                                                    <span class="aiz-square-check"></span>
                                                    <span class="fs-14 fw-400 text-dark">{{ $av->value }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Color Filter --}}
                            @if (get_setting('color_filter_activation'))
                                <div class="bg-white border mb-3">
                                    <div class="fs-16 fw-700 p-3">
                                        <a href="#"
                                            class="dropdown-toggle text-dark filter-section collapsed d-flex align-items-center justify-content-between"
                                            data-toggle="collapse" data-target="#collapse_color">
                                            {{ translate('Filter by color') }}
                                        </a>
                                    </div>
                                    <div class="collapse @if($selected_color) show @endif" id="collapse_color">
                                        <div class="p-3 aiz-radio-inline">
                                            @foreach ($colors as $color)
                                                <label class="aiz-megabox pl-0 mr-2"
                                                    data-toggle="tooltip"
                                                    data-title="{{ $color->name }}">
                                                    <input type="radio"
                                                        name="color"
                                                        value="{{ $color->code }}"
                                                        onchange="filter()"
                                                        @if($selected_color == $color->code) checked @endif>
                                                    <span class="aiz-megabox-elem rounded d-flex align-items-center justify-content-center p-1 mb-2">
                                                        <span class="size-30px d-inline-block rounded"
                                                            style="background: {{ $color->code }};"></span>
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- MAIN CONTENT --}}
                <div class="col-xl-9">

                    {{-- Breadcrumb: Home > Category only --}}
                    <ul class="breadcrumb bg-transparent py-0 px-1">
                        <li class="breadcrumb-item opacity-50 hov-opacity-100">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                        </li>
                        {{-- Show parent category in breadcrumb if this is a child --}}
                        @if ($category->parent_id != null && $category->parent_id != 0)
                            <li class="breadcrumb-item opacity-50 hov-opacity-100">
                                <a class="text-reset"
                                    href="{{ route('products.category', $category->parentCategory->slug) }}">
                                    {{ $category->parentCategory->getTranslation('name') }}
                                </a>
                            </li>
                        @endif
                        <li class="breadcrumb-item fw-700 text-dark">
                            {{ $category->getTranslation('name') }}
                        </li>
                    </ul>

                    {{-- Heading + Sort --}}
                    <div class="text-left mb-3">
                        <div class="row gutters-5 flex-wrap align-items-center">
                            <div class="col-lg col-10">
                                <h1 class="fs-20 fs-md-24 fw-700 text-dark">
                                    {{ $category->getTranslation('name') }}
                                </h1>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        @foreach ($category->subcategories as $sub)
                            <div class="col-6 col-md-3 mb-3">
                                {{-- <a href="{{ route('products.category', $category->slug) }}?{{ http_build_query(array_merge(request()->query(), ['subcategory' => $sub->slug])) }}" --}}

                                    <a href="{{ route('products.category', $category->slug) }}?{{ http_build_query(array_merge(request()->query(), ['subcategory' => $sub->slug])) }}"
                                    class="d-block text-center p-3 border h-100 {{ request('subcategory') == $sub->slug ? 'bg-white text-primary border border-primary' : 'bg-white text-dark' }}">


                                    @if ($sub->image)
                                        <img src="{{ $sub->image }}"
                                            class="img-fluid mb-2"
                                            style="max-height: 60px;">
                                    @endif

                                    <div class="fw-semibold">
                                        {{ $sub->name }}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div id="products-section" style="border-top: 1px solid #e9e9e9; margin-bottom: 16px">

                    </div>
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">

                        {{-- LEFT --}}
                        <h1 class="mb-0 fs-20 fw-700">
                            {{ translate('Products') }}
                        </h1>

                        {{-- RIGHT --}}
                        <div class="d-flex align-items-center gap-2">

                            {{-- FILTER BUTTON (mobile) --}}
                            <div class="d-xl-none mr-4">

                                <button type="button"
                                    class="btn btn-icon p-0"
                                    data-toggle="class-toggle"
                                    data-target=".aiz-filter-sidebar">
                                    <i class="la la-filter la-2x"></i>
                                </button>
                                {{ translate('or') }}
                            </div>

                            {{-- SORT --}}
                            <div style="min-width: 180px;">
                                <select class="form-control form-control-sm aiz-selectpicker rounded-0"
                                    name="sort_by" onchange="filter()">
                                    <option value="">{{ translate('Sort by') }}</option>
                                    <option value="newest"     @if($sort_by == 'newest') selected @endif>{{ translate('Newest') }}</option>
                                    <option value="oldest"     @if($sort_by == 'oldest') selected @endif>{{ translate('Oldest') }}</option>
                                    <option value="price-asc"  @if($sort_by == 'price-asc') selected @endif>{{ translate('Price low to high') }}</option>
                                    <option value="price-desc" @if($sort_by == 'price-desc') selected @endif>{{ translate('Price high to low') }}</option>
                                </select>
                            </div>

                        </div>
                    </div>


                    {{-- Subcategory Cards (shown above products) --}}
                    @if ($category->childrenCategories->isNotEmpty())
                        <div class="mb-4">
                            <h2 class="fs-16 fw-700 mb-3">{{ translate('Subcategories') }}</h2>
                            <div class="row gutters-10 row-cols-xxl-6 row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-3">
                                @foreach ($category->childrenCategories as $sub)
                                    <div class="col mb-3">
                                        <a href="{{ route('products.category', $category->slug) }}?subcategory={{ $sub->slug }}"
                                            class="d-block text-center p-3 bg-white border hov-shadow-out has-transition">
                                            @if ($sub->icon)
                                                <img src="{{ uploaded_asset($sub->icon) }}"
                                                    alt="{{ $sub->getTranslation('name') }}"
                                                    class="img-fluid mb-2"
                                                    style="max-height: 50px; object-fit: contain;">
                                            @endif
                                            <a href="{{ route('products.category', $category->slug) }}?subcategory={{ $sub->slug }}"
                                                class="d-block text-center p-3 bg-white border hov-shadow-out has-transition">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Products Grid --}}
                    <div class="px-3">
                        <div class="row gutters-16 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-4 row-cols-md-3 row-cols-2 ">
                            @forelse ($products as $product)
                                <div class="col has-transition z-1 mt-4">
                                    @include('frontend.'.get_setting('homepage_select').'.partials.product_box_1', ['product' => $product])
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">{{ translate('No products found') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="aiz-pagination mt-4">
                        {{ $products->appends(request()->input())->links() }}
                    </div>

                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('script')
<script>
    function filter() {
        $('#search-form').submit();
    }

    function rangefilter(arg) {
        $('input[name=min_price]').val(arg[0]);
        $('input[name=max_price]').val(arg[1]);
        filter();
    }

    // Mobile only scroll to products
    $(document).ready(function () {

        if (window.innerWidth < 768) {

            const urlParams = new URLSearchParams(window.location.search);

            if (urlParams.get('subcategory')) {

                $('html, body').animate({
                    scrollTop: $('#products-section').offset().top - 10
                }, 400);

            }
        }
    });
</script>
@endsection
