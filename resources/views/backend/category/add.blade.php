@extends('backend.layouts.app')
@section('title', 'Category Add')
{{-- @section('page_name', 'Category Add') --}}
@section('breadcrumb', 'Category Add')

@section('content')
    <div class="row">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="h3 mb-0">Add Category</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-house-add-fill"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Category Add</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="card card-primary card-outline mb-4">
                <div class="card-body">
                    <div>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form id="categoryForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="icon" class="form-label">Icon</label>
                                    <input type="text" name="icon" class="form-control iconpicker" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="header" class="form-label">Header</label>
                                    <input type="text" name="header" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="site_title" class="form-label">Site Title</label>
                                    <input type="text" name="site_title" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="5" required></textarea>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" required>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="meta_keyword" class="form-label">Meta Keyword <span class="text-danger"> Use
                                            Comma ","</span></label>
                                    <input type="text" name="meta_keyword" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea name="meta_description" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="meta_article_tag" class="form-label">Meta Article Tag <span
                                            class="text-danger"> Use Comma ","</span></label>
                                    <input type="text" name="meta_article_tag" class="form-control">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="meta_script_tag" class="form-label">Meta Script Tag <span
                                            class="text-danger"> Use Comma ","</span></label>
                                    <input type="text" name="meta_script_tag" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="is_featured" class="form-label">Is Featured?</label>
                                    <select name="is_featured" class="form-select" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="uploadOuter mb-3">
                                <label for="uploadFile" class="btn btn-primary form-label">Upload Image</label>
                                <strong>OR</strong>
                                <span class="dragBox">
                                    Drag and Drop image here
                                    <input type="file" name="photo" id="uploadFile" />
                                </span>
                            </div>
                            <div id="preview">
                                <img id="imagePreview" alt="Image Preview" style="max-width: 50%; display: none;">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('styleforIconPicker')
    <link href="{{ asset('backend/assets/css/bootstrapicons-iconpicker.css') }}" rel="stylesheet">
@endpush

@push('style')
    <style>
        .uploadOuter {
            text-align: center;
            padding: 20px;

            strong {
                padding: 0 10px
            }
        }

        .dragBox {
            width: 250px;
            height: 100px;
            margin: 0 auto;
            position: relative;
            text-align: center;
            font-weight: bold;
            line-height: 95px;
            color: #999;
            border: 2px dashed #ccc;
            display: inline-block;
            transition: transform 0.3s;

            input[type="file"] {
                position: absolute;
                height: 100%;
                width: 100%;
                opacity: 0;
                top: 0;
                left: 0;
            }
        }

        .draging {
            transform: scale(1.1);
        }

        #preview {
            text-align: center;

            img {
                max-width: 100%
            }
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('backend/assets/js/bootstrapicon-iconpicker.js') }}"></script>
    <script>
        $(function() {
            $('.iconpicker').iconpicker();
        });
    </script>
    <script>
        $(document).ready(function() {
            // Handle file upload preview
            $('#uploadFile').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        $('#imagePreview').attr('src', event.target.result).show();
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle form submission
            $('#categoryForm').on('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: '{{ route('admin.category.store') }}',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Handle success response
                        alert(response.message);
                        $('#categoryForm')[0].reset();
                        $('#imagePreview').hide();
                    },
                    error: function(xhr) {
                        // Handle error response
                        const errors = xhr.responseJSON.errors;
                        for (const key in errors) {
                            alert(errors[key].join(', '));
                        }
                    }
                });
            });
        });
    </script>

    <script>
        "use strict";

        function dragNdrop(event) {
            var fileName = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview");
            var previewImg = document.createElement("img");
            previewImg.setAttribute("src", fileName);
            preview.innerHTML = "";
            preview.appendChild(previewImg);
        }

        function drag() {
            document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
        }

        function drop() {
            document.getElementById('uploadFile').parentNode.className = 'dragBox';
        }
    </script>
@endpush
