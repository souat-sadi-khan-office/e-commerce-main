<head>

    @include('fontend.layouts.partials.seo')

    <link rel="stylesheet" href="{{asset('fontend/assets/css/animate.css')}}">	
    <link rel="stylesheet" href="{{asset('fontend/assets/bootstrap/css/bootstrap.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="{{asset('fontend/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/owlcarousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/owlcarousel/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/owlcarousel/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('fontend/assets/css/responsive.css')}}">

    @stack('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('styles')
</head>
