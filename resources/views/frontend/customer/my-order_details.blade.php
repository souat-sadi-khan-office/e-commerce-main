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
                            Order History
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


                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">


                                    <div class="invoice p-3 mb-3">

                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                From
                                                <address>
                                                    <strong>Admin, Inc.</strong><br>
                                                    795 Folsom Ave, Suite 600<br>
                                                    San Francisco, CA 94107<br>
                                                    Phone: (804) 123-5432<br>
                                                    Email: info@almasaeedstudio.com
                                                </address>
                                            </div>
                                            <div class="col-sm-4 invoice-col">
                                                To
                                                <address>
                                                    <strong>{{ $order['user_name'] }}</strong><br>
                                                    {!! add_line_breaks($order['billing_address']) !!} <br>
                                                    Phone: {{ $order['phone'] }}<br>
                                                    @if ($order['user_company'])
                                                        Company: {{ ucfirst($order['user_company']) }} <br>
                                                    @endif
                                                    Email: {{ $order['email'] }}
                                                </address>
                                            </div>
                                            <div class="col-sm-4 invoice-col">
                                                <b>Invoice {{ strtoupper($order['unique_id']) }}</b><br><br>
                                                <b>Shipping Address:</b> {!! add_line_breaks($order['shipping_address']) !!}<br>
                                                <b>Payment Status:</b> <span
                                                    class="py-1 badge text-bg-{{ $order['payment_status'] == 'Paid' ? 'success' : 'danger' }}">{{ str_replace('-', ' ', $order['payment_status']) }}</span><br>
                                                <b>Shipping Method:</b> <span class="badge text-bg-info">
                                                    {{ $order['shipping_method'] }}</span>
                                            </div>
                                        </div>
                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Qty</th>
                                                            <th>Product</th>
                                                            <th>Unit Price</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order['details'] as $details)
                                                            <tr>
                                                                <td>{{ $details->qty }}</td>
                                                                <td><a style="text-decoration:none;color: var(--bs-table-color-type);"
                                                                        href="{{ route('slug.handle', $details->slug) }}">{{ $details->name }}</a>
                                                                </td>
                                                                <td>{{ $details->unit_price }}</td>
                                                                <td>{{ $details->total_price }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                @if ($order['note'])
                                                    <p> <span class="lead">Order Note:</span>{!! add_line_breaks($order['note'], 35) !!}</p>
                                                @endif
                                                <p>Order Date: {{ $order['created_at'] }}</p>
                                                <p>Payment Currency: {{ $order['currency'] }}</p>
                                                <p>Payment Method: {{ $order['gateway_name'] }}</p>
                                            </div>
                                            <div class="col-6">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">Subtotal:</th>
                                                                <td>{{ $order['order_amount'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tax</th>
                                                                <td>{{ $order['tax_amount'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Shipping:</th>
                                                                <td>----</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Discount:</th>
                                                                <td>{{ $order['discount_amount'] }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total:</th>
                                                                <td>{{ $order['order_amount'] }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-12">

                                                <a href="{{ route('account.order.invoice', ['id' => encode($order['id']), 'download' => true]) }}"
                                                    class="btn btn-sm btn-fill-out rounded py-2" style="margin-right: 5px;">
                                                    <i class="bi bi-box-arrow-down"></i>Download Invoice
                                                </a>
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
