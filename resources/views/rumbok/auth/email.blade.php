@extends('rumbok.app')
@section('content')

<!-- ================================
       START RECOVER AREA
================================= -->

<section class="breadcrumb-section">
    <div class="breadcrumb-shape">
        <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
             class="hero-round-shape-2 item-moveTwo">
        <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape"
             class="hero-plus-sign item-rotate">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>@translate(Reset Password)</h2>
                <div class="breadcrumb-link margin-top-10">
                    <span><a href="{{url('/')}}">@translate(home)</a> / @translate(Reset Password)</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Login Section Starts -->
<section class="login-section padding-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login-image">
                    <img src="{{asset('asset_rumbok/images/login-image.jpg')}}" alt="image">
                </div>
            </div>
            <div class="col-lg-6">

                <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-35 pb-2">@translate(Reset Password)!</h3>
                        <p class="line-height-26">
                            @translate(Enter the email of your account to reset password.Then you will receive a link to email to reset the  password.If you have any issue about reset password) <a href="mail:{{getSystemSetting('type_mail')->value}}" class="primary-color-2">@translate(contact us)</a>
                        </p>


                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                @translate(A new password reset link sent to your email)
                            </div>
                        @endif


                    </div>
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                            <form method="post" action="{{ route('password.email') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text">@translate(Email Address)<span class="primary-color-2 ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" name="email" placeholder="Enter email address" required autocomplete="email"
                                                       autofocus>
                                                <span class="la la-envelope input-icon"></span>
                                            </div>
                                        </div>
                                    </div><!-- end col-lg-12 -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button class="theme-btn" type="submit">@translate(reset password)</button>
                                        </div>
                                    </div><!-- end col-lg-12 -->
                                    <div class="col-lg-6">
                                        <p><a href="{{ route('login') }}" class="theme-btn">@translate(Login)</a></p>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6">
                                        <p class="text-right register-text">@translate(Not a member)? <a href="{{ route('student.register') }}" class="primary-color-2">@translate(Register)</a></p>
                                    </div><!-- end col-lg-6 -->
                                </div><!-- end row -->
                            </form>
                        </div><!-- end contact-form -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- ================================
       END RECOVER AREA
================================= -->
@endsection
