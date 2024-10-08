@extends('fontend.layouts.app')
@section('title', 'HOME | CPL eCommarce')

@section('content')

        @include('fontend.homepage.bannerSection')
    <!-- Start MAIN CONTENT -->
    <div class="main_content">
        @if (View::exists('fontend.homepage.sliderSection') && homepage_setting('sliderSection'))
            @include('fontend.homepage.sliderSection')
        @endif

        @if (View::exists('fontend.homepage.midBanner') && homepage_setting('midBanner'))
            @include('fontend.homepage.midBanner')
        @endif

        @if (View::exists('fontend.homepage.dealOfTheDay') && homepage_setting('dealOfTheDay'))
            @include('fontend.homepage.dealOfTheDay')
        @endif

        @if (View::exists('fontend.homepage.trending') && homepage_setting('trending'))
            @include('fontend.homepage.trending')
        @endif

        @if (View::exists('fontend.homepage.brands') && homepage_setting('brands'))
            @include('fontend.homepage.brands')
        @endif

        @if (View::exists('fontend.homepage.popular&featured') && homepage_setting('popularANDfeatured'))
            @include('fontend.homepage.popular&featured')
        @endif

        @if (View::exists('fontend.homepage.newslatter') && homepage_setting('newslatter'))
            @include('fontend.homepage.newslatter')
        @endif

    </div>
@endsection
