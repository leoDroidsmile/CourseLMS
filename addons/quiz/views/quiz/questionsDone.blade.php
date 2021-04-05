
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Rumon Prince Sohan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/font.css') }}">
    <!-- inject:css -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link href="{{ asset('css/frontend.css') }}">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/flipclock.css')}}" rel="stylesheet" type="text/css">

    <!-- end inject -->
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

<div class="row p-lg-5">
    <div class="col-md-10 offset-1">
        <div class="card rounded shadow">
            <div class="card-body">
                <h4 class="card-title">@translate(Result) : {{$scores->status}}</h4><br>

                    <table class="table">
                        <tbody>
                            <tr>
                                <td>@translate(Your Quiz Score)</td>
                                <td><strong>{{$scores->score}}</strong></td>

                            </tr>
                            <tr>
                                <td>@translate(Wrong Answer)</td>
                                <td><strong>{{$scores->wrong}}</strong></td>

                            </tr>
                            <tr>
                                <td>@translate(Right Answer)</td>
                                <td> <strong>{{$scores->right}}</strong></td>

                            </tr>
                            <tr>
                                <td>@translate(Exam Complete in)</td>
                                <td><strong>{{$scores->minutes}} @translate(min)</strong></td>
                            </tr>
                        </tbody>
                    </table>


                <a class="btn btn-outline-secondary m-lg-5 float-right" href="{{$againQuizStart}}">@translate(Start Again the Quiz)</a>
            </div>
        </div>

    </div>
</div>




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

</body>

</html>
