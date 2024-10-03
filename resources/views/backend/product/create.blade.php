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
                                Product Managment
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create new product</li>
                    </ol>
                </div>

                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('zone.create')) --}}
                    <div class="col-sm-6 text-end">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-soft-danger">
                            <i class="bi bi-backspace"></i>
                            Back
                        </a>
                    </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-7">
            <div class="card mb-4">
                <div class="card-header">
                    <h1 class="h5 mb-0">Product Information</h1>
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
                            <select name="category_id" id="category_id" class="form-control"></select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="row">
                
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('backend/assets/js/dropify.min.js') }}"></script>
    <script>
        _componentSelect();
        _formValidation();

        // for categories
        $('#category_id').select2({
            width: '100%',
            placeholder: 'Select category',
            ajax: {
                url: '/search/category',
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
    </script>
@endpush