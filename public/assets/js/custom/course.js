(function ($) {

    "use strict"

    jQuery(document).ready(function () {

        /*
        |--------------------------------------------------------------------------
        | Summernote Rich Editor
        |--------------------------------------------------------------------------
        */

        $('.summernote').summernote({
            height: 300,
        });
        /*
        |--------------------------------------------------------------------------
        | Slugify JS
        |--------------------------------------------------------------------------
        | This plugin is used for auto create slug in relation with Title
        |--------------------------------------------------------------------------
        */
        $('#val-slug').slugify('#val-title');
        /*
        |--------------------------------------------------------------------------
        | If Free is being clicked, price feild will disappear
        |--------------------------------------------------------------------------
        */
        $(function () {

            $("#val-is_free").ready(function () {
               var att = $('#val-is_free').is(":checked");
                if (att) {
                    $("#auto_hide").hide();
                } else {
                    $("#auto_hide").show();
                }

            });

            $("#val-is_free").change(function () {
                if ($(this).is(":checked")) {
                    $("#auto_hide").hide();
                } else {
                    $("#auto_hide").show();
                }
            });
        });


        /*
        |--------------------------------------------------------------------------
        | If Discound is being clicked, discount price feild appear
        |--------------------------------------------------------------------------
        */
        $(function () {
            $("#val-is_discount").ready(function () {
                var att = $('#val-is_discount').is(":checked");
                if (!att) {
                    $("#discount_price").hide();
                } else {
                    $("#discount_price").show();
                }

            });

            $("#val-is_discount").change(function () {
                if ($(this).is(":checked")) {
                    $("#discount_price").show();
                } else {
                    $("#discount_price").hide();
                }
            });
        });
        /*
        |--------------------------------------------------------------------------
        | Checking Slug From database, unique or not.
        |--------------------------------------------------------------------------
        | If uniquue , this will show available message
        |--------------------------------------------------------------------------
        */
        $('#val-slug').change(function () {
            var error_email = '';
            var slug = $('#val-slug').val();
            var _token = $('input[name="_token"]').val();
            var filter = /^[a-z0-9-]+$/;
            if (!filter.test(slug)) {
                $('#error_email').html('<label class="text-danger">Invalid Slug</label>');
                $('#val-slug').addClass('has-error');
            } else {
                /*
                |--------------------------------------------------------------------------
                | Ajax Setup
                |--------------------------------------------------------------------------
                */
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                /*
                |--------------------------------------------------------------------------
                | Ajax Call
                |--------------------------------------------------------------------------
                */
                $.ajax({
                    url: "slug/check",
                    method: "POST",
                    data: {slug: slug, _token: _token},
                    success: function (result) {
                        if (result == 'unique') {
                            $('#error_email').html('<label class="text-success">Slug Available</label>');
                            $('#val-slug').removeClass('has-error');
                        } else {
                            $('#error_email').html('<label class="text-danger">Slug not Available</label>');
                            $('#val-slug').addClass('has-error');
                        }
                    }
                })
            }
        });
        // END

    })

})(jQuery);
