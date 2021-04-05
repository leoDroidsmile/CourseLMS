<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Rumon Prince Sohan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright" content="{{ env('APP_NAME') }}">
    <meta name="subject" content="{{ env('APP_NAME') }} {{ env('APP_VERSION') }}">
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">

    <title>{{getSystemSetting('type_name')->value}}</title>


    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}">
    <link href="{{ asset('css/font.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/barfiller.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/icofont.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/style.css')}}">
    <link href="{{ asset('css/frontend.css') }}">

    <!-- end inject -->
</head>

<body>

<!-- Preloader Starts -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
</div>


@include('rumbok.include.sidebar')

<!--======================================
        START HEADER AREA
    ======================================-->

<!-- Header Section Starts -->
<header class="header-section">
    <!-- Header Info Starts -->



    @if (!request()->is('student/*'))
        <div class="header-info">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="info-left">
                            <div class="phone-part">
                                <i class="fa fa-phone-square"></i>
                                <span><a href="tel:{{getSystemSetting('type_number')->value}}">{{getSystemSetting('type_number')->value}}</a></span>
                            </div>
                            <div class="email-part">
                                <i class="fa fa-envelope-open"></i>
                                <span><a href="mailto:{{getSystemSetting('type_mail')->value}}">
                                    {{getSystemSetting('type_mail')->value}}</a></span>
                            </div>
                            <div class="menu-toggle-bar">
                                <div class="custom-bars">
                                    <div class="custom-bar bar-1"></div>
                                    <div class="custom-bar bar-2"></div>
                                    <div class="custom-bar bar-3"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-right">
                            <ul>
                                <li>
                                    @if (env('FORUM_PANEL') === 'YES')
                                        <div>
                                            <a href="{{ route('forum.index') }}" target="_blank">
                                                <i class="fa fa-comments-o" aria-hidden="true"></i> @translate(Forum)
                                            </a>
                                        </div>
                                    @endif
                                </li>
                                @guest()
                                    <li class="login-button"><a href="{{ route('login') }}">@translate(Login)</a></li>
                                @endguest
                                @if(getSystemSetting('type_fb')->value != null)
                                    <li><a href="{{getSystemSetting('type_fb')->value}}" target="_blank"><i
                                                class="fa fa-facebook"></i></a></li>
                                @endif

                                @if(getSystemSetting('type_tw')->value != null)
                                    <li><a href="{{getSystemSetting('type_tw')->value}}" target="_blank"><i
                                                class="fa fa-twitter"></i></a></li>
                                @endif

                                @if(getSystemSetting('type_google')->value != null)
                                    <li><a href="{{getSystemSetting('type_google')->value}}" target="_blank"><i
                                                class="fa fa-google-plus"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

<!-- main Header Starts -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header-logo">
                        <a href="{{ route('homepage') }}"
                           title="{{getSystemSetting('type_name')->value}}">
                            <img class="img-fluid header-logo" src="{{ filePath(getSystemSetting('type_logo')->value) }}"
                                 alt="{{getSystemSetting('type_name')->value}}"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="main-header-right">
                        <!-- Category Dropdown Starts -->
                        <div class="category-dropdown">
                            <div class="menu-bar">
                                <a href="{{ route('course.filter') }}">
                                    <i class="fa fa-bars"></i>
                                    <span>@translate(Categories)</span>
                                </a>
                            </div>
                            <div class="category-menu">
                                <ul>
                                    @foreach(categories() as $item)
                                        <li class="{{$item->child->count() != 0 ? 'have-submenu' : ''}}">
                                            <a href="{{route('course.category',$item->slug)}}">{{$item->name}}</a>
                                            @if($item->child->count() != 0)
                                                <ul class="sub-menu">
                                                    @foreach($item->child as $child)
                                                        <li>
                                                            <a href="{{route('course.category',$child->slug)}}">{{$child->name}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="header-search">
                            <form action="#">
                                <input class="form-control" id="search" type="text" name="search"
                                       placeholder="@translate(Search for anything)">
                                <button type="submit"><i class="fa fa-search"></i></button>

                                <!-- Search bar END - -->

                                <!-- ======================== Search Suggession ============================= -->

                                <div class="overflow-hidden search-list w-100">
                                    <div id="appendSearchCart1"></div>
                                </div>
                                {{--some ajax value--}}
                                <input value="@translate(Your Cart is Empty)" type="hidden"
                                       id="emptyUrl" name="emptyUrl">
                                <input value="{{route('search.courses')}}" type="hidden"
                                       id="searchUrl" name="searchUrl">
                            </form>
                        </div>
                        <div class="header-button">
                            @auth
                                <div class="logo-right-button">
                                    <div class="header-action-button d-flex align-items-center">
                                        @if (Auth::user()->user_type === "Student")
                                            <div class="header-widget header-widget2">
                                                <div class="header-right-info">
                                                    <ul class="user-cart d-flex align-items-center ">
                                                        <li class="p-50p">
                                                            <a href="{{route('my.courses')}}"
                                                               class="template-button">@translate(My courses)</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>


                                            <div class="notification-wrap d-flex align-items-center ml-3">
                                                <div class="notification-item mr-3 cart_item">
                                                    <button class="notification-btn" type="button" onclick="openNav()"
                                                            id="cartDropdownMenu">
                                                        <i class="la la-shopping-cart user-cart-btn"></i>
                                                        <span class="quantity cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
                                                    </button>


                                                    <div id="mySidebar" class="cart-sidebar">
                                                        <a href="javascript:void(0)" class="closebtn"
                                                           onclick="closeNav()">close</a>
                                                        <a href="javascript:void(0)" class="arrow-btn" onclick="closeNav()"> <i
                                                                class="fa fa-angle-right"></i> </a>

                                                        <div class="text-center">
                                                            <h3>@translate(Your cart)</h3>
                                                            <hr>
                                                        </div>


                                                        <div class="cart_sidebar">
                                                            <input id="cartImg" name="cartImg" type="hidden" value="{{ asset('asset_rumbok/images/empty_cart.png') }}">
                                                            <ul id="cartAppend">
                                                                <img src="{{ asset('asset_rumbok/images/empty_cart.png') }}" class="w-100"  alt="">
                                                            </ul>


                                                            @auth()
                                                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Student")
                                                                    <input value="{{route('cart.list')}}" type="hidden"
                                                                           id="cartUrl" name="cartUrl">
                                                                    <input value="{{route('wish.list')}}" type="hidden"
                                                                           id="wishUrl" name="wishUrl">
                                                                    <input value="{{route('enroll.courses')}}" type="hidden"
                                                                           id="enrollUrl" name="enrollUrl">
                                                                    <input value="{{route('shopping.cart')}}" type="hidden"
                                                                           id="shoppingCart" name="shoppingCart">
                                                                    <input value="@translate(Go To Cart)" type="hidden"
                                                                           id="textUrl" name="textUrl">

                                                                @endif
                                                            @endauth

                                                            <div id="cartBtn">
                                                                <a href="{{route('course.filter')}}"
                                                                   class="theme-btn cart-btn btn-cart cart-text f-13 w-50">@translate(Get Your Course)</a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="notification-item mr-3 notify_btn">
                                                    <button class="notification-btn" type="button"
                                                            onclick="notifySidebaropenNav()">
                                                        <i class="la la-bell"></i>
                                                        <span class="quantity">{{ App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->count() }}</span>
                                                    </button>


                                                    <div id="notifySidebar" class="cart-sidebar">
                                                        <a href="javascript:void(0)" class="closebtn"
                                                           onclick="notifySidebarcloseNav()">close</a>
                                                        <a href="javascript:void(0)" class="arrow-btn"
                                                           onclick="notifySidebarcloseNav()"> <i class="fa fa-angle-right"></i>
                                                        </a>

                                                        <div class="text-center p-3">
                                                            <ul class="text-center">
                                                                <li>
                                                                    <h3>@translate(Notifications)</h3>
                                                                </li>
                                                            </ul>
                                                            <hr>
                                                        </div>

                                                        <div class="cart_sidebar">
                                                            <ul class="list-group">
                                                                <li>
                                                                    @forelse (App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->latest()->get() as $notification)
                                                                        <div
                                                                            class="{{ $notification->is_read === 0 ? 'bg-ecf0f1' : '' }}">
                                                                            <div class="mess__item">
                                                                                <div class="icon-element bg-color-1 text-white">
                                                                                    <i class="la la-bolt"></i>
                                                                                </div>
                                                                                <div class="content">
                                                                                    @foreach ($notification->data as $item)
                                                                                        <span
                                                                                            class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                                                        <p class="text">{{ $item }}</p>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @empty
                                                                        <div class="content text-center no-notify">
                                                                            <img src="{{ asset('rumbok/images/notify.png') }}" class="w-100" alt="">
                                                                        </div>
                                                                    @endforelse
                                                                    <a href="{{ route('student.dashboard') }}"
                                                                       class="cart-btn btn-cart cart-text notify-btn f-13 w-50 mt-3">@translate(See all notifications)</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="notification-item mr-3 wishlist_btn">
                                                    <button class="notification-btn" type="button" onclick="wishopenNav()">
                                                        <i class="la la-heart-o"></i>
                                                        <span class="quantity wishlist-quantity"></span>
                                                    </button>


                                                    <div id="wishSidebar" class="cart-sidebar">
                                                        <a href="javascript:void(0)" class="closebtn"
                                                           onclick="wishcloseNav()">close</a>
                                                        <a href="javascript:void(0)" class="arrow-btn" onclick="wishcloseNav()">
                                                            <i class="fa fa-angle-right"></i> </a>

                                                        <div class="text-center">
                                                            <h3>@translate(Your Wishlist)</h3>
                                                            <hr>
                                                        </div>


                                                        <div class="cart_sidebar">
                                                            <input id="wishtImg" name="wishImg" type="hidden" value="{{ asset('rumbok/images/wishlist.png') }}">
                                                            <ul id="wishlistAppend">
                                                                <img src="{{ asset('rumbok/images/wishlist.png') }}" class="w-100" alt="">
                                                            </ul>
                                                            <div id="cartBtn">
                                                                <a href="{{ route('my.wishlist') }}"
                                                                   class="theme-btn cart-btn cart-text w-75">@translate(Show All Wishlist)</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="user-action-wrap">
                                                <div class="notification-item user-action-item">
                                                    <div class="dropdown">
                                                        <button
                                                            class="notification-btn dot-status online-status dropdown-toggle"
                                                            type="button" id="userDropdown" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                             ? asset('rumbok/images/student.png')
                                                             : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                 alt="{{ Auth::user()->name }}"
                                                                 class="avatar-sm rounded-circle">
                                                        </button>
                                                        <div class="dropdown-menu userDrop" aria-labelledby="userDropdown">
                                                            <div class="mess-dropdown">
                                                                <div class="mess__title d-flex align-items-center">

                                                                    <a href="{{ route('student.dashboard') }}">
                                                                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                          ? asset('rumbok/images/student.png')
                                                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                             alt="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                                                             class="avatar-sm rounded-circle">
                                                                    </a>

                                                                    <div class="content ml-8">
                                                                        <h4 class="widget-title font-size-16">
                                                                            <a href="{{ route('student.dashboard') }}"
                                                                               class="text-white">
                                                                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                                                                            </a>
                                                                        </h4>
                                                                        <span
                                                                            class="email">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                                                    </div>
                                                                </div><!-- end mess__title -->
                                                                @if (Auth::user()->user_type == "Student")

                                                                    <div class="mess__body">
                                                                        <ul class="list-items">

                                                                            <li class="mb-0">
                                                                                <a href="{{ route('student.profile') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-user"></i> @translate(My Profile)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('my.courses')}}" class="d-block">
                                                                                    <i class="la la-file-video-o"></i> @translate(My courses)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('student.message')}}"
                                                                                   class="d-block">
                                                                                    <i class="la la-bell"></i>
                                                                                    @translate(Message)
                                                                                </a>
                                                                            </li>


                                                                            <li class="mb-0">
                                                                                <a href="{{ route('student.purchase.history') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-cart-plus"></i>
                                                                                    @translate(Purchase history)
                                                                                </a>
                                                                            </li>
                                                                            @if(affiliateStatus())
                                                                                <li class="mb-0">
                                                                                    <a href="{{ route('affiliate.area') }}"
                                                                                       class="d-block">
                                                                                        <i class="la la-adn"></i>
                                                                                        @translate(Affiliate Area)
                                                                                    </a>
                                                                                </li>
                                                                            @endif

                                                                            <li class="mb-0">
                                                                                <div class="section-block mt-2 mb-2"></div>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{ route('logout') }}" class="d-block"
                                                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                    <i class="la la-power-off text-danger"></i>
                                                                                    @translate(Logout)
                                                                                </a>

                                                                                <form id="logout-form"
                                                                                      action="{{ route('logout') }}" method="POST"
                                                                                      class="d-none">
                                                                                    @csrf
                                                                                </form>
                                                                            </li>

                                                                        </ul>
                                                                    </div>

                                                                @else

                                                                    <div class="mess__body">
                                                                        <ul class="list-items">
                                                                            <li class="mb-0">
                                                                                <a href="{{ route('dashboard') }}"
                                                                                   class="d-block">
                                                                                    <i class="la la-dashboard"></i> @translate(Go To Dashboard)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('my.courses')}}" class="d-block">
                                                                                    <i class="la la-file-video-o"></i> @translate(My courses)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <div class="section-block mt-2 mb-2"></div>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{ route('logout') }}" class="d-block"
                                                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                    <i class="la la-power-off text-danger"></i>
                                                                                    @translate(Logout)
                                                                                </a>

                                                                                <form id="logout-form"
                                                                                      action="{{ route('logout') }}" method="POST"
                                                                                      class="d-none">
                                                                                    @csrf
                                                                                </form>
                                                                            </li>

                                                                        </ul>
                                                                    </div>
                                                            @endif

                                                            <!-- end mess__body -->
                                                            </div><!-- end mess-dropdown -->
                                                        </div><!-- end dropdown-menu -->
                                                    </div><!-- end dropdown -->
                                                </div>
                                            </div>

                                        @else

                                            <div class="header-widget header-widget2">
                                                <div class="header-right-info">
                                                    <ul class="user-cart d-flex align-items-center ">
                                                        <li class="p-50p">
                                                            <a href="{{route('dashboard')}}"
                                                               class="btn btn-success text-white my-course-btn">@translate(Go To Dashboard)</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="user-action-wrap">
                                                <div class="notification-item user-action-item">
                                                    <div class="dropdown">
                                                        <button
                                                            class="notification-btn dot-status online-status dropdown-toggle"
                                                            type="button" id="userDropdown" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                             ? asset('rumbok/images/student.png')
                                                             : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                 alt="{{ Auth::user()->name }}"
                                                                 class="avatar-sm rounded-circle">
                                                        </button>
                                                        <div class="dropdown-menu userDrop" aria-labelledby="userDropdown">
                                                            <div class="mess-dropdown">
                                                                <div class="mess__title d-flex align-items-center">

                                                                    <a href="{{ route('dashboard') }}">
                                                                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                          ? asset('rumbok/images/student.png')
                                                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                                             alt="{{\Illuminate\Support\Facades\Auth::user()->name}}"
                                                                             class="avatar-sm rounded-circle">
                                                                    </a>

                                                                    <div class="content ml-8">
                                                                        <h4 class="widget-title font-size-16">
                                                                            <a href="{{ route('dashboard') }}"
                                                                               class="text-white">
                                                                                {{\Illuminate\Support\Facades\Auth::user()->name}}
                                                                            </a>
                                                                        </h4>
                                                                        <span
                                                                            class="email">{{\Illuminate\Support\Facades\Auth::user()->email}}</span>
                                                                    </div>
                                                                </div><!-- end mess__title -->


                                                                <div class="mess__body">
                                                                    <ul class="list-items">
                                                                        <li class="mb-0">
                                                                            <a href="{{ route('media.index') }}"
                                                                               class="d-block">
                                                                                <i class="la la-video-camera"></i> @translate(Media Manager)
                                                                            </a>
                                                                        </li>

                                                                        @if (Auth::user()->user_type === 'Admin')

                                                                            @if(env('ADDONS_MANAGER') == "YES")

                                                                                <li class="mb-0">
                                                                                    <a href="{{ route('addons.manager.index') }}"
                                                                                       class="d-block">
                                                                                        <i class="la la-puzzle-piece"></i> @translate(Addons Manager)
                                                                                    </a>
                                                                                </li>

                                                                            @endif

                                                                            <li class="mb-0">
                                                                                <a href="{{route('packages.index')}}" class="d-block">
                                                                                    <i class="la la-briefcase"></i> @translate(Instructor Package)
                                                                                </a>
                                                                            </li>

                                                                            <li class="mb-0">
                                                                                <a href="{{route('affiliate.setting.create')}}" class="d-block">
                                                                                    <i class="la la-chain"></i> @translate(Affiliate Area)
                                                                                </a>
                                                                            </li>


                                                                            <li class="mb-0">
                                                                                <a href="{{route('tickets.index')}}" class="d-block">
                                                                                    <i class="la la-ticket"></i> @translate(Support Ticket)
                                                                                </a>
                                                                            </li>
                                                                        @endif


                                                                        <li class="mb-0">
                                                                            <div class="section-block mt-2 mb-2"></div>
                                                                        </li>

                                                                        <li class="mb-0">
                                                                            <a href="{{ route('logout') }}" class="d-block"
                                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                                <i class="la la-power-off text-danger"></i>
                                                                                @translate(Logout)
                                                                            </a>

                                                                            <form id="logout-form"
                                                                                  action="{{ route('logout') }}" method="POST"
                                                                                  class="d-none">
                                                                                @csrf
                                                                            </form>
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                                <!-- end mess__body -->
                                                            </div><!-- end mess-dropdown -->
                                                        </div><!-- end dropdown-menu -->
                                                    </div><!-- end dropdown -->
                                                </div>
                                            </div>

                                        @endif

                                    </div>


                                    <div class="menu-toggler d-flex align-items-center">
                                        <div class="side-menu-open">
                                            <i class="la la-bars"></i>
                                        </div><!-- end side-menu-open -->
                                        <div class="user-menu-open ml-2">
                                            <a href="{{ route('student.profile') }}"
                                               class="d-block user-avatar-sm">

                                                <img class="avatar-sm" src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                          ? asset('rumbok/images/student.png')
                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                     alt="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="avatar-sm">
                                            </a>
                                        </div><!-- end user-menu-open -->
                                    </div>
                                </div><!-- end logo-right-button -->
                            @endauth

                            @guest
                                <a href="{{route('student.register')}}" class="template-button-2">@translate(become student)</a>
                                <a href="{{route('instructor.register')}}" class="template-button">@translate(instructor)</a>
                            @endguest

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @auth
        {{-- bottom responsive menu --}}
        <ul class="nav justify-content-center fixed-bottom bg-white btm-fixed-nav d-none">
            <li class="nav-item">
                <div class="notification-item mr-3">
                    <a href="{{ route('shopping.cart') }}">
                        <button class="notification-btn dropdown-toggle">
                            <i class="la la-shopping-cart"></i>
                            <span class="quantity cart-quantity">{{ App\Model\Cart::where('user_id',Auth::user()->id)->count() }}</span>
                        </button>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <div class="notification-item mr-3">
                    <a href="{{ route('student.dashboard') }}">
                        <button class="notification-btn dropdown-toggle">
                            <i class="la la-bell"></i>
                            <span class="quantity">{{ App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->count() }}</span>
                        </button>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <div class="notification-item mr-3">
                    <a href="{{ route('my.wishlist') }}">
                        <button class="notification-btn dropdown-toggle">
                            <i class="la la-heart-o"></i>
                            <span class="quantity wishlist-quantity">{{ App\Model\Wishlist::where('user_id',Auth::user()->id)->count() }}</span>
                        </button>
                    </a>
                </div>
            </li>
        </ul>
        {{-- bottom responsive menu --}}
    @endauth

</header>


<!--======================================
        END HEADER AREA
======================================-->


@yield('content')



@if(!request()->is('student/*'))


    @guest()
        <!-- CTA Section Starts -->
        <section class="cta-section gradient-bg padding-top-60 padding-bottom-30">
            <div class="cta-shape">
                <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="image" class="plus-sign item-rotate">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="section-title margin-bottom-40">
                            <h2>@translate(enhance your skills with) <span>@translate(best online course)</span></h2>
                        </div>
                        <div class="cta-button">
                            <a href="{{route('instructor.register')}}" class="template-button margin-right-20">start teaching</a>
                            <a href="{{route('student.register')}}" class="template-button-2">start learning</a>
                        </div>
                    </div>
                    <div class="col-xl-4 offset-xl-2 col-lg-6">
                        <div class="cta-image">
                            <img src="{{asset('asset_rumbok/images/cta-image.png')}}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endguest

    <!-- ================================
           Start FOOTER AREA
  ================================= -->

    <!-- Footer Section Starts -->
    <footer class="footer-section padding-top-30 padding-bottom-60">
        <div class="footer-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-3.png')}}" alt="shape" class="round-shape-3">
        </div>
        <div class="container">
            <div class="footer-widget-section">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <a href="{{route('homepage')}}">
                                    <img src="{{ filePath(getSystemSetting('footer_logo')->value) }}"
                                         alt="{{getSystemSetting('type_name')->value}}" class="round-shape-3">
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <div class="widget-title">
                                <h4 class="title">@translate(Categories)</h4>
                            </div>
                            <ul>
                                @foreach(\App\Model\Category::Published()->where('top', 1)->get() as $item)
                                    <li><a href="{{route('course.category',$item->slug)}}">{{$item->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <div class="widget-title">
                                <h4 class="title">@translate(useful links)</h4>
                            </div>
                            <ul>
                                @foreach(\App\Page::where('active',1)->get() as $item)
                                    <li><a href="{{route('pages',$item->slug)}}">{{$item->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <div class="widget-title">
                                <h4 class="title">@translate(company)</h4>
                            </div>
                            <div class="company-address d-flex">
                                <div class="address-icon template-icon green-icon margin-right-10">
                                    <i class="icofont-address-book"></i>
                                </div>
                                <div class="address-info">
                                    {{getSystemSetting('type_mail')->value}}<br>
                                    <span>{{getSystemSetting('type_footer')->value}}.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-copyright-section">
                <div class="row align-items-center">
                    <div class="col-sm-5">
                        <div class="copyright-text">
                            <span>&copy; {{date('Y')}} {{getSystemSetting('type_name')->value}}</span>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="copyright-button">
                            <div class="dropup-item item-1">
                                <div class="toggle-box box-1">
                                    <form id="ru-currency" method="post" action="{{route('frontend.currencies.change')}}">
                                        @csrf
                                        <select class="theme-btn sort-ordering-select selectpicker" data-live-search="true" tabindex="-98" name="id" onchange="currencyChange()">
                                            @foreach(\App\Model\Currency::where('is_published',true)->get() as $item)
                                                <option  value="{{$item->id}}" {{defaultCurrency() == $item->code ? 'selected' : null}}> {{Str::ucfirst($item->symbol.' '.$item->code)}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <div class="dropup-item item-2 margin-left-20">
                                <div class="toggle-box box-2">
                                    <form id="ru-lang" method="post" action="{{route('frontend.languages.change')}}">
                                        @csrf
                                        <select class="theme-btn sort-ordering-select  selectpicker" tabindex="-98" name="code" data-live-search="true" onchange="languageChange()">
                                            @foreach(\App\Model\Language::all() as $language)
                                                <option  value="{{$language->code}}"  {{(\Illuminate\Support\Facades\Session::get('locale') == $language->code ? 'selected' : env('DEFAULT_LANGUAGE') == $language->code ) ? 'selected' : null }}>{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- ================================
              END FOOTER AREA
    ================================= -->
@endif





<!-- template js files -->
<!-- Javascript Files -->
<script src="{{asset('asset_rumbok/js/vendor/jquery.js')}}"></script>
<script src="{{ asset('frontend/js/popper.js') }}"></script>
<script src="{{asset('asset_rumbok/js/vendor/bootstrap.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/slick.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/counterup.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/waypoints.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/isotop.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/barfiller.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/countdown.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/easing.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/wow.js')}}"></script>
<script src="{{asset('asset_rumbok/js/main.js')}}"></script>
<script src="{{ asset('js/frontend.js') }}"></script>
<script src="{{ asset('js/notify.js') }}"></script>


@include('layouts.modal')

@include('sweetalert::alert')
@yield('js')

</body>

</html>
