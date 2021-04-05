@extends('layouts.master')
@section('title','User Show')
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
                <h2 class="card-title">@translate(User Details)</h2>
            </div>
            <div class="float-right">
                <a href="{{ route("users.edit",$user->id) }}" class="btn btn-primary">
                    <i class="la la-pencil"></i>
                    @translate(Edit Profile)
                </a>
            </div>
        </div>

        <div class="card-body py-5">
                <div class="row">
                    <div class="col-3">
                        @if($user->image != null)
                            <div class="text-center">
                                <img src="{{filePath($user->image)}}" class="img-fluid img-preview rounded-circle avatar-xl">
                            </div>
                        @endif
                    </div>
                    <div class="col-9">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label">@translate(Name)</label>
                            <div class="col-md-6">
                                <div class="form-control border-0">{{ $user->name}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label">@translate(E-Mail
                                Address)</label>

                            <div class="col-md-6">
                               <div class="form-control border-0">{{ $user->email}}</div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('js-link')

@stop

@section('page-script')

@stop
