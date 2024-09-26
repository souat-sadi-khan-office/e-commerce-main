@include('backend.layouts.partials.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        @include('backend.layouts.partials.navbar')
        @include('backend.layouts.partials.sidebar')

        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('page_name')</h3>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    @yield('page_name')
                                </li>
                            </ol>
                        </div>

                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->

                    @yield('content')

                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        @include('backend.layouts.partials.footer')

    </div>
    <!--begin::Script-->
    @stack('script')
    @include('backend.components.scripts')
</body>
<!--end::Body-->


</html>
