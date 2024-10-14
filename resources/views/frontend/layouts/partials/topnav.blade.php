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
                                    <div class="row mb-3">
                                        <div class="col-md-12 mb-2 form-group">
                                            <h6>
                                                <b>Ship To</b>

                                                <span class="close-global-selector" style="float:right;">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                            </h6>
                                        </div>
        
                                        <div class="col-md-12 form-group mb-2">
                                            <select name="country_id" id="country_id" class="form-control select">
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Vieatnam">Vieatnam</option>
                                                <option value="Srilanka">Srilanka</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <select name="city_id" id="city_id" class="form-control select">
                                                <option value="Dhaka">Dhaka</option>
                                                <option value="Chittagond">Chittagond</option>
                                                <option value="Rajshahi">Rajshahi</option>
                                                <option value="Khulna">Khulna</option>
                                                <option value="Sylhet">Sylhet</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 form-group">
                                            <h6><b>Language</b></h6>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <select name="language" id="language" class="form-control select">
                                                <option value="en">English</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <h6><b>Currency</b></h6>
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <select name="currency_id" id="currency_id" class="form-control select">
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
                                    <a href="#" class="btn btn-fill-line rounded-0 btn-block">Save</a>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="product_search_form order-md-3">
                <form>
                    <div class="input-group">
                        <input class="form-control" placeholder="Search" required id="search" name="search" type="text">
                        <button type="submit" class="search_btn">
                            <i class="linearicons-magnifier"></i>
                        </button>
                    </div>
                </form>
                <div class="typed-search-box stop-propagation document-click-d-none d-none bg-white rounded shadow-lg position-absolute left-0 top-100 w-100" style="min-height: 200px">
                    <div class="searching-preloader">
                        <div class="search-preloader">
                            <div class="lds-ellipsis">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="search-nothing d-none p-3 text-center fs-16">
                        
                    </div>
                    <div id="search-content" class="text-left">
                        <div class="">
                            <div class="px-2 py-1 text-uppercase text-muted bg-soft-secondary">Popular Suggesstion</div>
                            <ul class="list-group">
                                <li class="list-group-item py-1">
                                    <a class="text-reset hov-text-primary" href="#">Processor</a>
                                </li>
                                <li class="list-group-item py-1">
                                    <a class="text-reset hov-text-primary" href="#">Motherboard</a>
                                </li>
                                <li class="list-group-item py-1">
                                    <a class="text-reset hov-text-primary" href="#">Ram</a>
                                </li>
                                <li class="list-group-item py-1">
                                    <a class="text-reset hov-text-primary" href="#">Ssd</a>
                                </li>
                                <li class="list-group-item py-1">
                                    <a class="text-reset hov-text-primary" href="#">Psu</a>
                                </li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary">Category Suggestions</div>
                            <ul class="list-group">
                                <li class="list-group-item py-1">
                                    <a class="text-reset hov-text-primary" href="#">Desktop</a>
                                </li>
                                <li class="list-group-item py-1">
                                    <a class="text-reset hov-text-primary" href="#">Laptop</a>
                                </li>
                                <li class="list-group-item py-1">
                                    <a class="text-reset hov-text-primary" href="#">Monitor</a>
                                </li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="px-2 py-1 text-uppercase fs-10 text-right text-muted bg-soft-secondary">Products</div>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a class="text-reset" href="#">
                                        <div class="row">
                                            <div class="col-auto">
                                                <img class="search-image" src="https://www.startech.com.bd/image/cache/catalog/processor/amd/ryzen-5-5600g/ryzen-5-5600g-228x228.jpg">
                                            </div>
                                            <div class="col">
                                                <div class="product-name text-truncate fs-14 mb-5px">
                                                    AMD Ryzen 5 5600G Processor with Radeon Graphics
                                                </div>
                                                <div class="">
                                                   
                                                    <del class="opacity-60 fs-15">13,900</del>
                                                    <span class="fw-600 fs-16 text-primary">13,700</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a class="text-reset" href="#">
                                        <div class="row">
                                            <div class="col-auto">
                                                <img class="search-image" src="https://www.startech.com.bd/image/cache/catalog/processor/amd/ryzen-5-5600g/ryzen-5-5600g-228x228.jpg">
                                            </div>
                                            <div class="col">
                                                <div class="product-name text-truncate fs-14 mb-5px">
                                                    AMD Ryzen 5 5600G Processor with Radeon Graphics
                                                </div>
                                                <div class="">
                                                   
                                                    <del class="opacity-60 fs-15">13,900</del>
                                                    <span class="fw-600 fs-16 text-primary">13,700</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a class="text-reset" href="#">
                                        <div class="row">
                                            <div class="col-auto">
                                                <img class="search-image" src="https://www.startech.com.bd/image/cache/catalog/processor/amd/ryzen-5-5600g/ryzen-5-5600g-228x228.jpg">
                                            </div>
                                            <div class="col">
                                                <div class="product-name text-truncate fs-14 mb-5px">
                                                    AMD Ryzen 5 5600G Processor with Radeon Graphics
                                                </div>
                                                <div class="">
                                                   
                                                    <del class="opacity-60 fs-15">13,900</del>
                                                    <span class="fw-600 fs-16 text-primary">13,700</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
                                    <a href="#">0</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="q-actions">
                        <div class="ac">
                            <a class="ic" href="{{ route('login') }}">
                                <i class="linearicons-user"></i>
                            </a>
                            <div class="ac-content">
                                <a href="{{ route('login') }}">
                                    <h5>Account</h5>
                                </a>
                                <p>
                                    @if (Auth::guard('customer')->check())
                                        <a href="{{ route('dashboard') }}">Profile</a>
                                        or 
                                        <a id="logout" href="javascript:;" data-url="{{ route('logout') }}">Logout</a>
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
        </div>
    </div>
</div>