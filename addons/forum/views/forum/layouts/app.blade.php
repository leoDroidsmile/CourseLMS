
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
                            <li><a href="javascript:void(0)" onclick="loadPosts()"><span>Posts</span></a></li>
                            <li>
                                @auth
                                <a href="javascript:void(0)" onclick="loadCreate()"><span>New</span></a>
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

@yield('forum_content')

<div id="forum_content">
    {{-- Load blade here --}}
</div>

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
    
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('forum/js/medium-editor.js') }}"></script>

    

           <script>

               "use strict"

                $(document).ready(function(){
                    $.get('{{ route('forum.posts') }}', {_token:'{{ csrf_token() }}'},  function(data){
                        $('#forum_content').empty();
                        $('#forum_content').html(data);
                    });
                });

                function loadCreate(){
                        $.get('{{ route('forum.create') }}', {_token:'{{ csrf_token() }}'},  function(data){
                        $('#forum_content').empty();
                        $('#forum_content').html(data);
                    });        
                }

                function loadPosts(){
                        $.get('{{ route('forum.posts') }}', {_token:'{{ csrf_token() }}'},  function(data){
                        $('#forum_content').empty();
                        $('#forum_content').html(data);
                    });
                }

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

            </script>   

           @yield('js')

</body>

</html>