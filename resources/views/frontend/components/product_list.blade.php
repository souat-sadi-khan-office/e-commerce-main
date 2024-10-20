@if (count($products))
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 col-sm-12 col-xl-3">
                <div class="product">
                    <div class="product_img">
                        <a href="{{ route('slug.handle', $product->slug) }}">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}">
                        </a>
                        <div class="product_action_box">
                            <ul class="list_none pr_action_btn">
                                <li>
                                    <input type="hidden" id="product-{{ $product->sku }}" value="1">
                                    <a href="javascript:;" class="add-to-cart" data-id="{{ $product->sku }}">
                                        <i class="icon-basket-loaded"></i> 
                                        Add To Cart
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="add_compare" data-id="{{ $product->id }}" data-bs-toggle="tooltip" data-bs-placement="Top" title="Add to Compare">
                                        <i class="icon-shuffle"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('quick.view', $product->slug) }}" class="popup-ajax">
                                        <i class="icon-magnifier-add"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="add_wishlist" data-id="{{ $product->id }}" href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Save to Wish List">
                                        <i class="icon-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product_info">
                        <h6 class="product_title">
                            <a href="{{ route('slug.handle', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h6>
                        <div class="product_price">
                            <div class="price">{{ $product->unit_price }}</div>
                            {{-- @if (isset($product->discount_type))
                                <span class="price">
                                    {{ format_price(convert_price($product->discounted_price)) }}
                                </span>
                                <del>
                                    {{ format_price(convert_price($product->price)) }}
                                </del>
                                <div class="on_sale">
                                    <span>
                                        {{ $product['discount_type'] == 'amount' ? format_price(convert_price($product['discount'])) : $product['discount'] . '%' }}
                                        Off
                                    </span>
                                </div>
                            @else
                                <span class="price">
                                    {{ format_price(convert_price($product->price)) }}</span>
                            @endif --}}
                        </div>
                        <div class="rating_wrap">
                            <div class="rating">
                                <div class="product_rate" style="width:{{ ($product->details->average_rating * 100) / ($product->details->number_of_rating == 0 ? 1 : $product->details->number_of_rating) }}%"></div>
                            </div>
                            <span class="rating_num">({{ $product->details->number_of_rating }})</span>
                        </div>
                        <div class="pr_desc">
                            @if ($spec = $product->specificationsWithDetails->where('key_feature', 1)->take(4))
                                <ul>
                                    @foreach ($spec as $item)
                                    
                                        @if ($item->specificationKeyType && $item->specificationKeyTypeAttribute)
                                            <li>{{ $item->specificationKeyType->name }}: {{ $item->specificationKeyTypeAttribute->name }}</li>
                                        @endif
                                        
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="list_product_action_box">
                            <ul class="list_none pr_action_btn">
                                <li class="add-to-cart">
                                    <a href="javascript:;">
                                        <i class="icon-basket-loaded"></i> 
                                        Add To Cart
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="add_compare" data-id="{{ $product->id }}" data-bs-toggle="tooltip" data-bs-placement="Top" title="Add to Compare">
                                        <i class="icon-shuffle"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('quick.view', $product->slug) }}" class="popup-ajax">
                                        <i class="icon-magnifier-add"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="add_wishlist" data-id="{{ $product->id }}" href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Save to Wish List">
                                        <i class="icon-heart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="row">
        <div class="col-md-12">
            <div class="bg_white text-center">
                <img src="{{ asset('pictures/none.gif') }}" alt="Nothing Found"> <br>
                <p><b>No product found with this criteria </b></p>
            </div>
        </div>
    </div>
@endif