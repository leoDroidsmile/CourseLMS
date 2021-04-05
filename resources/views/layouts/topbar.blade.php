<!-- Start Topbar Mobile -->
<div class="topbar-mobile">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="mobile-logobar">

                <a href="{{route('dashboard')}}" class="mobile-logo"><img src="{{filePath(getSystemSetting('type_logo')->value)}}"
                                                                    class="img-fluid" alt="logo"></a>
            </div>
            <div class="mobile-togglebar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="topbar-toggle-icon">
                            <a class="topbar-toggle-hamburger" href="javascript:void();">
                                <img src="{{ asset('assets/images/svg-icon/horizontal.svg') }}"
                                     class="img-fluid menu-hamburger-horizontal" alt="horizontal">
                                <img src="{{ asset('assets/images/svg-icon/verticle.svg') }}"
                                     class="img-fluid menu-hamburger-vertical" alt="verticle">
                            </a>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="menubar">
                            <a class="menu-hamburger" href="javascript:void();">
                                <img src="{{ asset('assets/images/svg-icon/menu.svg') }}"
                                     class="img-fluid menu-hamburger-collapse" alt="collapse">
                                <img src="{{ asset('assets/images/svg-icon/close.svg') }}"
                                     class="img-fluid menu-hamburger-close" alt="close">
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Start Topbar -->
<div class="topbar">
    <!-- Start row -->
    <div class="row align-items-center">
        <!-- Start col -->
        <div class="col-md-12 align-self-center">
            <div class="togglebar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="menubar">
                            <a class="menu-hamburger" href="javascript:void();">
                                <img src="{{ asset('assets/images/svg-icon/menu.svg') }}"
                                     class="img-fluid menu-hamburger-collapse" alt="menu">
                                <img src="{{ asset('assets/images/svg-icon/close.svg') }}"
                                     class="img-fluid menu-hamburger-close" alt="close">
                            </a>
                        </div>
                    </li>
                    <li class="list-inline-item">
                        <div class="px-5"></div>
                    </li>
                    <li class="list-inline-item">
                        <a target="_blank" href="{{url('/')}}">
                            <i class="fa fa-globe"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="infobar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="languagebar">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="languagelink"
                                   data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false"><span class="live-icon">
                                        {{Str::ucfirst(\Illuminate\Support\Facades\Session::get('locale') ?? env('DEFAULT_LANGUAGE'))}}
                                    </span><span class="feather icon-chevron-down live-icon"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languagelink">
                                    @foreach(\App\Model\Language::all() as $language)
                                        <a class="dropdown-item" href="{{route('language.change')}}"
                                           onclick="event.preventDefault();
                                               document.getElementById('{{$language->name}}').submit()">
                                            <img width="25" height="auto"
                                                 src="{{ asset("uploads/lang/". $language->image) }}" alt=""/>
                                            {{$language->name}}</a>
                                        <form id="{{$language->name}}" class="d-none"
                                              action="{{ route('language.change') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="code" value="{{$language->code}}">
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <!--currency-->
                    <li class="list-inline-item">
                        <div class="languagebar">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="languagelink"
                                   data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false"><span class="live-icon">
                                        {{Str::ucfirst(defaultCurrency())}}
                                    </span><span class="feather icon-chevron-down live-icon"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languagelink">
                                    @foreach(\App\Model\Currency::all() as $item)
                                        <a class="dropdown-item" href="{{route('currencies.change')}}"
                                           onclick="event.preventDefault();
                                               document.getElementById('{{$item->code}}').submit()">
                                            {{Str::ucfirst($item->symbol.' '.$item->code)}}</a>
                                        <form id="{{$item->code}}" class="d-none"
                                              action="{{ route('currencies.change') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-inline-item">
                        <div class="notifybar">
                            <div class="dropdown show">
                                <a class="dropdown-toggle infobar-icon" href="javascript:void()" role="button"
                                   id="notoficationlink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="true"><img
                                        src="{{ asset('assets/images/svg-icon/notifications.svg') }}" class="img-fluid"
                                        alt="notifications">
                                    <span class="live-icon">{{ App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->count() }}</span></a>
                                <div class="dropdown-menu dropdown-menu-right hide st-drop"
                                     aria-labelledby="notoficationlink" x-placement="top-end">
                                    <div class="notification-dropdown-title">
                                        <h4>
                                            @translate(Notifications)</h4>
                                    </div>
                                    <ul class="list-unstyled lms-notify">

                                        @forelse (App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->latest()->get() as $notification)

                                            <li class="media dropdown-item {{ $notification->is_read === 0 ? 'bg-ecf0f1' : '' }}">
                                                <span class="action-icon badge badge-success-inverse">N</span>
                                                <div class="media-body">
                                                    <a href="{{ route('see_all_notifications',Auth::user()->id)  }}">
                                                      @foreach ($notification->data as $item)
                                                        <h5 class="action-title">
                                                          {{ $item }}
                                                        </h5>
                                                      @endforeach
                                                    </a>
                                                    <p><span class="timing">{{ $notification->created_at->diffForHumans() }}</span></p>
                                                </div>
                                            </li>

                                        @empty

                                            <li class="notification-dropdown-title stit-notification">
                                                <h5>
                                                    @translate(You have no new notifications yet)
                                                </h5>
                                            </li>

                                        @endforelse

                                    </ul>


                                    <div class="notification-dropdown-title">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ route('see_all_notifications', Auth::user()->id) }}"
                                                   class="stit-s-12">
                                                    @translate(See all notifications)</a>
                                            </div>
                                            @if ( App\NotificationUser::where('user_id',Auth::user()->id)->where('is_read',false)->count() > 0)
                                                <div class="col-md-6">
                                                    <a href="{{ route('mark_all_read', Auth::user()->id) }}"
                                                       class="stit-s-12">
                                                        @translate(Mark all As read)</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-inline-item">
                        <div class="profilebar">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="profilelink"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Auth::user()->image != null ? filepath(\Illuminate\Support\Facades\Auth::user()->image)  : asset('/assets/images/users/profile.svg')}}"
                                        class="img-fluid rounded-circle avatar-sm"
                                        alt="profile">
                                    <span class="live-icon">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                                    <span class="feather icon-chevron-down live-icon"></span></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Instructor")
                                    <div class="dropdown-item">
                                        <div class="profilename">
                                                <h5>
                                                    <i class="fa fa-money"></i> {{formatPrice(instructorDetails(\Illuminate\Support\Facades\Auth::id())->balance)}}
                                                </h5>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="userbox">
                                        <ul class="list-unstyled mb-0">

                                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Instructor")
                                                <li class="media dropdown-item">
                                                    <a href="{{ route("instructors.edit",Illuminate\Support\Facades\Auth::user()->id) }}"
                                                       class="profile-icon">
                                                        <img src="{{asset('assets/images/svg-icon/crm.svg')}}"
                                                             class="img-fluid" alt="user">

                                                        @translate(My Profile)</a>
                                                </li>
                                            @else
                                                <li class="media dropdown-item">
                                                    <a href="{{ route("users.show",Illuminate\Support\Facades\Auth::user()->id) }}"
                                                       class="profile-icon">
                                                        <img src="{{asset('assets/images/svg-icon/crm.svg')}}"
                                                             class="img-fluid" alt="user">
                                                        @translate(My Profile)</a>
                                                </li>
                                            @endif
                                            <li class="media dropdown-item">
                                                {{-- Todo::raw logout script code--}}
                                                <a href="{{route('logout')}}"
                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                   class="profile-icon">
                                                    <img src="{{asset('assets/images/svg-icon/logout.svg')}}"
                                                         class="img-fluid" alt="logout">
                                                    @translate(Logout)
                                                    <form id="logout-form" action="{{route('logout')}}" method="POST">
                                                        @csrf
                                                    </form>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<!-- End Topbar -->
