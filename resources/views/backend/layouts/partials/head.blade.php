<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/font_source_sans3.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/overlayscrollbars.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href={{ asset('backend/assets/css/adminlte.css') }}>
    @stack('styleforIconPicker')
    <link rel="stylesheet" href={{ asset('backend/assets/css/fontawesome.min.css') }}>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/toastr.min.css') }}">
    <script src="{{ asset('backend/assets/js/toastr.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- @livewireStyles --}}

    @livewireStyles
    @livewireScripts
    @stack('style')
</head>
