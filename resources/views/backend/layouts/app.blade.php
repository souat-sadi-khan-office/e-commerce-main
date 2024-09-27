@include('backend.layouts.partials.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('backend.layouts.partials.navbar')
        @include('backend.layouts.partials.sidebar')

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        
                        @if (View::hasSection('page_name'))
                            <div class="col-sm-6">
                                <h3 class="mb-0">@yield('page_name')</h3>
                            </div>
                        @endif

                        @if (View::hasSection('breadcrumb'))
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        @yield('page_name')
                                    </li>
                                </ol>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">

                    @yield('content')

                </div>
            </div>
        </main>
        @include('backend.layouts.partials.footer')

    </div>

    @stack('script')
    @include('backend.components.scripts')
</body>
</html>