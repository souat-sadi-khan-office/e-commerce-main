<div class="product_slider carousel_slider owl-carousel owl-theme dot_style1" data-loop="true" data-autoplay="true" data-margin="20"
    data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "991":{"items": "4"}}'>
    @foreach ($products as $product)
        <div class="item">
            <div class="product_wrap">
                <span class="pr_flash bg-danger">Hot</span>
                <div class="product_img">
                    <a href="shop-product-detail.html">
                        <img src="{{ asset($product['thumb_image']) }}" alt="thumb_image">
                        <img class="product_hover_img" src="{{ asset($product['hover_image']) }}" alt="hover_image">
                    </a>
                    <div class="product_action_box">
                        <ul class="list_none pr_action_btn">
                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a>
                            </li>
                            <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                            <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a>
                            </li>
                            <li><a href="#"><i class="icon-heart"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product_info">
                    <h6 class="product_title"><a href="shop-product-detail.html">{{ ucwords($product['name']) }}</a>
                    </h6>
                    <div class="product_price">
                        @if (isset($product['discount_type']))
                            <span class="price">{{ format_price($product['discounted_price']) }}</span>
                            <del>{{ format_price($product['unit_price']) }}</del>
                            <div class="on_sale">
                                <span>{{ $product['discount_type'] == 'amount' ? format_price($product['discount']) : $product['discount'] . '%' }}
                                    Off</span>
                            </div>
                        @else
                            <span class="price">{{ format_price($product['unit_price']) }}</span>
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
