<div class="middle-header dark_skin">
    <div class="custom-container">
        <div class="nav_block">
            <a class="navbar-brand" href="index.html">
                <img class="logo_light" src="{{ get_settings('system_logo_white') ? asset(get_settings('system_logo_white')) : asset('pictures/default-logo-white.png') }}" alt="logo">
                <img class="logo_dark" src="{{ get_settings('system_logo_dark') ? asset(get_settings('system_logo_dark')) : asset('pictures/default-logo-dark.png') }}" alt="logo">
            </a>
            <div class="product_search_form">
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
                        <button type="submit" class="search_btn"><i class="linearicons-magnifier"></i></button>
                    </div>
                </form>
            </div>
            <ul class="navbar-nav attr-nav align-items-center">
            </ul>
        </div>
    </div>
</div>