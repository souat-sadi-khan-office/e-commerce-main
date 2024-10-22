<div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-autoplay="true" data-margin="20"
    data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
    @foreach ($products as $product)
        <div class="item">
            <div class="product_wrap">
                <span class="pr_flash bg-success">Sale</span>
                <div class="product_img">
                    <a href="shop-product-detail.html">
                        <img src="{{ asset($product['thumb_image']) }}" alt="thumb_image">
                        <img class="product_hover_img" src="{{ asset($product['hover_image']) }}" alt="hover_image">
                    </a>
                    <div class="product_action_box">
                        <ul class="list_none pr_action_btn">
                            <li>
                                <a class="add-to-cart" href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Add to Cart">
                                    <i class="fas fa-shopping-bag"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" class="add_compare" data-id="{{ $product['id'] }}" data-bs-toggle="tooltip" data-bs-placement="Top" title="Add to Compare">
                                    <i class="fas fa-random"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('quick.view', $product['slug']) }}" class="popup-ajax">
                                    <i class="fas fa-search"></i>
                                </a>
                            </li>
                            <li>
                                <a data-id="{{ $product['id'] }}" href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Save to Wish List" class="add_wishlist" >
                                    <i class="far fa-heart"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product_info">
                    <h6 class="product_title"><a href="shop-product-detail.html">{{ ucwords($product['name']) }}</a>
                    </h6>
                    <div class="product_price">
                        @if (isset($product['discount_type']))
                        <span class="price">{{ format_price(convert_price($product['discounted_price'])) }}</span>
                        <del>{{ format_price(convert_price($product['unit_price'])) }}</del>
                        <div class="on_sale">
                            <span>{{ $product['discount_type'] == 'amount' ? format_price(convert_price($product['unit_price'])) : $product['discount'] . '%' }}
                                Off</span>
                        </div>
                    @else
                        <span class="price">{{ format_price(convert_price($product['unit_price'])) }}</span>
                    @endif
                    </div>
                    <div class="rating_wrap">
                        <div class="rating">
                            <div class="product_rate" style="width:{{ $product['averageRating'] }}%"></div>
                        </div>
                        <span class="rating_num">({{ $product['ratingCount'] }})</span>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
</div>
    <script>
        $(document).ready(function() {
            $('.carousel_slider').each( function() {
			var $carousel = $(this);
			$carousel.owlCarousel({
				dots : $carousel.data("dots"),
				loop : $carousel.data("loop"),
				items: $carousel.data("items"),
				margin: $carousel.data("margin"),
				mouseDrag: $carousel.data("mouse-drag"),
				touchDrag: $carousel.data("touch-drag"),
				autoHeight: $carousel.data("autoheight"),
				center: $carousel.data("center"),
				nav: $carousel.data("nav"),
				rewind: $carousel.data("rewind"),
				navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
				autoplay : $carousel.data("autoplay"),
				animateIn : $carousel.data("animate-in"),
				animateOut: $carousel.data("animate-out"),
				autoplayTimeout : $carousel.data("autoplay-timeout"),
				smartSpeed: $carousel.data("smart-speed"),
				responsive: $carousel.data("responsive")
			});	
		});
        })
    </script>
