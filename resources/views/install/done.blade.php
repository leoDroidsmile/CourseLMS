
@extends('install.app')
@section('content')
    <div class="pad-btm text-center">
        <h1 class="h3">Congratulations!!!</h1>
        <p>You have successfully completed the installation process. Please Login to continue.</p>
    </div>
    <div class="m-2"></div>
    <div class="text-center">
        <a href="{{ \Illuminate\Support\Str::before(env('APP_URL'),'/public') }}" class="btn btn-primary">Start Using Now</a>
    </div>
@endsection
