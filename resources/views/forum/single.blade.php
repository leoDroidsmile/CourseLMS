

<main id="tt-pageContent">
    <div class="container">
        <div class="tt-single-topic-list">
            <div class="tt-item">
                 <div class="tt-single-topic">
                    <div class="tt-item-header">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                @if (isset($single_post->username->image))
                                    <img src="{{ asset($single_post->username->image) }}" class="img-fluid w-8 rounded">
                                @else
                                    <img src="{{ asset('favicon.png') }}" class="img-fluid w-8 rounded">
                                @endif
                            </div>
                            <div class="tt-avatar-title">
                                
                               {{ $single_post->username->name }}

                            </div>
                        
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                {{ $single_post->created_at->format('d M, Y') }}
                          
                        </div>
                        <h3 class="tt-item-title">
                            {{ $single_post->title }}
                        </h3>

                    </div>
                    <div class="tt-item-description">
                        <p>
                            {!! $single_post->discussion !!}
                        </p>
                    </div>
                    <div class="tt-item-info info-bottom">
                        {{-- replied --}}
                            <i class="fa fa-comment-o pr-2" aria-hidden="true"></i>
                            <div class="total_replies">
                                {{-- ajax --}}
                            </div>
                        <div class="col-separator"></div>
                            <input type="text" value="{{ route('forum.share', $single_post->id) }}" id="post_link" class="opacity">
                        <a href="javascript:void(0)" onclick="getPostLink('copy')"><span class="badge badge-primary">Share</span></a>


                    </div>
                </div>
            </div>


            {{-- replies--}}
            <div id="replies"></div>
            {{-- replies::END--}}


        </div>
        <div class="tt-wrapper-inner">
            <h4 class="tt-title-separator"><span>You’ve reached the end of replies</span></h4>
        </div>

        <div class="tt-wrapper-inner">
            <div class="pt-editor form-default">
                <h6 class="pt-title">Post Your Reply</h6>
                <small>Double click to highlight text</small>

                <form class="postReplyForm">

                    <input type="hidden" value="{{ $single_post->id }}" id="post_id">

                    <div class="form-group post-textarea rounded shadow">
                        <textarea name="message" class="form-control h-200 editable" id="reply" rows="5"></textarea>
                    </div>
                    <div class="pt-row">
                        <div class="col-auto">
                        <div class="col-auto">

                            @auth
                            <a href="javascript:void(0)" class="btn btn-secondary btn-width-lg" id="postReplyBtn">Reply</a>
                            @endauth

                            @guest
                                <a href="{{ route('login') }}" class="btn btn-secondary btn-width-lg">Reply</a>
                            @endguest
                            
                        </div>
                    </div>

                </form>

            </div>
        </div>


    </div>
</main>


<input type="hidden" value="{{ route('forum.post.reply') }}" id="forum_reply_url">
<input type="hidden" value="{{ route('forum.get.reply') }}" id="forum_get_reply">
<input type="hidden" value="{{ $single_post->id }}" class="forum_post_id">
<input type="hidden" value="{{ route('forum.helpful') }}" class="forum_helpful">


<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>

<script>
    "use strict"

    $('#postReplyBtn').on('click', function(){

        var url  = $('#forum_reply_url').val();
        var reply  = $('#reply').val();
        var post_id  = $('#post_id').val();

        // ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                reply: reply,
                post_id: post_id
            },
            success: function(data) {
                $('#reply').val('');
                getReplyList();
            }
        });

    });

    // getPostList
    function getReplyList() {

        var url  = $('#forum_get_reply').val();
        var forum_post_id  = $('.forum_post_id').val();

        // ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            data:{
                forum_post_id: forum_post_id
            },
            success: function(data) {
                $('#replies').html(data.replyData);
                $('.total_replies').text(data.total_replies);
            }
        });
    }


    function helpful(ele){

        var url  = $('.forum_helpful').val();
        var post_id  = $('#post_id').val();
        var dataID = $(ele).attr('data-id');
        var reply_id = $(ele).attr('data-replyid');
        var love_count = $(ele).attr('data-replyid');

        // ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                post_id: post_id,
                reply_id: reply_id
            },
            success: function(data) {

                console.log(data);

                var x = $('#lovecount-'+love_count).text(data.helpful_count);
                console.log(data);
                $('#'+dataID).addClass(data.love);
                $('#'+dataID).removeClass(data.remove_love);

            }
        });

    };


    $(document).ready(function(){
        getReplyList();

var editor = new MediumEditor('.editable', {
    toolbar: true,
    spellcheck: true,
    cleanPastedHTML: true,
    targetBlank: true,
    placeholder: {
        text: 'Write an answer'
    },
    keyboardCommands: {
        /* This example includes the default options for keyboardCommands,
           if nothing is passed this is what it used */
        commands: [
            {
                command: 'bold',
                key: 'b',
                meta: true,
                shift: false
            },
            {
                command: 'italic',
                key: 'i',
                meta: true,
                shift: false
            },
            {
                command: 'underline',
                key: 'u',
                meta: true,
                shift: false
            }
        ],
    },
    showWhenToolbarIsVisible:true,
    sticky:true,
    buttons:['bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote'],
    keyboardCommands: true,
    hideOnClick: false,

});

        
    });


    function getPostLink()
{

    var copyText = document.getElementById("post_link");
    copyText.select();
    document.execCommand("copy");

}


</script>

