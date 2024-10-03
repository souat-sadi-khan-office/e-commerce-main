@extends('backend.layouts.app')
@section('title', 'Create New Product')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dropify.min.css') }}">
@endpush

@section('page_name')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">Create new Product</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-add-fill"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.product.index') }}">
                                Product Management
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create new product</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-soft-danger">
                        <i class="bi bi-backspace"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
   
    <form action="{{ route('admin.product.store')}}" method="POST" classp="content_form">
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <div class="row">
                    <!-- Product Information -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Product Information</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="name">Product name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
            
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="slug">Product slug <span class="text-danger">*</span></label>
                                        <input type="text" name="slug" id="slug" class="form-control" required>
                                    </div>
            
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="category_id">Category <span class="text-danger">*</span></label>
                                        <select name="category_id[]" id="category_id" class="form-control select">
                                            <option value="" disabled selected>--Select Category--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
            
                                    <div class="Sub_Categories row"></div>
                                   
            
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="brand_id">Brand</label>
                                        <select name="brand_id" id="brand_id" class="form-control"></select>
                                    </div>
            
                                    <div class="col-md-12 form-group mb-3" style="display:none;" id="brand_type_area">
                                        <label for="brand_type_id">Brand type</label>
                                        <select name="brand_type_id" id="brand_type_id" class="form-control"></select>
                                    </div>
            
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="unit">Unit</label>
                                        <input type="text" name="unit" id="unit" class="form-control" placeholder="Unit (e.g. KG, Pc etc)">
                                    </div>
            
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="min_purchase_quantity">Minimum purchase quantity <span class="text-danger">*</span></label>
                                        <input type="number" name="min_purchase_quantity" id="min_purchase_quantity" class="form-control" value="1" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Product Specification -->
                    <div class="col-mb-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Product Specification</h2>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="specification_key row"></div>
                                    <button id="add-another" type="button" class="btn btn-primary mt-2" style="display:none;">Add Another
                                        Specification</button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Product Images -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Product Images</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="images">Gallery Images (540 X 600)</label>
                                        <input type="file" name="images[]" id="images" class="form-control dropify" multiple data-max-file-size="2M" >
                                        <small class="text-muted">These images are visible in product details page gallery. Use 600x600 sizes images.</small>
                                    </div>
    
                                    <div class="col-md-12 form-group">
                                        <label for="thumb_image">Thumbnail Image (540 X 600)</label>
                                        <input type="file" name="thumb_image" id="thumb_image" class="form-control dropify" data-max-file-size="2M" >
                                        <small class="text-muted">This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Videos -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Product Videos</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="video_provider">Video Provider</label>
                                        <input type="text" name="video_provider" id="video_provider" class="form-control" placeholder="YouTube">
                                    </div>
    
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="video_link">Video Link</label>
                                        <input type="url" name="video_link" id="video_link" class="form-control" placeholder="Video Link">
                                        <small class="text-muted">Use proper link without extra parameter. Don't use short share link/embeded iframe code.</small>
                                    </div>
    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Description -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Product Description</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @include('backend.components.descriptionInput')
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- SEO Meta Tags -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">SEO Meta Tags</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="site_title">Site title</label>
                                        <input type="text" name="site_title" id="site_title" class="form-control" placeholder="Site Title">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="meta_title">Meta title</label>
                                        <input type="text" name="meta_title" id="meta_title" class="form-control" placeholder="Meta Title">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="meta_keyword">Meta keyword</label>
                                        <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="meta_description">Meta description</label>
                                        <textarea name="meta_description" id="meta_description" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="meta_article_tags">Meta article tag</label>
                                        <textarea name="meta_article_tags" id="meta_article_tags" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="meta_script_tags">Meta script tag</label>
                                        <textarea name="meta_script_tags" id="meta_script_tags" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-5">
                <div class="row">
    
                    <!-- Stock -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Stock & Amunt</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <p>It will be added</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Discount -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Discount</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="is_discounted">Discount Available</label>
                                        <select name="is_discounted" id="is_discounted" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="discount_type">Discount Type </label>
                                        <select name="discount_type" id="discount_type" class="form-control" disabled>
                                            <option value="amount">Amount</option>
                                            <option value="percentage">Percent</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="discount">Amount</label>
                                        <input type="text" name="discount" id="discount" class="form-control" value="0" disabled>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="discount_start_date">Discount start date</label>
                                        <input type="text" name="discount_start_date" id="discount_start_date" class="form-control date" disabled>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="discount_end_date">Discount end date</label>
                                        <input type="text" name="discount_end_date" id="discount_end_date" class="form-control date" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Status -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Status</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Feature Product -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Feature Product</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="is_featured">Feature Product</label>
                                        <select name="is_featured" id="is_featured" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Return Policy -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Return Policy</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="is_returnable">Is Returnable</label>
                                        <select name="is_returnable" id="is_returnable" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
    
                                    <label for="return_deadline">Return Deadline</label>
                                    <div class="col-md-12 input-group mb-3">
                                        <input type="text" class="form-control" name="return_deadline" id="return_deadline" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Days</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Low Stock Quantity Warning -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Low Stock Quantity Warning</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="low_stock_quantity">Quantity</label>
                                        <input type="number" name="low_stock_quantity" id="low_stock_quantity" class="form-control" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Cash on Delivery -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Cash on Delivery</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="cash_on_delivery">Cash on Delivery</label>
                                        <select name="cash_on_delivery" id="case_on_deliver" class="form-control">
                                            <option value="1">Available</option>
                                            <option value="0">Not available</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Estimate Shipping Time -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Estimate Shipping Time</h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <label for="est_shipping_time">Estimate Shipping Time</label>
                                    <div class="col-md-12 input-group mb-3">
                                        <input type="text" class="form-control" name="est_shipping_time" id="est_shipping_time">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Days</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Vat & TAX -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Vat & TAX</h2>
                            </div>
                            <div class="card-body">
                                @foreach ($taxes as $tax)
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="taxes_{{ $tax->id }}">{{ $tax->name }}</label>
                                            <input type="text" name="taxes[]" id="taxes_{{ $tax->id }}" class="form-control" value="0">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="tax_type_{{ $tax->id }}">Type</label>
                                            <select name="tax_types[]" id="tax_type_{{ $tax->id }}" class="form-control">
                                                <option value="flat">Flat</option>
                                                <option value="percent">Percent</option>
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
    
            <div class="col-md-12 form-group mb-3 text-end">
                <button class="btn btn-soft-success" type="submit" id="submit">
                    <i class="bi bi-send"></i>
                    Create
                </button>
                <button class="btn btn-soft-warning" style="display: none;" id="submitting" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="{{ asset('backend/assets/js/dropify.min.js') }}"></script>
    <script>
        _componentSelect();
        _formValidation();
        _initCkEditor("editor");

        $('.dropify').dropify();

        // For return
        $(document).on('change', '#is_returnable', function() {
            let is_returnable = $(this).val();
            if(is_returnable == 1) {
                $('#return_deadline').removeAttr('disabled');
            } else {
                $('#return_deadline').attr('disabled', 'true');
            }
        });

        // For discount
        $(document).on('change', '#is_discounted', function() {
            let is_discounted = $(this).val();
            if(is_discounted == 1) {
                $('#discount_type').removeAttr('disabled');
                $('#discount').removeAttr('disabled');
                $('#discount_start_date').removeAttr('disabled');
                $('#discount_end_date').removeAttr('disabled')
            } else {
                $('#discount_type').attr('disabled', true);
                $('#discount').attr('disabled', 'true');
                $('#discount_start_date').attr('disabled', 'true');
                $('#discount_end_date').attr('disabled', 'true');
            }
        });

        // For getting brand type
        $(document).on('change', '#brand_id', function() {

            $('#brand_type_area').hide();
            $('#brand_type_id').val(null).trigger('change');

            let brand_id = $(this).val();
            $.ajax({
                url: '/search/brand-types',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    brand_id: brand_id 
                },
                delay: 250,
                cache: true,
                success: function (data) {
                    if(data.status && data.responses.length > 0) {

                        var dataTypes = [{
                            id: '', 
                            text: 'Select brand type',
                        }].concat(data.responses.map(function(type) {
                            return {
                                id: type.id,
                                text: type.name
                            };
                        }));

                        // select2 এ ডাটা ইনসার্ট করা
                        $('#brand_type_id').select2({
                            data: dataTypes,
                            width: '100%',
                            placeholder: 'Select brand type'
                        });

                        $('#brand_type_area').show();

                    }
                }
            });
        });

        // for brands
        $('#brand_id').select2({
            width: '100%',
            placeholder: 'Select Brand',
            templateResult: formatBrandOption, 
            templateSelection: formatBrandSelection,
            ajax: {
                url: '/search/brands',
                method: 'POST',
                dataType: 'JSON',
                delay: 250,
                cache: true,
                data: function (data) {
                    return {
                        searchTerm: data.term
                    };
                },

                processResults: function (response) {
                    return {
                        results:response
                    };
                }
            }
        });

        function formatBrandOption(brand) {
            if (!brand.id) {
                return brand.text;
            }

            var brandImage = '<img src="' + brand.image_url + '" class="img-flag" style="height: 20px; width: 20px; margin-right: 10px;" />';
            var brandOption = $('<span>' + brandImage + brand.text + '</span>');
            return brandOption;
        }

        function formatBrandSelection(brand) {
            if (!brand.id) {
                return brand.text;
            }

            var brandImage = '<img src="' + brand.image_url + '" class="img-flag" style="height: 20px; width: 20px; margin-right: 10px;" />';
            return $('<span>' + brandImage + brand.text + '</span>');
        }
    </script>
    <script src="{{ asset('backend/assets/js/addproduct.js') }}"></script>
@endpush
