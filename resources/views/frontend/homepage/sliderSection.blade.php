<!-- START SECTION SLIDERS -->
<div class="section small_pt pb-0">
    <div class="custom-container">
        <div class="row">
            <div class="col-xl-3 d-none d-xl-block">
                <div class="sale-banner">
                    <a class="hover_effect1" href="#">
                        <img src="{{ asset('frontend/assets/images/shop_banner_img6.jpg') }}" alt="shop_banner_img6">
                    </a>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="row">
                    <div class="col-12">
                        <div class="heading_tab_header">
                            <div class="heading_s2">
                                <h4>Exclusive Products</h4>
                            </div>
                            <div class="tab-style2">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#tabmenubar" aria-expanded="false">
                                    <span class="ion-android-menu"></span>
                                </button>
                                <ul class="nav nav-tabs justify-content-center justify-content-md-end" id="tabmenubar"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="arrival-tab" data-bs-toggle="tab" href="#arrival"
                                            role="tab" aria-controls="arrival" aria-selected="true">New Arrival</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="sellers-tab" data-bs-toggle="tab" href="#sellers"
                                            role="tab" aria-controls="sellers" aria-selected="false">Best
                                            Sellers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="featured-tab" data-bs-toggle="tab" href="#featured"
                                            role="tab" aria-controls="featured" aria-selected="false">Featured</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="special-tab" data-bs-toggle="tab" href="#special"
                                            role="tab" aria-controls="special" aria-selected="false">Special Offer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="tab_slider">
                            <div class="tab-pane fade show active" id="arrival" role="tabpanel"
                                aria-labelledby="arrival-tab">
                                <div class="product_slider carousel_slider owl-carousel owl-theme dot_style1"
                                    data-loop="true" data-margin="20" data-autoplay="true"
                                    data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
                                    @foreach ($newProducts as $product)
                                        <div class="item">
                                            <div class="product_wrap">
                                                @if ($product['ratingCount'] > 5 && $product['averageRating'] > 80)
                                                    <span class="pr_flash bg-danger">Hot</span>
                                                @else
                                                    <span class="pr_flash">New</span>
                                                @endif
                                                <div class="product_img">
                                                    <a href="shop-product-detail.html">
                                                        <img src="{{ asset($product['thumb_image']) }}"
                                                            alt="thumb_image">
                                                        <img class="product_hover_img"
                                                            src="{{ asset($product['hover_image']) }}"
                                                            alt="hover_image">
                                                    </a>
                                                    <div class="product_action_box">
                                                        <ul class="list_none pr_action_btn">
                                                            <li class="add-to-cart"><a href="#"><i
                                                                        class="icon-basket-loaded"></i> Add To Cart</a>
                                                            </li>
                                                            <li><a href="shop-compare.html" class="popup-ajax"><i
                                                                        class="icon-shuffle"></i></a></li>
                                                            <li><a href="{{ route('quick.view', $product['slug']) }}"
                                                                    class="popup-ajax"><i
                                                                        class="icon-magnifier-add"></i></a></li>
                                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product_info">
                                                    <h6 class="product_title"><a
                                                            href="shop-product-detail.html">{{ ucwords($product['name']) }}</a>
                                                    </h6>
                                                    <div class="product_price">
                                                        @if (isset($product['discount_type']))
                                                            <span
                                                                class="price">{{ format_price($product['discounted_price']) }}</span>
                                                            <del>{{ format_price($product['unit_price']) }}</del>
                                                            <div class="on_sale">
                                                                <span>{{ $product['discount_type'] == 'amount' ? format_price($product['discount']) : $product['discount'] . '%' }}
                                                                    Off</span>
                                                            </div>
                                                        @else
                                                            <span
                                                                class="price">{{ format_price($product['unit_price']) }}</span>
                                                        @endif

                                                    </div>
                                                    <div class="rating_wrap">
                                                        <div class="rating">
                                                            <div class="product_rate"
                                                                style="width:{{ $product['averageRating'] }}%"></div>
                                                        </div>
                                                        <span
                                                            class="rating_num">({{ $product['ratingCount'] }})</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="ajax_quick_view" style="display: none;">
                                <div class="row">
                                    <!-- Content will be populated via AJAX -->
                                </div>
                                <button title="Close (Esc)" type="button" class="mfp-close">×</button>
                            </div>

                            <div class="tab-pane fade" id="sellers" role="tabpanel" aria-labelledby="sellers-tab">

                            </div>
                            <div class="tab-pane fade" id="featured" role="tabpanel"
                                aria-labelledby="featured-tab">

                            </div>
                            <div class="tab-pane fade" id="special" role="tabpanel" aria-labelledby="special-tab">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#sellers-tab').on('click', function() {
                // Send an AJAX request to the home route with seller parameter
                $.ajax({
                    url: '/?best_seller=1',
                    method: 'POST',
                    dataType: 'HTML',
                    success: function(response) {
                        if (response) {

                            $('#sellers').html(response);
                            // carousel_slider();
                        } else {
                            console.error('Request failed:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

            $('#featured-tab').on('click', function() {
                // Send an AJAX request to the home route with seller parameter
                $.ajax({
                    url: '/?featured=1',
                    method: 'POST',
                    dataType: 'HTML',
                    success: function(response) {
                        if (response) {

                            $('#featured').html(response);
                            // carousel_slider();
                        } else {
                            console.error('Request failed:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
            $('#special-tab').on('click', function() {
                // Send an AJAX request to the home route with seller parameter
                $.ajax({
                    url: '/?offred=1',
                    method: 'POST',
                    dataType: 'HTML',
                    success: function(response) {
                        if (response) {

                            $('#special').html(response);
                            // carousel_slider();
                        } else {
                            console.error('Request failed:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });

            $('.popup-ajax').on('click', function(e) {
                e.preventDefault();

                var url = $(this).attr('href');

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        $('.ajax_quick_view .row').html(response); // Populate the modal content
                        $('.ajax_quick_view').css('display', 'block'); // Show the modal
                    },
                    error: function() {
                        alert('Failed to load content.');
                    }
                });
            });

            // Close modal when clicking outside of it
            $(window).on('click', function(event) {
                if ($(event.target).hasClass('ajax_quick_view')) {
                    $('.ajax_quick_view').css('display', 'none');
                }
            });
        });
    </script>
@endpush
@push('styles')
    <style>
        .ajax_quick_view {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1000;
            /* Sit on top */
            left: 0;
            top: 10px;
            width: 90%;
            height: 90%;
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.5);
            /* Black with opacity */
        }

        .ajax_quick_view .row {
            margin: 5% auto;
            /* Center the content */
            background-color: #fff;
            /* White background for the modal content */
            padding: 20px;
            border-radius: 8px;
            /* Rounded corners */
            width: 80%;
            /* Adjust as needed */
        }
    </style>
@endpush
<!-- END SECTION SLIDERS -->
