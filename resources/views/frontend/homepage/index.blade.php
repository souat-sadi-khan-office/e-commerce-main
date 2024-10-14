@extends('frontend.layouts.app')
@section('title', 'HOME | CPL eCommarce')

@section('content')

        @include('frontend.homepage.bannerSection')
    <!-- Start MAIN CONTENT -->
    <div class="main_content">
        @if (View::exists('frontend.homepage.sliderSection') && homepage_setting('sliderSection'))
            @include('frontend.homepage.sliderSection')
        @endif

        @if (View::exists('frontend.homepage.midBanner') && homepage_setting('midBanner'))
            @include('frontend.homepage.midBanner')
        @endif

        @if (View::exists('frontend.homepage.dealOfTheDay') && homepage_setting('dealOfTheDay'))
            @include('frontend.homepage.dealOfTheDay')
        @endif

        @if (View::exists('frontend.homepage.trending') && homepage_setting('trending'))
            @include('frontend.homepage.trending')
        @endif

        @if (View::exists('frontend.homepage.brands') && homepage_setting('brands'))
            @include('frontend.homepage.brands')
        @endif

        @if (View::exists('frontend.homepage.popular&featured') && homepage_setting('popularANDfeatured'))
            @include('frontend.homepage.popular&featured')
        @endif

        @if (View::exists('frontend.homepage.newslatter') && homepage_setting('newslatter'))
            @include('frontend.homepage.newslatter')
        @endif

    </div>    
@endsection
