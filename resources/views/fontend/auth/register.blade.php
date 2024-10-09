@extends('fontend.layouts.app')
@section('title', 'Login ', get_settings('system_name'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/toastr.min.css') }}">
@endpush
@push('breadcrumb')
<div class="breadcrumb_section page-title-mini">
    <div class="custom-container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">
                            <i class="linearicons-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('login') }}">
                            Account Login
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Register Account
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endpush

@section('content')
<div class="main_content bg_gray">

    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3>Register Account</h3>
                            </div>
                            <form method="POST" id="register-form" action="{{ route('register.post') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="customer_first_name">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="customer_first_name" id="customer_first_name" class="form-control" required placeholder="First Name">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="customer_last_name">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" name="customer_last_name" id="customer_last_name" class="form-control" required placeholder="Last Name">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="customer_email">E-Mail <span class="text-danger">*</span></label>
                                        <input type="email" name="email" id="customer_email" class="form-control" required placeholder="E-Mail">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="customer_phone">Phone <span class="text-danger">*</span></label>
                                        <input type="text" name="customer_phone" id="customer_phone" class="form-control" required placeholder="Phone">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control" required placeholder="Password">
                                        <div class="progress mt-2">
                                            <div id="password-strength-bar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small id="password-strength-text"></small>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <button type="submit" class="btn btn-fill-out btn-block" id="submit">
                                            Register 
                                        </button>
                                        <button class="btn btn-fill-out mb-3 btn-block" style="display: none;" id="submitting" type="button">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="different_login">
                                <span> Already have an account</span>
                            </div>
                            <div class="form-note text-center">If you already have an account with us, please login at the <a href="{{ route('login') }}">login</a> page.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/js/parsley.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/toastr.min.js') }}"></script>
    <script>
        document.getElementById('password').addEventListener('input', function() {
            var password = this.value;
            var strengthBar = document.getElementById('password-strength-bar');
            var strengthText = document.getElementById('password-strength-text');
            
            var strength = 0;

            if (password.length >= 8) strength += 1; 
            if (password.match(/[A-Z]/)) strength += 1; 
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[@$!%*#?&]/)) strength += 1;

            var color = '';
            var text = '';

            switch(strength) {
                case 0:
                    color = 'danger';
                    text = 'Too weak';
                    strengthBar.style.width = '0%';
                    break;
                case 1:
                    color = 'danger';
                    text = 'Weak';
                    strengthBar.style.width = '25%';
                    break;
                case 2:
                    color = 'warning';
                    text = 'Medium';
                    strengthBar.style.width = '50%';
                    break;
                case 3:
                    color = 'info';
                    text = 'Strong';
                    strengthBar.style.width = '75%';
                    break;
                case 4:
                    color = 'success';
                    text = 'Very Strong';
                    strengthBar.style.width = '100%';
                    break;
            }

            strengthBar.className = 'progress-bar bg-' + color;
            strengthText.innerHTML = text;
        });


        var _formValidation = function () {
            if ($('#register-form').length > 0) {
                $('#register-form').parsley().on('field:validated', function () {
                    var ok = $('.parsley-error').length === 0;
                    $('.bs-callout-info').toggleClass('hidden', !ok);
                    $('.bs-callout-warning').toggleClass('hidden', ok);
                });
            }

            $('#register-form').on('submit', function (e) {
                e.preventDefault();

                $('#submit').hide();
                $('#submitting').show();

                $(".ajax_error").remove();

                var submit_url = $('#register-form').attr('action');
                var formData = new FormData($("#register-form")[0]);

                //Start Ajax
                $.ajax({
                    url: submit_url,
                    type: 'POST',
                    data: formData,
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    dataType: 'JSON',
                    success: function (data) {
                        console.log(data)
                        if (!data.status) {
                            if (data.validator) {
                                for (const [key, messages] of Object.entries(data.message)) {
                                    messages.forEach(message => {
                                        toastr.error(message);
                                    });
                                }
                            } else {
                                toastr.error(data.message);
                            }
                        } else {
                            toastr.success(data.message);
                            
                            $('#register-form')[0].reset();
                            if (data.goto) {
                                setTimeout(function () {

                                    window.location.href = data.goto;
                                }, 500);
                            }
                        }

                        $('#submit').show();
                        $('#submitting').hide();
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
                                // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                                toastr.error(value);
                                i++;

                            });
                        } else {
                            toastr.warning(jsonValue.message);
                        }

                        $('#submit').show();
                        $('#submitting').hide();
                    }
                });
            });
        };

        _formValidation();
    </script>
@endpush