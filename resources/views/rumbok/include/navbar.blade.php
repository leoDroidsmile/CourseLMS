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
