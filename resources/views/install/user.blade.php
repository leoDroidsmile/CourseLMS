@extends('install.app')
@section('content')

    <div class="card-body">
        <h3 class="text-lg-center p-3">@translate(Create Admin User)</h3>


        @if($message = Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
            @endif

        @if($message = Session::get('invalidKey'))
            <div class="alert alert-danger">This purchase key is not valid</div>
        @endif

        @if($message = Session::get('notManyvendor'))
            <div class="alert alert-danger">You inserted a wrong purchase code, Please purchase our item from CODECANYON for a valid code</div>
        @endif

        @if($message = Session::get('used'))
            <div class="alert alert-danger">{{Session::get('used')}}</div>
        @endif



        <form method="POST" action="{{ route('admin.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">@translate(Name)</label>

                <div class="col-md-6">
                    <input placeholder=" User name" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">@translate(E-Mail Address)</label>

                <div class="col-md-6">
                    <input id="email" placeholder=" Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">@translate(Password)</label>

                <div class="col-md-6">
                    <input id="password" placeholder=" Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    <small class="text-info">Minimum 8 characters</small>
                </div>

            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@translate(Confirm Password)</label>

                <div class="col-md-6">
                    <input id="password-confirm" placeholder=" Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <small class="text-info">Minimum 8 characters</small>
                </div>
            </div>


            <div class="form-group mt-4 mb-0">
                <label class="text-md-right">@translate(Important information)</label>
            </div>
            <div className="form-group row mb-3">
                <label className="col-md-4 col-form-label text-md-right"></label>
                <div className="col-md-6">
                    <ul className="list-group ml-0 pl-0">
                        <li className="list-group-item text-semibold border-0 pl-0 sm-text">
                            You can use this
                            <span className="text-danger">
                                    purchase code
                                  </span>
                            only in one domain. Once used, you can only
                            transfer the website in it's subdomains. The
                            main domain can not be changed unless you
                            verify your purchase code from the support
                            team of this software. And this support will
                            not be free.
                        </li>
                        <li className="list-group-item text-semibold border-0 pl-0 sm-text">
                            You can install in localhost, it will not
                            affect your live server installation with the
                            same purchase code.
                        </li>

                        <li className="list-group-item text-semibold text-secondary border-0 pl-0 sm-text">
                            <i className="fa fa-info mr-2"></i>You need
                            internet connection to save these information
                        </li>
                    </ul>
                </div>
            </div>

            <div class="form-group mt-3">
                <label for="purchase_key" class="text-md-right">@translate(Purchase code)</label>
                <input placeholder="Enter purchase code" id="purchase_key" type="text" class="form-control" name="purchase_key" value="{{ old('purchase_key') }}" required>
            </div>

            <input type="hidden" name="domain_name" value="{{request()->getHttpHost()}}"/>
            <input type="hidden" name="ip_address" value="{{request()->ip()}}"/>

            <div class=>
                <div class="">
                    <button type="submit" class="btn btn-block btn-primary">
                        @translate(Register)
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
