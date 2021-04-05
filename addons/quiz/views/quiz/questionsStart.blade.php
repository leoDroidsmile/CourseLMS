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
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link href="{{ asset('css/frontend.css') }}">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/quiz.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/flipclock.css')}}" rel="stylesheet" type="text/css">

</head>

<body>

<!-- start cssload-loader -->
<div class="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card rounded shadow m-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <h4 class="card-title">@translate(Quiz Name): {{$quiz->name}}</h4>

                            <h4>@translate(Questions) : {{$quiz->questions->count()}}</h4>
                            <h4>@translate(Pass Mark) : {{$quiz->pass_mark}}</h4>
                            <h4>@translate(Total Mark) : {{$quiz->questions->sum('grade')}}</h4>

                    </div>
                    <div class="col-8">
                        <div class="countdown-wrapper">
                            <div id="countdown" class="countdown"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="card rounded shadow m-3">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-12 col-md-12">
                        <form id="regForm" method="POST" action="{{route('quiz.submit')}}" class="no-validate">
                            @csrf
                            <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                            <input type="hidden" name="content_id" value="{{$content->id}}">

                            @foreach($quiz->questions as $question)
                                <input type="hidden" name="question[]" value="{{$question->id}}">
                                <div class="tab">
                                    <h2>@translate(Question) {{$loop->index+1}} : {{ $question->question  }}</h2>

                                    <div class="m-auto text-center m-3">
                                        @foreach(json_decode($question->options,true) as $ns)
                                        <input id="radio_{{$ns['index']}}" class="radio isHidden"
                                               name="answer_{{$question->id}}" value="{{$ns['index']}}" type="radio">
                                        <label for="radio_{{$ns['index']}}" class="label shadow {{ $ns['image'] != NULL ? 'h-auto' : '' }} ">
                                            <div class="d-flex h-100">
                                                @if($ns['image'] == null)
                                                    <p class="m-auto text-dark">{{$ns['answer']}}</p>
                                                @else
                                                    <img src="{{filePath($ns['image'])}}" class="w-100">
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                    </div>
                                </div>
                            @endforeach



                            <div class="question">
                                @foreach($quiz->questions as $question)
                                    <span class="step"></span>
                                @endforeach
                            </div>


                             <div class="m-5">
                                <div class="text-center">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">@translate(Previous)</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">@translate(Next)</button>
                                </div>
                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- end scroll top -->

<!-- template js files -->
<script src="{{ asset('frontend/js/jquery.js') }}"></script>
<script src="{{asset('assets/js/flipclock.js')}}"></script>
<script src="{{asset('assets/js/popper.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/modernizr.js')}}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
<!-- Core js -->
<script src="{{asset('assets/js/core.js')}}"></script>
<script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('js/frontend.js') }}"></script>
<script src="{{ asset('js/notify.js') }}"></script>
<!-- Form Step js -->
<script src="{{asset('assets/plugins/jquery-step/jquery.steps.js')}}"></script>
<script src="{{asset('assets/js/custom/custom-form-wizard.js')}}"></script>


@include('layouts.modal')
@include('sweetalert::alert')

<script>
    (function () {
        var countdown, init_countdown, set_countdown;

        countdown = init_countdown = function () {
            countdown = new FlipClock($('.countdown'), {
                clockFace: 'MinuteCounter',
                language: 'en',
                autoStart: false,
                countdown: true,
                showSeconds: true,
                callbacks: {
                    start: function () {
                        /*here start the exam*/
                        return console.log('The clock has started!');
                    },
                    stop: function () {
                        /*here e3nd the exam*/
                        $('#regForm').submit();
                        return console.log('The clock has stopped!');
                    },
                    interval: function () {
                        /*here time is going*/
                        var time;
                        time = this.factory.getTime().time;
                        if (time) {
                            return console.log('Clock interval', time);
                        }
                    }
                }
            });


            return countdown;
        };

        set_countdown = function (minutes, start) {
            var elapsed, end, left_secs, now, seconds;
            if (countdown.running) {
                return;
            }
            seconds = minutes * 60;
            now = new Date();
            start = new Date(start);
            end = start.getTime() + seconds * 1000;
            left_secs = Math.round((end - now.getTime()) / 1000);
            elapsed = false;
            if (left_secs < 0) {
                left_secs *= -1;
                elapsed = true;
            }
            countdown.setTime(left_secs);
            return countdown.start();
        };

        init_countdown();

        set_countdown({{$quiz->quiz_time}}, new Date());

    }).call(this);


</script>

<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
        } else {
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }

    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
</script>

</body>

</html>
