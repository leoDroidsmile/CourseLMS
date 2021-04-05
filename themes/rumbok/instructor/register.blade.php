@extends('rumbok.app')
@section('content')

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                 class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>@translate(Instructor Registration)</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> /@translate(Instructor Registration)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Package Section Starts -->
    <form method="post" action="{{ route('instructor.create') }}" class="needs-validation" novalidate>
        @csrf
        <!-- Register Section Starts -->
        <div class="register-section padding-top-80 padding-bottom-120">
            <div class="container ">
                <div class="register-form p-5">
                    <section class="package-section padding-top-120">
                        <div class="container">
                            <div class="row">
                                @foreach($packages as $item)
                                    <div class="col-lg-4 col-md-6 instructor-register">
                                        <label>
                                            <input type="radio" required name="package_id" value="{{$item->id}}"
                                                   class="card-input-element">
                                            <div class="single-package-item">
                                                <div class="package-offer green-bg">
                                                    <span>{{$item->commission}}% @translate(Commission)</span>
                                                </div>
                                                <div class="package-content">
                                                    <div class="package-icon template-icon green-icon">
                                                        <i class="icofont-document-folder"></i>
                                                    </div>
                                                    <p class="margin-top-20"> @translate(If you buy this package, admin will get)
                                                        <strong class="text-info text-dark"> {{$item->commission}} % </strong>
                                                        @translate(of the course price for each enrollment of that course)</p>
                                                    <div class="package-price green-price">
                                                        <h4>{{formatPrice($item->price)}}</h4>
                                                    </div>
                                                </div>
                                                <div class="package-image">
                                                    <img src="{{filePath($item->image)}}" alt="image">
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </section>
                    <div class="invalid-feedback alert alert-danger" id="mess" >
                        @translate(Please select the package )
                    </div>
                    <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-box">
                                    <span class="la la-user input-icon"> <label class="label-text">@translate(Full Name)<span
                                            class="primary-color-2 ml-1">*</span></label></span>
                                    <div class="form-group">
                                        <input class="form-control pl-2 @error('name') is-invalid @enderror"
                                               type="text" name="name" placeholder="Full name" required
                                               value="{{ old('name') }}">


                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-box">
                                     <span class="la la-envelope input-icon">
                                         <label class="label-text">@translate(Email Address)<span
                                            class="primary-color-2 ml-1">*</span></label>
                                     </span>
                                    <div class="form-group">
                                        <input class="form-control pl-2 @error('email') is-invalid @enderror"
                                               type="email" name="email" placeholder="Email address"
                                               required value="{{ old('email') }}">


                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-box">
                                    <span class="la la-lock input-icon">
                                        <label class="label-text">@translate(Password)<span
                                            class="primary-color-2 ml-1">*</span></label>
                                    </span>
                                    <div class="form-group">
                                        <input class="form-control pl-2 @error('password') is-invalid @enderror"
                                               type="password" name="password" placeholder="Password"
                                               required>
                                        <small id="emailHelp" class="form-text text-muted">Password minimum
                                            8 characters.</small>


                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-box">
                                    <span class="la la-lock input-icon">
                                         <label class="label-text">@translate(Confirm Password)<span
                                            class="primary-color-2 ml-1">*</span></label>
                                    </span>
                                    <div class="form-group">

                                        <input
                                            class="form-control pl-2 @error('confirm_password') is-invalid @enderror"
                                            type="password" name="confirm_password"
                                            placeholder="Confirm password" required>


                                        @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="register-button margin-top-20">
                            <button type="submit" class="template-button">@translate(register account)</button>
                            <span>@translate(Already have an account)? <a href="{{ route('login') }}" class="login-link">@translate(Login)</a></span>
                        </div>
                </div>
            </div>
        </div>
    </form>
@endsection
