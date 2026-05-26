@extends('backend.layouts.app')

@section('content')

@php
    CoreComponentRepository::instantiateShopRepository();
    CoreComponentRepository::initializeCache();
@endphp

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">

        <div class="col-md-6">
            <h1 class="h3">{{ translate('All Subcategories') }}</h1>
        </div>

        <div class="col-md-6 text-md-right">
            <a href="{{ route('subcategories.create') }}" class="btn btn-circle btn-info">
                <span>{{ translate('Add New Subcategory') }}</span>
            </a>
        </div>

    </div>
</div>

<div class="card">

    <div class="card-header d-block d-md-flex">

        <h5 class="mb-0 h6">
            {{ translate('Subcategories') }}
        </h5>

        <form id="sort_subcategories" action="" method="GET">

            <div class="box-inline pad-rgt pull-left">

                <div style="min-width: 200px;">

                    <input
                        type="text"
                        class="form-control"
                        id="search"
                        name="search"

                        @isset($sort_search)
                            value="{{ $sort_search }}"
                        @endisset

                        placeholder="{{ translate('Type name & Enter') }}"
                    >

                </div>

            </div>

        </form>

    </div>

    <div class="card-body">

        <table class="table aiz-table mb-0">

            <thead>

                <tr>
                    <th>#</th>
                    <th>{{ translate('Image') }}</th>
                    <th>{{ translate('Name') }}</th>
                    <th>{{ translate('Slug') }}</th>
                    <th>{{ translate('Category') }}</th>
                    <th>{{ translate('Description') }}</th>
                    <th class="text-right">{{ translate('Options') }}</th>
                </tr>

            </thead>

            <tbody>

                @foreach($subcategories as $key => $subcategory)

                    <tr>

                        <td>
                            {{ ($key + 1) + ($subcategories->currentPage() - 1) * $subcategories->perPage() }}
                        </td>

                        <td>

                            @if($subcategory->image)

                                <img
                                    src="{{ uploaded_asset($subcategory->image) }}"
                                    alt="image"
                                    class="h-50px"
                                >

                            @else

                                —

                            @endif

                        </td>

                        <td>
                            {{ $subcategory->getTranslation('name') }}
                        </td>

                        <td>
                            {{ $subcategory->slug }}
                        </td>

                        <td>

                            @php
                                $category = \App\Models\Category::find($subcategory->category_id);
                            @endphp

                            @if($category)
                                {{ $category->name }}
                            @else
                                —
                            @endif

                        </td>

                        <td>

                            @if($subcategory->description)
                                {{ \Illuminate\Support\Str::limit($subcategory->description, 50) }}
                            @else
                                —
                            @endif

                        </td>

                        <td class="text-right">

                            <a
                                class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                href="{{ route('subcategories.edit', $subcategory) }}"
                                title="{{ translate('Edit') }}"
                            >
                                <i class="las la-edit"></i>
                            </a>

                            <a
                                href="#"
                                class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                data-href="{{ route('subcategories.destroy', $subcategory) }}"
                                title="{{ translate('Delete') }}"
                            >
                                <i class="las la-trash"></i>
                            </a>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <div class="aiz-pagination">
            {{ $subcategories->appends(request()->input())->links() }}
        </div>

    </div>

</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
