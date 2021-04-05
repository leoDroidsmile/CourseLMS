"use strict";

$(document).ready(function(){

    $('#student-submit').on('click',function(){
        $('#student-form').submit();
    });

    // screen Responsive
    if ($(document).width() > 992){
        $('#mobile-sidebar-preview').css('display','none');
        $('#mobile-sidebar-feature').css('display','none');
    }

    if ($(document).width() < 992){
        $('#sidebar-preview').css('display','none');
        $('#sidebar-feature').css('display','none');
    }

});

$("img").lazyload({
    effect : "fadeIn"
});
