@extends(themeManager().'.app')

@section('content')
  <!-- ================================
         START LOGIN AREA
  ================================= -->
  @if(themeManager() == 'rumbok')
      <!-- Breadcrumb Section Starts -->
      <section class="breadcrumb-section">
          <div class="breadcrumb-shape">
              <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape" class="hero-round-shape-2 item-moveTwo">
              <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
          </div>
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <h2>@translate(login )</h2>
                      <div class="breadcrumb-link margin-top-10">
                          <span><a href="{{url('/')}}">@translate(home)</a> / @translate(login )</span>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <!-- Login Section Starts -->
      <section class="login-section padding-120">
          <div class="container">
              <div class="row">                  <div class="col-lg-6">
                      <div class="login-image">
                          <img src="{{asset('asset_rumbok/images/login-image.jpg')}}" alt="image">
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="login-form">
                          <h3>@translate(login to your) <span>@translate(account)!</span></h3>
                          @if(env('GOOGLE_APP_ID') != "")

                              <div class="google-button">
                                  <a href="{{ url('/auth/redirect/google') }}" class="template-button"><i class="fa fa-google"></i> @translate(google)</a>
                              </div>
                              <span class="separator">or</span>
                          @endif

                          @if(env('DEMO') == "YES")
                              <hr>
                              <div class="row">
                                  <div class="col-md-4 col-sm-12 mb-2">
                                      <button class="btn btn-primary px-5" type="button" id="admin">Admin</button>
                                  </div>

                                  <div class="col-md-4 col-sm-12  mb-2">
                                      <button class="btn btn-primary  px-5 " type="button" id="instructor">Instructor</button>
                                  </div>

                                  <div class="col-md-4 col-sm-12  mb-2">
                                      <button class="btn btn-primary px-5" type="button" id="student">Student</button>
                                  </div>
                              </div>
                              @endif

                          <div class="tab-content margin-top-30">
                              <div class="tab-one-content lost active">
                                  <form method="post" action="{{ route('login') }}">
                                      @csrf
                                      <div class="form-group">
                                          <label for="loginEmail"><i class="fa fa-envelope"></i> @translate(Email Address)</label>
                                          <input class="form-control @error('email') is-invalid @enderror pl-2" type="email" id="email" name="email" placeholder="example@mail.com" required value="{{ old('email') }}">
                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                          <label for="loginPassword"><i class="fa fa-lock"></i> @translate(Password)</label>
                                          <input id="pass" class="form-control @error('password') is-invalid @enderror pl-2" type="password" name="password" placeholder="********" required>
                                          @error('password')
                                          <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                    </span>
                                          @enderror

                                      </div>
                                      <div class="checkbox-forgotpass-area">
                                          <div class="checkbox-part">
                                              <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                              <label for="remember"> @translate(remember me)</label>
                                          </div>
                                          <div class="forgotpass-part">
                                              <a href="{{route('student.password.reset')}}">forgot password?</a>
                                          </div>
                                      </div>
                                      <div class="login-button margin-top-20">
                                          <button class="template-button" id="loginBtn" type="submit">@translate(login account)</button>
                                          <span>@translate(Create an account)? <a href="{{route('student.register')}}">@translate(register)</a></span>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  @elseif(false)

  @else
      <section class="login-area section--padding">
          <div class="container">
              <div class="row">
                  <div class="col-lg-7 mx-auto">
                      <div class="card-box-shared">
                          <div class="card-box-shared-title text-center">
                              <h3 class="widget-title font-size-35">@translate(Login to Your Account)!</h3>
                          </div>

                          {{-- Flash message after successful registration --}}
                          @if (Session::has('message'))
                              <div class="alert alert-info text-center">{{ Session::get('message') }}</div>
                          @endif



                          {{-- Login form --}}
                          <div class="card-box-shared-body">
                              <div class="contact-form-action">
                                  <form method="post" action="{{ route('login') }}">
                                      @csrf
                                      <div class="row">
                                          @if(env('GOOGLE_APP_ID') != "")
                                              <div class="col-12">
                                                  <div class="form-group">
                                                      <a class="theme-btn w-100 text-center" href="{{ url('/auth/redirect/google') }}">
                                                          <i class="fa fa-google mr-2"></i>@translate(Google)
                                                      </a>
                                                  </div>
                                              </div><!-- end col-lg-4 -->
                                              <div class="col-lg-12">
                                                  <div class="account-assist mt-3 margin-bottom-35px text-center">
                                                      <p class="account__desc">@translate(or)</p>
                                                  </div>
                                              </div><!-- end col-md-12 -->
                                          @endif
                                              @if(env('DEMO') == "YES")
                                                  <hr>
                                                  <div class="row">
                                                      <div class="col-md-4 col-sm-12 mb-2">
                                                          <button class="btn btn-primary px-5 " type="button" id="admin">Admin</button>
                                                      </div>

                                                      <div class="col-md-4 col-sm-12  mb-2">
                                                          <button class="btn btn-primary  px-5 " type="button" id="instructor">Instructor</button>
                                                      </div>

                                                      <div class="col-md-4 col-sm-12  mb-2">
                                                          <button class="btn btn-primary px-5" type="button" id="student">Student</button>
                                                      </div>
                                                  </div>
                                              @endif
                                          <div class="col-lg-12">
                                              <div class="input-box">
                                                  <label class="label-text">@translate(Email)<span class="primary-color-2 ml-1">*</span></label>
                                                  <div class="form-group">
                                                      <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="@translate(Email)" required value="{{ old('email') }}">
                                                      <span class="la la-envelope input-icon"></span>

                                                      @error('email')
                                                      <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                                      @enderror

                                                  </div>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12">
                                              <div class="input-box">
                                                  <label class="label-text">@translate(Password)<span class="primary-color-2 ml-1">*</span></label>
                                                  <div class="form-group">
                                                      <input id="pass" class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="@translate(Password)" required>
                                                      <span class="la la-lock input-icon"></span>

                                                      @error('password')
                                                      <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                    </span>
                                                      @enderror

                                                  </div>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12">
                                              <div class="form-group">
                                                  <div class="custom-checkbox d-flex justify-content-between">
                                                      <input type="checkbox" id="chb1" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                      <label for="chb1">@translate(Remember Me)</label>
                                                      <a href="{{route('student.password.reset')}}" class="primary-color-2"> @translate(Forgot my password)?</a>
                                                  </div>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12 ">
                                              <div class="btn-box">
                                                  <button class="theme-btn" id="loginBtn" type="submit">@translate(login account)</button>
                                              </div>
                                          </div><!-- end col-md-12 -->
                                          <div class="col-lg-12">
                                              <p class="mt-4">@translate(Don't have an account)? <a href="{{ route('student.register') }}" class="primary-color-2">@translate(Register)</a></p>
                                          </div><!-- end col-md-12 -->
                                      </div><!-- end row -->
                                  </form>
                              </div><!-- end contact-form -->
                          </div>
                      </div>
                  </div><!-- end col-lg-7 -->
              </div><!-- end row -->
          </div><!-- end container -->
      </section><!-- end login-area -->
  @endif
  <!-- ================================
         START LOGIN AREA
  ================================= -->
@endsection
@if(env('DEMO') == 'YES')
@section('js')
    <script>
        $('#admin').click(function () {
            $('#email').val("admin@mail.com");
            $('#pass').val("12345678");
        })

        $('#instructor').click(function () {
            $('#email').val("instructor@mail.com");
            $('#pass').val("12345678");
        })

        $('#student').click(function () {
            $('#email').val("student@mail.com");
            $('#pass').val("12345678");
        })

    </script>

@endsection
@endif
