@extends('frontend.course.lesson.app')
@section('content')
    <!--======================================
          START HEADER AREA
      ======================================-->
    <section class="header-menu-area course-dashboard-header">
        <div class="header-menu-fluid">
            <div class="header-menu-content course-dashboard-menu-content">
                <div class="container-fluid">
                    <div class="main-menu-content d-flex align-items-center">
                        <div class="logo-box">
                            <a href="{{ route('homepage') }}" class="logo"
                               title="{{ getSystemSetting('type_name')->value }}">
                                <img
                                    src="{{ filePath(getSystemSetting('footer_logo')->value) }}"
                                    alt="{{ getSystemSetting('type_name')->value }}" class="w-75"></a>
                        </div>
                        <div class="course-dashboard-title">
                            <a href="{{ route('course.single',$s_course->slug) }}">{{ $s_course->title }}</a>
                        </div>
                        <div class="menu-wrapper">
                            <div class="logo-right-button">
                                <ul class="d-flex align-items-center">
                                    <li><a href="{{ route('course.single',$s_course->slug) }}"
                                           class="theme-btn theme-btn-light"><i class="la la-star mr-1"></i>@translate(Go to course details)</a></li>
                                </ul>
                            </div><!-- end logo-right-button -->
                        </div><!-- end menu-wrapper -->
                    </div><!-- end row -->
                </div><!-- end container-fluid -->
            </div><!-- end header-menu-content -->
        </div><!-- end header-menu-fluid -->
    </section><!-- end header-menu-area -->
    <!--======================================
            END HEADER AREA
    ======================================-->

    <!--======================================
            START COURSE-DASHBOARD
    ======================================-->
    <section class="course-dashboard">
        <div class="course-dashboard-wrap">
            <div class="course-dashboard-container d-flex">
                <div class="course-dashboard-column">
                    <div class="lecture-viewer-container">
                        <div class="lecture-video-item" id="videoId">

                            @if (isset($s_course->overview_url))
                                @if ($s_course->provider === "Youtube")
                                    <iframe
                                        src="https://www.youtube.com/embed/{{ Str::after($s_course->overview_url,'https://youtu.be/') }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>

                                @elseif($s_course->provider === "Vimeo")
                                    <iframe
                                        src="https://player.vimeo.com/video/{{ Str::after($s_course->overview_url,'https://vimeo.com/') }}"
                                        frameborder="0" allow="autoplay; fullscreen"
                                        allowfullscreen></iframe>
                                @elseif($s_course->provider === "HTML5")
                                    <video controls crossorigin playsinline id="player">
                                        <source src="{{$s_course->overview_url}}"
                                                type="video/mp4" size="100%"/>
                                    </video>

                                @else
                                    <div class="">
                                        <h1>@translate(No video found)</h1>
                                    </div>
                                @endif

                            @endif
                        </div>

                    </div><!-- end lecture-viewer-container -->
                    <div class="lecture-video-detail">
                        <div class="lecture-tab-body">
                            <div class="section-tab section-tab-2">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="mobile-course-tab">
                                        <a href="#course-content" role="tab" data-toggle="tab" aria-selected="true">
                                            @translate(Course Content)
                                        </a>
                                    </li>
                                    <li role="presentation" class="pl-5">
                                        <a href="#overview" role="tab" data-toggle="tab" class="active"
                                           aria-selected="true">
                                            @translate(Overview)
                                        </a>
                                    </li>
                                    <li role="presentation" class="pl-5">
                                        <a href="#content-details" role="tab" data-toggle="tab" aria-selected="false"
                                           aria-selected="true">
                                            @translate(Content Overview)
                                        </a>
                                    </li>

                                    <li role="presentation" class="pl-5">
                                        <a href="#quest-and-ans" role="tab" data-toggle="tab" aria-selected="false">
                                            @translate(Comments)
                                        </a>
                                    </li>
                                    <li class="pl-5">
                                        <button
                                            onclick="forModal('{{route('message.create',$s_course->id)}}','{{ $s_course->relationBetweenInstructorUser->name }}')"
                                            class="btn btn-success text-white">
                                            @translate(Send message)
                                        </button>
                                    </li>
                                    @if(env('CERTIFICATE_ACTIVE') === 'YES')
                                        <li role="presentation" class="pl-5">
                                            <a href="#certificate" role="tab" data-toggle="tab" aria-selected="false">
                                                @translate(Get Certificate)
                                            </a>
                                        </li>
                                    @endif


                                    @if(env('WALLET_ACTIVE') === 'YES')

                                        @if (checkRedeem($s_course->id))

                                            @if(\App\Http\Controllers\FrontendController::seenCourse($enroll->first()->id,$s_course->id) == number_format(100))
                                                <li class="pl-5">
                                                    <a href="{{ route('course.redeem.point', $s_course->id) }}">
                                                        @translate(Redeem Points)
                                                    </a>
                                                </li>
                                            @else
                                                <li class="pl-5">
                                                    @translate(Point Redeemed)
                                                </li>
                                            @endif

                                        @else
                                            <li class="pl-5">
                                                @translate(Complete this to redeem point)
                                            </li>

                                        @endif
                                        
                                    @endif


                                </ul>
                            </div>
                        </div>
                        <div class="lecture-video-detail-body">
                            <div class="tab-content">
                                {{-- course-content --}}
                                <div role="tabpanel" class="tab-pane fade" id="course-content">
                                    <div class="mobile-course-content-wrap">
                                        <div class="mobile-course-menu">
                                            <div class="course-dashboard-side-content">
                                                <div class="accordion course-item-list-accordion" id="mobileCourseMenu">

                                                    @foreach ($s_course->classes as $item)
                                                        <div class="card">
                                                            <div class="card-header" id="collapseMenu-{{ $item->id }}">
                                                                <h2 class="mb-0">
                                                                    <button class="btn btn-link" type="button"
                                                                            data-toggle="collapse"
                                                                            data-target="#collapse-{{ $item->id }}"
                                                                            aria-expanded="true"
                                                                            aria-controls="collapse-{{ $item->id }}">
                                                                        <span
                                                                            class="widget-title font-size-15 font-weight-semi-bold">Class {{ $loop->index++ + 1 }}: {{ $item->title }}</span>
                                                                        <div class="course-duration">
                                                                            <div class="course-duration">
                                                                                <span>{{ $item->contents->count() }}</span>
                                                                                <span>
                                                                         {{duration( $item->contents->sum('duration'))}}

                                                                  </span>
                                                                            </div>
                                                                        </div>
                                                                    </button>
                                                                </h2>
                                                            </div>
                                                            <div id="collapse-{{ $item->id }}"
                                                                 class="collapse {{ $loop->first ? 'show' : '' }}"
                                                                 aria-labelledby="collapseMenu-{{ $item->id }}"
                                                                 data-parent="#accordionCourseMenu">
                                                                <div class="card-body">
                                                                    <div class="course-content-list">
                                                                        <ul class="course-list">

                                                                            @forelse ($item->contents as $content)





                                                                                <li class="course-item-link active-resource"
                                                                                    onclick="contentData('{{$content->id}}')">

                                                                                    <input type="hidden"
                                                                                           id="contentVideoUrl-{{$content->id}}"
                                                                                           value="{{route('class.content',$content->id)}}">
                                                                                    <div
                                                                                        class="course-item-content-wrap">
                                                                                        <div class="custom-checkbox">
                                                                                            <i class="la la-book"></i>
                                                                                        </div>

                                                                                        <div
                                                                                            class="course-item-content">
                                                                                            <h4 class="widget-title font-size-15 font-weight-medium">

                                                                                                {{ $loop->index++ + 1 }}
                                                                                                . {{ $content->title }}
                                                                                            </h4>
                                                                                            <div
                                                                                                class="courser-item-meta-wrap">
                                                                                                <p class="course-item-meta">
                                                                                                    <i class="la la-file"></i>

                                                                                                    {{duration($content->duration) }}

                                                                                                </p>


                                                                                                @if($content->source_code != null)
                                                                                                    <div
                                                                                                        class="msg-action-dot">
                                                                                                        <div
                                                                                                            class="dropdown">
                                                                                                            <a class="theme-btn theme-btn-light"
                                                                                                               href="#!"
                                                                                                               data-toggle="dropdown"
                                                                                                               aria-haspopup="true"
                                                                                                               aria-expanded="false">
                                                                                                                <i class="fa fa-folder-open mr-1"></i>
                                                                                                                Resources<i
                                                                                                                    class="fa fa-angle-down ml-1"></i>
                                                                                                            </a>
                                                                                                            <div
                                                                                                                class="dropdown-menu">
                                                                                                                <a class="dropdown-item"
                                                                                                                   href="{{filePath($content->source_code)}}"
                                                                                                                   target="_blank">
                                                                                                                    source.zip
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif


                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>


                                                                                @endforeach

                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- course-content::END --}}
                                {{-- overview --}}
                                <div role="tabpanel" class="tab-pane fade active show" id="overview">
                                    <div class="lecture-overview-wrap">
                                        <div class="lecture-overview-item">
                                            <div class="lecture-heading">
                                                <h3 class="widget-title pb-2">@translate(About this course)</h3>
                                                <p>
                                                    {!! $s_course->short_description !!}

                                                </p>
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex ">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="widget-title font-size-16">@translate(By the
                                                        numbers)</h3>
                                                </div>
                                                <div class="lecture-overview-stats-item">
                                                    <ul class="list-items">
                                                        <li><span>@translate(Skill level):</span>{{ $s_course->level }}
                                                        </li>
                                                        <li>
                                                            <span>@translate(Students):</span>{{\App\Model\Enrollment::where('course_id',$s_course->id)->count()}}
                                                        </li>
                                                        <li><span>@translate(Languages):</span>{{ $s_course->language }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="lecture-overview-stats-item">
                                                    <ul class="list-items">
                                                        <li>
                                                            <span>@translate(Lectures):</span>{{ $s_course->classes->count() }}
                                                        </li>
                                                        <li><span>@translate(Video length):</span>
                                                            @php
                                                                $total_duration = 0;
                                                                foreach ($s_course->classes as $item){
                                                                    $total_duration +=$item->contents->sum('duration');
                                                                }

                                                            @endphp
                                                            {{duration($total_duration)}}

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>

                                        <div class="section-block"></div>

                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="widget-title font-size-16">@translate(Description)</h3>
                                                </div>
                                                <div
                                                    class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                                    <div class="lecture-description show-more-content">
                                                        <p>
                                                            {!! $s_course->big_description !!}

                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                        <div class="section-block"></div>
                                        <div class="lecture-overview-item">
                                            <div class="lecture-overview-stats-wrap d-flex ">
                                                <div class="lecture-overview-stats-item">
                                                    <h3 class="widget-title font-size-16">@translate(Instructor)</h3>
                                                </div>
                                                <div
                                                    class="lecture-overview-stats-item lecture-overview-stats-wide-item">
                                                    <div class="lecture-owner-wrap d-flex align-items-center">
                                                        <div class="lecture-owner-avatar">
                                                            <img
                                                                src="{{ filePath($s_course->relationBetweenInstructorUser->relationBetweenInstructor->image) }}"
                                                                alt="">
                                                        </div>
                                                        <div class="lecture-owner-title-wrap">
                                                            <h3 class="widget-title pb-1 font-size-18"><a
                                                                    href="{{route('single.instructor',$s_course->relationBetweenInstructorUser->slug)}}"
                                                                    class="primary-color">{{ $s_course->relationBetweenInstructorUser->name }}</a>
                                                            </h3>

                                                        </div>
                                                    </div>
                                                    <div class="lecture-owner-profile pt-4">
                                                        <ul class="social-profile">
                                                            <li>
                                                                <a target="_blank"
                                                                   href="{{ $s_course->relationBetweenInstructorUser->relationBetweenInstructor->fb }}"><i
                                                                        class="fa fa-facebook"></i></a></li>
                                                            <li>
                                                                <a target="_blank"
                                                                   href="{{ $s_course->relationBetweenInstructorUser->relationBetweenInstructor->tw }}"><i
                                                                        class="fa fa-twitter"></i></a></li>
                                                            <li>
                                                                <a target="_blank"
                                                                   href="{{ $s_course->relationBetweenInstructorUser->relationBetweenInstructor->skype }}"><i
                                                                        class="fa fa-skype"></i></a></li>
                                                            <li>
                                                                <a target="_blank"
                                                                   href="{{ $s_course->relationBetweenInstructorUser->relationBetweenInstructor->linked }}"><i
                                                                        class="fa fa-linkedin"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="lecture-owner-decription pt-4">
                                                        {!! $s_course->relationBetweenInstructorUser->relationBetweenInstructor->about !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                    </div><!-- end lecture-overview-wrap -->
                                </div><!-- end tab-pane -->
                                {{-- overview::END --}}
                                {{-- question and answer --}}
                                <div role="tabpanel" class="tab-pane fade" id="quest-and-ans">
                                    <div class="lecture-overview-wrap lecture-announcement-wrap">
                                        <div class="lecture-overview-item">
                                            <div class="question-list-container">
                                                <div class="question-list-item">
                                                    <ul class="comments-list" id="comments"></ul>
                                                </div>

                                            </div>
                                            <div class="lecture-overview-stats-wrap">
                                                <div class="lecture-overview-stats-item">
                                                    <div
                                                        class="lecture-announcement-form d-flex align-items-center pt-4">
                                                        <div class="lecture-owner-avatar">
                                                            <img
                                                                src="{{ \Illuminate\Support\Facades\Auth::user()->image == null ? asset('uploads/user/user.png') : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}">
                                                        </div>
                                                        <div class="contact-form-action">
                                                            <form id="comment_form">
                                                                <input type="hidden" value="{{route('comments')}}"
                                                                       id="commentSaveUrl">
                                                                <input type="hidden" value="{{$s_course->id}}"
                                                                       id="course_id">
                                                                <div class="form-group mb-0">
                                                                    <input class="form-control" required type="text"
                                                                           name="comment" id="comment"
                                                                           placeholder="Enter your comment">
                                                                    <button class="submit-btn" type="submit"
                                                                            id="comment_submit"><i
                                                                            class="la la-arrow-right"></i></button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                    </div>
                                </div><!-- end tab-pane -->
                                {{-- question and answer::END --}}
                                {{--CONTENT DETAILS--}}
                                <div role="tabpanel" class="tab-pane fade " id="content-details">
                                    <div class="lecture-overview-wrap">
                                        <div class="lecture-overview-item">
                                            <div class="lecture-heading">
                                                <h3 class="widget-title pb-2">@translate(About this Content)</h3>
                                                <p class="course-content">
                                                    {{--here show the content details--}}

                                                </p>
                                            </div>
                                        </div><!-- end lecture-overview-item -->
                                        <!-- end lecture-overview-item -->
                                    </div><!-- end lecture-overview-wrap -->
                                </div>
                                {{--CONTENT DETAILS--}}


                                {{--Certificate --}}
                                @if(env('CERTIFICATE_ACTIVE') === 'YES')
                                    <div role="tabpanel" class="tab-pane fade" id="certificate">
                                        <div class="mobile-course-content-wrap">
                                            <div class="mobile-course-menu">
                                                <div class="course-dashboard-side-content">
                                                    <div class="accordion course-item-list-accordion"
                                                         id="mobileCourseMenu">

                                                        <div class="container p-5">
                                                            <div class="progress" data-percentage="{{\App\Http\Controllers\FrontendController::seenCourse($enroll->first()->id,$s_course->id)}}">
            <span class="progress-left">
                <span class="progress-bar"></span>
            </span>
                                                                    <span class="progress-right">
                <span class="progress-bar"></span>
            </span>
                                                                <div class="progress-value">
                                                                    <div>
                                                                        {{\App\Http\Controllers\FrontendController::seenCourse($enroll->first()->id, $s_course->id)}}%<br>
                                                                        <span>completed</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-center">
                                                        @if(\App\Http\Controllers\FrontendController::seenCourse($enroll->first()->id,$s_course->id) == number_format(100))
                                                        <a href="{{route('certificate.get',$s_course->id)}}" target="_blank" class="btn btn-success"> @translate(Generate Certificate)</a>
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div><!-- end lecture-video-detail-body -->
                    </div><!-- end lecture-video-detail -->
                    <div class="section-block"></div>
                    <div class="footer-area section-bg padding-top-40px padding-bottom-40px">
                        <div class="container-fluid">
                            <div class="copyright-content copyright-content-2">
                                <div class="row align-items-center">
                                    <div class="col-lg-4 column-lmd-half column-td-full">
                                        <div class="copyright-content-inner">
                                            <a href="{{route('homepage')}}">
                                                <img src="{{ filePath(getSystemSetting('type_logo')->value) }}"
                                                     alt="{{ getSystemSetting('type_name')->value }}"
                                                     class="footer__logo w-75">
                                            </a>
                                            <p class="copy__desc">@translate(Copyright)
                                                &copy; {{date('Y')}} {{ getSystemSetting('type_footer')->value }}</p>
                                        </div>
                                    </div><!-- end col-lg-4 -->
                                    <div class="col-lg-6 column-lmd-half column-td-full">
                                        <ul class="list-items">
                                            @foreach(\App\Page::where('active',1)->get() as $item)
                                                <li>
                                                    <a href="{{route('pages',$item->id)}}">{{\Illuminate\Support\Str::ucfirst($item->title)}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div><!-- end row -->
                            </div><!-- end copyright-content -->
                        </div><!-- end container-fluid -->
                    </div><!-- end footer-area -->
                </div><!-- end course-dashboard-column -->


                <div class="course-dashboard-sidebar-column">
                    <button class="sidebar-open" type="button"><i class="la la-angle-left"></i> @translate(Course
                        content)
                    </button>
                    <div class="course-dashboard-sidebar-wrap">
                        <div class="course-dashboard-side-heading d-flex align-items-center justify-content-between">
                            <h3 class="widget-title font-size-20">@translate(Course content)</h3>
                            <button class="sidebar-close" type="button"><i class="la la-times"></i></button>
                        </div><!-- end course-dashboard-side-heading -->
                        <div class="course-dashboard-side-content">
                            <div class="accordion course-item-list-accordion" id="accordionCourseMenu">
                                <input value="{{route('seen.list',$s_course->id)}}" type="hidden" id="seenList">
                                @foreach ($s_course->classes as $item)
                                    <div class="card">
                                        <div class="card-header" id="collapseMenu-{{ $item->id }}">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#collapse-{{ $item->id }}" aria-expanded="true"
                                                        aria-controls="collapse-{{ $item->id }}">
                                                    <span class="widget-title font-size-15 font-weight-semi-bold">@translate(Class) {{ $loop->index++ + 1 }}: {{ $item->title }}</span>
                                                    <div class="course-duration">
                                                        <div class="course-duration">
                                                            <span>{{ $item->contents->count() }}</span>
                                                            <span>
                                                       {{duration( $item->contents->sum('duration'))}}

                                                </span>
                                                        </div>
                                                    </div>
                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapse-{{ $item->id }}"
                                             class="collapse {{ $loop->first ? 'show' : '' }}"
                                             aria-labelledby="collapseMenu-{{ $item->id }}"
                                             data-parent="#accordionCourseMenu">
                                            <div class="card-body">
                                                <div class="course-content-list">
                                                    <ul class="course-list">
                                                        @forelse ($item->contents as $content)
                                                            <li class="course-item-link active-resource">
                                                                <div class="course-item-content-wrap">
                                                                    <div class="custom-checkbox">
                                                                        <div class="custom-checkbox">
                                                                            <input type="checkbox"
                                                                                   data-url="{{route('seen.remove', $content->id)}}"
                                                                                   id="chb-{{$content->id}}">
                                                                            <label for="chb-{{$content->id}}"></label>
                                                                        </div>
                                                                    </div>


                                                                    <div class="course-item-content"
                                                                         onclick="contentData('{{$content->id}}')">
                                                                        <input type="hidden"
                                                                               id="contentVideoUrl-{{$content->id}}"
                                                                               value="{{route('class.content',$content->id)}}">
                                                                        <h4 class="widget-title font-size-15 font-weight-medium">

                                                                            {{ $loop->index++ + 1 }}
                                                                            . {{ $content->title }}</h4>
                                                                        <div class="courser-item-meta-wrap">
                                                                            <p class="course-item-meta"><i
                                                                                    class="la la-file"></i>
                                                                                {{duration($content->duration)}}
                                                                            </p>


                                                                            @if($content->source_code != null)
                                                                                <div class="msg-action-dot">
                                                                                    <div class="dropdown">
                                                                                        <a class="theme-btn theme-btn-light"
                                                                                           href="#"
                                                                                           data-toggle="dropdown"
                                                                                           aria-haspopup="true"
                                                                                           aria-expanded="false">
                                                                                            <i class="fa fa-folder-open mr-1"></i>
                                                                                            @translate(Resources)<i
                                                                                                class="fa fa-angle-down ml-1"></i>
                                                                                        </a>
                                                                                        <div class="dropdown-menu">
                                                                                            <a class="dropdown-item"
                                                                                               href="{{filePath($content->source_code)}}"
                                                                                               target="_blank">
                                                                                                source.zip
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        @if (zoomActive())
                                                                            <div class="">
                                                                                @if($content->meeting != null)
                                                                                    <p class="course-item-meta">
                                                                                        <i class="la la-video-camera"></i>
                                                                                        @translate(Meeting Id)
                                                                                        - {{$content->meeting->meeting_id}}
                                                                                    </p>
                                                                                    <p class="course-item-meta">
                                                                                        <i class="la la-calendar-check-o"></i>
                                                                                        @translate(Start Time)
                                                                                        - {{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s')}}
                                                                                    </p>
                                                                                    @if($content->meeting->duration != null)
                                                                                        <p class="course-item-meta">
                                                                                            <i class="la la-calendar-check-o"></i>
                                                                                            @translate(Duration)
                                                                                            - {{ $content->meeting->duration }}
                                                                                            min
                                                                                        </p>
                                                                                    @endif
                                                                                    <p id="demo-{{ $content->meeting->meeting_id }}"></p>
                                                                                    <a href="javascript:void(0)"
                                                                                       class="countDown d-none"
                                                                                       onclick="myFunction('{{ \Carbon\Carbon::parse($content->meeting->start_time)->format('M d, Y G:i:s') }}','demo-{{ $content->meeting->meeting_id }}')">HUH</a>
                                                                                @endif
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div><!-- end course-dashboard-sidebar-column -->
            </div><!-- end course-dashboard-container -->
        </div><!-- end course-dashboard-wrap -->
    </section><!-- end course-dashboard -->
    <!--======================================
            END COURSE-DASHBOARD
    ======================================-->

@endsection

@section('js')
    <script type="text/javascript">
        "use strict"
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            commenting();
            seenContend();
            // console.clear();

        });

        $('#comment_form').on('submit', function (e) {
            e.preventDefault();
            commenting();

        });


        //published the all checkbox
        $('input[type="checkbox"]').change(function () {
            var url = this.dataset.url;
            if (url != null) {
                $.ajax({
                    url: url,
                    method: 'get',
                    success: function (result) {
                        console.log(result);
                    },
                });
            }

        });


        /*for commenting*/
        function commenting() {
            var comment = $('#comment').val();
            var url = $('#commentSaveUrl').val();
            var course_id = $('#course_id').val();

            $.ajax({
                url: url,
                method: 'POST',
                data: {course_id: course_id, comment: comment},
                success: function (result) {
                    $('#comments').empty();
                    result.data.forEach(function (item, index) {

                        document.getElementById("comments").innerHTML += '<li>\n' +
                            '                                                            <div class="comment">\n' +
                            '                                                                <div class="comment-avatar">\n' +
                            '                                                                    <img class="avatar__img" alt="" src="' + item.image + '">\n' +
                            '                                                                </div>\n' +
                            '                                                                <div class="comment-body">\n' +
                            '                                                                    <div class="meta-data d-flex align-items-center justify-content-between">\n' +
                            '                                                                        <div class="question-meta-content">\n' +
                            '                                                                            <a href="javascript:void(0)">\n' +
                            '                                                                                <h3 class="comment__author">' + item.name + '</h3>\n' +
                            '                                                                                <p class="comment-content">' + item.comment + '</p>\n' +
                            '                                                                            </a>\n' +
                            '                                                                        </div>\n' +
                            '                                                                    </div>\n' +
                            '                                                                    <p class="comment__meta">\n' +
                            '                                                                        <span>' + item.time + '</span>\n' +
                            '                                                                    </p>\n' +
                            '                                                                </div>\n' +
                            '                                                            </div>\n' +
                            '                                                        </li>';
                    })
                }
            })
            $('#comment').val('');
        }

        /**/

        /*get content data*/
        function contentData(id) {
            var url = $('#contentVideoUrl-' + id).val();
            $.ajax({
                url: url,
                method: 'GET',
                success: function (result) {
                    console.log(result);
                    $('#videoId').empty();
                    $('.course-content').empty();
                    if (result.provider == "Youtube") {
                        playYoutube(result.url)
                    } else if (result.provider == "Vimeo") {
                        playVimeo(result.url)
                    } else if (result.provider == "HTML5") {
                        playHtml(result.url)
                    } else if (result.provider == "File") {
                        playFile(result.url)
                    } else if (result.provider == "Live") {
                        liveClass(result.url)
                    } else if (result.provider == "Quiz") {
                        quizView(result.url)
                    } else {
                        playDoc(result.url, result.item1, result.item2, result.description)
                    }
                    $('.course-content').append(result.description);
                    seenContend();
                }
            });
        }

        /*quiz*/
        function quizView(url) {
            $('#videoId').append('  <iframe  ' +
                '                                        src="' + url + '"\n' +
                '                                        frameborder="0"\n' +
                '                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"\n' +
                '                                        allowfullscreen></iframe>');
        }

        /*for youtube*/
        function playYoutube(data) {
            $('#videoId').append('  <iframe' +
                '                                        src="https://www.youtube.com/embed/' + data + '"\n' +
                '                                        frameborder="0"\n' +
                '                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"\n' +
                '                                        allowfullscreen></iframe>');
        }

        /*for vimeo video*/
        function playVimeo(data) {
            $('#videoId').append(' <iframe\n' +
                '            src="https://player.vimeo.com/video/' + data + '"\n' +
                '             frameborder="0" allow="autoplay; fullscreen"\n' +
                '            allowfullscreen></iframe>');
        }

        /*for Html5 video*/
        function playHtml(data) {
            $('#videoId').append(' <video controls crossorigin playsinline id="player" class="html-video-frame" src="' + data + '"></video>');
        }

        /*for Html5 video*/
        function playFile(data) {
            $('#videoId').append(' <video controls crossorigin playsinline id="player" class="html-video-frame" src="' + data + '"></video>');
        }

        /*for Live Class video*/
        function liveClass(data) {
            $('#videoId').append('<a href="' + data + '" target="_blank" class="float-play-icon" title="Live Class URL"><img src="{{ filePath('live.jpg') }}" class="w-100" alt="#Liveclass"><span class="as-play-icon"><i class="fa fa-video-camera m-auto" aria-hidden="true"></i></span></a>');
        }

        /*fot document*/
        function playDoc(data, item1, item2, description) {

            $('#videoId').append('<div class="card text-center document-height w-100">\n' +
                '  <div class="card-header">' + item1 + '  </div>\n' +
                '  <div class="card-body">\n' +
                '  <p class="card-body">' + description + '</p>\n' +
                '    <a href="' + data + '" class="btn btn-success btn-lg fa fa-download" target="_blank">  ' + item2 + '</a>\n' +
                '  </p>\n' +
                '</div>');
        }

        /*seen content checked*/
        function seenContend() {
            var url = $('#seenList').val();
            if (url != null) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function (result) {
                        result.forEach(function (item, index) {
                            $("#chb-" + item.content_id).prop("checked", true);
                        })
                    }
                })
            }
        }

        $(window).on('load', function () {
            $('.countDown').click();
        });


        function myFunction(expire_date, id) {

            var expire_date = expire_date;
            // Set the date we're counting down to
            var countDownDate = new Date(expire_date).getTime();

            // Update the count down every 1 second
            var x = setInterval(function () {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById(id).innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(id).innerHTML = "EXPIRED";
                }
            }, 1000);
        }
    </script>

@endsection

