@extends('frontend.layouts.app', ['title' => $product->details->site_title ])

@push('page_meta_information')

    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta property="og:site_name" content="{{ get_settings('system_name') }}">
    
    <meta name="title" content="{{ $product->details->meta_title }}">
    <meta name="author" content="{{ get_settings('system_name') }} : {{ route('home') }}">
    <meta name="keywords" content="{{ $product->details->meta_keyword }}" />
    <meta name="description" content="{{ $product->details->meta_description }}">	

    <!-- For Open Graph -->
    <meta property="og:url" content="{{ route('home') }}">	
    <meta property="og:type" content="Product">
    <meta property="og:title" content="{{ $product->details->meta_title }}">	
    <meta property="og:description" content="{{ $product->details->meta_description }}">	
    <meta property="og:image" content="{{ asset($product->thumb_image) }}">	

    <!-- For Twitter -->
    <meta name="twitter:card" content="Product" />
    <meta name="twitter:creator" content="{{ get_settings('system_name') }}" /> 
    <meta name="twitter:title" content="{{ $product->details->meta_title }}" />
    <meta name="twitter:description" content="{{ $product->details->meta_description }}" />	
    <meta name="twitter:site" content="{{ route('home') }}" />		
    <meta name="twitter:image" content="{{ asset($product->thumb_image) }}">
@endpush

@push('breadcrumb')
    <div class="breadcrumb_section page-title-mini">
        <div class="custom-container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="linearicons-home"></i>
                            </a>
                        </li>
                        @foreach ($breadcrumb as $category)
                            <li class="breadcrumb-item">
                                <a href="{{ route('slug.handle', ['slug' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                        <li class="breadcrumb-item active">
                            {{ $product->name }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.css') }}">	
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlcarousel/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slick-theme.css') }}">
@endpush
@section('content')
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                    <div class="product-image vertical_gallery">
                        <div id="pr_item_gallery" class="product_gallery_item slick_slider" data-vertical="true" data-vertical-swiping="true" data-slides-to-show="5" data-slides-to-scroll="1" data-infinite="false">
                            @if ($product->image)
                                @foreach ($product->image as $key => $image)
                                    <div class="item">
                                        <a href="javascript:;" class="product_gallery_item {{ $key == 0 ? 'active' : '' }}" data-image="{{ asset($image->image) }}" data-zoom-image="{{ asset($image->image) }}">
                                            <img src="{{ asset($image->image) }}" alt="{{ $product->name . ' Image '. $key }}" />
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="product_img_box">
                            <img id="product_img" src="{{ asset($product->thumb_image) }}" data-zoom-image="{{ asset($product->thumb_image) }}" alt="{{ $product->name }} Original Image" />
                            <a href="javascript:;" class="product_img_zoom" title="Zoom">
                                <span class="linearicons-zoom-in"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="pr_detail">
                        <div class="product_description">
                            <h1 class="h4 product_title">
                                {{ $product->name }}
                            </h1>
                            <div class="product_price">
                                @if (home_price($product) != home_discounted_price($product))
                                    <span class="price">{{ home_discounted_price($product) }}</span>
                                    <del>{{ home_price($product) }}</del>
                                    <div class="on_sale">
                                        @if ($product->discount_type == 'amount')
                                            <span>Flat {{ $product->discount }} Off</span>
                                        @else 
                                            <span>{{ $product->discount }}% Off</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="price">{{ home_discounted_price($product) }}</span>
                                @endif
                            </div>
                            <div class="rating_wrap">
                                <div class="rating">
                                    <div class="product_rate" style="width:{{ ($product->details->average_rating * 100) / ($product->details->number_of_rating == 0 ? 1 : $product->details->number_of_rating) }}%"></div>
                                </div>
                                <span class="rating_num">({{ $product->details->number_of_rating }})</span>
                            </div>
                            <div style="margin-top: 60px;" class="pr_desc"></div>
                            <div class="product_sort_info">
                                @if ($keySpec)
                                    <h6><b>Key Features</b>: </h6>
                                    <ul class="mt-4">
                                        @foreach ($keySpec as $keySpefication)
                                            <li><i class="fas fa-dot-circle"></i> {{ $keySpefication['key'] }}: {{ $keySpefication['attribute'] }}/A</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        @if ($product->low_stock)
                            <button class="btn btn-fill-warning btn-sm" type="button">
                                <i class="fas fa-info-circle"></i>
                                Limited Stock
                            </button>
                        @endif
                        @if ($product->in_stock)
                        <hr />
                        <div class="cart_extra">
                            <div class="cart-product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="minus">
                                    <input type="text" name="quantity" value="1" title="Qty" class="qty" size="4">
                                    <input type="button" value="+" class="plus">
                                </div>
                            </div>
                            <div class="cart_btn">
                                <button class="btn btn-fill-out btn-sm btn-addtocart" type="button"><i class="icon-basket-loaded"></i> Add to cart</button>
                                <a href="#" class="btn btn-fill-out btn-sm">Buy Now</a>

                                <a class="add_compare" data-id="{{ $product->id }}" href="javascript:;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Add to Compare">
                                    <i class="fas fa-random"></i>
                                </a>
                                <a class="add_wishlist" href="#">
                                    <i class="far fa-heart"></i>
                                </a>
                            </div>
                        </div>
                        @else
                        <hr />
                            <button class="btn btn-fill-secondary" type="button">
                                Out of Stock
                            </button>
                        @endif
                        
                        <hr />
                        <ul class="product-meta">
                            <li>SKU: <a href="#">BE45VGRT</a></li>
                            @if ($product->category)
                                <li>
                                    Category: 
                                    <a href="{{ route('slug.handle', ['slug' => $product->category->slug]) }}">
                                        {{ $product->category->name }}
                                    </a>
                                </li>
                            @endif
                            @if ($product->brand)
                                <li>
                                    Brand: 
                                    <a href="{{ route('slug.handle', ['slug' => $product->brand->slug]) }}">
                                        {{ $product->brand->name }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                        
                        <div class="product_share">
                            <span>Share:</span>
                            <ul class="social_icons">
                                <li>
                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('slug.handle', ['slug' => $product->slug])) }}">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('slug.handle', ['slug' => $product->slug])) }}&text={{ urlencode($product->name) }}" target="_blank">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(route('slug.handle', ['slug' => $product->slug])) }}&media={{ urlencode($product->thumb_image) }}&description={{ urlencode($product->name) }}" target="_blank">
                                        <i class="fab fa-pinterest"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:?subject={{ urlencode('Check out this product: ' . $product->name) }}&body={{ urlencode('Check out this product: ' . route('slug.handle', ['slug' => $product->slug])) }}"  target="_blank">
                                        <i class="far fa-envelope"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode('Check out this product: ' . route('slug.handle', ['slug' => $product->slug])) }}" target="_blank">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="section bg_gray">
        <div class="custom-container ">
            <div class="row">
                <div class="col-md-9">
                    <div class="tab-style1">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link product-details-tab active" id="Spacification-tab" data-bs-toggle="tab" href="#Spacification" role="tab" aria-controls="Spacification" aria-selected="true">Spacification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product-details-tab" id="Description-tab" data-bs-toggle="tab" href="#Description" role="tab" aria-controls="Description" aria-selected="false">Description</a>
                            </li>

                            @if ($product->details->video_link)
                                <li class="nav-item">
                                    <a class="nav-link product-details-tab" id="Video-tab" data-bs-toggle="tab" href="#Video" role="tab" aria-controls="Video" aria-selected="false">Video</a>
                                </li>
                            @endif
                            
                            <li class="nav-item">
                                <a class="nav-link product-details-tab" id="Question-tab" data-bs-toggle="tab" href="#Question" role="tab" aria-controls="Question" aria-selected="false">Questions ({{ count($product->question) }})</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link product-details-tab" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews" role="tab" aria-controls="Reviews" aria-selected="false">Reviews ({{ $product->details->number_of_rating }})</a>
                            </li>
                        </ul>
                        <div class="tab-content product-details shop_info_tab">
                            <!-- Specification Tab -->
                            <div class="tab-pane fade show active" id="Spacification" role="tabpanel" aria-labelledby="Spacification-tab">
                            
                                <div class="section-head">
                                    <h2>Specification</h2>
                                    <p>Looking for guidance on building your perfect PC? Get detailed insights and expert advice on each component to ensure compatibility and top performance.</p>
                                </div>

                                <table class="data-table flex-table" cellpadding="0" cellspacing="0">
                                    @foreach ($spec as $data)
                                        <thead>
                                            <tr>
                                                <td class="heading-row" colspan="3">{{ @$data[0]['specificationKey'] }}</td>
                                            </tr>
                                        </thead>
                                        @if ($data)
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td class="name">{{ $item['specificationKeyType'] }}</td>
                                                        <td class="value">{{ $item['specificationKeyTypeAttribute'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                            
                            <!-- Description Tab -->
                            <div class="tab-pane fade" id="Description" role="tabpanel" aria-labelledby="Description-tab">
                                <div class="section-head">
                                    <h2>Description</h2>
                                    <p>Explore a wide range of PC components designed to meet your performance needs. From powerful processors to high-speed storage, every part plays a crucial role in building a custom PC tailored for gaming, content creation, or productivity. Find the right components to optimize your system’s speed, graphics, and overall efficiency.</p>
                                </div>

                                <div class="full-description" itemprop="description">
                                    {!! $product->details->description !!}
                                </div>

                            </div>
                            
                            <!-- Video Tab -->
                            @if ($product->details->video_link)
                                <div class="tab-pane fade" id="Video" role="tabpanel" aria-labelledby="Video-tab">
                                    <div class="section-head">
                                        <h2>Video</h2>
                                        <p>Watch our expert reviews and guides on the latest PC components. Learn how to choose the best parts, assemble your PC, and maximize performance with in-depth video tutorials tailored for beginners and professionals alike.</p>
                                    </div>

                                    <div class="full-description" itemprop="description">
                                        <div class="fluid-width-video-wrapper">
                                            {!! $product->details->video_link !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                                
                            <!-- Questions Tab -->
                            <div class="tab-pane fade" id="Question" role="tabpanel" aria-labelledby="Question-tab">
                                <div class="section-head" style="padding-bottom: 0px;">
                                    <h2>Questions ({{ count($product->question) }})</h2>
                                    <p>Have question about this product? Get specific details about this product from expert.</p>
                                </div>
                                
                                <div id="question">
                                    @if (count($product->question))
                                        @foreach ($product->question as $question)
                                            <div class="question-wrap">
                                                <p class="author">
                                                    <span class="name">{{ $question->name }}</span> on {{ get_system_date($question->created_at) }}
                                                </p>
                                                <h3 class="question">
                                                    <span class="hint">Q:</span> 
                                                    {{ $question->message }}
                                                </h3>
                                                @if ($question->answer)
                                                    <p class="answer">
                                                        <span class="hint">A:</span> 
                                                        {{ $question->answer->message }}
                                                    </p>
                                                    <p class="author answerer">
                                                        <span class="text-muted">By</span> 
                                                        <span>{{ get_settings('system_name') }} Support</span> 
                                                        <span class="text-muted">{{ get_system_date($question->answer->created_at) }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else   
                                        <div class="empty-content">
                                            <i class="icon far fa-comment-alt"></i>
                                            <div class="empty-text">There are no questions asked yet. Be the first one to ask a question.</div>
                                        </div>
                                    @endif
                                </div>

                                <div class="review_form field_form">
                                    <h5>Your Question </h5>
                                    <small class="text-danger"> (Please don`t use any links, &, (, ), /, +, $, # Symbols)</small>
                                    <form class="row mt-3" method="POST" id="question-form" action="{{ route('question-form.submit') }}">
                                        @csrf
                                        <div class="form-group col-md-12 mb-3">
                                            <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->name : '' }}">
                                        </div>
                                        <div class="form-group col-12 mb-3">
                                            <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                                        </div>
                                        <div class="form-group col-12 mb-3">
                                            <input type="hidden" name="product" value="{{ $product->slug }}">
                                            <button type="submit" style="display:none;" class="btn btn-fill-out" id="submit_question_form">Submit Review</button>
                                        </div>
                                        <div class="form-group col-12 mb-3">
                                            <button class="btn btn-dark" disabled id="submitting_question_form" type="button">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Reviews Tab -->
                            <div class="tab-pane fade" id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                                <div class="section-head" style="padding-bottom: 0px;">
                                    <h2>Customer Reviews ({{ $product->details->number_of_rating }})</h2>
                                    <p>Get specific details about this product from customers who own it.</p>
                                </div>
                                <div class="comments">
                                    @if ($product->details->number_of_rating == 0)
                                        <div class="empty-content">
                                            <i class="icon far fa-comment-alt"></i>
                                            <div class="empty-text">There are no review added yet. Be the first one to add a review.</div>
                                        </div>
                                    @else
                                        <h5 class="product_tab_title">
                                            <div class="rating_wrap star_rating">
                                                <div class="rating">
                                                    <div class="product_rate" style="width:{{ ($product->details->average_rating * 100) / ($product->details->number_of_rating == 0 ? 1 : $product->details->number_of_rating) }}%"></div>
                                                </div>

                                                {{ round($product->details->average_rating) }} out of 5
                                            </div>
                                        </h5>
                                        @if ($product->ratings)
                                            
                                            <ul class="list_none comment_list mt-4">
                                                @foreach ($product->ratings as $rating)
                                                    <li>
                                                        <div style="padding-left: 0px;" class="comment_block">
                                                            <div class="rating_wrap">
                                                                <div class="rating">
                                                                    <div class="product_rate" style="width:{{ ($rating->rating * 100) / 5 }}%"></div>
                                                                </div>
                                                            </div>
                                                            <p class="customer_meta">
                                                                <span class="review_author">{{  $rating->name }}</span>
                                                                <span class="comment-date">{{ get_system_date($rating->created_at) }}</span>
                                                            </p>
                                                            <div class="description">
                                                                <p>{{ nl2br($rating->review) }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif
                                    
                                </div>

                                <div class="review_form field_form">
                                    <h5>Write A Review</h5>
                                    <form class="row mt-3" id="review-form" method="POST" action="{{ route('review.submit') }}">
                                        <div class="form-group col-12 mb-3">
                                            <div class="star_rating">
                                                <span data-value="1"><i class="far fa-star"></i></span>
                                                <span data-value="2"><i class="far fa-star"></i></span> 
                                                <span data-value="3"><i class="far fa-star"></i></span>
                                                <span data-value="4"><i class="far fa-star"></i></span>
                                                <span data-value="5"><i class="far fa-star"></i></span>
                                            </div>
                                            <input type="hidden" name="rating" id="rating" class="star_rating_field" value="0">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <input required="required" placeholder="Enter Name *" class="form-control" name="name" type="text" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->name : '' }}">
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <input required="required" placeholder="Enter Email *" class="form-control" name="email" type="email" value="{{ Auth::guard('customer')->check() ? Auth::guard('customer')->user()->email : '' }}">
                                        </div>
                                        <div class="form-group col-12 mb-3">
                                            <textarea required="required" placeholder="Your review *" class="form-control" name="message" rows="4"></textarea>
                                        </div>
                                        
                                        
                                        <div class="form-group col-12 mb-3">
                                            <input type="hidden" name="product" value="{{ $product->slug }}">
                                            <button type="submit" class="btn btn-fill-out" id="submit_review_form">Submit Review</button>
                                        </div>
                                        <div class="form-group col-12 mb-3">
                                            <button class="btn btn-dark" disabled id="submitting_review_form" type="button">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sidebar product-details-page">
                        <div class="widget">
                            <h5 class="widget_title">Same Category Products</h5>
                            <ul class="widget_recent_post">
                                <li>
                                    <div class="post_img">
                                        <a href="#"><img src="{{ asset('frontend/assets/images/shop_small1.jpg') }}" alt="shop_small1"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">Lether Gray Tuxedo</a></h6>
                                        <div class="product_price"><span class="price">$55.00</span><del>$95.00</del></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:68%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post_img">
                                        <a href="#"><img src="{{ asset('frontend/assets/images/shop_small2.jpg') }}" alt="shop_small2"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">woman full sliv dress</a></h6>
                                        <div class="product_price"><span class="price">$68.00</span><del>$99.00</del></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:87%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post_img">
                                        <a href="#"><img src="{{ asset('frontend/assets/images/shop_small3.jpg') }}" alt="shop_small3"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">light blue Shirt</a></h6>
                                        <div class="product_price"><span class="price">$69.00</span><del>$89.00</del></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:70%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="widget">
                            <h5 class="widget_title">Same Brand Products</h5>
                            <ul class="widget_recent_post">
                                <li>
                                    <div class="post_img">
                                        <a href="#"><img src="{{ asset('frontend/assets/images/shop_small1.jpg') }}" alt="shop_small1"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">Lether Gray Tuxedo</a></h6>
                                        <div class="product_price"><span class="price">$55.00</span><del>$95.00</del></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:68%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post_img">
                                        <a href="#"><img src="{{ asset('frontend/assets/images/shop_small2.jpg') }}" alt="shop_small2"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">woman full sliv dress</a></h6>
                                        <div class="product_price"><span class="price">$68.00</span><del>$99.00</del></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:87%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post_img">
                                        <a href="#"><img src="{{ asset('frontend/assets/images/shop_small3.jpg') }}" alt="shop_small3"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">light blue Shirt</a></h6>
                                        <div class="product_price"><span class="price">$69.00</span><del>$89.00</del></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:70%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="widget">
                            <h5 class="widget_title">Recently Viewed Products</h5>
                            <ul class="widget_recent_post">
                                <li>
                                    <div class="post_img">
                                        <a href="#"><img src="{{ asset('frontend/assets/images/shop_small1.jpg') }}" alt="shop_small1"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">Lether Gray Tuxedo</a></h6>
                                        <div class="product_price"><span class="price">$55.00</span><del>$95.00</del></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:68%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post_img">
                                        <a href="#"><img src="{{ asset('frontend/assets/images/shop_small2.jpg') }}" alt="shop_small2"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">woman full sliv dress</a></h6>
                                        <div class="product_price"><span class="price">$68.00</span><del>$99.00</del></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:87%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="post_img">
                                        <a href="#"><img src="{{ asset('frontend/assets/images/shop_small3.jpg') }}" alt="shop_small3"></a>
                                    </div>
                                    <div class="post_content">
                                        <h6 class="product_title"><a href="shop-product-detail-left-sidebar.html">light blue Shirt</a></h6>
                                        <div class="product_price"><span class="price">$69.00</span><del>$89.00</del></div>
                                        <div class="rating_wrap">
                                            <div class="rating">
                                                <div class="product_rate" style="width:70%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="small_divider"></div>
                    <div class="divider"></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="heading_s1">
                        <h3>Releted Products</h3>
                    </div>
                    <div class="releted_product_slider carousel_slider owl-carousel owl-theme" data-margin="20" data-responsive='{"0":{"items": "1"}, "481":{"items": "2"}, "768":{"items": "3"}, "1199":{"items": "4"}}'>
                        <div class="item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset('frontend/assets/images/product_img1.jpg') }}" alt="product_img1">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart">
                                                <a href="#">
                                                    <i class="fas fa-cart-plus"></i>
                                                    Add To Cart
                                                </a>
                                            </li>
                                            <li>
                                                <a href="shop-compare.html">
                                                    <i class="fas fa-random"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="shop-quick-view.html" class="popup-ajax">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="shop-product-detail.html">Blue Dress For Woman</a></h6>
                                    <div class="product_price">
                                        <span class="price">$45.00</span>
                                        <del>$55.25</del>
                                        <div class="on_sale">
                                            <span>35% Off</span>
                                        </div>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:80%"></div>
                                        </div>
                                        <span class="rating_num">(21)</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            <span class="active" data-color="#87554B"></span>
                                            <span data-color="#333333"></span>
                                            <span data-color="#DA323F"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset('frontend/assets/images/product_img2.jpg') }}" alt="product_img2">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a></li>
                                            <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="shop-product-detail.html">Lether Gray Tuxedo</a></h6>
                                    <div class="product_price">
                                        <span class="price">$55.00</span>
                                        <del>$95.00</del>
                                        <div class="on_sale">
                                            <span>25% Off</span>
                                        </div>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:68%"></div>
                                        </div>
                                        <span class="rating_num">(15)</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            <span class="active" data-color="#847764"></span>
                                            <span data-color="#0393B5"></span>
                                            <span data-color="#DA323F"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product">
                                <span class="pr_flash">New</span>
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset('frontend/assets/images/product_img3.jpg') }}" alt="product_img3">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a></li>
                                            <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="shop-product-detail.html">woman full sliv dress</a></h6>
                                    <div class="product_price">
                                        <span class="price">$68.00</span>
                                        <del>$99.00</del>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:87%"></div>
                                        </div>
                                        <span class="rating_num">(25)</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            <span class="active" data-color="#333333"></span>
                                            <span data-color="#7C502F"></span>
                                            <span data-color="#2F366C"></span>
                                            <span data-color="#874A3D"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset('frontend/assets/images/product_img4.jpg') }}" alt="product_img4">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a></li>
                                            <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="shop-product-detail.html">light blue Shirt</a></h6>
                                    <div class="product_price">
                                        <span class="price">$69.00</span>
                                        <del>$89.00</del>
                                        <div class="on_sale">
                                            <span>20% Off</span>
                                        </div>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:70%"></div>
                                        </div>
                                        <span class="rating_num">(22)</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            <span class="active" data-color="#333333"></span>
                                            <span data-color="#A92534"></span>
                                            <span data-color="#B9C2DF"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product">
                                <div class="product_img">
                                    <a href="shop-product-detail.html">
                                        <img src="{{ asset('frontend/assets/images/product_img5.jpg') }}" alt="product_img5">
                                    </a>
                                    <div class="product_action_box">
                                        <ul class="list_none pr_action_btn">
                                            <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                            <li><a href="shop-compare.html"><i class="icon-shuffle"></i></a></li>
                                            <li><a href="shop-quick-view.html" class="popup-ajax"><i class="icon-magnifier-add"></i></a></li>
                                            <li><a href="#"><i class="icon-heart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product_info">
                                    <h6 class="product_title"><a href="shop-product-detail.html">blue dress for woman</a></h6>
                                    <div class="product_price">
                                        <span class="price">$45.00</span>
                                        <del>$55.25</del>
                                        <div class="on_sale">
                                            <span>35% Off</span>
                                        </div>
                                    </div>
                                    <div class="rating_wrap">
                                        <div class="rating">
                                            <div class="product_rate" style="width:80%"></div>
                                        </div>
                                        <span class="rating_num">(21)</span>
                                    </div>
                                    <div class="pr_desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
                                    </div>
                                    <div class="pr_switch_wrap">
                                        <div class="product_color_switch">
                                            <span class="active" data-color="#87554B"></span>
                                            <span data-color="#333333"></span>
                                            <span data-color="#5FB7D4"></span>
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
@push('scripts')
    <script src="{{ asset('backend/assets/js/parsley.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/owlcarousel/js/owl.carousel.min.js')}}"></script> 
    <script src="{{ asset('frontend/assets/js/magnific-popup.min.js')}}"></script> 
    <script src="{{ asset('frontend/assets/js/waypoints.min.js')}}"></script> 
    <script src="{{ asset('frontend/assets/js/parallax.js')}}"></script> 
    <script src="{{ asset('frontend/assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.dd.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/slick.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.elevatezoom.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/pages/product.js')}}"></script>



@endpush