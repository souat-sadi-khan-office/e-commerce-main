<footer class="footer_dark">
	<div class="footer_top">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                	<div class="widget">
                        <div class="footer_logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ get_settings('system_logo_white') ? asset(get_settings('system_logo_white')) : asset('pictures/default-logo-white.png') }}" alt="logo"/>
                            </a>
                        </div>
                        {!! get_settings('system_about_wizard') !!}
                    </div>
                    <div class="widget">
                        <ul class="social_icons social_white">
                            <li>
                                <a target="_blank" href="{{ get_settings('system_facebook_link') }}">
                                    <i class="ion-social-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ get_settings('system_twitter_link') }}">
                                    <i class="ion-social-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ get_settings('system_youtube_link') }}">
                                    <i class="ion-social-youtube-outline"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ get_settings('system_instagram_link') }}">
                                    <i class="ion-social-instagram-outline"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="{{ get_settings('system_linkedin_link') }}">
                                    <i class="ion-social-linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
        		</div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">{{ get_settings('footer_menu_one_label_text') }}</h6>
                        <ul class="widget_links">
                            @if (get_settings('footer_menu_one_labels') != null)
                                @foreach ( json_decode(get_settings('footer_menu_one_labels')) as $key => $value)
                                    <li>
                                        <a href="{{ json_decode(App\Models\ConfigurationSetting::where('type', 'footer_menu_one_links')->first()->value, true)[$key] }}">
                                            {{ $value }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">{{ get_settings('footer_menu_tow_label_text') }}</h6>
                        <ul class="widget_links">
                            @if (get_settings('footer_menu_two_labels') != null)
                                @foreach ( json_decode(get_settings('footer_menu_two_labels')) as $key => $value)
                                    <li>
                                        <a href="{{ json_decode(App\Models\ConfigurationSetting::where('type', 'footer_menu_two_links')->first()->value, true)[$key] }}">
                                            {{ $value }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">My Account</h6>
                        <ul class="widget_links">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Discount</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Orders History</a></li>
                            <li><a href="#">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Contact Info</h6>
                        <ul class="contact_info contact_info_light">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>{{ get_settings('system_footer_contact_address') }}</p>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a target="_blank" href="mailto:{{ get_settings('system_footer_contact_email') }}">{{ get_settings('system_footer_contact_email') }}</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p>{{ get_settings('system_footer_contact_phone') }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-md-0 text-center text-md-start">
                        {!! get_settings('system_copyright_wizard') !!}
                    </p>
                </div>
                <div class="col-md-6">
                    <ul class="footer_payment text-center text-lg-end">
                        <li>
                            <a href="javascript:;">
                                <img style="width:300px;" src="{{ get_settings('system_payment_method_photo') ? asset(get_settings('system_payment_method_photo')) : '' }}" alt="Payment Method Photo">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
{{-- <a href="#" class="compare-button" target="_blank">
    <i class="lab la-whatsapp my-sudipmart"></i>
</a> --}}

@php
    
@endphp

<a href="javascript:;" class="cart-button compare-btn">
    <i class="fas fa-random"></i>
    <div class="label">Compare</div>
    <span class="counter compare_counter">{{ session()->get('compare_list') ? count(session()->get('compare_list')) : 0 }}</span>
</a>

<a href="javascript:;" class="cart-button">
    <i class="fas fa-shopping-bag"></i>
    <div class="label">Cart</div>
    <span class="counter">0</span>
</a>

<div class="cart-modal m-cart" id="m-cart">
    <div class="title">
        <p>YOUR CART</p>
        <span class="mc-toggler loaded close">
            <i class="ti-close"></i>
        </span>
    </div>
    <div class="content">
        <div class="empty-content">
            <p class="text-center">Your shopping cart is empty!</p>
        </div>
    </div>
    <div class="footer">
        <div class="promotion-code">
            <div class="input-group">
                <input type="text" placeholder="Promo Code" id="input-cart-coupon">
                <span class="input-group-btn">
                    <button class="btn btn-sm btn-fill-out rounded-0" type="submit">
                        Apply
                    </button>
                </span>
            </div>
        </div>
                
        <div class="total">
            <div class="title">Sub-Total</div>
            <div class="amount">0৳</div>
        </div>
                
        <div class="total">
            <div class="title">Total</div>
            <div class="amount">0৳</div>
        </div>
    </div>
</div>