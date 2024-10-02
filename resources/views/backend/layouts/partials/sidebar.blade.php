<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">

        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ get_settings('system_logo_white') ? asset(get_settings('system_logo_white')) : asset('pictures/default-logo-white.png') }}" alt="App Logo" class="brand-image">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ Request::is('admin/dashboard') ? ' active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::segment(2) == 'categories' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::segment(2) == 'categories' ? ' active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Categories
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('admin.category.index') }}"
                                class="nav-link {{ Request::is('admin/categories') ? ' active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Primary Categories</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('admin.category.index.sub') }}"
                                class="nav-link {{ Request::is('admin/categories/sub') ? ' active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Sub Categories</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('admin.category.add') }}"
                                class="nav-link {{ Request::is('admin/categories/add') ? ' active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Category</p>
                            </a> </li>
                    </ul>
                </li>

                <!-- Brands -->
                <li class="nav-item {{ Request::is('admin/brand*') || Request::is('admin/brand-type') ? 'menu-open' : '' }}">
                    <a href="javascript:;" class="nav-link {{ Request::is('admin/brand') || Request::is('admin/brand/create') || Request::is('admin/brand-type') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-ubuntu"></i>
                        <p>
                            Brands
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> 
                            <a href="{{ route('admin.brand.index') }}" class="nav-link {{ Request::is('admin/brand') || Request::is('admin/brand/*') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Brand</p>
                            </a> 
                        <li class="nav-item"> <a href="{{ route('admin.category.sub.add') }}"
                                class="nav-link {{ Request::is('admin/categories/sub/add') ? ' active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Sub Category</p>
                            </a>
                        </li>

                        <li class="nav-item"> 
                            <a href="{{ route('admin.brand-type.index') }}" class="nav-link {{ Request::is('admin/brand-type') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Brand Types</p>
                            </a> 
                        <li class="nav-item {{ Request::segment(3) == 'specification' ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link {{ Request::segment(3) == 'specification' ? ' active' : '' }}">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>
                                    Specification Keys
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"> <a href="{{ route('admin.category.specification.key.index') }}"
                                        class="nav-link {{ Request::is('admin/categories/specification/keys') ? ' active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Add Keys</p>
                                    </a>
                                </li>
                                <li class="nav-item"> <a href="{{ route('admin.category.specification.type.index') }}"
                                    class="nav-link {{ Request::is('admin/categories/specification/types') ? ' active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Add Key Types</p>
                                </a>
                            </li>
                            <li class="nav-item"> <a href="{{ route('admin.category.specification.type.attribute.index') }}"
                                class="nav-link {{ Request::is('admin/categories/specification/types/attributes') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Add Type attributes</p>
                            </a>
                        </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- OTP Setup -->
                <li class="nav-item ">
                    <a href="#" class="nav-link {{ Request::segment(2) == 'admin/roles' ? ' active' : '' }}">
                        <i class="nav-icon bi bi-telephone"></i>
                        <p>
                            OTP Setup
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.stuff.index') }}"
                                class="nav-link {{ Request::is('admin/stuff') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>OTP Configuration</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>OTP Templates</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Website Setup -->
                <li class="nav-item ">
                    <a href="#" class="nav-link {{ Request::segment(2) == 'admin/roles' ? ' active' : '' }}">
                        <i class="nav-icon bi bi-globe"></i>
                        <p>
                            Website Setup
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.stuff.index') }}"
                                class="nav-link {{ Request::is('admin/stuff') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Header</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Footer</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Pages</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Appearance</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <!-- Setup & Configuration -->
                <li class="nav-item {{ Request::is('admin/settings/*') || Request::is('admin/currency') ? 'menu-open' : '' }}">
                    <a href="javascript:;" class="nav-link {{ Request::is('admin/settings/*') ? ' active' : '' }}">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Settings
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> 
                            <a href="{{ route('admin.settings.general') }}" class="nav-link {{ Request::is('admin/settings/general') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>General Settings</p>
                            </a>
                        </li>
                        
                        {{-- <li class="nav-item"> 
                            <a href="{{ route('admin.settings') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Language</p>
                            </a> 
                        </li> --}}

                        <li class="nav-item"> 
                            <a href="{{ route('admin.currency.index') }}" class="nav-link {{ Request::is('admin/currency') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Currency</p>
                            </a>
                        </li>

                        <li class="nav-item"> 
                            <a href="{{ route('admin.settings.vat') }}" class="nav-link {{ Request::is('admin/settings/vat') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>VAT & Tax</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Shipping Configuration -->
                <li
                    class="nav-item {{ Request::is('admin/zone') || Request::is('admin/city') || Request::is('admin/country') ? 'menu-open' : '' }}">
                    <a href="javascript:;" class="nav-link ">
                        <i class="nav-icon bi bi-truck"></i>
                        <p>
                            Shipping
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.stuff.index') }}"
                                class="nav-link {{ Request::is('admin/stuff') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Shipping Configuration</p>
                            </a>
                        </li>

                        {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('zone.view')) --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.zone.index') }}"
                                class="nav-link {{ Request::is('admin/zone') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Zones</p>
                            </a>
                        </li>
                        {{-- @endif --}}

                        {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('country.view')) --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Countries</p>
                            </a>
                        </li>
                        {{-- @endif --}}

                        {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('city.view')) --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Cities</p>
                            </a>
                        </li>
                        {{-- @endif --}}
                    </ul>
                </li>

                <!-- Staff & Permission -->
                <li
                    class="nav-item {{ Request::is('admin/stuff') || Request::is('admin/roles') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::segment(2) == 'admin/roles' ? ' active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>
                            Staffs
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('stuff.view')) --}}
                            <li class="nav-item"> 
                                <a href="{{ route('admin.stuff.index') }}" class="nav-link {{ Request::is('admin/stuff*') ? ' active' : '' }}"> 
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>All Staffs</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                        
                        {{-- @if (Auth::guard('admin')->user()->hasPermissionTo('roles.view')) --}}
                            <li class="nav-item"> 
                                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles*') ? ' active' : '' }}"> 
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Staff Permission</p>
                                </a>
                            </li>
                        {{-- @endif --}}
                    </ul>
                </li>

                <!-- System -->
                @if (Auth::guard('admin')->user()->hasPermissionTo('test-model.view'))
                    <li class="nav-item">
                        <a href="{{ route('admin.system_server') }}"
                            class="nav-link {{ Request::is('admin/server-status') ? ' active' : '' }}">
                            <i class="nav-icon bi bi-hdd"></i>
                            <p>
                                System
                            </p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>
