<!DOCTYPE html>
<html lang="en">
@include('fontend.layouts.partials.head')

<body>
    @if (Request::is('/'))
        <input type="hidden" id="isHomePage" value="1">
    @else   
        <input type="hidden" id="isHomePage" value="0">
    @endif
    {{-- @include('fontend.layouts.partials.preloader') --}}
    {{-- @include('fontend.components.popup') --}}
    <!-- START HEADER -->
    <header class="header_wrap fixed-top header_with_topbar ">
        @include('fontend.layouts.partials.topbar')
        @include('fontend.layouts.partials.topnav')
        @include('fontend.layouts.partials.navbar')
    </header>
    <!-- END HEADER-->
    @stack('breadcrumb')

    @yield('content')

    @include('fontend.layouts.partials.footer')

    @include('fontend.layouts.partials.footerlinks')
    @stack('scripts')

</body>

</html>
