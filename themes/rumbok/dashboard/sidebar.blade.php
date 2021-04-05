<div class="dashboard-sidebar">
    <div class="dashboard-nav-trigger">
        <div class="dashboard-nav-trigger-btn">
            <i class="la la-bars"></i> @translate(Dashboard Nav)
        </div>
    </div>
    <div class="dashboard-nav-container">
        <div class="humburger-menu">
            <div class="humburger-menu-lines side-menu-close"></div><!-- end humburger-menu-lines -->
        </div><!-- end humburger-menu -->
        <div class="side-menu-wrap">
            <ul class="side-menu-ul">

                <li class="sidenav__item {{ request()->is('student/profile') ? 'page-active' : '' }}"><a
                        href="{{ route('student.profile') }}"><i class="la la-user"></i>@translate(My Profile)</a></li>
                <li class="sidenav__item {{ request()->is('student/message') ? 'page-active' : '' }}"><a
                        href="{{ route('student.message') }}"><i class="la la-bell"></i>@translate(Message)</a></li>
                        <li class="sidenav__item {{ request()->is('student/dashboard') ? 'page-active' : '' }}"><a
                                href="{{ route('student.dashboard') }}"><i class="la la-dashboard"></i>@translate(Notfications)</a>
                        </li>
                <li class="sidenav__item {{ request()->is('student/purchase/history') ? 'page-active' : '' }}"><a
                        href="{{ route('student.purchase.history') }}"><i class="la la-shopping-cart"></i>@translate(Purchase
                        History)</a></li>
                @if(affiliateStatus())
                <li class="sidenav__item {{ request()->is('student/affiliate*') ? 'page-active' : '' }}"><a
                        href="{{ route('affiliate.area') }}"><i class="la la-adn"></i>@translate(Affiliate Area)</a></li>
                @endif
                <li class="sidenav__item"><a href="{{ route('logout') }}"
                                             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="la la-power-off text-danger"></i>@translate(Logout)</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <!-- end side-menu-wrap -->
    </div>
</div><!-- end dashboard-sidebar -->
