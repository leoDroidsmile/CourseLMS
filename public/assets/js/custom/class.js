"use strict";
$(document).ready(function() {
  // summernote
  $('.summernote').summernote({
    height: 150,
  });

// content_form
$('#class_submit').on('click',function(){
  $('#class_form').on('submit');
});

// content_form
$('#content_submit').on('click',function(){
  $('#content_form').on('submit');
});

// Content Type
$(function () {
    $('#val-Content').change(function () {
        $('.docs').hide();
        $('#' + $(this).val()).show();
    });
});

// provider file

    $('#val-provider').on('change',function(){
        let selectedOptionVal = $('#val-provider').find(":selected").val();//selected option value

        if (selectedOptionVal === 'File')
        {
            $('#val-video_url').addClass('d-none');
            $('#val-video_file').removeClass('d-none');
            $('.media-btn').removeClass('d-none');
        }else{
            $('#val-video_url').removeClass('d-none');
            $('#val-video_file').addClass('d-none');
            $('.media-btn').addClass('d-none');
        }
    });


    // Get Zoom class url

    
// provider file

    $('#val-meeting').on('change',function(){
        let selectedZoomVal = $('#val-meeting').find(":selected").attr('data-url');//selected option value
        $('#val-video_url').val(selectedZoomVal);
    });


// END
});
