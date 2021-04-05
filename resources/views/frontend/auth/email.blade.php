@extends('frontend.app')
@section('content')

<!-- ================================
       START RECOVER AREA
================================= -->
<section class="recover-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
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
                                        <p><a href="{{ route('login') }}" class="primary-color-2">@translate(Login)</a></p>
                                    </div><!-- end col-lg-6 -->
                                    <div class="col-lg-6">
                                        <p class="text-right register-text">@translate(Not a member)? <a href="{{ route('student.register') }}" class="primary-color-2">@translate(Register)</a></p>
                                    </div><!-- end col-lg-6 -->
                                </div><!-- end row -->
                            </form>
                        </div><!-- end contact-form -->
                    </div>
                </div>
            </div><!-- end col-lg-7 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end recover-area -->
<!-- ================================
       END RECOVER AREA
================================= -->
@endsection
