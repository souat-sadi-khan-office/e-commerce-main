@include('backend.layouts.partials.head')
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('backend.layouts.partials.navbar')
        @include('backend.layouts.partials.sidebar')


        <main class="app-main">
            @if (View::hasSection('page_name'))
                @yield('page_name')
            @endif

            <div class="app-content">
                <div class="container-fluid">

                    @yield('content')

                </div>
            </div>
        </main>
        @include('backend.layouts.partials.footer')

    </div>

    @include('backend.components.scripts')
    @stack('script')
</body>
</html>