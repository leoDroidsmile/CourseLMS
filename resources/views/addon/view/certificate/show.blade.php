<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Rumon Prince Sohan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright"content="{{ env('APP_NAME') }}">
    <meta name="subject" content="{{ env('APP_NAME') }} {{ env('APP_VERSION') }}">
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">
    <title>{{getSystemSetting('type_name')->value}}</title>
    <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}">
    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}">
    <link href="{{ asset('css/font.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/tooltipster.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link href="{{ asset('css/frontend.css') }}">
    <!-- end inject -->
</head>

<body>



<div class="container">
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-body text-center {{$demo->valid == true ? 'text-success-gradient' : 'text-danger-gradient'}} ">{{$demo->message}}</h3>
                </div>
                @if($demo->valid == true)
                <div class="card-body">
                    <img src="{{filePath($demo->image)}}" class="img-fluid m-4">
                </div>
                @else
                    <div class="card-body">
                        <img src="{{filePath('uploads/notfound.png')}}" class="img-fluid m-4">
                    </div>
                @endif

                @if($demo->valid == true)
                    <div class="text-center">
                        <a class="btn btn-outline-success w-25 m-5" href="{{route('image.download',$demo->id)}}">@translate(Download Certificate)</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>


@yield('content')









<!-- template js files -->
<script src="{{ asset('frontend/js/jquery.js') }}"></script>
<script src="{{ asset('frontend/js/popper.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/js/magnific-popup.js') }}"></script>
<script src="{{ asset('frontend/js/isotope.js') }}"></script>
<script src="{{ asset('frontend/js/waypoint.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.js') }}"></script>
<script src="{{ asset('frontend/js/particles.js') }}"></script>
<script src="{{ asset('frontend/js/particlesRun.js') }}"></script>
<script src="{{ asset('frontend/js/fancybox.js') }}"></script>
<script src="{{ asset('frontend/js/wow.js') }}"></script>
<script src="{{ asset('frontend/js/date-time-picker.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.filer.js') }}"></script>
<script src="{{ asset('frontend/js/emojionearea.js') }}"></script>
<script src="{{ asset('frontend/js/smooth-scrolling.js') }}"></script>
<script src="{{ asset('frontend/js/tooltipster.bundle.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<script src="{{ asset('js/frontend.js') }}"></script>
<script src="{{ asset('js/notify.js') }}"></script>


</body>

</html>

