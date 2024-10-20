@extends('frontend.layouts.app')
@section('title', 'HOME | CPL eCommarce')

@section('content')

    @include('frontend.homepage.bannerSection', ['banners' => $banners])
    <!-- Start MAIN CONTENT -->
    <div class="main_content">

        {{-- <div class="section mt-5">
            <div class="custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="cat_overlap radius_all_5">
                            <div class="row align-items-center">
                                <div class="col-lg-3 col-md-4">
                                    <div class="text-center text-md-start">
                                        <h4>Featured Categories</h4>
                                        <p class="mb-2">There are many variations of passages of Lorem</p>
                                        <a href="#" class="btn btn-line-fill btn-sm">View All</a>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <div class="cat_slider mt-4 mt-md-0 carousel_slider owl-carousel owl-theme nav_style5" data-loop="true" data-dots="false" data-nav="true" data-margin="30" data-responsive='{"0":{"items": "1"}, "380":{"items": "2"}, "991":{"items": "3"}, "1199":{"items": "6"}}'>
                                        <div class="item">
                                            <div class="categories_box">
                                                <a href="#">
                                                    <i class="flaticon-bed"></i>
                                                    <span>Bedroom</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="categories_box">
                                                <a href="#">
                                                    <i class="flaticon-table"></i>
                                                    <span>Dining Table</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="categories_box">
                                                <a href="#">
                                                    <i class="flaticon-sofa"></i>
                                                    <span>Sofa</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="categories_box">
                                                <a href="#">
                                                    <i class="flaticon-armchair"></i>
                                                    <span>Armchair</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="categories_box">
                                                <a href="#">
                                                    <i class="flaticon-chair"></i>
                                                    <span>chair</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="categories_box">
                                                <a href="#">
                                                    <i class="flaticon-desk-lamp"></i>
                                                    <span>desk lamp</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        @if (View::exists('frontend.homepage.sliderSection') && homepage_setting('sliderSection'))
            @include('frontend.homepage.sliderSection',['newProducts'=>$newProducts])
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

@push('scripts')
    <script>

        $(document).ready(function() {
            _newsletterFormValidation();

            $('#newsletter_submit').show();
            $('#newsletter_submitting').hide();
        })
        

        var _newsletterFormValidation = function () {
            if ($('#newletter-form').length > 0) {
                $('#newletter-form').parsley().on('field:validated', function () {
                    var ok = $('.parsley-error').length === 0;
                    $('.bs-callout-info').toggleClass('hidden', !ok);
                    $('.bs-callout-warning').toggleClass('hidden', ok);
                });
            }

            $('#newletter-form').on('submit', function (e) {
                e.preventDefault();

                $('#newsletter_submit').hide();
                $('#newsletter_submitting').show();

                $(".ajax_error").remove();

                var submit_url = $('#newletter-form').attr('action');
                var formData = new FormData($("#newletter-form")[0]);

                $.ajax({
                    url: submit_url,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'JSON',
                    success: function (data) {
                        if (!data.status) {
                            if (data.validator) {
                                for (const [key, messages] of Object.entries(data.message)) {
                                    messages.forEach(message => {
                                        toastr.error(message);
                                    });
                                }
                            } else {
                                toastr.warning(data.message);
                            }
                        } else {
                            toastr.success(data.message);
                            
                            $('#newletter-form')[0].reset();
                            if (data.load) {
                                setTimeout(function () {

                                    window.location.href = "";
                                }, 500);
                            }
                        }

                        $('#newsletter_submit').show();
                        $('#newsletter_submitting').hide();
                    },
                    error: function (data) {
                        var jsonValue = $.parseJSON(data.responseText);
                        const errors = jsonValue.errors;
                        if (errors) {
                            var i = 0;
                            $.each(errors, function (key, value) {
                                const first_item = Object.keys(errors)[i]
                                const message = errors[first_item][0];
                                if ($('#' + first_item).length > 0) {
                                    $('#' + first_item).parsley().removeError('required', {
                                        updateClass: true
                                    });
                                    $('#' + first_item).parsley().addError('required', {
                                        message: value,
                                        updateClass: true
                                    });
                                }
                                toastr.error(value);
                                i++;

                            });
                        } else {
                            toastr.warning(jsonValue.message);
                        }

                        $('#newsletter_submit').show();
                        $('#newsletter_submitting').hide();
                    }
                });
            });
        };

    </script>
@endpush
