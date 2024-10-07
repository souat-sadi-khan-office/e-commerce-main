@extends('backend.layouts.app')
@section('title', 'Product Management')
@push('style')
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush
@section('page_name')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">Product List</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-house-add-fill"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Product Management</li>
                    </ol>
                </div>

                {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('brand.create')) --}}
                    <div class="col-sm-6 text-end">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-soft-success">
                            <i class="bi bi-plus"></i>
                            Create New
                        </a>
                    </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="data-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Added By</th>
                                <th>Info</th>
                                <th>Total Stock</th>
                                <th>Publish</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>

        $(function () {
        
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.product.index') }}",
                columns: [
                    {data: 'product_name', name: 'product_name'},
                    {data: 'created_by', name: 'added_by'},
                    {data: 'info', name: 'info'},
                    {data: 'stock', name: 'stock'},
                    {data: 'status', name: 'status'},
                    {data: 'featured', name: 'featured'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

            _statusUpdate();

            // For duplicate items
            $(document).on('click', '#duplicate_item', function(e) {
                e.preventDefault();
                var row = $(this).data('id');
                var url = $(this).data('url');
                Swal.fire({
                    title: 'Duplicate Product?',
                    icon: 'warning',
                    html: `
                        <p>It will create the same product. Check items that will copy: </p>
                        <table class="table table-bordered">
                            <tr>
                                <th>
                                    Modules
                                </th>
                                <th>
                                    Selection
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    Product Taxes
                                </td>
                                <td class="text-center">
                                    <div class="text-center form-check form-switch">
                                        <input checked class="form-check-input" type="checkbox" role="switch" id="product_taxes">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Product Stock Purchase
                                </td>
                                <td>
                                    <div class="text-center form-check form-switch">
                                        <input checked class="form-check-input" type="checkbox" role="switch" id="stock_purchase">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Product Images
                                </td>
                                <td>
                                    <div class="text-center form-check form-switch">
                                        <input checked class="form-check-input" type="checkbox" role="switch" id="product_images">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Product Specifications
                                </td>
                                <td>
                                    <div class="text-center form-check form-switch">
                                        <input checked class="form-check-input" type="checkbox" role="switch" id="product_specifications">
                                    </div>
                                </td>
                            </tr>
                        </table>' +
                    `,

                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, duplicate',
                    cancelButtonText: 'No, cancel',
                    preConfirm: () => {
                        var product_taxes = Swal.getPopup().querySelector('#product_taxes').checked  
                        var stock_purchase = Swal.getPopup().querySelector('#stock_purchase').checked  
                        var product_images = Swal.getPopup().querySelector('#product_images').checked  
                        var product_specifications = Swal.getPopup().querySelector('#product_specifications').checked  
            
                        return {
                            product_taxes: product_taxes, 
                            stock_purchase: stock_purchase,
                            product_images: product_images,
                            product_specifications: product_specifications,
                        }
                    }
                }).then((result) => {
                    let formData = new FormData();
                    formData.append('stock_purchase', result.value.stock_purchase);
                    formData.append('product_taxes', result.value.product_taxes);
                    formData.append('product_images', result.value.product_images);
                    formData.append('product_specifications', result.value.product_specifications);

                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            contentType: false,
                            data: formData,
                            cache: false,
                            processData: false,
                            dataType: 'JSON',
                            success: function(data) {

                                if (data.status) {

                                    toastr.success(data.message);
                                    if (data.load) {
                                        setTimeout(function() {
                                            window.location.href = "";
                                        }, 1000);
                                    }

                                } else {
                                    toastr.warning(data.message);
                                }
                            },
                            error: function(data) {
                                var jsonValue = $.parseJSON(data.responseText);
                                const errors = jsonValue.errors
                                var i = 0;
                                $.each(errors, function(key, value) {
                                    toastr.error(value);
                                    i++;
                                });
                            }
                        });
                    }
                });
            });
            
        });
    </script>
@endpush