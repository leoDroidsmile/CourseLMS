
<!DOCTYPE html>
<html lang="en">


<head>

    <!-- meta -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="Rumon Prince Sohan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="copyright"content="{{ env('APP_NAME') }}">
    <meta name="subject" content="{{ env('APP_NAME') }} {{ env('APP_VERSION') }}">
    <meta name="description" content="@yield('meta_description', config('app.name'))">
    <meta name="author" content="@yield('meta_author', config('app.name'))">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site Title -->
    <title> @yield('forum_title') </title>

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}"><!-- favicon -->

    @include('forum.forumly.layouts.style')

    @yield('css')

</head>

<body>
    <!-- Preloader starts-->
    <div class="preloader">
        <div class="loading-center">
            <div class="loading-center-absolute">
                <div class="object object_one"></div>
                <div class="object object_two"></div>
                <div class="object object_three"></div>
            </div>
        </div>
    </div>

    <!-- Preloader ends -->

    @includeWhen(true, forumComp('header'))

    @yield('content')

    @includeWhen(true, forumComp('footer'))

    @include('forum.forumly.layouts.script')

    @yield('js')

</body>

</html>