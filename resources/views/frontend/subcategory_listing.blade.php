@extends('frontend.layouts.app')

{{-- @section('meta_title'){{ $sub->name }}@stop
@section('meta_description'){{ $sub->name }} products@stop --}}

@section('content')
<section class="mb-4 pt-4">
    <div class="container sm-px-0 pt-2">
        <div class="row">
            <div class="col-12">

                {{-- Breadcrumb --}}
                <ul class="breadcrumb bg-transparent py-0 px-1 mb-3">
                    <li class="breadcrumb-item opacity-50 hov-opacity-100">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                    </li>
                    <li class="breadcrumb-item opacity-50 hov-opacity-100">
                        <a class="text-reset" href="{{ route('search') }}">{{ translate('All Categories') }}</a>
                    </li>
                    <li class="breadcrumb-item opacity-50 hov-opacity-100">
                        <a class="text-reset" href="{{ route('products.category', $category->slug) }}">
                            {{ $category->getTranslation('name') }}
                        </a>
                    </li>
                    <li class="breadcrumb-item fw-700 text-dark">
                        {{ $sub->name }}
                    </li>
                </ul>

                <h1 class="fs-20 fs-md-24 fw-700 text-dark mb-4">{{ $sub->name }}</h1>

                {{-- Products Grid --}}
                <div class="row gutters-16 row-cols-xxl-5 row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-2 border-top border-left">
                    @forelse ($products as $product)
                        <div class="col border-right border-bottom has-transition hov-shadow-out z-1">
                            @include('frontend.'.get_setting('homepage_select').'.partials.product_box_1', ['product' => $product])
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">{{ translate('No products found in this subcategory') }}</p>
                        </div>
                    @endforelse
                </div>

                <div class="aiz-pagination mt-4">
                    {{ $products->appends(request()->input())->links() }}
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
