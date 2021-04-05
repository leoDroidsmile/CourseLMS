<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{getSystemSetting('type_name')->value}}</title>

    <!-- Favicon -->
    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}">

    <!-- inject:css -->
    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}">
    <link href="{{ asset('css/font.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/icofont.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('asset_rumbok/css/style.css')}}">
    <link href="{{ asset('css/frontend.css') }}">

    @notifyCss

</head>
<body>

<!-- Preloader Starts -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
</div>


@yield('content')



@include('rumbok.include.footer');
<!-- template js files -->
<script src="{{asset('asset_rumbok/js/vendor/jquery.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/bootstrap.js')}}"></script>
<script src="{{ asset('frontend/js/popper.js') }}"></script>
<script src="{{asset('asset_rumbok/js/vendor/slick.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/counterup.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/waypoints.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/isotop.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/barfiller.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/countdown.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/easing.js')}}"></script>
<script src="{{asset('asset_rumbok/js/vendor/wow.js')}}"></script>

<script src="{{asset('asset_rumbok/js/main.js')}}"></script>
<script src="{{ asset('js/frontend.js') }}"></script>
<script src="{{ asset('js/notify.js') }}"></script>
@include('layouts.modal')
@include('notify::messages')
@include('sweetalert::alert')
@notifyJs
@yield('js')

<script>
    "use strict"
    var player = new Plyr('#player');
</script>
</body>

</html>
