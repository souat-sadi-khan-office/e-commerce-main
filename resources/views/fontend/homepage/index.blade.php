@extends('fontend.layouts.app')
@section('title', 'HOME | CPL eCommarce')

@section('content')
    @include('fontend.homepage.bannerSection')
    <!-- Start MAIN CONTENT -->
    <div class="main_content">

        @include('fontend.homepage.sliderSection')

        @if(View::exists('fontend.homepage.midBanner'))
            @include('fontend.homepage.midBanner')
        @endif

        @if(View::exists('fontend.homepage.dealOfTheDay'))
            @include('fontend.homepage.dealOfTheDay')
        @endif

        @if(View::exists('fontend.homepage.trending'))
            @include('fontend.homepage.trending')
        @endif

        @if(View::exists('fontend.homepage.brands'))
            @include('fontend.homepage.brands')
        @endif

        @if(View::exists('fontend.homepage.popular&featured'))
            @include('fontend.homepage.popular&featured')
        @endif

        @if(View::exists('fontend.homepage.newslatter'))
            @include('fontend.homepage.newslatter')
        @endif

    </div>

    <input type="hidden" id="isHomePage" value="1">
    
@endsection
