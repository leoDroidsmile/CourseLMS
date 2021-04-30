<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Navigationbar -->
        <div class="navigationbar">

            <div class="vertical-menu-detail">
                <div class="logobar">
                    <a href="{{route('dashboard')}}" class="logo"><img
                            src="{{filePath(getSystemSetting('type_logo')->value)}}" class="img-fluid" alt="logo"></a>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-crm" role="tabpanel"
                         aria-labelledby="v-pills-crm-tab">
                        <ul class="vertical-menu">
                            <li><a href="{{route('dashboard')}}">
                                    <i class="fa fa-tachometer"
                                       aria-hidden="true"></i><span> @translate(Dashboard)</span></a>
                            </li>

                            {{-- Admin's Nav --}}
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                <li class="{{request()->is('dashboard/user*')
                                   || request()->is('dashboard/student*')
                                   || request()->is('dashboard/instructor*')
                                    ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-users"></i>
                                        <span>@translate(User Management)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li><a href="{{route('users.index')}}"
                                               class="{{request()->is('dashboard/user*')  ?'active':null}}">@translate(Admins)</a>
                                        </li>

                                        <li><a href="{{route('instructors.index')}}"
                                               class="{{request()->is('dashboard/instructor*') ?'active':null}}">@translate(Instructors)</a>
                                        </li>
                                        <li><a href="{{route('students.index')}}"
                                               class="{{request()->is('dashboard/student*')  ?'active':null}}">@translate(Students)</a>
                                        </li>

                                    </ul>
                                </li>
                            @endif


                            <li class="{{request()->is('dashboard/media/manager*')
                                    ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-picture-o"></i>
                                    <span>@translate(Media Manager)</span><i
                                        class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li>
                                        <a href="{{route('media.index')}}"
                                           class="{{request()->is('dashboard/media/manager*')
                                                ?'active':null}}">
                                            @translate(Add Media)
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="{{request()->is('dashboard/course*')
                                   ||request()->is('dashboard/category*')
                                   || request()->is('dashboard/category*') ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-book"></i>
                                    <span>@translate(Courses) @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                            <sup
                                                class="badge badge-info">{{\App\Model\Course::where('is_published',false)->count() > 0 ? "@translate(Unpublished)":null}}</sup>
                                        @endif</span>

                                    <i class="feather icon-chevron-right"></i>

                                </a>
                                <ul class="vertical-submenu">
                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin")
                                        {{-- instructor's Nav --}}
                                        <li><a href="{{route('course.create')}}"
                                               class="{{request()->is('dashboard/course/create*') ?'active':null}}">@translate(Start
                                                New Course)</a></li>
                                    @else
                                        {{-- admin's Nav --}}
                                        <li><a href="{{route('categories.index')}}"
                                               class="{{request()->is('dashboard/category*') ?'active':null}}">@translate(Categories)</a>
                                        </li>
                                    @endif

                                    <li><a href="{{route('course.index')}}"
                                           class="{{request()->is('dashboard/course/index*') ?'active':null}}">@translate(All
                                            Courses) @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                                <sup
                                                    class="badge badge-info">{{\App\Model\Course::where('is_published',false)->count() > 0 ? \App\Model\Course::where('is_published',false)->count():null}}</sup>
                                            @endif</a></li>

                                </ul>
                            </li>


                        {{-- Coupon manager --}}
                            @if (couponActive() && \Illuminate\Support\Facades\Auth::user()->user_type == "Admin")

                                <li class="{{request()->is('dashboard/coupon*')
                                    ? 'active' : null}}">
                                    <a href="javascript:;">
                                        <i class="fa fa-bullhorn"></i>
                                        <span>@translate(Coupon Manager)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        {{-- <li>
                                            <a href="{{route('coupon.index')}}"
                                               class="{{request()->is('dashboard/coupon/new')
                                                    ?'active':null}}">
                                                @translate(New Coupon)
                                            </a>
                                        </li> --}}
                                        <li>
                                            <a href="{{route('coupon.all')}}"
                                               class="{{request()->is('dashboard/coupons')
                                                    ?'active':null}}">
                                                @translate(Coupons)
                                            </a>
                                        </li>
                                    
                                        <li>
                                            <a href="{{route('teachercoupon.all')}}"
                                               class="{{request()->is('dashboard/teachercoupons')
                                                    ?'active':null}}">
                                                @translate(Teacher Coupons)
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            {{-- Coupon manager::END --}}




                            {{-- Zoom manager --}}
                            @if (zoomActive() && \Illuminate\Support\Facades\Auth::user()->user_type != "Admin")

                                <li class="{{request()->is('dashboard/zoom*')
                                    ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-television"></i>
                                        <span>@translate(Zoom Meeting)</span><i
                                            class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li>
                                            <a href="{{route('zoom.setting')}}"
                                               class="{{request()->is('dashboard/zoom/setting*')
                                                    ?'active':null}}">
                                                @translate(Zoom Setup)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('zoom.index')}}"
                                               class="{{request()->is('dashboard/zoom/board*')
                                                    ?'active':null}}">
                                                @translate(Zoom Dashboard)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('meeting.create')}}"
                                               class="{{request()->is('dashboard/zoom/create/meeting*')
                                                    ?'active':null}}">
                                                @translate(Create Meeting)
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            {{-- Zoom manager::END --}}

                            {{--quiz start--}}
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin" && env('QUIZ_ACTIVE') == 'YES')
                                <li class="{{request()->is('dashboard/quiz*') ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-question-circle"></i>
                                        <span>@translate(Quiz)</span>
                                        <i class="feather icon-chevron-right"></i>

                                    </a>
                                    <ul class="vertical-submenu">
                                        {{-- instructor's Nav --}}
                                        <li><a href="{{route('quiz.create')}}"
                                               class="{{request()->is('dashboard/quiz/create*') ?'active':null}}">@translate(Quiz
                                                Create)</a></li>
                                        <li><a href="{{route('quiz.list')}}"
                                               class="{{request()->is('dashboard/quiz/list*') || request()->is('dashboard/quiz/questions*')  ?'active':null}}">@translate(Quiz
                                                List)</a></li>
                                    </ul>
                                </li>
                            @endif
                            {{--quiz end--}}


                            {{--Certificate start--}}
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin" && certificate())
                                <li><a href="{{route('certificate.setup')}}"
                                       class="{{request()->is('dashboard/certificate*') ?'active':null}}">
                                        <i class="fa fa-certificate"></i> <span>@translate(Certificate Setting)</span>
                                    </a>
                                </li>
                            @endif
                            {{--Certificate end--}}



                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                {{-- Package area --}}
                                <li><a href="{{route('packages.index')}}"
                                       class="{{request()->is('dashboard/package*') ?'active':null}}">
                                        <i class="fa fa-briefcase"></i> <span>@translate(Instructor Package)</span></a>
                                </li>

                                <li><a href="{{route('payments.index')}}"
                                       class="{{request()->is('dashboard/payment*') ?'active':null}}">
                                        <i class="fa fa-money"></i>
                                        <span>@translate(Instructor's Payment)
                                            @if(\App\Model\Payment::where('status','Request')->count() > 0)
                                                <sup
                                                    class="badge badge-info">{{\App\Model\Payment::where('status','Request')->count()}}
                                                </sup>

                                            @endif
                                        </span>
                                    </a>
                                </li>

                            @endif


                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Instructor")

                                <li><a href="{{route('students.index')}}"
                                       class="{{request()->is('dashboard/students*')  || request()->is('student*')?'active':null}}">
                                        <i class="fa fa-users"></i> <span>@translate(Students)</span></a>
                                </li>
                                {{-- Message with student --}}
                                <li><a href="{{route('messages.index')}}"
                                       class="{{request()->is('dashboard/message*') ?'active':null}}">
                                        <i class="fa fa-envelope-o"></i> <span>@translate(Messages)</span>
                                    </a>
                                </li>
                                {{-- Comment in Course --}}
                                <li><a href="{{route('comments.index')}}"
                                       class="{{request()->is('dashboard/comments*') ?'active':null}}">
                                        <i class="fa fa-comments-o"></i> <span>@translate(Comments)</span>
                                    </a>
                                </li>
                                {{-- Payment request area --}}
                                <li><a href="{{route('payments.index')}}"
                                       class="{{request()->is('dashboard/payment*') ?'active':null}}">
                                        <i class="fa fa-money"></i> <span>@translate(Request Payment)</span>

                                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                            <sup
                                                class="badge badge-info">{{\App\Model\Payment::where('status','Request')->count()}}</sup>
                                        @endif
                                    </a>
                                </li>

                                {{-- Instructor Earning area --}}
                                <li><a href="{{route('instructor.earning')}}"
                                       class="{{request()->is('dashboard/instructor*') ?'active':null}}">
                                        <i class="fa fa-history"></i> <span>@translate(Earning History)</span>
                                    </a>
                                </li>

                            @endif


                            {{--affiliate--}}
                            @if(affiliateStatus() && \Illuminate\Support\Facades\Auth::user()->user_type == 'Admin')
                                <li class="{{request()->is('dashboard/affiliate*') ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="la la-adn"></i>
                                        <span>@translate(Affiliate Area)</span>
                                        @if(\App\Model\Affiliate::where('is_confirm',false)->where('is_cancel',false)->count() >0 || \App\Model\AffiliatePayment::where('status','Request')->count() > 0)
                                            <sup
                                                class="badge badge-info">{{(int)\App\Model\Affiliate::where('is_confirm',false)->where('is_cancel',false)->count() + (int)\App\Model\AffiliatePayment::where('status','Request')->count()}}</sup>
                                        @endif
                                    </a>
                                    <ul class="vertical-submenu">
                                        {{--settings --}}
                                        <li><a href="{{route('affiliate.setting.create')}}"
                                               class="{{request()->is('dashboard/affiliate/setting*') ?'active':null}}">@translate(Settings)</a>
                                        </li>


                                        <li><a href="{{route('affiliate.request.list')}}"
                                               class="{{request()->is('dashboard/affiliate/index') ?'active':null}}">@translate(Requests)
                                                @if(\App\Model\Affiliate::where('is_confirm',false)->where('is_cancel',false)->count() >0)
                                                    <sup
                                                        class="badge badge-info">{{\App\Model\Affiliate::where('is_confirm',false)->where('is_cancel',false)->count()}}</sup>
                                                @endif
                                            </a>
                                        </li>


                                        <li><a href="{{route('affiliate.payment.request')}}"
                                               class="{{request()->is('dashboard/affiliate/payment*') ?'active':null}}">@translate(Payment
                                                request)
                                                @if(\App\Model\AffiliatePayment::where('status','Request')->count() > 0)
                                                    <sup
                                                        class="badge badge-info">{{\App\Model\AffiliatePayment::where('status','Request')->count()}}</sup>
                                                @endif
                                            </a>
                                        </li>


                                    </ul>
                                </li>
                            @endif


                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                {{-- Admin Earning area --}}
                                <li><a href="{{route('admin.earning.index')}}"
                                       class="{{request()->is('dashboard/admin*') ?'active':null}}">
                                        <i class="fa fa-history"></i> <span>@translate(Admin's Earning)</span>
                                    </a>
                                </li>

                                @if(themeManager() == 'rumbok')
                                    <li><a href="{{route('know.index')}}"
                                           class="{{request()->is('dashboard/know*') ?'active':null}}">
                                            <i class="fa fa-sticky-note"></i> <span>@translate(Home Page Content)</span>
                                        </a>
                                    </li>
                                    @endif

                                @if(env('BLOG_ACTIVE') == "YES")
                                    <li><a href="{{route('blog.index')}}"
                                            class="{{request()->is('dashboard/blog*') ?'active':null}}">
                                            <i class="fa fa-contao"></i> <span>@translate(Blog)</span>
                                        </a>
                                    </li>
                                @endif
                               
                            @endif

                            {{-- Support Ticket --}}
                            <li><a href="{{route('tickets.index')}}"
                                   class="{{request()->is('dashboard/ticket*') ?'active':null}}">
                                    <i class="fa fa-envelope-open-o"></i> <span>@translate(Support Ticket)</span>
                                </a>
                            </li>


                            {{-- Settings Area --}}
                            <li class="{{request()->is('dashboard/smtp*')
                                   || request()->is('dashboard/language*')
                                   || request()->is('dashboard/slider*')
                                   || request()->is('dashboard/site*')
                                   || request()->is('dashboard/pages*')
                                   || request()->is('dashboard/app*')
                                   || request()->is('dashboard/themes*')
                                   || request()->is('dashboard/currencies*') ? 'active' : null}}">
                                <a href="javaScript:void();">
                                    <i class="fa fa-gear"></i>
                                    <span>@translate(Settings)</span><i class="feather icon-chevron-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                                        <li><a href="{{route('app.setting')}}"
                                               class="{{request()->is('dashboard/app*') ?'active':null}}">@translate(Gateway
                                                Settings)</a></li>
                                        <li><a href="{{route('currencies.index')}}"
                                               class="{{request()->is('dashboard/currency*') ?'active':null}}">@translate(Currency
                                                Settings)</a>
                                        </li>
                                        <li><a href="{{route('language.index')}}"
                                               class="{{request()->is('dashboard/language*') ?'active':null}}">@translate(Language
                                                Settings)</a></li>
                                        <li><a href="{{route('smtp.create')}}"
                                               class="{{request()->is('dashboard/smtp*') ?'active':null}}">@translate(SMTP
                                                Settings)</a></li>

                                        <li><a href="{{route('sliders.index')}}"
                                               class="{{request()->is('dashboard/slider*') ?'active':null}}">@translate(Slider
                                                Settings)</a></li>

                                        <li><a href="{{route('pages.index')}}"
                                               class="{{request()->is('dashboard/pages*') ?'active':null}}">@translate(Pages)</a>
                                        </li>


                                        <li><a href="{{route('site.setting')}}"
                                               class="{{request()->is('dashboard/site*') ?'active':null}}">@translate(Organization
                                                Settings)</a></li>

                                        <li><a href="{{route('other.setting')}}"
                                               class="{{request()->is('dashboard/other*') ?'active':null}}">@translate(Other
                                                Settings)</a></li>


                                    @else
                                        {{-- Instructor Earning area --}}
                                        <li><a href="{{route('account.create')}}"
                                               class="{{request()->is('dashboard/account*') ?'active':null}}">@translate(Payment
                                                Account Setup)
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>

                            @if(env('FORUM_PANEL') == "YES")
                                {{-- Forum manager --}}
                                @if(Auth::user()->user_type === "Admin" || Auth::user()->user_type === "Instructor")
                                    <li class="{{request()->is('dashboard/forum*') ? 'active' : null}}">
                                        <a href="javaScript:void();">
                                            <i class="fa fa-question-circle"></i>
                                            <span>@translate(Forum Manager)</span>
                                            <i class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">
                                            <li><a href="{{route('forum.panel')}}"
                                                   class="{{request()->is('dashboard/forum/panel*') ?'active':null}}">@translate(Forum
                                                    Posts)</a></li>

                                            <li><a href="{{route('forum.replies')}}"
                                                   class="{{request()->is('dashboard/forum/replies*') ?'active':null}}">@translate(Forum
                                                    Replies)</a></li>

                                            <li><a href="{{route('forum.index')}}" target="_blank">@translate(Browse
                                                    Forum)</a></li>
                                        </ul>
                                    </li>
                                @endif
                            @endif


                            @if(env('SUBSCRIPTION_ACTIVE') == "YES")
                                {{-- Zoom manager --}}
                                @if(Auth::user()->user_type === "Admin" || Auth::user()->user_type === "Instructor")
                                    <li class="{{request()->is('dashboard/subscription*') ? 'active' : null}}">
                                        <a href="javaScript:void();">
                                            <i class="fa fa-th-list"></i>
                                            <span>@translate(Subscription Manager)</span>
                                            <i class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">

                                            @if(adminPower())

                                                <li>
                                                    <a href="{{route('subscription.index')}}"
                                                       class="{{request()->is('dashboard/subscription') || request()->is('dashboard/subscription/package/courses*') ? 'active':null}}">
                                                        @translate(Packages)
                                                    </a>
                                                </li>

                                                @if(enableCourse())
                                                    <li>
                                                        <a href="{{route('subscription.courses')}}"
                                                           class="{{request()->is('dashboard/subscription/courses') ?'active':null}}">
                                                            @translate(Courses)
                                                        </a>
                                                    </li>
                                                @endif


                                                <li>
                                                    <a href="{{route('subscription.members')}}"
                                                       class="{{request()->is('dashboard/members') ?'active':null}}">
                                                        @translate(Members)
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{route('subscription.payments')}}"
                                                       class="{{request()->is('dashboard/payments') ?'active':null}}">
                                                        @translate(Payments)
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{route('subscription.instructor.earning')}}"
                                                       class="{{request()->is('dashboard/instructor/earning*') ?'active':null}}">
                                                        @translate(Earnings)
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{route('subscription.settings')}}"
                                                       class="{{request()->is('dashboard/subscription/settings') ?'active':null}}">
                                                        @translate(Settings)
                                                    </a>
                                                </li>

                                            @endif

                                            @if(enableInstructorRequest())

                                                <li>
                                                    <a href="{{route('subscription.requests')}}"
                                                       class="{{request()->is('dashboard/subscription/requests') ?'active':null}}">
                                                        @translate(Requests)
                                                    </a>
                                                </li>
                                            @endif

                                            @if(instructorPower())

                                                <li>
                                                    <a href="{{route('subscription.payments')}}"
                                                       class="{{request()->is('subscription.payments') ?'active':null}}">
                                                        @translate(Payment)
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{route('subscription.instructor.earning')}}"
                                                       class="{{request()->is('dashboard/instructor/earning*') ?'active':null}}">
                                                        @translate(Earnings)
                                                    </a>
                                                </li>

                                            @endif


                                        </ul>
                                    </li>
                                @endif
                            @endif

                            @if(env('ADDONS_MANAGER') == "YES")
                                {{-- Zoom manager --}}
                                @if(Auth::user()->user_type === "Admin")


                                    {{-- Addons manager --}}
                                    <li><a href="{{route('addons.manager.index')}}"
                                           class="{{request()->is('dashboard/addon*') ?'active':null}}">
                                            <i class="fa fa-puzzle-piece"></i> <span>@translate(Addon Manager)</span>
                                        </a>
                                    </li>
                                @endif
                            @endif

                            @if(env('WALLET_ACTIVE') == "YES")
                                {{-- Forum manager --}}
                                @if(Auth::user()->user_type === "Admin")
                                    <li class="{{request()->is('dashboard/wallet*') ? 'active' : null}}">
                                        <a href="javaScript:void();">
                                            <i class="fa fa-question-circle"></i>
                                            <span>@translate(Wallet Settings)</span>
                                            <i class="feather icon-chevron-right"></i>
                                        </a>
                                        <ul class="vertical-submenu">
                                            <li>
                                                <a href="{{route('dashboard.wallet')}}"
                                                   class="{{request()->is('dashboard/wallet') ?'active':null}}">
                                                   @translate(Wallet Options)
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endif


                            @if(env('THEME_MANAGER') == "YES")
                                @if(Auth::user()->user_type === "Admin")
                                    {{-- THEME manager --}}
                                    <li><a href="{{route('theme.manager.index')}}"
                                           class="{{request()->is('dashboard/theme*') ?'active':null}}">
                                            <i class="fa  fa-pie-chart"></i> <span>@translate(Theme Manager)</span>
                                        </a>
                                    </li>
                                @endif
                            @endif


                            {{-- Activity Log Manager --}}
                            @if(Auth::user()->user_type === "Admin" || Auth::user()->user_type === "Instructor")
                                <li class="{{request()->is('dashboard/forum*') ? 'active' : null}}">
                                    <a href="javaScript:void();">
                                        <i class="fa fa-bus"></i>
                                        <span>@translate(Activity Log Manager)</span>
                                        <i class="feather icon-chevron-right"></i>
                                    </a>
                                    <ul class="vertical-submenu">
                                        <li><a href="{{ url('/activity') }}"
                                               class="{{request()->is('/activity*') ?'active':null}}">@translate(Logs)</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif


                        </ul>
                    </div>

                </div>

            </div>
        </div>
        <!-- End Navigation bar -->
    </div>
    <!-- End Sidebar -->
</div>
