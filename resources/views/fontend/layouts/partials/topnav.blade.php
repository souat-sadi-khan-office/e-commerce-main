<div class="middle-header dark_skin">
    <div class="custom-container">
        <div class="nav_block">
            <a class="navbar-brand" href="index.html">
                <img class="logo_light" src="{{asset('fontend/assets/images/logo_light.png')}}" alt="logo" />
                <img class="logo_dark" src="{{asset('fontend/assets/images/logo_dark.png')}}" alt="logo" />
            </a>
            <div class="product_search_form rounded_input">
                <form>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="custom_select">
                                <select class="first_null">
                                    <option value="">All Category</option>
                                    <option value="Dresses">Dresses</option>
                                    <option value="Shirt-Tops">Shirt & Tops</option>
                                    <option value="T-Shirt">T-Shirt</option>
                                    <option value="Pents">Pents</option>
                                    <option value="Jeans">Jeans</option>
                                </select>
                            </div>
                        </div>
                        <input class="form-control" placeholder="Search Product..." required=""  type="text">
                        <button type="submit" class="search_btn2"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
            <ul class="navbar-nav attr-nav align-items-center">
                <li><a href="#" class="nav-link"><i class="linearicons-user"></i></a></li>
                <li><a href="#" class="nav-link"><i class="linearicons-heart"></i><span class="wishlist_count">0</span></a></li>
                <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-bs-toggle="dropdown"><i class="linearicons-bag2"></i><span class="cart_count">2</span><span class="amount"><span class="currency_symbol">$</span>159.00</span></a>
                    <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                        <ul class="cart_list">
                            <li>
                                <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                <a href="#"><img src="{{asset('fontend/assets/images/cart_thamb1.jpg')}}" alt="cart_thumb1">Variable product 001</a>
                                <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span></span>78.00</span>
                            </li>
                            <li>
                                <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                <a href="#"><img src="{{asset('fontend/assets/images/cart_thamb2.jpg')}}" alt="cart_thumb2">Ornare sed consequat</a>
                                <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span></span>81.00</span>
                            </li>
                        </ul>
                        <div class="cart_footer">
                            <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">$</span></span>159.00</p>
                            <p class="cart_buttons"><a href="#" class="btn btn-fill-line view-cart">View Cart</a><a href="#" class="btn btn-fill-out checkout">Checkout</a></p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>