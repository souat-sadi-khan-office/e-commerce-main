@extends('frontend.layouts.app', ['title' => "Cart | ". get_settings('system_name') ])

@push('page_meta_information')

    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta property="og:site_name" content="{{ get_settings('system_name') }}">
    
    <meta name="title" content="{{ "Cart | ". get_settings('system_name')  }}">
@endpush

@push('breadcrumb')
    <div class="breadcrumb_section page-title-mini">
        <div class="custom-container">
            <div class="row align-items-center">
                <div class="col-md-12 mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="linearicons-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Cart
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('styles')
    
@endpush
@section('content')
<div class="section">
	<div class="custom-container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive shop_cart_table">
                    @if (count($models) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($models as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="{{ $item['slug'] }}">
                                                <img src="{{ $item['thumb_image'] }}" alt="{{ $item['name'] }}">
                                            </a>
                                        </td>
                                        <td class="product-name" data-title="Product">
                                            <a href="{{ $item['slug'] }}">
                                                {{ $item['name'] }}
                                            </a>
                                        </td>
                                        <td class="product-price {{ $item['id'] }}-unit-price" data-title="Price">
                                            {{ format_price(convert_price($item['price'])) }}
                                        </td>
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity quantity-{{ $item['id'] }}">
                                                <input type="button" value="-" class="minus minus-{{ $item['id'] }}" data-slug="{{ $item['slug'] }}" data-id="{{ $item['id'] }}" style="{{ $item['quantity'] > 1 ? '' : 'display:none;' }}">
                                                <input disabled type="text" name="quantity" value="{{ $item['quantity'] }}" title="Qty" class="qty" size="4" id="qty_{{ $item['id'] }}">
                                                <input type="button" value="+" class="plus" data-slug="{{ $item['slug'] }}" data-id="{{ $item['id'] }}">
                                            </div>
                                            <div style="display: none;" class="quantity-loader quantity-loader-{{ $item['id'] }}">
                                                <i class="fas fa-spinner fa-spin"></i>
                                            </div>
                                        </td>
                                        <td class="product-subtotal sub-total-{{ $item['id'] }}" data-title="Total">
                                            {{ format_price(convert_price($item['quantity'] * $item['price'])) }}
                                        </td>
                                        <td class="product-remove" data-title="Remove">
                                            <a href="javascript:;" class="remove-item-from-cart text-danger" data-load="1" data-id="{{ $item['id'] }}" data-bs-toggle="tooltip" data-bs-placement="Top" title="Remove">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="px-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-lg-4 col-md-6 mb-3 mb-md-0 mx-auto">
                                                <div class="coupon field_form input-group">
                                                    <input type="text" value="" class="form-control form-control-sm" placeholder="Enter Coupon Code..">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-fill-out btn-sm" type="submit">Apply Coupon</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    @else
                        <div class="col-md-12">
                            <div class="bg_white text-center">
                                <img src="{{ asset('pictures/none.gif') }}" alt="Nothing Found"> <br>
                                <p><b>Your cart is empty. </b></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if (count($models) > 0)
            <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="heading_s1 mb-3">
                        <h6>Calculate Shipping</h6>
                    </div>
                    <form class="field_form shipping_calculator">
                        <div class="form-row">
                            <div class="form-group col-lg-12 mb-3">
                                <div class="custom_select">
                                    <select class="form-control">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6 mb-3">
                                <input required="required" placeholder="State / Country" class="form-control" name="name" type="text">
                            </div>
                            <div class="form-group col-lg-6 mb-3">
                                <input required="required" placeholder="PostCode / ZIP" class="form-control" name="name" type="text">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-12 mb-3">
                                <button class="btn btn-fill-line" type="submit">Update Totals</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="border p-3 p-md-4">
                        <div class="heading_s1 mb-3">
                            <h6>Cart Totals</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="cart_sub_total_label">Cart Subtotal</td>
                                        <td class="cart_sub_total_amount">{{ format_price(convert_price($total_price)) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="cart_shipping_label">Shipping</td>
                                        <td class="cart_shipping_amount">Free Shipping</td>
                                    </tr>
                                    <tr>
                                        <td class="cart_total_label">Total</td>
                                        <td class="cart_total_amount"><strong>{{ format_price(convert_price($total_price)) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="#" class="btn btn-fill-out">Proceed To CheckOut</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.plus', function() {
            let id = $(this).data('id');
            let slug = $(this).data('slug');

            $('.quantity-'+id).hide();
            $('.quantity-loader-'+id).show();
            $.ajax({
                url: '/cart/add',
                method: 'POST',
                data: {
                    slug: slug,
                    quantity: 1
                },
                dataType: 'JSON',
                success: function (response) {
                    if(response.status) {
                        toastr.success(response.message);

                        $('.sub-total-'+response.id).html(response.item_sub_total);
                        $('.cart_sub_total_amount').html(response.cart_sub_total_amount);
                        $('.cart_total_amount').html('<b>'+response.cart_total_amount+'</b>');
                    } else {
                        toastr.warning(response.message);
                    }

                    _hideMinusButton(response.id);

                    $('.quantity-loader-'+response.id).hide();
                    $('.quantity-'+response.id).show();
                },
                error: function (error) {
                    toastr.error("Something went wrong! Please try again");

                    $('.quantity-loader').hide();
                    $('.quantity').show();
                }
            });
        });

        _hideMinusButton = function(id) {
            let qty = $('#qty_'+id).val();
            if(parseInt(qty) <= 1) {
                $('.minus-'+id).hide();
            } else {
                $('.minus-'+id).show();
            }
        }

        $(document).on('click', '.minus', function() {
            let id = $(this).data('id');
            let slug = $(this).data('slug');

            $('.quantity-'+id).hide();
            $('.quantity-loader-'+id).show();
            $.ajax({
                url: '/cart/sub',
                method: 'POST',
                data: {
                    slug: slug,
                    quantity: 1
                },
                dataType: 'JSON',
                success: function (response) {
                    if(response.status) {
                        toastr.success(response.message);

                        $('.sub-total-'+response.id).html(response.item_sub_total);
                        $('.cart_sub_total_amount').html(response.cart_sub_total_amount);
                        $('.cart_total_amount').html('<b>'+response.cart_total_amount+'</b>');

                        _hideMinusButton(response.id);
                        if(response.load) {
                            window.location.href="";
                        }

                    } else {
                        toastr.warning(response.message);
                    }

                    $('.quantity-loader-'+response.id).hide();
                    $('.quantity-'+response.id).show();
                },
                error: function (error) {
                    toastr.error("Something went wrong! Please try again");

                    $('.quantity-loader').hide();
                    $('.quantity').show();
                }
            });
        });
    </script>
@endpush