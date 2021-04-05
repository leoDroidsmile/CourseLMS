@extends('layouts.master')
@section('title','User Update')
@section('parentPageTitle', 'sample')

@section('css-link')

@stop

@section('page-style')

@stop

@section('content')
    <!-- Content Header (Page header) -->
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(User Update)</h2>
            </div>
            <div class="float-right">
                <a href="{{ route("users.index") }}" class="btn btn-primary">
                    <i class="la la-plus"></i>
                    @translate(Show All User)
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{route('users.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}"/>
                <input type="hidden" name="user_type" value="{{$user->user_type}}"/>
                <div class="">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">@translate(Name) <span
                                class="text-danger">*</span></label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ $user->name}}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">@translate(E-Mail Address)
                            <span class="text-danger">*</span></label>

                        <div class="col-md-6">
                            <input id="email" readonly type="" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ $user->email}}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <label class="col-md-4 col-form-label text-md-right">@translate(Password)</label>
                        <div class="col-md-6">
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                   name="password" placeholder="@translate(Password)">


                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                            @enderror

                        </div>

                    </div><!-- end col-md-12 -->

                    <input type="hidden" name="image" value="{{$user->image}}">

                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' name="newImage" id="imageUpload" accept=".png, .jpg, .jpeg"/>
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview"
                                 style="background-image: url({{filePath($user->image)}});">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="group_id" value="1">
                </div>
                <div class="float-right">
                    <button class="btn btn-primary m-2" type="submit">@translate(Update)</button>
                </div>

            </form>
        </div>
    </div>

@endsection


@section('js-link')

@stop

@section('page-script')

@stop
