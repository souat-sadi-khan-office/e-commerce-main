
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice {{strtoupper($order['unique_id'])}} | {{ get_settings('system_name') ? get_settings('system_name') : 'Project Alpha' }}</title>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/font_source_sans3.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href={{ asset('backend/assets/css/adminlte.css') }}>
    <link rel="stylesheet" href={{ asset('backend/assets/css/fontawesome.min.css') }}>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @stack('style')
<body>
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h4>
                    <a href="{{ route('admin.dashboard') }}" class="brand-link" style="text-decoration: none">
                        <img style="height: 40px"
                            src="{{ get_settings('system_logo_white') ? asset(get_settings('system_logo_white')) : asset('pictures/default-logo-white.png') }}"
                            alt="App Logo" class="brand-image">
                    </a>
                    <small class="float-right">- {{ get_system_time(now()) }},{{ now()->format('M Y') }}</small>
                </h4>
            </div>
            <!-- /.col -->
        </div>
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
            <!-- /.col -->
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
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice {{ strtoupper($order['unique_id']) }}</b><br>
                <br>
                <b>Shipping Address:</b> {!! add_line_breaks($order['shipping_address']) !!}<br>
                <b>Payment Status:</b> <span
                    class="py-1 badge text-bg-{{ $order['payment_status'] == 'Paid' ? 'success' : 'danger' }}">{{ str_replace('-', ' ', $order['payment_status']) }}</span><br>
                <b>Shipping Method:</b> <span class="badge text-bg-info"> {{ $order['shipping_method'] }}</span>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
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
                                        href="{{ route('slug.handle', $details->slug) }}">{{ $details->name }}</a></td>
                                <td>{{ $details->unit_price }}</td>
                                <td>{{ $details->total_price }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                @if ($order['note'])
                    <p> <span class="lead">Order Note:</span>{!! add_line_breaks($order['note'], 35) !!}</p>
                @endif
                <p class="lead">Order Date: {{ $order['created_at'] }}</p>
                <p class="lead">Payment Currency: {{ $order['currency'] }}</p>
                <p class="lead">Payment Method: {{ $order['gateway_name'] }}</p>


            </div>
            <!-- /.col -->
            <div class="col-6">
                <p class="lead">Payment : {{ $order['payment_status'] }}</p>

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
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" ></script>
    <script src={{ asset('backend/assets/js/adminlte.js') }}></script>
    <script src={{ asset('backend/assets/js/main.js') }}></script>
</body>
</html>
