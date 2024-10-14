@extends('frontend.layouts.app')
@section('title', 'Login ', get_settings('system_name'))

@push('breadcrumb')
<div class="breadcrumb_section page-title-mini">
    <div class="custom-container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <i class="linearicons-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            Account
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        My Wish List
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endpush

@section('content')
<div class="section bg_gray">
	<div class="custom-container">
        <div class="row">
            @include('frontend.customer.partials.sidebar')
            <div class="col-lg-9 col-md-8 dashboard_content">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        @include('frontend.customer.partials.header')
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="h5">My Wish List</h1>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive wishlist_table">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-thumbnail">&nbsp;</th>
                                                        <th class="product-name">Product</th>
                                                        <th class="product-price">Price</th>
                                                        <th class="product-stock-status">Stock Status</th>
                                                        <th class="product-add-to-cart"></th>
                                                        <th class="product-remove">Remove</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="product-thumbnail"><a href="#"><img style="max-width:80px;" src="https://www.startech.com.bd/image/cache/catalog/processor/Intel/core-i5-14600k/core-i5-14600k-01-500x500.webp" alt="product1"></a></td>
                                                        <td class="product-name" data-title="Product"><a href="#">Blue Dress For Woman</a></td>
                                                        <td class="product-price" data-title="Price">$45.00</td>
                                                          <td class="product-stock-status" data-title="Stock Status"><span class="badge rounded-pill text-bg-success">In Stock</span></td>
                                                        <td class="product-add-to-cart"><a href="#" class="btn btn-sm btn-fill-out"><i class="icon-basket-loaded"></i> Add to Cart</a></td>
                                                        <td class="product-remove" data-title="Remove"><a href="#"><i class="ti-close"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="product-thumbnail"><a href="#"><img style="max-width:80px;" src="https://www.startech.com.bd/image/cache/catalog/processor/amd/ryzen-5-5600g/ryzen-5-5600g-500x500.jpg" alt="product2"></a></td>
                                                        <td class="product-name" data-title="Product"><a href="#">Lether Gray Tuxedo</a></td>
                                                        <td class="product-price" data-title="Price">$55.00</td>
                                                          <td class="product-stock-status" data-title="Stock Status"><span class="badge rounded-pill text-bg-success">In Stock</span></td>
                                                        <td class="product-add-to-cart"><a href="#" class="btn btn-sm btn-fill-out"><i class="icon-basket-loaded"></i> Add to Cart</a></td>
                                                        <td class="product-remove" data-title="Remove"><a href="#"><i class="ti-close"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="product-thumbnail"><a href="#"><img style="max-width:80px;" src="https://www.startech.com.bd/image/cache/catalog/processor/intel/i5-12400/i5-12400-01-500x500.webp" alt="product3"></a></td>
                                                        <td class="product-name" data-title="Product"><a href="#">woman full sliv dress</a></td>
                                                        <td class="product-price" data-title="Price">$68.00</td>
                                                          <td class="product-stock-status" data-title="Stock Status"><span class="badge rounded-pill text-bg-success">In Stock</span></td>
                                                        <td class="product-add-to-cart"><a href="#" class="btn btn-sm btn-fill-out"><i class="icon-basket-loaded"></i> Add to Cart</a></td>
                                                        <td class="product-remove" data-title="Remove"><a href="#"><i class="ti-close"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
			</div>
		</div>
	</div>
</div>
@endsection