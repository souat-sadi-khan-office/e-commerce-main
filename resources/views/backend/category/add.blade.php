@extends('backend.layouts.app')
@section('title', 'Category Add')
@section('page_name', 'Category Add')
@section('breadcrumb', 'Category Add')

@section('content')
    <div class="row">
        <div class="app-content">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <h4>Create Category</h4>
                </div>
                <div class="card-body">
                    <livewire:category-form />

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
        }

        .draging {
            transform: scale(1);
        }

        #preview {
            text-align: center;
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
@endpush
