@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('page_name')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm">
                            <i class="bi bi-hourglass-top"></i>
                        </span>
                        <div class="info-box-content"> <span class="info-box-text">Idle Time</span> <span
                                class="info-box-number">{{ $data['cpu']['idle_time'] }}</span> </div>
                        <!-- /.info-box-content -->
                    </div> <!-- /.info-box -->
                </div> <!-- /.col --> <!-- fix for small devices only --> <!-- <div class="clearfix hidden-md-up"></div> -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm">
                            <i class="bi bi-cpu"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">User CPU Usage</span>
                            <span class="info-box-number">
                                {{ $data['cpu']['user_cpu_time'] }}
                            </span>
                        </div> <!-- /.info-box-content -->
                    </div> <!-- /.info-box -->
                </div> <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-arrow-repeat"></i>
                        </span>
                        <div class="info-box-content"> <span class="info-box-text">System CPU Usage</span> <span
                                class="info-box-number">{{ $data['cpu']['system_cpu_time'] }}</span> </div>
                        <!-- /.info-box-content -->
                    </div> <!-- /.info-box -->
                </div> <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm">
                            <i class="bi bi-pie-chart"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Cache</span>
                            <span class="info-box-number">{{ $data['cacheSize']['size'] }}
                                -{{ $data['cacheSize']['count'] }} Files</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div> <!-- /.info-box -->
                </div> <!-- /.col -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-primary shadow-sm gredient"> <i
                                class="bi bi-gear-fill"></i> </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Execution Time</span>
                            <span class="info-box-number">
                                {{ $data['executionTime'] }}
                            </span>
                        </div> <!-- /.info-box-content -->
                    </div> <!-- /.info-box -->
                </div> <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('admin.stock.index') }}" style="text-decoration: none;">
                        <div class="info-box"> <span class="info-box-icon text-bg-success shadow-sm gredient"> <i
                                    class="bi bi-cart-fill"></i> </span>
                            <div class="info-box-content"> <span class="info-box-text">Ordered Stock</span> <span
                                    class="info-box-number">{{ $data['total_order_qty'] }}</span> </div>
                            <!-- /.info-box-content -->
                        </div> <!-- /.info-box -->
                    </a>
                </div> <!-- /.col --> <!-- fix for small devices only --> <!-- <div class="clearfix hidden-md-up"></div> -->

                <div class="col-12 col-sm-6 col-md-3">
                    <a style="text-decoration: none;" href="{{ route('admin.customer.index') }}">
                        <div class="info-box"> <span class="info-box-icon text-bg-warning shadow-sm gredient-2"> <i
                                    class="bi bi-people-fill text-light"></i> </span>
                            <div class="info-box-content"> <span class="info-box-text">Total Customers</span> <span
                                    class="info-box-number">{{ $data['total_users'] }}</span> </div>
                            <!-- /.info-box-content -->
                        </div> <!-- /.info-box -->
                    </a>
                </div> <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box"> <span class="info-box-icon text-bg-danger shadow-sm gredient-2"> <i
                                class="bi bi-bookmark-star"></i> </span>
                        <div class="info-box-content"> <span class="info-box-text">Reviews</span> <span
                                class="info-box-number">{{ $data['total_ratings'] }}</span> </div>
                        <!-- /.info-box-content -->
                    </div> <!-- /.info-box -->
                </div> <!-- /.col -->
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="small-box text-bg-primary gredient-box-primary-2">
                        <div class="inner">
                            <h3>{{ $data['total_orders'] }}</h3>
                            <p>Total Orders</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path
                                d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z">
                            </path>
                        </svg>
                        <a href="{{ route('admin.order.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i> </a>
                    </div>


                    <div class="card text-bg-warning gredient-box-warning-2">
                        <div class="card-header">
                            <h3 class="card-title"><i class="bi bi-currency-exchange"></i> Order Amounts</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                        </div> <!-- /.card-header -->
                        <div class="card-body" style="box-sizing: border-box; display: block;">
                            <ul>
                                <li>Total : {{ $data['total_order_amount'] }}</li>
                                <li>Paid : {{ $data['total_paid_order_amount'] }}</li>
                                <li>Unpaid : {{ $data['total_unpaid_order_amount'] }}</li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <a href="{{ route('admin.currency.index') }}" style="text-decoration: none;">
                        <div class="info-box mb-3 text-bg-secondary gredient-box-secondary">
                            <span class="info-box-icon">
                                <i class="bi bi-currency-exchange"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Currency</span>
                                <span class="info-box-number">{{ $data['total_currency'] }}</span>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.currency.index') }}" style="text-decoration: none;">
                        <div class="info-box mb-3 text-bg-info gredient-box-info">
                            <span class="info-box-icon">
                                <i class="bi bi-currency-exchange"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Active Currency</span>
                                <span class="info-box-number">{{ $data['total_active_currency'] }}</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="{{ route('admin.category.index') }}" style="text-decoration: none;">
                        <div class="info-box mb-3 shadow-sm"
                            style="background: repeating-linear-gradient(149deg, #2336b8, black 1000px); color:white">
                            <span class="info-box-icon">
                                <i class="bi bi-columns-gap"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Product Category</span>
                                <span class="info-box-number">{{ $data['total_categories'] }}</span>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.category.index') }}" style="text-decoration: none;">
                        <div class="info-box mb-3 text-bg-primary gredient-box-primary">
                            <span class="info-box-icon">
                                <i class="bi bi-grid-1x2"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Parent Categories</span>
                                <span class="info-box-number">{{ $data['total_primary_categories'] }}</span>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.category.index') }}" style="text-decoration: none;">
                        <div class="info-box mb-3 text-bg-secondary gredient-box-secondary">
                            <span class="info-box-icon">
                                <i class="bi bi-columns"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Sub Categories</span>
                                <span class="info-box-number">{{ $data['total_sub_categories'] }}</span>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.category.index') }}" style="text-decoration: none;">
                        <div class="info-box mb-3 text-bg-info gredient-box-info">
                            <span class="info-box-icon">
                                <i class="bi bi-columns-gap"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Active Categories</span>
                                <span class="info-box-number">{{ $data['active_categories'] }}</span>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.brand.index') }}" style="text-decoration: none;">
                        <div class="info-box mb-3 text-bg-secondary gredient-box-secondary">
                            <span class="info-box-icon">
                                <i class="bi bi-ubuntu"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Product Brands</span>
                                <span class="info-box-number">{{ $data['total_brands'] }}</span>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.brand.index') }}" style="text-decoration: none;">
                        <div class="info-box mb-3 text-bg-info gredient-box-info-2">
                            <span class="info-box-icon">
                                <i class="bi bi-ubuntu"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Active Product Brands</span>
                                <span class="info-box-number">{{ $data['active_brands'] }}</span>
                            </div>
                        </div>
                    </a>



                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="info-box text-bg-success gredient-box-success"> <span class="info-box-icon"> <i
                                        class="bi bi-chat-text-fill"></i>
                                </span>
                                <div class="info-box-content"> <span class="info-box-text">Product Qustions</span> <span
                                        class="info-box-number">{{ $data['total_questions'] }}</span>
                                    <div class="progress">
                                        <div class="progress-bar"
                                            style="width:{{ $data['questions_percentage_change'] }}%">
                                        </div>
                                    </div> <span class="progress-description">
                                        {{ $data['questions_percentage_change'] }}% Increase in 30 Days
                                    </span>
                                </div> <!-- /.info-box-content -->
                            </div>

                            <a href="{{ route('admin.stock.index') }}" style="text-decoration: none;">

                                <div class="info-box text-bg-primary gredient-box-primary-2"> <span class="info-box-icon">
                                        <i class="bi bi-archive"></i>
                                    </span>
                                    <div class="info-box-content"> <span class="info-box-text">Product Stock</span> <span
                                            class="info-box-number">{{ $data['total_stock'] }} Unit</span>
                                        <div class="progress">
                                            <div class="progress-bar"
                                                style="width:{{ $data['order_to_stock_ratio%'] }}%">
                                            </div>
                                        </div> <span class="progress-description">
                                            {{ $data['order_to_stock_ratio%'] }}% Order Completed
                                        </span>
                                    </div> <!-- /.info-box-content -->
                                </div>
                            </a>

                        </div>

                        <div class="col-md-6">
                            <div class="card text-bg-success gredient-box-success">
                                <div class="card-header">
                                    <h3 class="card-title"> <i class="nav-icon bi bi-basket2-fill"></i> Orders</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                    </div>
                                </div> <!-- /.card-header -->
                                <div class="card-body" style="box-sizing: border-box; display: block;">
                                    <ul>
                                        <li>Total : {{ $data['total_orders'] }} </li>
                                        <li>Pending : {{ $data['total_pending_orders'] }}</li>
                                        <li>Packaging : {{ $data['total_packaging_orders'] }}</li>
                                        <li>In Delivery : {{ $data['total_shipping_orders'] }}</li>
                                        <li>Delivered : {{ $data['total_delivered_orders'] }}</li>
                                        <li>Returned & Failed :
                                            {{ $data['total_returned_orders'] + $data['total_failed_orders'] }}</li>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>

                        <div class="col-md-12">
                            @if (isset($data['top_customers']) && count($data['top_customers']))

                                <table class="table table-primary">
                                    <h6 class="form-label">Top Customers <i class="bi bi-patch-check"></i></h6>
                                    <thead>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Orders</th>
                                        <th>Amount</th>
                                    </thead>

                                    <tbody>
                                        @foreach ($data['top_customers'] as $user)
                                            <tr>
                                                <td class="avatar"> {!! App\CPU\Images::show($user->avatar) !!} {{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->orders_count }}</td>
                                                <td>
                                                    {{ get_system_default_currency()->symbol . round(covert_to_defalut_currency($user->total_final_amount), 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('style')
    <style>
        .avatar img {
            width: 30px !important
        }
    </style>
@endpush
@push('script')
@endpush
