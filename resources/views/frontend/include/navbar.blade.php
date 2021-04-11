<div class="header-menu-content">
    <div class="container-fluid">
        <div class="main-menu-content">
            <div class="row align-items-center h-100">
                <div class="col-lg-3">
                    <div class="logo-box">
                        <a href="{{ route('homepage') }}"
                           class="w-50"
                           title="{{getSystemSetting('type_name')->value}}">
                            <img class="img-fluid header-logo" src="{{ filePath(getSystemSetting('type_logo')->value) }}"
                                 alt="{{getSystemSetting('type_name')->value}}"></a>
                        <div class="header-category">
                            <ul>
                                <li>
                                    <a href="{{ route('course.filter') }}"><i class="fa fa-th p-2"></i>@translate(Categories)</a>
                                    <ul class="dropdown-menu-item">
                                        @foreach(categories() as $item)
                                            <li>
                                                @if($item->child->count() != 0)
                                                    <span class="la la-angle-right menu-collapse"></span>
                                                @endif
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
                                </li>
                            </ul>
                        </div><!-- end header-category -->
                    </div>
                </div><!-- end col-lg-3 -->
                <div class="col-lg-9">
                    <div class="menu-wrapper">
                        <div class="contact-form-action search-form-action m-auto">
                            <form>
                                <div class="input-box">
                                    <div class="form-group">
                                        <!-- Search bar -->
                                        <input class="form-control" id="search" type="text" name="search"
                                               placeholder="@translate(Search for anything)">
                                        <span class="la la-search search-icon"></span>

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

                                        <!-- =========================== Search Suggession END ========================== -->
                                    </div>
                                </div><!-- end input-box -->
                            </form>
                        </div><!-- end contact-form-action -->

                        <!-- end main-menu -->

                        @auth
                            <div class="logo-right-button">


                                <div class="header-action-button d-flex align-items-center">

                                    @if (Auth::user()->user_type === "Student")
                                        
                        
                                    <div class="header-widget header-widget2">
                                        <div class="header-right-info">
                                            <ul class="user-cart d-flex align-items-center ">
                                                <li class="p-50p">
                                                    <a href="{{route('my.courses')}}"
                                                       class="btn btn-success text-white my-course-btn">@translate(My courses)</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="notification-wrap d-flex align-items-center ml-3">
                                        <div class="notification-item mr-3 cart_item">
                                        
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
                                                    <input id="cartImg" name="cartImg" type="hidden" value="{{ asset('frontend/images/empty_cart.png') }}">
                                                    <ul id="cartAppend">
                                                        <img src="{{ asset('frontend/images/empty_cart.png') }}" class="w-100"  alt="">
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
                                                                    <img src="{{ asset('frontend/images/notify.png') }}" class="w-100" alt="">
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
                                                    <input id="wishtImg" name="wishImg" type="hidden" value="{{ asset('frontend/images/wishlist.png') }}">
                                                    <ul id="wishlistAppend">
                                                        <img src="{{ asset('frontend/images/wishlist.png') }}" class="w-100" alt="">
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
                                                             ? asset('frontend/images/student.png')
                                                             : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                         alt="{{ Auth::user()->name }}"
                                                         class="avatar-sm rounded-circle">
                                                </button>
                                                <div class="dropdown-menu userDrop" aria-labelledby="userDropdown">
                                                    <div class="mess-dropdown">
                                                        <div class="mess__title d-flex align-items-center">

                                                            <a href="{{ route('student.dashboard') }}">
                                                                <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                          ? asset('frontend/images/student.png')
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

                                                                @if (walletActive())
                                                                    <span class="email"><i class="fa fa-money"></i> {{  walletBalance() }}</span>
                                                                @endif


                                                            </div>
                                                        </div><!-- end mess__title -->

                                                        
                                                        @if (Auth::user()->user_type != "Admin")
                                                            
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
                                                             ? asset('frontend/images/student.png')
                                                             : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                         alt="{{ Auth::user()->name }}"
                                                         class="avatar-sm rounded-circle">
                                                </button>
                                                <div class="dropdown-menu userDrop" aria-labelledby="userDropdown">
                                                    <div class="mess-dropdown">
                                                        <div class="mess__title d-flex align-items-center">

                                                            <a href="{{ route('dashboard') }}">
                                                                <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                                                          ? asset('frontend/images/student.png')
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
                                          ? asset('frontend/images/student.png')
                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                                 alt="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="avatar-sm">
                                        </a>
                                    </div><!-- end user-menu-open -->
                                </div>


                            </div><!-- end logo-right-button -->





                        @endauth


                        @guest
                            <div class="logo-right-button">
                                <ul id="custom_toggle_bar" class="d-flex">
                                    <li class="pr-2"><a href="{{route('instructor.register')}}"
                                                        class="theme-btn instructor-btn">@translate(Instructor)</a></li>
                                    <li><a href="{{route('student.register')}}" class="theme-btn student-btn">@translate(Become Student)</a></li>
                                </ul>
                                <div class="side-menu-open">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>


                        @endguest
                        <div class="ml-2"></div>
                    @guest

                    @endguest


                    <!-- end logo-right-button -->
                        <div class="side-nav-container">
                            <div class="humburger-menu">
                                <div class="humburger-menu-lines side-menu-close"></div>
                                <!-- end humburger-menu-lines -->
                            </div><!-- end humburger-menu -->
                            {{-- responsive menu --}}
                            <div class="side-menu-wrap">
                                <ul class="side-menu-ul">
                                    <li class="sidenav__item">
                                        <a href="{{ route('homepage') }}">@translate(Home)</a>
                                    </li>

                                    <li class="sidenav__item">
                                        <a href="{{ route('course.filter') }}">@translate(Categories)</a>
                                        <span class="menu-plus-icon"></span>
                                        <ul class="side-sub-menu">
                                            @foreach(categories() as $item)
                                                <li class="sidenav__item">
                                                    <a href="{{ route('course.category',$item->slug) }}">{{$item->slug}}</a>
                                                    @if($item->child->count() > 0)

                                                        <ul class="side-sub-menu">
                                                            @foreach($item->child as $child)
                                                                <li>
                                                                   <a href="{{route('course.category',$child->slug)}}" class="pl-55">{{$child->name}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    @auth
                                        <li class="sidenav__item">
                                            <a href="{{route('my.courses')}}">@translate(My courses)</a>
                                        </li>
                                        <li class="sidenav__item">
                                            <a href="{{route('student.dashboard')}}">@translate(Dashboard)</a>
                                        </li>
                                        <li class="sidenav__item">
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">@translate(Logout)</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" >
                                                @csrf
                                            </form>

                                        </li>
                                    @endauth

                                </ul>
                                @guest

                                    <div class="side-btn-box">
                                        <a href="{{ route('login') }}" class="theme-btn">@translate(Login)</a>
                                        <span>or</span>
                                        <a href="{{ route('student.register') }}"
                                           class="theme-btn">@translate(Register)</a>
                                    </div>
                                @endguest

                            </div><!-- end side-menu-wrap -->
                            {{-- responsive menu END--}}
                        </div><!-- end side-nav-container -->
                    </div><!-- end menu-wrapper -->
                </div><!-- end col-lg-9 -->
            </div><!-- end row -->
        </div>
    </div><!-- end container-fluid -->
</div><!-- end header-menu-content -->


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
