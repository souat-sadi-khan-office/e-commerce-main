<div class="col-lg-3 col-md-4">
    <div class="dashboard_menu bg_white">
        <ul class="nav nav-tabs flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="ti-layout-grid2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/my-orders') ? 'active' : '' }}" href="{{ route('account.my_orders') }}">
                    <i class="ti-shopping-cart-full"></i>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/quotes') ? 'active' : '' }}" href="{{ route('account.quote') }}">
                    <i class="ti-list"></i>
                    Quote
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/edit-profile') ? 'active' : '' }}" href="{{ route('account.edit_profile') }}">
                    <i class="ti-user"></i>
                    Edit Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/change-password') ? 'active' : '' }}" href="{{ route('account.change_password') }}">
                    <i class="ti-lock"></i>
                    Change Password
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/phone-book*') ? 'active' : '' }}" href="{{ route('account.phone-book.index') }}">
                    <i class="ti-mobile"></i>
                    Phone Book
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/address-book*') ? 'active' : '' }}" href="{{ route('account.address-book.index') }}">
                    <i class="ti-location-pin"></i>
                    Address
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/wish-list') ? 'active' : '' }}" href="{{ route('account.wishlist') }}">
                    <i class="ti-heart"></i>
                    Wish List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/saved-pc') ? 'active' : '' }}" href="{{ route('account.saved_pc') }}">
                    <i class="ti-desktop"></i>
                    Saved PC
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('account/star-points') ? 'active' : '' }}" href="{{ route('account.star_points') }}">
                    <i class="ti-star"></i>
                    Star Points
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account/transaction') ? 'active' : '' }}" href="{{ route('account.transaction') }}">
                    <i class="ti-wallet"></i>
                    Your Transactions
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" id="logout" href="javascript:;" data-url="{{ route('logout') }}">
                    <i class="ti-lock"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>