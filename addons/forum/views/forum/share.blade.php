
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Forum - Responsive HTML5 Template">
    <meta name="author" content="Forum">
    <link rel="shortcut icon" href="favicon/favicon.ico">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
      
   
    <link rel="stylesheet" href="{{ asset('forum/css/style.css') }}">
     <meta name="csrf-token" content="{{ csrf_token() }}">


<link rel="stylesheet" href="{{ asset('forum/css/medium-editor.css') }}" type="text/css" media="screen" charset="utf-8">

</head>

<body>
<!-- tt-mobile menu -->
<nav class="panel-menu" id="mobile-menu">
    <ul>

    </ul>
    <div class="mm-navbtn-names">
        <div class="mm-closebtn">
            Close
            <div class="tt-icon">
                <svg>
                  <use xlink:href="#icon-cancel"></use>
                </svg>
            </div>
        </div>
        <div class="mm-backbtn">Back</div>
    </div>
</nav>
<header id="tt-header">
    <div class="container">
        <div class="row tt-row no-gutters">
            <div class="col-auto">
             
                <!-- desctop menu -->
                 <div class="tt-desktop-menu">
                    <nav>
                        <ul>
                            <li>
                                <a href="{{ route('homepage') }}"
                                    title="{{getSystemSetting('type_name')->value}}" class="mt-2">
                            <img class="img-fluid" width="200" src="{{ filePath(getSystemSetting('type_logo')->value) }}"
                                 alt="{{getSystemSetting('type_name')->value}}"></a>

                            </li>
                            <li><a href="{{ route('forum.index') }}"><span>Posts</span></a></li>
                            <li>
                                @auth
                                <a href="{{ route('forum.create') }}" onclick="loadCreate()"><span>New</span></a>
                                @endauth
                                
                                @guest
                                <a href="{{ route('login') }}"><span>New</span></a>
                                @endguest
                            </li>
                           
                        </ul>
                    </nav>
                </div>
                <!-- /desctop menu -->
                <!-- tt-search -->
                <div class="tt-search">
                    <!-- toggle -->
                    <button class="tt-search-toggle" data-toggle="modal" data-target="#modalAdvancedSearch">
                       <svg class="tt-icon">
                          <use xlink:href="#icon-search"></use>
                        </svg>
                    </button>
                    <!-- /toggle -->
                    <span class="search-wrapper">
                        <div class="search-form">
                            <input type="text" id="search" name="title" class="tt-search__input" placeholder="Search">
                            <button class="tt-search__btn" type="button">
                               <i class="fa fa-search"></i>
                            </button>
                        </div>
                       
                    </span>

                     {{-- Search result --}}
                    <div class="search-table d-none">
                        <div class="row m-auto" id="show_data">
                            {{-- Data goes here --}}
                        </div>
                    </div>
                    {{-- Search result:END --}}


                </div>
                <!-- /tt-search -->
            </div>
            <div class="col-auto ml-auto">
                <div class="tt-account-btn">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                        <a href="{{ route('student.register') }}" class="btn btn-secondary">Sign up</a>
                    @endguest
                        
                    @auth
                        <span class="btn btn-primary">{{ Auth::user()->name }}</span>
                    @endauth



                </div>
            </div>
        </div>
    </div>
</header>

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
                        <a href="javascript:void(0)" onclick="getPostLink('copy')"><span class="badge badge-primary copy_share">Share</span></a>


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


<div class="card mt-4">
  <div class="card-body">
    <blockquote class="blockquote mb-0 text-center">
      <p>© 2020 {{ getSystemSetting('type_footer')->value }} v{{ env('APP_VERSION') }}</p>
    </blockquote>
  </div>
</div>

@auth
    
<a href="javascript:void(0)" onclick="loadCreate()" class="tt-btn-create-topic">
    <span class="tt-icon">
        <i class="fa fa-plus-circle f-s-40" aria-hidden="true"></i>
    </span>
</a>

@endauth
@guest

<a href="{{ route('login') }}" class="tt-btn-create-topic">
    <span class="tt-icon">
        <i class="fa fa-plus-circle f-s-40" aria-hidden="true"></i>
    </span>
</a>

@endguest



    <input type="hidden" id="search_url" value="{{ route('forum.search') }}">
    <input type="hidden" value="{{ route('forum.post.reply') }}" id="forum_reply_url">
    <input type="hidden" value="{{ route('forum.get.reply') }}" id="forum_get_reply">
    <input type="hidden" value="{{ $single_post->id }}" class="forum_post_id">
    <input type="hidden" value="{{ route('forum.helpful') }}" class="forum_helpful">
    
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>

    <script src="{{ asset('forum/js/medium-editor.js') }}"></script>

    

           <script>
"use strict"

                function singlePost(ele){
                    var postId = $(ele).attr('data-id');
                    var url = $('.singlePost').val();

                    // ajax setup
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                
                    $.ajax({
                    type: 'GET',
                    url: url,
                    data:{
                        postId: postId
                    },
                    success: function(data) {
                        $('#forum_content').empty();
                        $('#forum_content').html(data);
                        $('.search-table').addClass('d-none');
                    }
                    });
                }


                /**SEARCH FILTER */
                $(document).ready(function () {

                    $('#search').on('keyup', function () {
                        var url = $('#search_url').val();
                        var input = $('#search').val();

                        /*ajax get value*/
                        if (url === null) {
                            location.reload()
                        } else {

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $.ajax({
                                url: url,
                                method: 'GET',
                                data: {
                                    input: input
                                },
                                success: function (result) {
                                    if (input === null || input === '') {
                                        $('#show_data').addClass('d-none');
                                        $('.search-table').addClass('d-none');
                                        console.log(result);
                                    } else {
                                        $('#show_data').html(result);
                                        $('#show_data').removeClass('d-none');
                                        $('.search-table').removeClass('d-none');
                                        console.log(result);
                                    }
                                }
                            });
                        }
                    })
                });


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
    $('.copy_share').text('Copied')

}

            </script>   

         

</body>

</html>