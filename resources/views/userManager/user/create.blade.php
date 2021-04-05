@extends('layouts.master')
@section('title','User')
@section('parentPageTitle', 'index')


@section('css-link')

@stop

@section('page-style')

@stop

@section('content')
    <!-- Content Header (Page header) -->

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(User Create)</h2>
            </div>
            <div class="float-right">
                <a href="{{ route("users.index") }}" class="btn btn-primary">
                    <i class="la la-plus"></i>
                    @translate(Show All User)
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{route('users.store')}}" method="post">
                @csrf
                <input type="hidden" name="user_type" value="Admin">
                <div class="">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@translate(Name) <span class="text-danger">*</span></label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus >

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">@translate(E-Mail Address) <span class="text-danger">*</span></label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">@translate(Password) <span class="text-danger">*</span></label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@translate(Confirm Password) <span class="text-danger">*</span></label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <input type="hidden" name="group_id" value="1">
                    <input type="hidden" name="user_type" value="Admin">

                </div>
                <div class="float-right">
                    <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
                </div>

            </form>
        </div>
    </div>

@endsection


@section('js-link')

@stop

@section('page-script')

@stop
