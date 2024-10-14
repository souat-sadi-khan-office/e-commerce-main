<div class="middle-header dark_skin r">
    <div class="custom-container">
        <div class="nav_block">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="logo_light" src="{{ get_settings('system_logo_white') ? asset(get_settings('system_logo_white')) : asset('pictures/default-logo-white.png') }}" alt="System white logo">
                <img class="logo_dark" src="{{ get_settings('system_logo_dark') ? asset(get_settings('system_logo_dark')) : asset('pictures/default-logo-dark.png') }}" alt="System dark logo">
            </a>
            <div class="order-md-2">
                <ul class="navbar-nav attr-nav align-items-center">
                    <li style="cursor: pointer;">
                        <div class="q-actions system-selector">
                            <div class="ac">
                                <a class="ic" href="javascript:;">
                                    <img src="{{ asset('frontend/assets/images/eng.png') }}" alt="Country Flag">
                                </a>
                                <div class="ac-content">
                                    <p>English</p>
                                    <h5>
                                        Euro
                                        <svg viewBox="0 0 1024 1024" width="1em" height="1em" fill="currentColor" aria-hidden="false" focusable="false"><path d="M296.256 354.944l224 224 224-224a74.656 74.656 0 0 1 0 105.6l-197.6 197.6a37.344 37.344 0 0 1-52.8 0l-197.6-197.6a74.656 74.656 0 0 1 0-105.6z"></path></svg>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="cart_box" id="globalSelector">
                            <ul class="cart_list country-dropdown">
                                <li>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <h6>
                                                <b>Ship To</b>

                                                <span class="close-global-selector" style="float:right;">
                                                    <i class="linearicons-cross"></i>
                                                </span>
                                            </h6>
                                        </div>
        
                                        <div class="col-md-12 form-group mb-1">
                                            <select name="country_id" id="country_id" class="form-control select">
                                                <option value="">Bangladesh</option>
                                                <option value="">Singapore</option>
                                                <option value="">Malaysia</option>
                                                <option value="">Vieatnam</option>
                                                <option value="">Srilanka</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <select name="city_id" id="city_id" class="form-control select">
                                                <option value="">Dhaka</option>
                                                <option value="">Chittagond</option>
                                                <option value="">Rajshahi</option>
                                                <option value="">Khulna</option>
                                                <option value="">Sylhet</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12 form-group">
                                            <h6><b>Language</b></h6>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <select name="country_id" id="country_id" class="form-control select">
                                                <option value="">Bangladesh</option>
                                                <option value="">Singapore</option>
                                                <option value="">Malaysia</option>
                                                <option value="">Vieatnam</option>
                                                <option value="">Srilanka</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12 form-group">
                                            <h6><b>Currency</b></h6>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <select name="currency_id" id="currency_id" class="form-control   ">
                                                <option value="">USD</option>
                                                <option value="">BDT</option>
                                                <option value="">INR</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="cart_footer">
                                <p class="cart_buttons">
                                    <a href="#" class="btn btn-fill-line btn-sm rounded-0 btn-block">Save</a>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="product_search_form order-md-3">
                
                <form>
                    <div class="input-group">
                        <input class="form-control" placeholder="Search" required=""  type="text">
                        <button type="submit" class="search_btn">
                            <i class="linearicons-magnifier"></i>
                        </button>
                    </div>
                </form>
            </div>
            <ul class="navbar-nav attr-nav align-items-center order-md-5">
                <li>
                    <div class="q-actions">
                        <div class="ac">
                            <a class="ic" href="">
                                <i class="linearicons-heart"></i>
                            </a>
                            <div class="ac-content">
                                <a href="">
                                    <h5>Wishlist</h5>
                                </a>
                                <p>
                                    <a href="https://www.startech.com.bd/account/logout">0</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="q-actions">
                        <div class="ac">
                            <a class="ic" href="">
                                <i class="linearicons-user"></i>
                            </a>
                            <div class="ac-content">
                                <a href="">
                                    <h5>Account</h5>
                                </a>
                                <p>
                                    @if (Auth::guard('customer')->check())
                                        <a href="{{ route('dashboard') }}">Profile</a>
                                        or 
                                        <a href="{{ route('logout') }}">Logout</a>
                                    @else
                                        <a href="{{ route('login') }}">Login</a>
                                        or 
                                        <a href="{{ route('register') }}">Register</a>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <div class="contact_phone order-md-last">
                <i class="linearicons-phone-wave"></i>
                <span>123-456-7689</span>
            </div>
            {{-- <ul class="navbar-nav attr-nav align-items-center">
                <li class="">
                    <button type="submit" class="search_btn3">Search</button>
                </li>
                <li>
                    <div class="q-actions">
                        <div class="ac">
                            <a class="ic" href="">
                                <i class="linearicons-user"></i>
                            </a>
                            <div class="ac-content">
                                <a href="">
                                    <h5>Account</h5>
                                </a>
                                <p>
                                    <a href="https://www.startech.com.bd/account/account">Profile</a>
                                    or 
                                    <a href="https://www.startech.com.bd/account/logout">Logout</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                
            </ul> --}}
        </div>
    </div>
</div>