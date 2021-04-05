<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Favicon -->
  <link rel="icon" sizes="16x16" href="{{ filePath(getSystemSetting('favicon_icon')->value) }}">
    <!-- Start css -->
    <link href="{{asset('/')}}assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/css/style.css" rel="stylesheet" type="text/css">
    <!-- End css -->
</head>

<body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box error-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-8 col-lg-6">
                        <div class="text-center">
                            <img src="{{getSystemSetting('type_logo')}}" class="img-fluid error-logo" alt="logo">
                            <img src="{{asset('/')}}assets/images/error/internal-server.svg" class="img-fluid error-image" alt="500">
                            <h4 class="error-subtitle mb-4">@translate(500 Internal Server Error)</h4>
                            <p class="mb-4">@translate(The server encountered an internal error or misconfiguration and was unable to
                                complete your request.)</p>
                            <a href="{{route('dashboard')}}" class="btn btn-primary font-16"><i class="feather icon-home mr-2"></i> @translate(Go back to Dashboard)</a>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->
    <script src="{{asset('/')}}assets/js/jquery.js"></script>
    <script src="{{asset('/')}}assets/js/popper.js"></script>
    <script src="{{asset('/')}}assets/js/bootstrap.js"></script>
    <script src="{{asset('/')}}assets/js/modernizr.js"></script>
    <script src="{{asset('/')}}assets/js/detect.js"></script>
    <script src="{{asset('/')}}assets/js/jquery.slimscroll.js"></script>
    <!-- End js -->
</body>

</html>
