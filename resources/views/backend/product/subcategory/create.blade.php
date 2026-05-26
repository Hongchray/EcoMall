@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">
                    {{ translate('Subcategory Information') }}
                </h5>
            </div>

            <div class="card-body">

                <form class="form-horizontal"
                      action="{{ route('subcategories.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{ translate('Category') }}
                        </label>

                        <div class="col-md-9">
                            <select class="form-control aiz-selectpicker"
                                    name="category_id"
                                    data-live-search="true"
                                    required>

                                <option value="">
                                    {{ translate('Select Category') }}
                                </option>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->getTranslation('name') }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{ translate('Name') }}
                        </label>

                        <div class="col-md-9">
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="{{ translate('Name') }}"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{ translate('Image') }}
                        </label>

                        <div class="col-md-9">

                            <div class="input-group"
                                 data-toggle="aizuploader"
                                 data-type="image">

                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse') }}
                                    </div>
                                </div>

                                <div class="form-control file-amount">
                                    {{ translate('Choose File') }}
                                </div>

                                <input type="hidden"
                                       name="image"
                                       class="selected-files">
                            </div>

                            <div class="file-preview box sm"></div>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{ translate('Description') }}
                        </label>

                        <div class="col-md-9">
                            <textarea name="description"
                                      rows="5"
                                      class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit"
                                class="btn btn-primary">
                            {{ translate('Save') }}
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
