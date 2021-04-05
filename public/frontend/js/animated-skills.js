//spy scroll
$.fn.visible = function(partial) {

    var $t            = $(this),
        $w            = $(window),
        viewTop       = $w.scrollTop(),
        viewBottom    = viewTop + $w.height(),
        _top          = $t.offset().top,
        _bottom       = _top + $t.height(),
        compareTop    = partial === true ? _bottom : _top,
        compareBottom = partial === true ? _top : _bottom;

    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

};

function spy_scroll(selector){

    $(selector).each(function(i, el) {

        var el = $(el);

        if (el.visible(true) && $(".animated_skills").length === 0) {

            $(selector).addClass("animated_skills");
            for (var i = 0; i <= $(".skills .skill").length -1; i += 1) {

                progress_count(i);

            }

        }

    });

}

//animate skills
function progress_count(progress_num) {

    var valu_percent = $(".skills .skill:eq(" + progress_num + ") span:last-of-type").text(),
        valu = parseInt( valu_percent ),
        skills_progress = $(".skill-area .skills .skill");

    (function theLoop (i) {

        setTimeout(function () {

            $(".skills .skill:eq(" + progress_num + ") .progress_bar").width(i+"%");

            $(".skills .skill:eq(" + progress_num + ") span:last-of-type").text( i+"%" ) ;

            if( $(skills_progress).css('visibility') !== 'visible') {
                $(skills_progress).css("visibility", "visible");

            }

            if (i != valu) {
                i++;
                theLoop(i);
            }

        }, 15);

    })(0);

}