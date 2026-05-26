@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{ translate('Subcategory Information') }}</h5>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">

            <div class="card-body p-0">

                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (get_all_active_language() as $key => $language)
                        <li class="nav-item">
                            <a class="nav-link text-reset
                                @if ($language->code == $lang)
                                    active
                                @else
                                    bg-soft-dark border-light border-left-0
                                @endif py-3"
                               href="{{ route('subcategories.edit', ['subcategory' => $subcategory->id, 'lang' => $language->code]) }}">

                                <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}"
                                     height="11"
                                     class="mr-1">

                                <span>{{ $language->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <form class="p-4"
                      action="{{ route('subcategories.update', $subcategory) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                   @method('PUT')

                    <input type="hidden" name="lang" value="{{ $lang }}">

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{ translate('Category') }}
                        </label>

                        <div class="col-md-9">
                            <select class="form-control aiz-selectpicker"
                                    name="category_id"
                                    data-live-search="true"
                                    required>

                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if($subcategory->category_id == $category->id)
                                            selected
                                        @endif>

                                        {{ $category->getTranslation('name') }}

                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{ translate('Name') }}
                            <i class="las la-language text-danger"
                               title="{{ translate('Translatable') }}"></i>
                        </label>

                        <div class="col-md-9">
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ $subcategory->getTranslation('name', $lang) }}"
                                   placeholder="{{ translate('Name') }}"
                                   required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            {{ translate('Slug') }}
                        </label>

                        <div class="col-md-9">
                            <input type="text"
                                   name="slug"
                                   class="form-control"
                                   value="{{ $subcategory->slug }}"
                                   placeholder="{{ translate('Slug') }}">
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
                                       class="selected-files"
                                       value="{{ $subcategory->image }}">

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
                                      class="form-control">{{ $subcategory->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit"
                                class="btn btn-primary">
                            {{ translate('Update') }}
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
