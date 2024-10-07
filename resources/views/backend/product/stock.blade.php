@extends('backend.layouts.app')
@section('title', 'Stock management')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dropify.min.css') }}">
@endpush

@section('page_name')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">Stock Management</h1>
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
                        <li class="breadcrumb-item active" aria-current="page">Stock Management</li>
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
   
    <form action="{{ route('admin.product.store')}}" method="POST" class="content_form" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>#</th>
                        <th>Added By</th>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Purchase Unit Price</th>
                        <th>Purchase Total Price</th>
                        <th>Sellable</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @if ($model->purchase)
                            @foreach ($model->purchase as $key => $purchase)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $purchase->admin->name }}</td>
                                    <td>{{ get_system_date($purchase->created_at) . ' '. get_system_time($purchase->created_at) }}</td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td>{{ $purchase->purchase_unit_price }}</td>
                                    <td>{{ $purchase->purchase_total_price }}</td>
                                    <td>
                                        
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center"><b>Nothing to show</b></td>
                            </tr>
                        @endif
                    </tbody>
                </table>                
            </div>
    
            <div class="col-md-5">
                <div class="row">
    
                    <!-- Product Costing & Pricing -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Product Cost & Pricing </h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- unit_price -->
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="unit_price">Unit Price <span class="text-danger">*</span></label>
                                        <input type="text" name="unit_price" id="unit_price" class="form-control number" value="0" required >
                                    </div>

                                    <!-- quanitiy -->
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                        <input type="text" name="quantity" id="quantity" class="form-control number" value="0" required>
                                        <small class="text-muted">Product quanity must be same on the product stock adding table.</small>
                                    </div>

                                    <!-- sku -->
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="sku">SKU</label>
                                        <input type="text" name="sku" id="sku" class="form-control">
                                    </div>

                                    <!-- total_price -->
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="total_price">Total Price <span class="text-danger">*</span></label>
                                        <input type="text" name="total_price" id="total_price" class="form-control" value="0" required>
                                        <small class="text-muted">Total Price = Unit Price X Quantity</small>
                                    </div>

                                    <!-- purchase_price -->
                                    <div class="col-md-12 form-goup mb-3">
                                        <label for="purchase_price">Purchase Price </label>
                                        <input type="text" name="purchase_price" id="purchase_price" class="form-control number" value="0" >
                                        <small class="text-muted">This is the product purchase price from sellter.</small>
                                    </div>

                                    <!-- currency_id -->
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="currency_id">Currency</label>
                                        <select name="currency_id" id="currency_id" class="form-control select">
                                            @foreach ($currencies as $currency)
                                                <option {{ get_settings('system_default_currency') == $currency->id ? 'selected' : '' }} value="{{ $currency->id }}">{{ $currency->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- file -->
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="file">File </label>
                                        <input type="file" name="file" id="file" class="form-control">
                                    </div>

                                    <!-- is_selleable -->
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="is_selleable">Is sellable</label>
                                        <select name="is_sellable" id="is_sellable" class="form-contom select">
                                            <option selected value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Stocks -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0">Product Stocks </h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <div class="alert alert-warning">
                                            <b>Warning</b>: Here product stock must be the same quanity as on the <b>Product costing</b> quanity.
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3 form-group">
                                        <label for="stock_type">Stock Types <span class="text-danger">*</span></label>
                                        <select name="stock_types" id="stock_types" class="form-control select">
                                            <option selected value="globally">Globally</option>
                                            <option value="zone_wise">Zone wise</option>
                                            <option value="country_wise">Country wise</option>
                                            <option value="city_wise">City Wise</option>
                                        </select>
                                    </div>

                                    <!-- globally_area -->
                                    <div id="globally_area">
                                        <div class="col-md-12 form-group mb-3">
                                            <label for="globally_stock_amount">Total in Stock <spna class="text-danger">*</spna></label>
                                            <input type="text" class="form-control number" name="globally_stock_amount" id="globally_stock_amount" required value="0">
                                        </div>
                                    </div>

                                    <!-- zone_wise_area -->
                                    <div id="zone_wise_area" style="display: none">
                                        <div class="col-md-12 form-group mb-3">
                                            <label for="zone_wise_id">Zones <span class="text-danger">*</span></label>
                                            <select id="zone_wise_id" class="form-control select" data-placeholder="Select zones">
                                                <option value="">Select zones</option>
                                                @foreach ($zones as $zone)
                                                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="zone_wise_data"></div>
                                    </div>

                                    <!-- country_wise_area -->
                                    <div id="country_wise_area" style="display: none;">
                                        <div class="col-md-12 form-group mb-3">
                                            <label for="country_wise_id">Countries <span class="text-danger">*</span></label>
                                            <select name="country_wise_id[]" id="country_wise_id" class="form-control select" data-placeholder="Select countries">
                                                <option value="">Select countries</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="country_wise_data"></div>
                                    </div>

                                    <!-- city_wise_area -->
                                    <div style="display:none;" id="city_wise_area">
                                        <div class="col-md-12 form-group mb-3">
                                            <label for="city_wise_id">Cities <span class="text-danger">*</span></label>
                                            <select name="city_wise_id[]" id="city_wise_id" class="form-control select" data-placeholder="Select cities">
                                                <option value="">Select cities</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div id="city_wise_data"></div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="col-md-12 form-group mb-3 text-end">
                <button class="btn btn-soft-success" type="submit" id="submit">
                    <i class="bi bi-send"></i>
                    Update
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

        $(document).on('change', '#stock_types', function() {
            let stock_type = $(this).val();
            switch(stock_type) {
                case 'globally':
                    $('#globally_area').show();
                    $('#globally_stock_amount').attr('required', true);

                    $('#zone_wise_area').hide();
                    $('#zone_wise_data').html("");

                    $('#country_wise_area').hide();
                    $('#country_wise_data').html("");

                    $('#city_wise_area').hide();
                    $('#city_wise_data').html("");
                break;
                case 'zone_wise':
                    $('#globally_area').hide();
                    $('#globally_stock_amount').removeAttr('required');

                    $('#zone_wise_area').show();

                    $('#country_wise_area').hide();
                    $('#country_wise_data').html("");

                    $('#city_wise_area').hide();
                    $('#city_wise_data').html("");
                break;
                case 'country_wise': 
                    $('#globally_area').hide();
                    $('#globally_stock_amount').removeAttr('required');

                    $('#zone_wise_area').hide();
                    $('#zone_wise_data').html("");

                    $('#country_wise_area').show();

                    $('#city_wise_area').hide();
                    $('#city_wise_data').html("");
                break;
                case 'city_wise': 
                    $('#globally_area').hide();
                    $('#globally_stock_amount').removeAttr('required');

                    $('#zone_wise_area').hide();
                    $('#zone_wise_data').html("");
                    
                    $('#country_wise_area').hide();
                    $('#country_wise_data').html("");

                    $('#city_wise_area').show();
                break;
            }
        });

        $(document).on('change', '#zone_wise_id', function() {
            let zone_id = $(this).val();
            $('#zone_wise_id option').filter(function() {
                return $(this).val() == zone_id;
            }).remove();

            $.ajax({
                url: '/admin/get-zone-information-by-id',
                method: 'POST',
                data: {
                    zone_id: zone_id
                },
                dataType: 'JSON',
                cache: true,
                success: function(data) {
                    var randomNumber = Math.floor(Math.random() * (1000000 - 100000)) + 100000;
                    let content = `
                        <div class="row" id="zone_wise_item_`+ randomNumber +`">
                            <div class="col-md-6 form-group mb-3">
                                <label for="zone_id">Zone <span class="text-danger">*</span></label>
                                <input type="hidden" name="zone_id[]"  value="`+ data.id +`">
                                <input type="text" id="zone_id" disabled class="form-control" value="`+ data.name +`">
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="zone_wise_stock_quantity">Quantity</label>
                                <input type="text" name="zone_wise_stock_quantity[]" id="zone_wise_stock_quanity" class="form-control" required value="0">
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <button type="button" style="margin-top: 25px;" class="btn btn-sm btn-soft-danger remove_zone_item" data-id="`+ randomNumber +`">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;

                    $('#zone_wise_data').append(content);
                }
            })
        });

        $(document).on('click', '.remove_zone_item', function() {
            let id = $(this).data('id');
            $('#zone_wise_item_'+id).remove();
        });

        $(document).on('change', '#country_wise_id', function() {
            let country_id = $(this).val();
            $('#country_wise_id option').filter(function() {
                return $(this).val() == country_id;
            }).remove();

            $.ajax({
                url: '/admin/get-country-information-by-id',
                method: 'POST',
                data: {
                    country_id: country_id
                },
                dataType: 'JSON',
                cache: true,
                success: function(data) {
                    var randomNumber = Math.floor(Math.random() * (1000000 - 100000)) + 100000;
                    let content = `
                        <div class="row" id="country_wise_item_`+ randomNumber +`">
                            <div class="col-md-6 form-group mb-3">
                                <label for="country_id">Country <span class="text-danger">*</span></label>
                                <input type="hidden" name="country_id[]"  value="`+ data.id +`">
                                <input type="text" id="country_id" disabled class="form-control" value="`+ data.name +`">
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="country_wise_quantity">Quantity</label>
                                <input type="text" name="country_wise_quantity[]" value="0" id="country_wise_quantity" class="form-control" required>
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <button type="button" style="margin-top: 25px;" class="btn btn-sm btn-soft-danger remove_country_item" data-id="`+ randomNumber +`">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;

                    $('#country_wise_data').append(content);
                }
            })
        });

        $(document).on('click', '.remove_country_item', function() {
            let id = $(this).data('id');
            $('#country_wise_item_'+id).remove();
        });

        $(document).on('change', '#city_wise_id', function() {
            let city_id = $(this).val();
            $('#city_wise_id option').filter(function() {
                return $(this).val() == city_id;
            }).remove();

            $.ajax({
                url: '/admin/get-city-information-by-id',
                method: 'POST',
                data: {
                    city_id: city_id
                },
                dataType: 'JSON',
                cache: true,
                success: function(data) {
                    var randomNumber = Math.floor(Math.random() * (1000000 - 100000)) + 100000;
                    let content = `
                        <div class="row" id="city_wise_item_`+ randomNumber +`">
                            <div class="col-md-6 form-group mb-3">
                                <label for="city_id">City <span class="text-danger">*</span></label>
                                <input type="hidden" name="city_id[]"  value="`+ data.id +`">
                                <input type="text" id="city_id" disabled class="form-control" value="`+ data.name +`">
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="city_wise_quantity">Quantity</label>
                                <input type="text" name="city_wise_quantity[]" id="city_wise_quantity" class="form-control" value="0">
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <button type="button" style="margin-top: 25px;" class="btn btn-sm btn-soft-danger remove_city_item" data-id="`+ randomNumber +`">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    `;

                    $('#city_wise_data').append(content);
                }
            })
        });

        $(document).on('click', '.remove_city_item', function() {
            let id = $(this).data('id');
            $('#city_wise_item_'+id).remove();
        });

        $(document).on('keyup', '#unit_price', function() {
            let unit_price = parseInt($(this).val());
            let quantity = parseInt($('#quantity').val());
            let total_price = unit_price * quantity;

            $('#total_price').val(total_price);
        })

        $(document).on('keyup', '#quantity', function() {
            let quantity = parseInt($(this).val());
            let unit_price = parseInt($('#unit_price').val());
            let total_price = unit_price * quantity;

            $('#total_price').val(total_price);
        })
    </script>
@endpush
