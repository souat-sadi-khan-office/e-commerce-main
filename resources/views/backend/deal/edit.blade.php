@extends('backend.layouts.app')
@section('title', 'Update deal information')
@section('page_name')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">Update deal information</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-add-fill"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.flash-deal.index') }}">Flash Deal Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Updae deal information</li>
                    </ol>
                </div>

                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('brand.view')) --}}
                    <div class="col-sm-6 text-end">
                        <a href="{{ route('admin.flash-deal.index') }}" class="btn btn-soft-danger">
                            <i class="bi bi-backspace"></i>
                            Back
                        </a>
                    </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/tempus-dominus.min.css') }}">
@endpush
@section('content')
    <form action="{{ route('admin.flash-deal.update', $model->id) }}" enctype="multipart/form-data" class="content_form" method="post">
        @method('PATCH')
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0">Deal Information</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12 form-group mb-3">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" required value="{{ $model->title }}">
                            </div>

                            <div class="col-md-12 form-group mb-3">
                                <label for="slgu">Slug <span class="text-danger">*</span></label>
                                <input type="text" name="slug" id="slug" class="form-control" required value="{{ $model->slug }}">
                            </div>

                            <div class="col-sm-12 form-group mb-3" id="htmlTarget">
                                <label for="starting_time" class="form-label">Starting date</label>
                                <input id="starting_time" type="text" value="{{ get_system_date($model->stating_time) }}" class="form-control" name="starting_time">
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="deadline_type">Deadline Type</label>
                                <select name="deadline_type" id="deadline_type" class="form-control select" data-placeholder="Select one">
                                    <option value="">Select one</option>
                                    <option {{ $model->deadline_type == 'minute' ? 'selected' : '' }} value="minute">Minute</option>
                                    <option {{ $model->deadline_type == 'hour' ? 'selected' : '' }} value="hour">Hour</option>
                                    <option {{ $model->deadline_type == 'day' ? 'selected' : '' }} value="day">Day</option>
                                    <option {{ $model->deadline_type == 'week' ? 'selected' : '' }} value="week">Week</option>
                                    <option {{ $model->deadline_type == 'month' ? 'selected' : '' }} value="month">Month</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="deadline_time">Dealline time <span class="text-danger">*</span></label>
                                <input type="number" name="deadline_time" id="deadline_time" class="form-control" value="{{ $model->deadline_time }}">
                            </div>
                            
                            <div class="col-md-12 mb-3 form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control dropify" data-default-file="{{ $model->image ? asset($model->image) : '' }}">
                            </div>

                            @include('backend.components.descriptionInput', ['description' => $model->description ?? ''])

                            <div class="col-md-12 mb-3 form-group">
                                <label for="product_id">Products </label>
                                <select multiple name="product_id[]" id="product_id" class="form-control">
                                    @foreach ($pp as $item)
                                        <option data-image="{{ asset($item->thumb_image) }}" value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">For selecting multiple product at a time, use your keyboard <b>Control</b> key and click on the products that you want to add. </small>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0">SEO Meta Tags</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <!-- site_title -->
                            <div class="col-md-12 form-group mb-3">
                                <label for="site_title">Site title </label>
                                <input type="text" value="{{ $model->site_title }}" name="site_title" id="site_title" class="form-control">
                            </div>

                            <!-- meta_title -->
                            <div class="col-md-12 form-group mb-3">
                                <label for="meta_title">Meta title </label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control" value="{{ $model->meta_title }}">
                            </div>

                            <!-- meta_keyword -->
                            <div class="col-md-12 form-group mb-3">
                                <label for="meta_keyword">Meta keyword</label>
                                <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="4" class="form-control">{{ $model->meta_keyword }}</textarea>
                            </div>

                            <!-- meta_description -->
                            <div class="col-md-12 form-group mb-3">
                                <label for="meta_description">Meta description</label>
                                <textarea name="meta_description" id="meta_description" cols="30" rows="4" class="form-control">{{ $model->meta_description }}</textarea>
                            </div>

                            <!-- meta_article_tag -->
                            <div class="col-md-12 form-group mb-3">
                                <label for="meta_article_tag">Meta article tag</label>
                                <textarea name="meta_article_tag" id="meta_article_tag" cols="30" rows="4" class="form-control">{{ $model->meta_article_tag }}</textarea>
                            </div>

                            <!-- meta_script_tag -->
                            <div class="col-md-12 form-group">
                                <label for="meta_script_tag">Meta script tag</label>
                                <textarea name="meta_script_tag" id="meta_script_tag" cols="30" rows="4" class="form-control">{{ $model->meta_script_tag }}</textarea>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-group mb-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0">Product Information</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <div class="alert alert-danger">If any product has discount or exists in another flash deal, the discount will be replaced by this discount & time limit.</div>
                            </div>

                            <div class="col-md-12 product_area mb-3 table-responsive">
                                @if ($products)
                                    <table class="table table-borderd table-hover">
                                        <thead>
                                            <th>Product</th>
                                            <th>Base Price</th>
                                            <th>Discount</th>
                                            <th>Discount Type</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                {!! App\CPU\Images::show($product->product->thumb_image) !!}
                                                            </div>
                                                            <div class="col">
                                                                {{ $product->product->name }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $product->product->unit_price }}
                                                    </td>
                                                    <td>
                                                        <input type="number" name="discount[]" value="{{ $product->discount_amount }}" id="discount_{{ $product->id }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <select name="discount_type[]" id="discount_type_{{ $product->id }}" class="form-control">
                                                            <option {{ $product->discount_type == 'amount' ? 'selected' : '' }} value="amount">Flat</option>
                                                            <option {{ $product->discount_type == 'percentage' ? 'selected' : '' }} value="percentage">Percent</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 form-group">
                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('stuff.create')) --}}
                    <button type="submit" class="btn btn-soft-success"  id="submit">
                        <i class="bi bi-send"></i>
                        Update
                    </button>
                    <button class="btn btn-soft-warning" style="display: none;" id="submitting" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                {{-- @endif --}}
                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('stuff.view')) --}}
                    <a href="{{ route('admin.flash-deal.index') }}" class="btn btn-soft-danger">
                        <i class="bi bi-backspace"></i>
                        Back
                    </a>
                {{-- @endif --}}
            </div>
        </div>
    </form>
@endsection
@push('script')
    <script src="{{ asset('backend/assets/js/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/tempus-dominus.min.js') }}"></script>

    <script>
        _formValidation();
        _initCkEditor("editor");
        _componentSelect();

        function formatProduct(option) {
            if (!option.id) {
                return option.text;
            }
            var imageUrl = $(option.element).data('image');
            var productHtml = '<img src="' + imageUrl + '" style="width: 40px; height: 40px; margin-right: 10px;" />' + option.text;
            return $(productHtml);
        }

        $('#product_id').select2({
            templateResult: formatProduct,
            templateSelection: formatProduct,
            escapeMarkup: function(m) { return m; }  // allow HTML in the dropdown
        });

        $('.dropify').dropify();

        const element = document.getElementById('starting_time');
        const input = document.getElementById('starting_time');
        const picker = new tempusDominus.TempusDominus(element, {
            defaultDate: new Date(), // Set today's date as default
            display: {
                components: {
                    calendar: true,
                    date: true,
                    month: true,
                    year: true,
                    decades: true,
                    clock: false // Disable the time selection
                }
            }
        });

        // Event listener to update the input value when the date changes
        element.addEventListener('change.td', (e) => {
            const selectedDate = picker.dates.formatInput(e.detail.date); // Get the selected date
            console.log(selectedDate);
            input.value = selectedDate; // Set it to the input field
        });

        function generateSlug(name) {
            return name
                .toString()
                .toLowerCase()
                .trim()
                .replace(/&/g, '-and-')
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-') 
                .replace(/-+/g, '-');
        }

        $('#name').on('input', function() {
            const name = $(this).val();
            const slug = generateSlug(name);
            $('#slug').val(slug);

            // Check if the slug exists
            $.ajax({
                url: '{{ route('admin.slug.check') }}',
                type: 'GET',
                data: {
                    slug: slug,
                    id: '{{ $model->id }}',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.exists) {
                        const timestamp = Date.now();
                        $('#slug').val(slug + '-' + timestamp);
                    }
                }
            });
        });

        $(document).on('change', '#product_id', function() {
            let value = $(this).val();
            $('.product-area').html("");
            $('.product_area').html(`
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `);
            $.ajax({
                url: '/search/product-data',
                method: 'POST',
                data: {
                    data: value
                },
                dataType: 'JSON',
                cache: true,
                success: function(data) {
                    let content = `
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th>Product</th>
                                <th>Base Price</th>
                                <th>Discount</th>
                                <th>Discount Type</th>
                            </thead>
                            <tbody>
                    `;

                    $.each(data, function(index, product) {
                        var row = '<tr><td><div class="row"><div class="col-auto"><img src="' + product.thumb_image + '" alt="' + product.name + ' ' + index + '" width="50"></div><div class="col">' + product.name + '</div></div></td><td>' + product.unit_price + '</td><td><input type="number" name="discount[]" value="0" id="discount_`+ index +`" class="form-control"></td><td><select name="discount_type[]" id="discount_type_'+ index +'" class="form-control"><option value="amount">Flat</option><option value="percentage">Percent</option></select></td></tr>';
                        content = content.concat(row);
                    });
                                
                    footer = `
                            </tbody>
                        </table>
                    `;
                    content = content.concat(footer);

                    $('.product_area').html("");
                    $('.product_area').html(content);
                }
            })
        })

        // for categories
        $('#product_id').select2({
            width: '100%',
            placeholder: 'Select products',
            templateResult: formatProductOption, 
            templateSelection: formatProductSelection,
            ajax: {
                url: '/search/product',
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


        function formatProductOption(product) {
            if (!product.id) {
                return product.text;
            }

            var productImage = '<img src="' + product.image_url + '" class="img-flag" style="height: 20px; width: 20px; margin-right: 10px;" />';
            var productOption = $('<span>' + productImage + product.text + '</span>');
            return productOption;
        }

        function formatProductSelection(product) {
            if (!product.id) {
                return product.text;
            }

            var productImage = '<img src="' + product.image_url + '" class="img-flag" style="height: 20px; width: 20px; margin-right: 10px;" />';
            return $('<span>' + productImage + product.text + '</span>');
        }
    </script>
@endpush