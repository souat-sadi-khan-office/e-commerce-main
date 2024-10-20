<div class="row">
    <div class="col-12">
        <div class="heading_tab_header">
            <div class="heading_s2">
                <h4>On Sale Products</h4>
            </div>
            <div class="view_all">
                <a href="{{ route('on-sale-product') }}" class="text_default">
                    <span>View All {{ count($products) }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="on-sale-carousel product_list owl-carousel owl-theme nav_style5" data-nav="true" data-dots="false" data-loop="true" data-margin="20" data-responsive='{"0":{"items": "1"}, "380":{"items": "1"}, "640":{"items": "2"}, "991":{"items": "1"}}'>
            <div class="item">
                @foreach($products as $index => $product)
                    <div class="product_wrap">
                        <span class="pr_flash bg-danger">Hot</span>
                        <div class="product_img">
                            <a href="shop-product-detail.html">
                                <img src="{{ asset($product['thumb_image']) }}" alt="{{ $product['name'] }}">
                                <img class="product_hover_img" src="{{ asset($product['hover_image']) }}" alt="{{ $product['name'] }}">
                            </a>
                        </div>
                        <div class="product_info">
                            <h6 class="product_title"><a href="shop-product-detail.html">{{ $product['name'] }}</a></h6>
                            <div class="product_price">
                                <span class="price">{{ $product['unit_price'] }}</span>
                                @if($product['discount'])
                                    <del>{{ $product['unit_price'] }}</del>
                                    <div class="on_sale">
                                        <span>{{ $product['discounted_price'] }}% Off</span>
                                    </div>
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
            
                    @if(($index + 1) % 3 == 0)
                        </div><div class="item">
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>