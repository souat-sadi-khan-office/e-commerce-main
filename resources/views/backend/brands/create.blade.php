@extends('backend.layouts.app')
@section('title', 'Create new Brand')
@section('page_name')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">Create new Brand</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-add-fill"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.stuff.index') }}">Brand Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create new Brand</li>
                    </ol>
                </div>

                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('brand.view')) --}}
                    <div class="col-sm-6 text-end">
                        <a href="{{ route('admin.brand.index') }}" class="btn btn-soft-danger">
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
@endpush
@section('content')
    <div class="row">
        <div class="col-md-7 mx-auto">
            <form action="{{ route('admin.brand.store') }}" enctype="multipart/form-data" class="content_form" method="post">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3 form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter Brand Name" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="col-md-12 mb-3 form-group">
                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                <input type="text" name="slug" id="slug" class="form-control" required>
                            </div>
                    
                            <div class="col-md-12 mb-3 form-group">
                                <label for="logo">Logo <span class="text-danger">*</span></label>
                                <input type="file" accept=".jpg, .png, .webp"  name="logo" id="logo" class="form-control dropify" required>
                                <span class="text-danger">Logo size is <b>185 X 55</b> pixrl. Please use <b>.WEBP</b> format picture for better performance.</span>
                            </div>

                            <div class="col-md-12 mb-3 form-group">
                                <label for="description">Description <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12 mb-3 form-group">
                                <label for="meta_tile">Meta Title <span class="text-danger">*</span></label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control" required placeholder="Enter your Meta Title">
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="meta_keyword">Meta Keyword</label>
                                <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="4" class="form-control" placeholder="Enter your SEO Meta Keyword"></textarea>
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="meta_keyword">Meta Description <span class="text-danger">*</span></label>
                                <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="4" class="form-control" placeholder="Enter your SEO Meta Description" required></textarea>
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="meta_article_tag">Meta Article Tag</label>
                                <textarea name="meta_article_tag" id="meta_article_tag" cols="30" rows="4" class="form-control" placeholder="Enter your SEO Meta Article Scripts"></textarea>
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="meta_script_tag">Meta Script Tag</label>
                                <textarea name="meta_script_tag" id="meta_script_tag" cols="30" rows="4" class="form-control" placeholder="Enter your SEO Meta Scripts"></textarea>
                            </div>
                    
                            <div class="col-md-12 form-group">
                                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('stuff.create')) --}}
                                    <button type="submit" class="btn btn-soft-success"  id="submit">
                                        <i class="bi bi-send"></i>
                                        Create & Back to Listing
                                    </button>
                                {{-- @endif --}}
                                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('stuff.view')) --}}
                                    <a href="{{ route('admin.stuff.index') }}" class="btn btn-soft-danger">
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
        _formValidation();

        $('.dropify').dropify();
        
        $(document).on('keyup', '#name', function() {
            let value = $(this).val();
            let slug = _slugify(value);
            $('#slug').val(slug);
        })
    </script>
@endpush