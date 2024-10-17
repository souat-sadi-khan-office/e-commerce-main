<div class="bottom_header dark_skin main_menu_uppercase border-top border-bottom">
    <div class="custom-container">
        <div class="row align-items-center"> 
            <div class="col-lg-3 col-md-4 col-sm-6 col-3">
                <div class="categories_wrap">
                    <button type="button" data-bs-toggle="collapse" data-bs-target="#navCatContent" aria-expanded="false" class="categories_btn categories_menu">
                        <span>All Categories </span>
                        <i class="linearicons-menu"></i>
                    </button>
                    <div id="navCatContent" class="{{ Request::is('/') ? 'nav_cat' : '' }} navbar nav collapse">
                        {{-- <ul> 
                            
                            @foreach ($main_categories as $main_category)
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-item nav-link dropdown-toggler" href="{{ route('slug.handle', $main_category->slug) }}" data-bs-toggle="dropdown">
                                        <img class="category-image" src="{{ asset($main_category->photo) }}" alt="{{ $main_category->name }}">
                                        <span>{{ $main_category->name }}</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-7">
                                                <ul class="d-lg-flex">
                                                    <li class="mega-menu-col col-lg-6">
                                                        <ul> 
                                                            <li class="dropdown-header">Featured Item</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Vestibulum sed</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur tempus</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-6">
                                                        <ul>
                                                            <li class="dropdown-header">Popular Item</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur laoreet</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur tempus</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-5">
                                                <div class="header-banner2">
                                                    <img src="{{ asset('frontend/assets/images/menu_banner7.jpg') }}" alt="menu_banner1">
                                                    <div class="banne_info">
                                                        <h6>10% Off</h6>
                                                        <h4>Computers</h4>
                                                        <a href="#">Shop now</a>
                                                    </div>
                                                </div>
                                                <div class="header-banner2">
                                                    <img src="{{ asset('frontend/assets/images/menu_banner8.jpg') }}" alt="menu_banner2">
                                                    <div class="banne_info">
                                                        <h6>15% Off</h6>
                                                        <h4>Top Laptops</h4>
                                                        <a href="#">Shop now</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                            
                            <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-item nav-link dropdown-toggler" href="#" data-bs-toggle="dropdown"><i class="flaticon-responsive"></i> <span>Mobile & Tablet</span></a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-7">
                                            <ul class="d-lg-flex">
                                                <li class="mega-menu-col col-lg-6">
                                                    <ul> 
                                                        <li class="dropdown-header">Featured Item</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Vestibulum sed</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur tempus</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-6">
                                                    <ul>
                                                        <li class="dropdown-header">Popular Item</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur laoreet</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-5">
                                            <div class="header-banner2">
                                                <a href="#"><img src="{{ asset('frontend/assets/images/menu_banner6.jpg') }}" alt="menu_banner"></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-item nav-link dropdown-toggler" href="#" data-bs-toggle="dropdown"><i class="flaticon-camera"></i> <span>Camera</span></a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-7">
                                            <ul class="d-lg-flex">
                                                <li class="mega-menu-col col-lg-6">
                                                    <ul> 
                                                        <li class="dropdown-header">Featured Item</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Vestibulum sed</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur tempus</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-6">
                                                    <ul>
                                                        <li class="dropdown-header">Popular Item</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Curabitur laoreet</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Vivamus in tortor</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae facilisis</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Quisque condimentum</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Etiam ac rutrum</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec vitae ante ante</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="#">Donec porttitor</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-5">
                                            <div class="header-banner2">
                                                <a href="#"><img src="{{ asset('frontend/assets/images/menu_banner9.jpg') }}" alt="menu_banner"></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-item nav-link dropdown-toggler" href="#" data-bs-toggle="dropdown"><i class="flaticon-plugins"></i> <span>Accessories</span></a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-4">
                                            <ul> 
                                                <li class="dropdown-header">Woman's</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">Vestibulum sed</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Donec porttitor</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Donec vitae facilisis</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">Curabitur tempus</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Vivamus in tortor</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-4">
                                            <ul>
                                                <li class="dropdown-header">Men's</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Donec vitae ante ante</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Etiam ac rutrum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Quisque condimentum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="compare.html">Curabitur laoreet</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="order-completed.html">Vivamus in tortor</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-4">
                                            <ul>
                                                <li class="dropdown-header">Kid's</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Donec vitae facilisis</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Etiam ac rutrum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae ante ante</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec porttitor</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul> --}}
                        <ul>
                            @foreach ($main_categories as $main_category)
                                <li class="{{ $main_category->children->isNotEmpty() ? 'dropdown dropdown-mega-menu' : '' }}">
                                    @if ($main_category->children->isNotEmpty())
                                        <a class="nav-link dropdown-item dropdown-toggler" href="{{ route('slug.handle', $main_category->slug) }}" data-bs-toggle="dropdown">
                                            {!! $main_category->icon !!}
                                            <span>{{ $main_category->name }}</span>
                                        </a>
                                    @else
                                        <a class="nav-link" href="{{ route('slug.handle', $main_category->slug) }}">
                                            {!! $main_category->icon !!}
                                            <span>{{ $main_category->name }}</span>
                                        </a>
                                    @endif
                                    
                                    @if($main_category->children->isNotEmpty())
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li class="dropdown-header">{{ $main_category->name }}</li>
                                            @foreach($main_category->children as $child_category)
                                                <li>
                                                    <a class="dropdown-item nav-link nav_item" href="{{ route('slug.handle', $child_category->slug) }}">
                                                        {{ $child_category->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                            {{-- <li class="mega-menu-col col-lg-5">
                                                <div class="header-banner2">
                                                    <img src="{{ asset('frontend/assets/images/menu_banner7.jpg') }}" alt="menu_banner1">
                                                    <div class="banne_info">
                                                        <h6>10% Off</h6>
                                                        <h4>Computers</h4>
                                                        <a href="#">Shop now</a>
                                                    </div>
                                                </div>
                                                <div class="header-banner2">
                                                    <img src="{{ asset('frontend/assets/images/menu_banner8.jpg') }}" alt="menu_banner2">
                                                    <div class="banne_info">
                                                        <h6>15% Off</h6>
                                                        <h4>Top Laptops</h4>
                                                        <a href="#">Shop now</a>
                                                    </div>
                                                </div>
                                            </li> --}}
                                    </div>
                                    @endif
                                </li>
                            @endforeach
                            <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-item nav-link dropdown-toggler" href="#" data-bs-toggle="dropdown"><i class="flaticon-plugins"></i> <span>Accessories</span></a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-4">
                                            <ul> 
                                                <li class="dropdown-header">Woman's</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">Vestibulum sed</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Donec porttitor</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Donec vitae facilisis</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">Curabitur tempus</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Vivamus in tortor</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-4">
                                            <ul>
                                                <li class="dropdown-header">Men's</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Donec vitae ante ante</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Etiam ac rutrum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Quisque condimentum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="compare.html">Curabitur laoreet</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="order-completed.html">Vivamus in tortor</a></li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-4">
                                            <ul>
                                                <li class="dropdown-header">Kid's</li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Donec vitae facilisis</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Etiam ac rutrum</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae ante ante</a></li>
                                                <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec porttitor</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <a href="{{ route('categories') }}" class="more_categories">
                            All Categories
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler side_navbar_toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSidetoggle" aria-expanded="false"> 
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="pr_search_icon">
                        <a href="javascript:;" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
                    </div> 
                    <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                        {{-- <ul class="navbar-nav">
                            <li class="dropdown">
                                <a data-bs-toggle="dropdown" class="nav-link dropdown-toggle active" href="#">Home</a>
                                <div class="dropdown-menu">
                                    <ul> 
                                        <li><a class="dropdown-item nav-link nav_item" href="index.html">Fashion 1</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="index-2.html">Fashion 2</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="index-3.html">Furniture 1</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="index-4.html">Furniture 2</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="index-5.html">Electronics 1</a></li>
                                        <li><a class="dropdown-item nav-link nav_item active" href="index-6.html">Electronics 2</a></li>
                                    </ul>
                                </div>   
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu">
                                    <ul> 
                                        <li><a class="dropdown-item nav-link nav_item" href="about.html">About Us</a></li> 
                                        <li><a class="dropdown-item nav-link nav_item" href="contact.html">Contact Us</a></li> 
                                        <li><a class="dropdown-item nav-link nav_item" href="faq.html">Faq</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="404.html">404 Error Page</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="login.html">Login</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="signup.html">Register</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="term-condition.html">Terms and Conditions</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Products</a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                <li class="mega-menu-col col-lg-3">
                                    <ul> 
                                        <li class="dropdown-header">Woman's</li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">Vestibulum sed</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Donec porttitor</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Donec vitae facilisis</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">Curabitur tempus</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Vivamus in tortor</a></li>
                                    </ul>
                                </li>
                                <li class="mega-menu-col col-lg-3">
                                    <ul>
                                        <li class="dropdown-header">Men's</li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Donec vitae ante ante</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Etiam ac rutrum</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Quisque condimentum</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="compare.html">Curabitur laoreet</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="order-completed.html">Vivamus in tortor</a></li>
                                    </ul>
                                </li>
                                <li class="mega-menu-col col-lg-3">
                                    <ul>
                                        <li class="dropdown-header">Kid's</li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Donec vitae facilisis</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Etiam ac rutrum</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae ante ante</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec porttitor</a></li>
                                    </ul>
                                </li>
                                <li class="mega-menu-col col-lg-3">
                                    <ul>
                                        <li class="dropdown-header">Accessories</li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Donec vitae facilisis</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Etiam ac rutrum</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae ante ante</a></li>
                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec porttitor</a></li>
                                    </ul>
                                </li>
                            </ul>
                                    <div class="d-lg-flex menu_banners row g-3 px-3">
                                        <div class="col-lg-6">
                                            <div class="header-banner">
                                                <div class="sale-banner">
                                                    <a class="hover_effect1" href="#">
                                                        <img src="{{ asset('frontend/assets/images/shop_banner_img7.jpg') }}" alt="shop_banner_img7">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="header-banner">
                                                <div class="sale-banner">
                                                    <a class="hover_effect1" href="#">
                                                        <img src="{{ asset('frontend/assets/images/shop_banner_img8.jpg') }}" alt="shop_banner_img8">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Blog</a>
                                <div class="dropdown-menu dropdown-reverse">
                                    <ul>
                                        <li>
                                            <a class="dropdown-item menu-link dropdown-toggler" href="#">Grids</a>
                                            <div class="dropdown-menu">
                                                <ul> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-three-columns.html">3 columns</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-four-columns.html">4 columns</a></li> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-left-sidebar.html">Left Sidebar</a></li> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-right-sidebar.html">right Sidebar</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-standard-left-sidebar.html">Standard Left Sidebar</a></li> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-standard-right-sidebar.html">Standard right Sidebar</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item menu-link dropdown-toggler" href="#">Masonry</a>
                                            <div class="dropdown-menu">
                                                <ul> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-three-columns.html">3 columns</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-four-columns.html">4 columns</a></li> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-left-sidebar.html">Left Sidebar</a></li> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-right-sidebar.html">right Sidebar</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item menu-link dropdown-toggler" href="#">Single Post</a>
                                            <div class="dropdown-menu">
                                                <ul> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single.html">Default</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single-left-sidebar.html">left sidebar</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single-slider.html">slider post</a></li> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single-video.html">video post</a></li> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-single-audio.html">audio post</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item menu-link dropdown-toggler" href="#">List</a>
                                            <div class="dropdown-menu">
                                                <ul> 
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-list-left-sidebar.html">left sidebar</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="blog-list-right-sidebar.html">right sidebar</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown dropdown-mega-menu">
                                <a class="dropdown-toggle nav-link" href="#" data-bs-toggle="dropdown">Shop</a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-9">
                                            <ul class="d-lg-flex">
                                                <li class="mega-menu-col col-lg-4">
                                                    <ul> 
                                                        <li class="dropdown-header">Shop Page Layout</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">shop List view</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">shop List Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-list-right-sidebar.html">shop List Right Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Shop Load More</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-4">
                                                    <ul>
                                                        <li class="dropdown-header">Other Pages</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Cart</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Checkout</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="my-account.html">My Account</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Wishlist</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="compare.html">compare</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="order-completed.html">Order Completed</a></li>
                                                    </ul>
                                                </li>
                                                <li class="mega-menu-col col-lg-4">
                                                    <ul>
                                                        <li class="dropdown-header">Product Pages</li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Default</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Right Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Thumbnails Left</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="mega-menu-col col-lg-3">
                                            <div class="header_banner">
                                                <div class="header_banner_content">
                                                    <div class="shop_banner">
                                                        <div class="banner_img overlay_bg_40">
                                                            <img src="{{ asset('frontend/assets/images/shop_banner4.jpg') }}" alt="shop_banner2"/>
                                                        </div> 
                                                        <div class="shop_bn_content">
                                                            <h6 class="text-uppercase shop_subtitle">New Collection</h6>
                                                            <h5 class="text-uppercase shop_title">Sale 30% Off</h5>
                                                            <a href="#" class="btn btn-white rounded-0 btn-xs text-uppercase">Shop Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a class="nav-link nav_item" href="contact.html">Contact Us</a></li> 
                        </ul> --}}
                    </div>
                    <div class="pc-build-guide">
                        <a href="{{ route('laptop-buying-guide') }}" class="btn btn-sm btn-fill-out rounded py-2">
                            <i class="fas fa-laptop"></i>
                            Laptop Buying Guide
                        </a>
                        <a href="{{ route('pc-builder') }}" class="btn btn-sm btn-fill-out rounded py-2">
                            <i class="fas fa-desktop"></i>
                            PC Builder
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>