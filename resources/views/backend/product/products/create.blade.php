@extends('backend.layouts.app')



@section('content')



@php

    CoreComponentRepository::instantiateShopRepository();

    CoreComponentRepository::initializeCache();

@endphp



<div class="aiz-titlebar text-left mt-2 mb-3">

    <h5 class="mb-0 h6">{{translate('Add New Product')}}</h5>

</div>

<div class="">

    <!-- Error Meassages -->

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form class="form form-horizontal mar-top" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">

        <div class="row gutters-5">

            <div class="col-lg-8">

                @csrf

                <input type="hidden" name="added_by" value="admin">

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Information')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Product Name')}} <span class="text-danger">*</span></label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ translate('Product Name') }}" onchange="update_sku()" required>

                            </div>

                        </div>

                        <div class="form-group row" id="brand">

                            <label class="col-md-3 col-from-label">{{translate('Brand')}}</label>

                            <div class="col-md-8">

                                <select class="form-control aiz-selectpicker" name="brand_id" id="brand_id" data-live-search="true">

                                    <option value="">{{ translate('Select Brand') }}</option>

                                    @foreach (\App\Models\Brand::all() as $brand)

                                    <option value="{{ $brand->id }}" @selected(old('brand_id') == $brand->id)>{{ $brand->getTranslation('name') }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Unit')}} <span class="text-danger">*</span></label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="unit" value="{{ old('unit') }}" placeholder="{{ translate('Unit (e.g. KG, Pc etc)') }}" required>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Weight')}} <small>({{ translate('In Kg') }})</small></label>

                            <div class="col-md-8">

                                <input type="number" class="form-control" name="weight" step="0.01" value="0.00" placeholder="0.00">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Minimum Purchase Qty')}} <span class="text-danger">*</span></label>

                            <div class="col-md-8">

                                <input type="number" lang="en" class="form-control" name="min_qty" value="1" min="1" required>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Tags')}} <span class="text-danger">*</span></label>

                            <div class="col-md-8">

                                <input type="text" class="form-control aiz-tag-input" name="tags[]" placeholder="{{ translate('Type and hit enter to add a tag') }}">

                                <small class="text-muted">{{translate('This is used for search. Input those words by which cutomer can find this product.')}}</small>

                            </div>

                        </div>



                        @if (addon_is_activated('pos_system'))

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Barcode')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="barcode" value="{{ old('barcode') }}" placeholder="{{ translate('Barcode') }}">

                            </div>

                        </div>

                        @endif



                        @if (addon_is_activated('refund_request'))

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Refundable')}}</label>

                            <div class="col-md-8">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input type="checkbox" name="refundable" checked value="1">

                                    <span></span>

                                </label>

                            </div>

                        </div>

                        @endif

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Images')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Gallery Images')}} <small>(600x600)</small></label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="photos" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                                <small class="text-muted">{{translate('These images are visible in product details page gallery. Use 600x600 sizes images.')}}</small>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Thumbnail Image')}} <small>(300x300)</small></label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="thumbnail_img" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                                <small class="text-muted">{{translate('This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.')}}</small>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label">{{ translate('Detail Images') }}</label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="image_details" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Videos')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Video Provider')}}</label>

                            <div class="col-md-8">

                                <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">

                                    <option value="youtube" @selected(old('video_provider') == 'youtube')>{{translate('Youtube')}}</option>

                                    <option value="dailymotion" @selected(old('video_provider') == 'dailymotion')>{{translate('Dailymotion')}}</option>

                                    <option value="vimeo" @selected(old('video_provider') == 'vimeo')>{{translate('Vimeo')}}</option>

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Video Link')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="video_link" value="{{ old('video_link') }}" placeholder="{{ translate('Video Link') }}">

                                <small class="text-muted">{{translate("Use proper link without extra parameter. Don't use short share link/embeded iframe code.")}}</small>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Variation')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row gutters-5">

                            <div class="col-md-3">

                                <input type="text" class="form-control" value="{{translate('Colors')}}" disabled>

                            </div>

                            <div class="col-md-8">

                                <select class="form-control aiz-selectpicker" data-live-search="true" data-selected-text-format="count" name="colors[]" id="colors" multiple disabled>

                                    @foreach (\App\Models\Color::orderBy('name', 'asc')->get() as $key => $color)

                                    <option  value="{{ $color->code }}" data-content="<span><span class='size-15px d-inline-block mr-2 rounded border' style='background:{{ $color->code }}'></span><span>{{ $color->name }}</span></span>"></option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-1">

                                <label class="aiz-switch aiz-switch-success mb-0">

                                    <input value="1" type="checkbox" name="colors_active">

                                    <span></span>

                                </label>

                            </div>

                        </div>



                        <div class="form-group row gutters-5">

                            <div class="col-md-3">

                                <input type="text" class="form-control" value="{{translate('Attributes')}}" disabled>

                            </div>

                            <div class="col-md-8">

                                <select name="choice_attributes[]" id="choice_attributes" class="form-control aiz-selectpicker" data-selected-text-format="count" data-live-search="true" multiple data-placeholder="{{ translate('Choose Attributes') }}">

                                    @foreach (\App\Models\Attribute::all() as $key => $attribute)

                                    <option value="{{ $attribute->id }}">{{ $attribute->getTranslation('name') }}</option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                        <div>

                            <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}</p>

                            <br>

                        </div>



                        <div class="customer_choice_options" id="customer_choice_options">



                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product price + stock')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Unit price')}} <span class="text-danger">*</span></label>

                            <div class="col-md-6">

                                <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Unit price') }}" name="unit_price" class="form-control" required>

                            </div>

                        </div>



                        <div class="form-group row">

	                        <label class="col-sm-3 control-label" for="start_date">{{translate('Discount Date Range')}}</label>

	                        <div class="col-sm-9">

	                          <input type="text" class="form-control aiz-date-range" name="date_range" placeholder="{{translate('Select Date')}}" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off">

	                        </div>

	                    </div>



                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Discount')}} <span class="text-danger">*</span></label>

                            <div class="col-md-6">

                                <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Discount') }}" name="discount" class="form-control" required>

                            </div>

                            <div class="col-md-3">

                                <select class="form-control aiz-selectpicker" name="discount_type">

                                    <option value="amount" @selected(old('discount_type') == 'amount')>{{translate('Flat')}}</option>

                                    <option value="percent" @selected(old('discount_type') == 'percent')>{{translate('Percent')}}</option>

                                </select>

                            </div>

                        </div>



                        @if(addon_is_activated('club_point'))

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">

                                    {{translate('Set Point')}}

                                </label>

                                <div class="col-md-6">

                                    <input type="number" lang="en" min="0" value="0" step="1" placeholder="{{ translate('1') }}" name="earn_point" class="form-control">

                                </div>

                            </div>

                        @endif



                        <div id="show-hide-div">

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">{{translate('Quantity')}} <span class="text-danger">*</span></label>

                                <div class="col-md-6">

                                    <input type="number" lang="en" min="0" value="0" step="1" placeholder="{{ translate('Quantity') }}" name="current_stock" class="form-control" required>

                                </div>

                            </div>

                            <div class="form-group row">

                                <label class="col-md-3 col-from-label">

                                    {{translate('SKU')}}

                                </label>

                                <div class="col-md-6">

                                    <input type="text" placeholder="{{ translate('SKU') }}" name="sku" value="{{ old('sku') }}" class="form-control">

                                </div>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">

                                {{translate('External link')}}

                            </label>

                            <div class="col-md-9">

                                <input type="text" placeholder="{{ translate('External link') }}" value="{{ old('external_link') }}" name="external_link" class="form-control">

                                <small class="text-muted">{{translate('Leave it blank if you do not use external site link')}}</small>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">

                                {{translate('External link button text')}}

                            </label>

                            <div class="col-md-9">

                                <input type="text" placeholder="{{ translate('External link button text') }}" name="external_link_btn" value="{{ old('external_link_btn') }}" class="form-control">

                                <small class="text-muted">{{translate('Leave it blank if you do not use external site link')}}</small>

                            </div>

                        </div>

                        <br>

                        <div class="sku_combination" id="sku_combination">



                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('Product Description')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Description')}}</label>

                            <div class="col-md-8">

                                <textarea class="aiz-text-editor" name="description">{{ old('description') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('PDF Specification')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('PDF Specification')}}</label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="document">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="pdf" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">

                        <h5 class="mb-0 h6">{{translate('SEO Meta Tags')}}</h5>

                    </div>

                    <div class="card-body">

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Meta Title')}}</label>

                            <div class="col-md-8">

                                <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="{{ translate('Meta Title') }}">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-from-label">{{translate('Description')}}</label>

                            <div class="col-md-8">

                                <textarea name="meta_description" rows="8" class="form-control">{{ old('meta_description') }}</textarea>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Meta Image') }}</label>

                            <div class="col-md-8">

                                <div class="input-group" data-toggle="aizuploader" data-type="image">

                                    <div class="input-group-prepend">

                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>

                                    </div>

                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>

                                    <input type="hidden" name="meta_img" class="selected-files">

                                </div>

                                <div class="file-preview box sm">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Product Category') }}</h5>
                        <h6 class="float-right fs-13 mb-0">
                            {{ translate('Select Main') }}
                            <span class="position-relative main-category-info-icon">
                                <i class="las la-question-circle fs-18 text-info"></i>
                                <span class="main-category-info bg-soft-info p-2 position-absolute d-none border">{{ translate('This will be used for commission based calculations and homepage category wise product Show.') }}</span>
                            </span>
                        </h6>
                    </div>
                    <div class="card-body">

                        {{-- Category Treeview --}}
                        <div class="h-300px overflow-auto c-scrollbar-light mb-3">
                           <ul id="treeview"
                                class="hummingbird-treeview-converter list-unstyled"

                                data-radio-name="category_id">

                                @foreach ($categories as $category)
                                    <li id="{{ $category->id }}">
                                        {{ $category->getTranslation('name') }}

                                        @if($category->childrenCategories->count() > 0)
                                            <ul>
                                                @foreach ($category->childrenCategories as $childCategory)
                                                    @include('backend.product.products.child_category', [
                                                        'child_category' => $childCategory
                                                    ])
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                        {{-- Subcategory List (hidden until category selected) --}}
                        <div id="subcategory-wrapper" style="display:none;">
                            <hr class="my-2">
                            <label class="col-from-label mb-2">
                                {{ translate('Sub Category') }}
                            </label>
                            <div class="h-200px overflow-auto c-scrollbar-light mt-2">
                                <ul class="list-unstyled" id="subcategory_list">
                                    @foreach($subcategories as $sub)
                                        <li class="subcategory-item py-1 px-2"
                                            data-category="{{ $sub->category_id }}"
                                            style="display:none;">
                                            <label class="d-flex align-items-center mb-0" style="cursor:pointer; gap:8px;">
                                                <input type="radio"
                                                    name="subcategory_id"
                                                    value="{{ $sub->id }}"
                                                    style="margin-right:6px;">
                                                {{ $sub->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>

                </div>
            </div>

            {{-- rest of your cards (Shipping, Stock, etc.) --}}

            <div class="col-12">

                <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">

                    <div class="btn-group mr-2" role="group" aria-label="Third group">

                        <button type="submit" name="button" value="unpublish" class="btn btn-primary action-btn">{{ translate('Save & Unpublish') }}</button>

                    </div>

                    <div class="btn-group" role="group" aria-label="Second group">

                        <button type="submit" name="button" value="publish" class="btn btn-success action-btn">{{ translate('Save & Publish') }}</button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>



@endsection



@section('script')

<style>
    /* Hide checkboxes injected by hummingbird treeview */
    .hummingbird-treeview input[type="checkbox"],
    #treeview input[type="checkbox"],
    .hummingbird-treeview-converter input[type="checkbox"] {
        display: none !important;
        visibility: hidden !important;
        width: 0 !important;
        height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
    }
</style>

<!-- Treeview js -->

<script src="{{ static_asset('assets/js/hummingbird-treeview.js') }}"></script>



<script type="text/javascript">
    // Single handler for category_id change
    $(document).on('change', 'input[name="category_id"]', function () {
        var val = $(this).val();

        // Sync to category_ids[] for controller
        $('input[name="category_ids[]"]').remove();
        $('<input>').attr({
            type: 'hidden',
            name: 'category_ids[]',
            value: val
        }).appendTo('#choice_form');

        // Filter subcategories
        filterSubcategories(val);
    });

    function filterSubcategories(categoryId) {
        var $wrapper = $('#subcategory-wrapper');
        var $items   = $('.subcategory-item');

        // Hide all, show matching
        $items.hide();
        var $matching = $items.filter('[data-category="' + categoryId + '"]');

        if ($matching.length > 0) {
            $matching.show();
            $wrapper.show();
        } else {
            $wrapper.hide();
        }

        // Reset any selected subcategory
        $('input[name="subcategory_id"]').prop('checked', false);
    }
    $(document).ready(function() {
        $("#treeview").hummingbird();

        // Forcefully remove checkboxes after hummingbird renders them
        setTimeout(function() {
            $('input[type="checkbox"]', '.hummingbird-treeview-converter').each(function() {
                $(this).closest('label').find('input[type="checkbox"]').hide();
                $(this).hide();
            });
        }, 100);

        var main_id = '{{ old("category_id") }}';
        if (main_id) {
            $('input[name="category_id"][value=' + main_id + ']').prop('checked', true);
            filterSubcategories(main_id);
        }
    });



    $('form').bind('submit', function (e) {

		if ( $(".action-btn").attr('attempted') == 'true' ) {

			//stop submitting the form because we have already clicked submit.

			e.preventDefault();

		}

		else {

			$(".action-btn").attr("attempted", 'true');

		}

        // Disable the submit button while evaluating if the form should be submitted

        // $("button[type='submit']").prop('disabled', true);



        // var valid = true;



        // if (!valid) {

            // e.preventDefault();



            ////Reactivate the button if the form was not submitted

            // $("button[type='submit']").button.prop('disabled', false);

        // }

    });



    $("[name=shipping_type]").on("change", function (){

        $(".flat_rate_shipping_div").hide();



        if($(this).val() == 'flat_rate'){

            $(".flat_rate_shipping_div").show();

        }



    });



    function add_more_customer_choice_option(i, name){

        $.ajax({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            },

            type:"POST",

            url:'{{ route('products.add-more-choice-option') }}',

            data:{

               attribute_id: i

            },

            success: function(data) {

                var obj = JSON.parse(data);

                $('#customer_choice_options').append(`

                    <div class="form-group row">

                        <div class="col-md-3">

                            <input type="hidden" name="choice_no[]" value="${i}">

                            <input type="text" class="form-control" name="choice[]" value="${name}" placeholder="{{ translate('Choice Title') }}" readonly>

                        </div>

                        <div class="col-md-8">

                            <select class="form-control aiz-selectpicker attribute_choice" data-live-search="true" name="choice_options_${i}[]" multiple>

                                ${obj}

                            </select>

                        </div>

                    </div>`);

                AIZ.plugins.bootstrapSelect('refresh');

           }

       });





    }



    $('input[name="colors_active"]').on('change', function() {

        if(!$('input[name="colors_active"]').is(':checked')) {

            $('#colors').prop('disabled', true);

            AIZ.plugins.bootstrapSelect('refresh');

        }

        else {

            $('#colors').prop('disabled', false);

            AIZ.plugins.bootstrapSelect('refresh');

        }

        update_sku();

    });



    $(document).on("change", ".attribute_choice",function() {

        update_sku();

    });



    $('#colors').on('change', function() {

        update_sku();

    });



    $('input[name="unit_price"]').on('keyup', function() {

        update_sku();

    });



    $('input[name="name"]').on('keyup', function() {

        update_sku();

    });



    function delete_row(em){

        $(em).closest('.form-group row').remove();

        update_sku();

    }



    function delete_variant(em){

        $(em).closest('.variant').remove();

    }



    function update_sku(){

        $.ajax({

           type:"POST",

           url:'{{ route('products.sku_combination') }}',

           data:$('#choice_form').serialize(),

           success: function(data) {

                $('#sku_combination').html(data);

                AIZ.uploader.previewGenerate();

                AIZ.plugins.fooTable();

                if (data.trim().length > 1) {

                   $('#show-hide-div').hide();

                }

                else {

                    $('#show-hide-div').show();

                }

           }

       });

    }



    $('#choice_attributes').on('change', function() {

        $('#customer_choice_options').html(null);

        $.each($("#choice_attributes option:selected"), function(){

            add_more_customer_choice_option($(this).val(), $(this).text());

        });



        update_sku();

    });



</script>

@endsection

