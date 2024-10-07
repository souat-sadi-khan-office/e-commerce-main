@extends('backend.layouts.app')
@section('title', 'Update Banner Information')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dropify.min.css') }}">
@endpush
@section('page_name')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">Update Banner Information</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-add-fill"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.banner.index') }}">Banner Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Banner Information</li>
                    </ol>
                </div>

                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('brand.view')) --}}
                    <div class="col-sm-6 text-end">
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-soft-danger">
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
        <div class="col-md-7 mx-auto">
            <form action="{{ route('admin.banner.update', $model->id) }}" enctype="multipart/form-data" class="content_form" method="POST">
                @method('PATCH')
                <div class="card">
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-12 mb-3 form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter Brand Name" name="name" id="name" class="form-control" required value="{{ $model->name }}">
                            </div>

                            <div class="col-md-12 form-group mb-3">
                                <label for="banner_type">Banner type <span class="text-danger">*</span></label>
                                <select name="banner_type" id="banner_type" class="form-control select">
                                    <option {{ $model->banner_type == 'main' ? 'selected' : '' }} value="main">Main Banner</option>
                                    <option {{ $model->banner_type == 'main_sidebar' ? 'selected' : '' }} value="main_sidebar">Main Sidebar Banner</option>
                                    <option {{ $model->banner_type == 'Mid' ? 'selected' : '' }} value="Mid">Mid Website Banner</option>
                                    <option {{ $model->banner_type == 'Footer' ? 'selected' : '' }} value="Footer">Footer Banner</option>
                                </select>
                            </div>
                    
                            <div class="col-md-12 mb-3 form-group">
                                <label for="image">Image <span class="text-danger">*</span></label>
                                <input type="file" accept=".jpg, .png, .webp"  name="image" id="image" class="form-control dropify" data-default-file="{{ asset($model->image) }}">
                                <span class="text-danger">Image size is <b>825 X 550</b> or <b>250 X 355</b> pixrl. Please use <b>.WEBP</b> format picture for better performance.</span>
                            </div>

                            <div class="col-md-12 form-group mb-3">
                                <label for="alt_tag">Image Alter Tag</label>
                                <input type="text" value="{{ $model->alt_tag}}" name="alt_tag" id="alt_tag" class="form-control">
                            </div>

                            <div class="col-md-12 form-group mb-3">
                                <label for="link">Link</label>
                                <input type="url" name="link" id="link" placeholder="starts with https:// or http://" class="form-control" value="{{ $model->link }}">
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control select" required>
                                    <option {{ $model->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $model->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
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
                                    <a href="{{ route('admin.banner.index') }}" class="btn btn-soft-danger">
                                        <i class="bi bi-backspace"></i>
                                        Back
                                    </a>
                                {{-- @endif --}}
                            </div>
                    
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('backend/assets/js/dropify.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            _formValidation();
            _componentSelect();

            $('.dropify').dropify({
                imgFileExtensions: ['png', 'jpg', 'jpeg', 'gif', 'bmp', 'webp']
            });
        })
    </script>
@endpush