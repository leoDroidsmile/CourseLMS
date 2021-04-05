"use strict";
$(document).ready(function () {
    // $( 'button[type="submit"]').attr('disabled', true);
    // $( 'button[type="submit"]').attr('type', 'button');
    // $( 'button[type="button"]').attr('title', 'Demo Mode');
    //
    // $( '#loginBtn').attr('disabled', false);
    // $( '#loginBtn').attr('type', 'submit');
    // $( '#loginBtn').attr('title', 'login');
    // $('.select2').select2({
    //     placeholder: 'Choose option',
    //     allowClear: true
    // });

    $('.select2-instructor').select2({
        placeholder: 'Select Instructor',
        allowClear: true
    });

    $(".lang").select2({
        placeholder: 'Choose option',
        templateResult: formatState,
        templateSelection: formatState
    });

    //this function for show dropdown image
    function formatState(opt) {
        if (!opt.id) {
            return opt.text.toUpperCase();
        }
        var optimage = $(opt.element).attr('data-image');


        if (!optimage) {
            return opt.text.toUpperCase();
        } else {
            var $opt = $(
                '<span><img src="' + optimage + '" width="32px" height="auto"/> ' + opt.text.toUpperCase() + '</span>'
            );
            return $opt;
        }
    }


//this is for slider
    $('.slider-published').change(function () {
        var url = this.dataset.urls;
        var id = this.dataset.ids;

        if (url != null && id != null) {
            $.ajax({
                url: url,
                data: {id: id},
                method: 'get',
                success: function (result) {

                    notification(result);
                    //this is slider reload
                    location.reload();
                },
            });
        }

    });

    //published the all checkbox
    $('input[type="checkbox"]').change(function () {

        var url = this.dataset.url;
        var id = this.dataset.id;


        if (url != null && id != null) {
            $.ajax({
                url: url,
                data: {id: id},
                method: 'get',
                success: function (result) {
                    notification(result);
                },
            });
        }

    });

    //hide the alert
    setTimeout(alertClose, 3000);

    $('.summernote').summernote({
        height: 300,
    });

    $('select').on('change', function () {
        var url = this.dataset.url
        var id = this.dataset.id
        var rating = this.value
        if (url != null && id != null && rating != null) {
            $.ajax({
                url: url,
                data: {id: id, rating: rating},
                method: 'get',
                success: function (result) {
                    notification(result);


                },
            });
        }
    });

});


//this is notification
function notification(result) {
    console.log(result);
    if (result.message != null){
        new PNotify({
            title: 'Message',
            text: result.message,
            type: 'info',

        });
    }
}

//this is notification
function mediaNotification(result) {

    new PNotify({
        title: result,
        type: 'success',
        maxHeight: '12px',
        animation: 'fade',
        shadow: true,
        animateSpeed: 'fast',
        hide: true,
    });
}





//this is for hide alert
function alertClose() {
    $("#gone").alert('close');
}

//show the modal in this function
function forModal(url, message) {
    $('#show-modal').modal('show');
    $('#title').text(message);
    $('#show-form').load(url);
    $('body').on('shown.bs.modal', '.modal', function () {
        $(this).find('select').each(function () {
            var dropdownParent = $(document.body);
            if ($(this).parents('.modal.in:first').length !== 0)
                dropdownParent = $(this).parents('.modal.in:first');
            $(this).select2({
                dropdownParent: dropdownParent
            });
        });
    });
}

//show the modal in this function
function forMediaModal(url, message) {

    $('#show-media-modal').modal('show');
    $('#title').text(message);
    $('#show-media-form').load(url);
    $('body').on('shown.bs.modal', '.modal', function () {
        $(this).find('select').each(function () {
            var dropdownParent = $(document.body);
            if ($(this).parents('.modal.in:first').length !== 0)
                dropdownParent = $(this).parents('.modal.in:first');
            $(this).select2({
                dropdownParent: dropdownParent
            });
        });
    });
}


//translate in one click
function copy() {
    $('#tranlation-table > tbody  > tr').each(function (index, tr) {
        $(tr).find('.value').val($(tr).find('.key').text());
    });
}

// avatar preview
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imageUpload").change(function () {
    readURL(this);
});


function imageUploadFIcon(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview_f_icon').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview_f_icon').hide();
            $('#imagePreview_f_icon').fadeIn(350);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imageUpload_f_icon").change(function () {
    imageUploadFIcon(this)
});


function imageUploadFLogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagePreview_f_logo').css('background-image', 'url(' + e.target.result + ')');
            $('#imagePreview_f_logo').hide();
            $('#imagePreview_f_logo').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imageUpload_f_logo").change(function () {
    imageUploadFLogo(this)
});

$('#trans-save').on('click', function () {
    $('#trans-form').submit();
});

/*instructor payment submit*/
$('#instructorSelect').change(function () {
    $('#ins_search').submit();
})

let reproductor = videojs('player', {
    fluid: true
});

// media slide

var mediaType = '';

function openNav(url, file) {
    document.getElementById("mySidenav").style.width = "80%";
    mediaType = file;
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

function getImage(identifier) {

    var imageUrl = $(identifier).data('image');

    try {
        if (mediaType == 'file') {


            $(".video_raw_url").val(imageUrl);
            var domain_name = $('#domain_name').val();
            var file_link = domain_name + '/public/' + imageUrl; // for developement
            $(".video_file_preview").val(imageUrl);
            $('.video_file_preview').removeClass('d-none');
            $(".video_file_preview").attr('src', file_link);
            mediaNotification('Selected');
        }

        if (mediaType == 'thumbnail') {


            $(".course_image").val(imageUrl);
            $(".course_thumb_url").val(imageUrl);
            var domain_name = $('#domain_name').val();
            var file_link = domain_name + '/public/' + imageUrl; // for developement
            $(".course_thumb_preview").val(imageUrl);
            $('.course_thumb_preview').removeClass('d-none');
            $(".course_thumb_preview").attr('src', file_link);
            mediaNotification('Selected');
        }

        if (mediaType == 'category') {
            $(".icon").val(imageUrl);
            $(".category_url").val(imageUrl);
            var domain_name = $('#domain_name').val();
            var file_link = domain_name + '/public/' + imageUrl; // for developement
            $(".category_preview").val(imageUrl);
            $('.category_preview').removeClass('d-none');
            $(".category_preview").attr('src', file_link);
            mediaNotification('Selected');
        }

        if (mediaType == 'slider') {
            $(".slider").val(imageUrl);
            $(".slider_url").val(imageUrl);
            var domain_name = $('#domain_name').val();
            var file_link = domain_name + '/public/' + imageUrl; // for developement
            $(".slider_preview").val(imageUrl);
            $('.slider_preview').removeClass('d-none');
            $(".slider_preview").attr('src', file_link);
            mediaNotification('Selected');
        }

        if (mediaType == 'package') {


            $(".package").val(imageUrl);
            $(".package_url").val(imageUrl);
            var domain_name = $('#domain_name').val();
            var file_link = domain_name + '/public/' + imageUrl; // for developement
            $(".package_preview").val(imageUrl);
            $('.package_preview').removeClass('d-none');
            $(".package_preview").attr('src', file_link);
            mediaNotification('Selected');
        }

        if (mediaType == 'source_code') {

            $(".source_code_url").val(imageUrl);
            var domain_name = $('#domain_name').val();
            var file_link = domain_name + '/public/' + imageUrl; // for developement
            $('.source_code_preview').removeClass('d-none');
            $(".source_code_preview").attr('src', file_link);
            mediaNotification('Selected');
        }
    } catch (error) {
        location.reload();
        mediaNotification('Somethin went wrong!');
    }

    closeNav();
}


function btnLoader() {

    var type = $('.type').val();
    var image = $('.media-img').val();
    var typeLenth = type.length;
    var imageLenth = image.length;

    if (typeLenth == '' || typeLenth == 'undefined' || typeLenth == 0 || imageLenth == '' || imageLenth == 'undefined' || imageLenth == 0) {
        $('.Error').text('This field is required');
    } else {
        $('#media-form').submit();

        $('.media-btn-submit').addClass('disabled');
        $('.submit-loader').removeClass('d-none');

        var curProg = 0;
        var interval = setInterval(function () {
            curProg = curProg + 100;
            $('.progBar').css('width', curProg + '%');
            $('.progBar').text(curProg - 100 + '%');
            if (curProg > 100) clearInterval(interval);
        }, 50);
    }
}


function addonLoader() {

    var curProg = 0;
    var interval = setInterval(function () {
        curProg = curProg + 100;
        $('.progBar').css('width', curProg + '%');
        $('.progBar').text(curProg - 100 + '%');
        if (curProg > 100) clearInterval(interval);
    }, 50);

}


function receivedData(e) {
    var url = $(e).data('url');
    var text = $(e).data('text');
    forModal(url, text);
}

/**
 * FILTER
 */

function filterMedia(media) {
    var domain_name = $('#domain_name').val();
    var url = $(media).data('url');
    var type = $(media).data('value');

    // ajax setup

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ajax setup request start

    $.ajax({
        type: 'POST',
        url: url,
        data: {
            type: type
        },
        success: function (data) {
            $('.media_row').html(data);
        }
    });
}

/**
 * SUBSCRIPTION COURSE
 */

function SubscriptionDuration(course) {
    var url = $(course).data('url');
    var course_id = $(course).data('id');
    var user_id = $(course).data('user');
    var subscription_duration = $(course).val();

    // ajax setup request start

    $.ajax({
        type: 'GET',
        url: url,
        data: {
            course_id: course_id,
            subscription_duration: subscription_duration,
            user_id: user_id
        },
        success: function (data) {
            notification(data);
        }
    });
}


