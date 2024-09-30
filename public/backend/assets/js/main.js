
// select2
var _componentSelect2Normal = function () {
    $('.select').select2({
        width: '100%',
        dropdownParent: $('#modal_remote')
    });
}

// For Opening Modal
var _componentRemoteModalLoadAfterAjax = function () {
    $(document).on('click', '#content_management', function (e) {
        e.preventDefault();
        $('#modal_remote').modal('toggle');
        var url = $(this).data('url');
        $('.modal-content').html('');
        $('#modal-loader').show();
        $.ajax({
            url: url,
            type: 'Get',
            dataType: 'html'
        })
        .done(function (data) {
            $('.modal-content').html(data);
            _componentSelect2Normal();
            _modalClassFormValidation();
        })
        .fail(function (data) {
            $('.modal-content').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
            $('#modal-loader').hide();
        });
    });
};

// For Generating Slug
var _slugify = function(text) {
    return text
        .toString()  
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '') 
        .replace(/\-\-+/g, '-') 
        .replace(/^-+/, '') 
        .replace(/-+$/, '');
}

// For form validation
var _formValidation = function () {
    if ($('.content_form').length > 0) {
        $('.content_form').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }

    $('.content_form').on('submit', function (e) {
        e.preventDefault();

        $('#submit').hide();
        $('#submitting').show();

        $(".ajax_error").remove();
        var submit_url = $('.content_form').attr('action');
        var formData = new FormData($(".content_form")[0]);

        //Start Ajax
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status) {

                    toastr.success(data.message);

                    $('.content_form')[0].reset();
                    if (data.goto) {
                        setTimeout(function () {

                            window.location.href = data.goto;
                        }, 500);
                    }

                    if (data.load) {
                        setTimeout(function () {

                            window.location.href = "";
                        }, 1000);
                    }

                } else {
                    toastr.error(data.message);
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

// For Submitting Modal Form
var _modalClassFormValidation = function () {
    if ($('.ajax-form').length > 0) {
        $('.ajax-form').parsley().on('field:validated', function () {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }
    $('.ajax-form').on('submit', function (e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submitting').show();
        $(".ajax_error").remove();
        var submit_url = $('.ajax-form').attr('action');
        var formData = new FormData($(".ajax-form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            success: function (data) {
                if (data.status) {

                    console.log(data);

                    toastr.success(data.message);
                    $('#submit').show();
                    $('#submitting').hide();

                    $('#modal_remote').modal('toggle');

                    if (data.goto) {
                        setTimeout(function () {
                            window.location.href = data.goto;
                        }, 1000);
                    }

                    if (data.load) {
                        setTimeout(function () {
                            window.location.href = "";
                        }, 1000);
                    }
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function (key, value) {
                        const first_item = Object.keys(errors)[i];
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
                    toastr.error(jsonValue.message);
                }

                $('#submit').show();
                $('#submitting').hide();
            }
        });
    });
};

// For delete items
$(document).on('click', '#delete_item', function(e) {
    e.preventDefault();
    var row = $(this).data('id');
    var url = $(this).data('url');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                method: 'Delete',
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function(data) {

                    if (data.status) {

                        toastr.success(data.message);
                        if (data.load) {
                            setTimeout(function() {

                                window.location.href = "";
                            }, 1000);
                        }

                    } else {
                        toastr.warning(data.message);
                    }
                },
                error: function(data) {
                    var jsonValue = $.parseJSON(data.responseText);
                    const errors = jsonValue.errors
                    var i = 0;
                    $.each(errors, function(key, value) {
                        toastr.error(value);
                        i++;
                    });
                }
            });
        }
    });

});