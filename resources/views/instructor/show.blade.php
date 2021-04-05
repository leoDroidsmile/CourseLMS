@extends('layouts.master')
@section('title','Profile')
@section('parentPageTitle', 'view')

@section('css-link')
@include('layouts.include.form.form_css')
@stop

@section('page-style')

@stop

@section('content')
<!-- BEGIN:content -->

<div class="card mb-3">
    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
    <form action="{{route('users.banned')}}" method="post" class="mt-2 mr-2">
        @csrf
        <input name="id" value="{{$instructor->user_id}}" type="hidden">
        <div>
            <div class="float-left py-1 px-3">
                <h3>@translate(Instructor Details)</h3>
            </div>
            @if($instructor->user->banned == false)
            <div class="float-right">
                <button type="submit" class="btn btn-blue btn-danger" href="">@translate(Disable Account)</button>
            </div>
            @else
                <div class="float-right">
                    <button type="submit" class="btn btn-blue btn-success">@translate(Active Account)</button>
                </div>
            @endif
        </div>
    </form>
    @endif
    <div class="card-body mt-2">
        <div class="row flex-row">
            <div class="col-xl-3">
                <!-- Begin Widget -->
                <div class="widget">
                    <div class="widget-body">
                        <div class="text-center">
                          <img src="{{filePath($instructor->image)}}" alt="avatar" class="img-fluid rounded-circle avatar-xl">
                        </div>
                        <h3 class="text-center mt-3 mb-1">{{ $instructor->name }}</h3>
                        <p class="text-center">@translate(Balance) : <span class="text-primary">{{ formatPrice($instructor->balance) }}</span></p>
                        <div class="em-separator separator-dashed"></div>
                        <div class="text-center">
                            <h5>@translate(Package)</h5>
                            <img src="{{ filePath($instructor->relationBetweenPackage->image) }}" class="img-fluid rounded-sm package-img">
                            <div class="em-separator separator-dashed"></div>
                            Price: <span class="text-primary">{{formatPrice($instructor->relationBetweenPackage->price)}}</span>
                            <div class="em-separator separator-dashed"></div>
                            Commission: <span class="text-primary">{{formatPrice($instructor->relationBetweenPackage->commission)}}</span>
                        </div>
                    </div>
                </div>
                <!-- End Widget -->
            </div>
            <div class="col-xl-9 mt-5">
                <div class="widget has-shadow">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                            <div class="widget-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>

                                    <tr class="text-center">
                                        <td>@translate(Email)</td>
                                        <td>{{ $instructor->email }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Phone)</td>
                                        <td>{{ $instructor->phone }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Address)</td>
                                        <td>{{ $instructor->address }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Linked In)</td>
                                        <td><a href={{ $instructor->linked }} target="_blank">{{ $instructor->linked }}</a></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Facebook)</td>
                                        <td><a href={{ $instructor->fb }} target="_blank">{{ $instructor->fb }}</a></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Twitter)</td>
                                        <td><a href={{ $instructor->tw }} target="_blank">{{ $instructor->tw }}</a></td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Skype)</td>
                                        <td><a href={{ $instructor->skype }} target="_blank">{{ $instructor->skype }}</a></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                                <div class="em-separator separator-dashed"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>
</div>

<!-- END:content -->
@endsection

@section('js-link')
@include('layouts.include.form.form_js')
@stop

@section('page-script')

@stop
