@extends('fontend.layouts.app')
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
                    <li class="breadcrumb-item active">
                        Account
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
            @include('fontend.customer.partials.sidebar')
            <div class="col-lg-9 col-md-8 dashboard_content">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        @include('fontend.customer.partials.header')
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Dashboard</h4>
                            </div>
                            <div class="card-body">
                                <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>

                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <div class="total-contain">
                                            <div class="total-icon">
                                                <i class="ti-shopping-cart-full"></i>
                                            </div>
                                            <div class="total-detail">
                                                <span class="text">Total Order</span>
                                                <h2 class="title">3658</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="total-contain">
                                            <div class="total-icon">
                                                <i class="ti-truck"></i>
                                            </div>
                                            <div class="total-detail">
                                                <span class="text">Total Pending Order</span>
                                                <h2 class="title">215</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="total-contain">
                                            <div class="total-icon">
                                                <i class="ti-heart"></i>
                                            </div>
                                            <div class="total-detail">
                                                <span class="text">Total Wishlist</span>
                                                <h2 class="title">31576</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="card countries-card px-3 pt-3 pb-2 mb-2">
                                            <h6>Your Top Searched Products</h6>
                                            <div class="row">
                                                <div class="col-md-12 table-responsive">
                                                    
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
	</div>
</div>
@endsection