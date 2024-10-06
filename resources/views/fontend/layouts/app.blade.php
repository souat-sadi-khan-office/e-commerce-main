<!DOCTYPE html>
<html lang="en">
@include('fontend.layouts.partials.head')

<body>
    @include('fontend.layouts.partials.preloader')
    @include('fontend.components.popup')
    <!-- START HEADER -->
    <header class="header_wrap">
        @include('fontend.layouts.partials.topbar')
        @include('fontend.layouts.partials.topnav')
        @include('fontend.layouts.partials.navbar')
    </header>
    <!-- END HEADER-->

    @yield('content')

    @include('fontend.layouts.partials.footer')

    <a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>
    
    @include('fontend.layouts.partials.footerlinks')
    @stack('scripts')

</body>

</html>
