@extends('backend.layouts.app')
@section('title', 'Update Page Information')
@push('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dropify.min.css') }}">
@endpush
@section('page_name')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">Update Page Information</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-add-fill"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.page.index') }}">Page Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Page Information</li>
                    </ol>
                </div>

                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('brand.view')) --}}
                    <div class="col-sm-6 text-end">
                        <a href="{{ route('admin.page.index') }}" class="btn btn-soft-danger">
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
            <form action="{{ route('admin.page.update', $model->id) }}" enctype="multipart/form-data" class="content_form" method="POST">
                @method('PATCH')
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3 form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Enter Brand Name" name="name" id="name" class="form-control" required value="{{ $model->name }}">
                            </div>

                            <div class="col-md-12 mb-3 form-group">
                                <label for="slug">Slug <span class="text-danger">*</span></label>
                                <input type="text" name="slug" id="slug" class="form-control" required value="{{ $model->slug }}">
                            </div>

                            <div class="col-md-12 mb-3 form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control select" required>
                                    <option {{ $model->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                    <option {{ $model->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                </select>
                            </div>

                            @include('backend.components.descriptionInput', ['description' => $model->description ?? ''])

                            <div class="col-md-12 mb-3 form-group">
                                <label for="meta_tile">Meta Title <span class="text-danger">*</span></label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control" required placeholder="Enter your Meta Title" value="{{ $model->meta_title }}">
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="meta_keyword">Meta Keyword</label>
                                <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="4" class="form-control" placeholder="Enter your SEO Meta Keyword">{{ $model->meta_keyword }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="meta_description">Meta Description <span class="text-danger">*</span></label>
                                <textarea name="meta_description" id="meta_description" cols="30" rows="4" class="form-control" placeholder="Enter your SEO Meta Description" required>{{ $model->meta_description }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="meta_article_tag">Meta Article Tag</label>
                                <textarea name="meta_article_tag" id="meta_article_tag" cols="30" rows="4" class="form-control" placeholder="Enter your SEO Meta Article Scripts">{{ $model->meta_article_tag }}</textarea>
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                <label for="meta_script_tag">Meta Script Tag</label>
                                <textarea name="meta_script_tag" id="meta_script_tag" cols="30" rows="4" class="form-control" placeholder="Enter your SEO Meta Scripts">{{ $model->meta_script_tag }}</textarea>
                            </div>

                            <div class="col-md-12 mb-3 form-group">
                                <label for="meta_image">Logo </label>
                                <input type="file" accept=".jpg, .png, .webp"  name="meta_image" id="meta_image" class="form-control dropify" data-default-file="{{ $model->meta_image ? asset($model->meta_image) : '' }}">
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
                                    <a href="{{ route('admin.page.index') }}" class="btn btn-soft-danger">
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
        _initCkEditor("editor");
        _componentSelect();

        $('.dropify').dropify();
        
        $(document).on('keyup', '#name', function() {
            let value = $(this).val();
            let slug = _slugify(value);
            $('#slug').val(slug);
        })
    </script>
@endpush