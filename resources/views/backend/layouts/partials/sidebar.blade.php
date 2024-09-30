<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">

        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="https://bestwebcreator.com/shopwise/demo/assets/images/logo_dark.png" alt="App Logo"
                class="brand-image">
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
                        <li class="nav-item"> <a href="./index.html"
                                class="nav-link {{ Request::is('admin/categories') ? ' active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Primary Categories</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./index2.html"
                                class="nav-link {{ Request::is('admin/sub-categories') ? ' active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Sub Categories</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{route('admin.category.add')}}"
                                class="nav-link {{ Request::is('admin/categories/add') ? ' active' : '' }}"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Add Category</p>
                            </a> </li>
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
                            <a href="{{ route('admin.stuff.index') }}" class="nav-link {{ Request::is('admin/stuff') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>OTP Configuration</p>
                            </a> 
                        </li>

                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
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
                            <a href="{{ route('admin.stuff.index') }}" class="nav-link {{ Request::is('admin/stuff') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Header</p>
                            </a> 
                        </li>

                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Footer</p>
                            </a> 
                        </li>
                        
                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Pages</p>
                            </a> 
                        </li>

                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Appearance</p>
                            </a> 
                        </li>

                        
                    </ul>
                </li>

                <!-- Setup & Configuration -->
                <li class="nav-item ">
                    <a href="#" class="nav-link {{ Request::segment(2) == 'admin/roles' ? ' active' : '' }}">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Settings
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> 
                            <a href="{{ route('admin.stuff.index') }}" class="nav-link {{ Request::is('admin/stuff') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>General Settings</p>
                            </a> 
                        </li>
                        
                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Language</p>
                            </a> 
                        </li>

                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Currency</p>
                            </a> 
                        </li>

                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>VAT & Tax</p>
                            </a> 
                        </li>
                    </ul>
                </li>

                <!-- Shipping Configuration -->
                <li class="nav-item ">
                    <a href="#" class="nav-link {{ Request::segment(2) == 'admin/roles' ? ' active' : '' }}">
                        <i class="nav-icon bi bi-truck"></i>
                        <p>
                            Shipping
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> 
                            <a href="{{ route('admin.stuff.index') }}" class="nav-link {{ Request::is('admin/stuff') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Shipping Configuration</p>
                            </a> 
                        </li>

                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Zones</p>
                            </a> 
                        </li>
                        
                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Countries</p>
                            </a> 
                        </li>

                        <li class="nav-item"> 
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Cities</p>
                            </a> 
                        </li>

                        
                    </ul>
                </li>

                <!-- Staff & Permission -->
                <li class="nav-item {{ Request::is('admin/stuff') || Request::is('admin/roles') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::segment(2) == 'admin/roles' ? ' active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>
                            Staffs
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::guard('admin')->user()->hasPermissionTo('stuff.view'))
                            <li class="nav-item"> 
                                <a href="{{ route('admin.stuff.index') }}" class="nav-link {{ Request::is('admin/stuff') ? ' active' : '' }}"> 
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>All Staffs</p>
                                </a> 
                            </li>
                        @endif
                        
                        @if (Auth::guard('admin')->user()->hasPermissionTo('roles.view'))
                            <li class="nav-item"> 
                                <a href="{{ route('admin.roles.index') }}" class="nav-link {{ Request::is('admin/roles') ? ' active' : '' }}"> 
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Staff Permission</p>
                                </a> 
                            </li>
                        @endif
                    </ul>
                </li>

                <!-- System -->
                @if (Auth::guard('admin')->user()->hasPermissionTo('test-model.view'))
                    <li class="nav-item"> 
                        <a href="{{ route('admin.system_server') }}" class="nav-link {{ Request::is('admin/server-status') ? ' active' : '' }}"> 
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
