@extends('rumbok.course.lesson.app')
@section('content')


    <!-- Header Section Starts -->
    <header class="header-section-backend">
        <!-- main Header Starts -->
        <div class="main-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="header-left">
                            <div class="header-logo">
                                <a href="{{route('homepage')}}">
                                    <img src="{{ filePath(getSystemSetting('footer_logo')->value) }}" alt="logo"></a>
                            </div>
                            <div class="header-title">
                                <h5>{{ $s_course->title }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="header-backend-buttons">
                            <a href="{{ route('course.single',$s_course->slug) }}" class="template-button">@translate(Go to course details)</a>
                            <a href="#" class="template-button-2 d-none">share</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Course Video Section Starts -->
    <section class="course-video-section padding-bottom-110">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-0 order-2 order-lg-1">
                    <div class="course-video-part" id="videoId">
                        @if (isset($s_course->overview_url))
                            @if ($s_course->provider === "Youtube")
                                <iframe width="100%" height="600"
                                        src="https://www.youtube.com/embed/{{ Str::after($s_course->overview_url,'https://youtu.be/') }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>

                            @elseif($s_course->provider === "Vimeo")
                                <iframe width="100%" height="600"
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

                    <div class="course-video-tab padding-top-60">
                        <div class="tab">
                            <ul>
                                <li class="tab-one active">
                                    <span>@translate(overview)</span>
                                </li>
                                <li class="tab-two">
                                    <span>@translate(Comment)</span>
                                </li>
                                <li class="tab-three"  onclick="forModal('{{route('message.create',$s_course->id)}}','{{ $s_course->relationBetweenInstructorUser->name }}')">
                                    <span>@translate(Send message)</span>
                                </li>
                                @if(env('CERTIFICATE_ACTIVE') === 'YES')
                                    <li class="tab-four">
                                        <span>@translate(Get Certificate)</span>
                                    </li>
                                @endif
                            </ul>
                            <div class="hr-line"></div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-one-content tab-content-bg overview-content lost active">
                                <div class="video-tab-title">
                                    <h5>@translate(about this course)</h5>
                                </div>
                                <p class="margin-top-20">{!! $s_course->short_description !!}</p>

                                <div class="video-tab-title margin-top-30">
                                    <h5>@translate(by the numbers)</h5>
                                </div>
                                <div class="content-list-items margin-top-20">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> @translate(skill level) : {{ $s_course->level }}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> @translate(lecture) : {{ $s_course->classes->count() }}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> @translate(student) : {{\App\Model\Enrollment::where('course_id',$s_course->id)->count()}}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i> @translate(video length) :
                                                @php
                                                    $total_duration = 0;
                                                    foreach ($s_course->classes as $item){
                                                        $total_duration +=$item->contents->sum('duration');
                                                    }
                                                @endphp
                                                {{duration($total_duration)}}</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <span class="single-list"><i class="fa fa-check"></i>@translate(language) : {{ $s_course->language }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if(env('CERTIFICATE_ACTIVE') == 'YES')
                                    <div class="video-tab-title margin-top-30">
                                        <h5>@translate(certificate)</h5>
                                    </div>
                                    <p class="margin-top-20">@translate(Get Course certificate by completing entire course)</p>
                                @endif
                                <div class="video-tab-title margin-top-30">
                                    <h5>@translate(description)</h5>
                                </div>
                                <p class="margin-top-20"> {!! $s_course->big_description !!} </p>
                            </div>

                            <div class="tab-two-content tab-content-bg q-a-content lost">
                                <div class="header-search">
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
                                <div class="video-tab-title margin-top-30">
                                    <h5>@translate(All Comments)</h5>
                                </div>
                                <div class="hr-line"></div>
                                <div id="comments">
                                    <div class="single-question">
                                        <div class="question-image">
                                            <img src="assets/images/question-image.png" alt="image">
                                        </div>
                                        <div class="question-content">
                                            <h6>how to install wordpress in cpanel?</h6>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.!</p>
                                            <div class="content-bottom">
                                                <h6>john doe</h6>
                                                <span>5 min ago</span>
                                                <span><a href="#"><i class="fa fa-comments"></i> 10 comments</a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-three-content tab-content-bg note-content lost d-none">
                                <div class="header-search">
                                    <form action="#">
                                        <input type="text" placeholder="Create New Note">
                                        <button type="submit"><i class="fa fa-plus"></i></button>
                                    </form>
                                </div>
                                <span>Click the "Create a new note" box, the "+" button, or press "N" to make your first note.</span>
                            </div>

                            @if(env('CERTIFICATE_ACTIVE') === 'YES')
                                <div class="tab-four-content tab-content-bg announcement-content lost">
                                    <div class="mobile-course-content-wrap">
                                        <div class="mobile-course-menu">
                                            <div class="course-dashboard-side-content">
                                                <div class="accordion course-item-list-accordion"
                                                     id="mobileCourseMenu">

                                                    <div class="container p-5">
                                                        <div class="progress"
                                                             data-percentage="{{\App\Http\Controllers\FrontendController::seenCourse($enroll->first()->id,$s_course->id)}}">
            <span class="progress-left">
                <span class="progress-bar"></span>
            </span>
                                                            <span class="progress-right">
                <span class="progress-bar"></span>
            </span>
                                                            <div class="progress-value">
                                                                <div>
                                                                    {{\App\Http\Controllers\FrontendController::seenCourse($enroll->first()->id,$s_course->id)}}
                                                                    %<br>
                                                                    <span>@translate(completed)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
                                                        @if(\App\Http\Controllers\FrontendController::seenCourse($enroll->first()->id,$s_course->id) == number_format(100))
                                                            <a href="{{route('certificate.get',$s_course->id)}}"
                                                               target="_blank" class="btn btn-success">
                                                                @translate(generate Certificate)</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 p-0 order-1 order-lg-2">
                    <div class="video-playlist-sidebar">
                        <h4>{{$s_course->title}}</h4>
                        <div class="curriculum-accordion margin-top-30">
                            <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                <input value="{{route('seen.list',$s_course->id)}}" type="hidden" id="seenList">
                                @foreach ($s_course->classes as $item)
                                    <div class="card">
                                        <div class="card-header" id="heading-{{ $item->id }}">
                                            <a href="#" role="button" data-toggle="collapse"
                                               data-target="#collapse-{{ $item->id }}"
                                               aria-expanded="true"
                                               aria-controls="collapse-{{ $item->id }}">{{ $item->title }}</a>
                                        </div>

                                        <div id="collapse-{{ $item->id }}"
                                             class="collapse {{ $loop->first ? 'show' : '' }}"
                                             aria-labelledby="heading-{{ $item->id }}" data-parent="#accordionExample">
                                            <div class="card-body">
                                                @forelse ($item->contents as $content)
                                                        <div class="single-course-video" onclick="contentData('{{$content->id}}')">
                                                            <div class="custom-checkbox">
                                                                <div class="custom-checkbox">
                                                                    <label for="chb-{{$content->id}}">
                                                                    <input type="checkbox"
                                                                           data-url="{{route('seen.remove', $content->id)}}"
                                                                           id="chb-{{$content->id}}">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <input type="hidden"
                                                                   id="contentVideoUrl-{{$content->id}}"
                                                                   value="{{route('class.content',$content->id)}}">
                                                            <a href="#" class="button-video">
                                                                <i class="fa fa-play-circle"></i> {{ $content->title }}
                                                            </a>
                                                            <span>{{duration($content->duration)}}</span>

                                                            @if($content->source_code != null)
                                                                <div class="msg-action-dot">
                                                                        <a class="resource-btn theme-btn-light"
                                                                           href="{{filePath($content->source_code)}}"
                                                                           target="_blank">

                                                                            <i class="fa fa-folder-open mr-1"></i>
                                                                            @translate(Resources)<i
                                                                                class="fa fa-download ml-1"></i>
                                                                        </a>
                                                                </div>
                                                            @endif
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
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


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
                        document.getElementById("comments").innerHTML += '<div class="single-question">\n' +
                            '                                        <div class="question-image">\n' +
                            '                                            <img src="' + item.image + '" alt="image">\n' +
                            '                                        </div>\n' +
                            '                                        <div class="question-content">\n' +
                            '                                            <p>' + item.comment + '</p>\n' +
                            '                                            <div class="content-bottom">\n' +
                            '                                                <h6 class="text-left">' + item.name + '</h6>\n' +
                            '                                                <span class="text-right">' + item.time + '</span>\n' +
                            '                                            </div>\n' +
                            '                                        </div>\n' +
                            '                                    </div>';
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
            $('#videoId').append('  <iframe  width="100%" height="600"' +
                '                                        src="' + url + '"\n' +
                '                                        frameborder="0"\n' +
                '                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"\n' +
                '                                        allowfullscreen></iframe>');
        }

        /*for youtube*/
        function playYoutube(data) {
            $('#videoId').append('  <iframe width="100%" height="600"' +
                '                                        src="https://www.youtube.com/embed/' + data + '"\n' +
                '                                        frameborder="0"\n' +
                '                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"\n' +
                '                                        allowfullscreen></iframe>');
        }

        /*for vimeo video*/
        function playVimeo(data) {
            $('#videoId').append(' <iframe width="100%" height="600"' +
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

