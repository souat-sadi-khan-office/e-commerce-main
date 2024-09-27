<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">

        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="https://bestwebcreator.com/shopwise/demo/assets/images/logo_dark.png" alt="App Logo" class="brand-image">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"  data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item"> 
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? ' active' : '' }}"> 
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <!-- System -->
                <li class="nav-item"> 
                    <a href="{{ route('admin.system_server') }}" class="nav-link {{ Request::is('admin/server-status') ? ' active' : '' }}"> 
                        <i class="nav-icon bi bi-hdd"></i>
                        <p>
                            System
                        </p>
                    </a>
                </li>
                
            </ul>
        </nav>
    </div>
</aside>