@extends('layouts.master')
@section('title','Theme Upload')
@section('parentPageTitle', 'Theme Upload')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-2">
                    <div class="card-header">
                        <span class="h1 card-title">@translate(Upload Theme)</span>
                    </div>

                    <div class="card-body t-div">
                        <div class="container m-auto">
                            <div class="row my-4">
                                <div class="col-12">


                                    <form action="{{ route('theme.install.index') }}" method="POST" enctype="multipart/form-data">
                                        @csrf



                                        <input type="file" class="dropify" name="theme">

                                        <div class="progress progress-height">
                                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated progBar addonProgressBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                        </div>

                                        <div class="text-center mt-5">
                                            <button type="submit" class="btn btn-primary w-50 p-3" onclick="addonLoader()">@translate(Install Theme)</button>
                                        </div>
                                    </form>




                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <hr>

@endsection
