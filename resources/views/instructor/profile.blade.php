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

    <div class="card m-b-30">

        <div class="card-body">


            <div class="row flex-row">
                <div class="col-xl-3">
                    <!-- Begin Widget -->
                    <div class="widget has-shadow">
                        <div class="widget-body">
                            <div class="mt-5">
                                <form class="form-horizontal" action="{{ route('instructors.update') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$each_user->id}}">
                                    <input type="hidden" name="user_id" value="{{$each_user->user_id}}">
                                    <input type="hidden" name="image" value="{{$each_user->image}}">

                                    <div class="avatar-upload mb-2">
                                        <div class="avatar-edit">
                                            <input type='file' name="newImage" id="imageUpload"
                                                   accept=".png, .jpg, .jpeg"/>
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                 style="background-image: url({{filePath($each_user->image)}});">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <h3 class="text-center mb-1">{{ $each_user->name }}</h3>
                            <p class="text-center">{{ $each_user->email }}</p>
                            <p class="text-center">@translate(Balance) : <span
                                    class="text-primary">{{ formatPrice($each_user->balance) }}</span></p>
                            <div class="text-center">
                                <h5>@translate(Package)</h5>
                                <img src="{{ filePath($each_user->relationBetweenPackage->image) }}"
                                     class="img-fluid rounded-sm package-img">
                                <div class="em-separator separator-dashed"></div>
                                Price: <span
                                    class="text-primary">{{formatPrice($each_user->relationBetweenPackage->price)}}</span>
                                <div class="em-separator separator-dashed"></div>
                                @translate(Commission): <span
                                    class="text-primary">{{formatPrice($each_user->relationBetweenPackage->commission)}}</span>
                            </div>

                            <div class="em-separator separator-dashed"></div>
                        </div>
                    </div>
                    <!-- End Widget -->
                </div>
                <div class="col-xl-9">
                    <div class="widget has-shadow">
                        <div class="widget-header bordered no-actions d-flex align-items-center">

                        </div>

                        <div class="tab-content" id="myTabContent">


                            <div class="tab-pane fade show active" id="information" role="tabpanel"
                                 aria-labelledby="information-tab">
                                <div class="widget-body">
                                    <div class="col-10 ml-auto">
                                        <div class="section-title mt-3 mb-3">

                                        </div>
                                    </div>

                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">@translate(Phone)</label>
                                        <div class="col-lg-6">
                                            <input type="tel" name="phone" class="form-control"
                                                   placeholder="+88 987 654 32" value="{{ $each_user->phone }}">
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">@translate(Address)</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control"
                                                      name="address">{!! $each_user->address !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">@translate(Linkedin)</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="linked"
                                                   placeholder="@translate(Linkedin)" value="{{ $each_user->linked }}">
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">@translate(Facebook)</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="fb"
                                                   placeholder="@translate(Facebook)" value="{{ $each_user->fb }}">
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">@translate(Twitter)</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="tw"
                                                   placeholder="@translate(Twitter)" value="{{ $each_user->tw }}">
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">@translate(Skype)</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="skype"
                                                   placeholder="@translate(Skype)" value="{{ $each_user->skype }}">
                                        </div>
                                    </div>

                                    <div class="form-group row d-flex align-items-center mb-5">
                                        <label class="col-lg-2 form-control-label d-flex justify-content-lg-end">@translate(About)</label>
                                        <div class="col-lg-6">
                                            <textarea class="form-control"
                                                      name="about">{!! $each_user->about !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row d-flex align-items-center mb-5">

                                        <label
                                            class="col-md-2 col-form-label text-md-right">@translate(Password)</label>
                                        <div class="col-md-6">
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                   type="password"
                                                   name="password" placeholder="@translate(Password)">


                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                  </span>
                                            @enderror

                                        </div>

                                    </div>
                                        {{--check certifecate--}}
                                        @if(env('CERTIFICATE_ACTIVE') === "YES")
                                            <div class="img-fluid m-3">
                                                <img src="{{filePath($each_user->signature)}}" height="80" width="45"
                                                     class="img-fluid">
                                            </div>
                                            <hr>
                                            <div class="form-group row mb-5">
                                                <label class="form-control-label col-md-2">@translate(Signature)</label><br>

                                                <div class="col-md-6">
                                                    <input type="file" class="form-control-file" name="signature"
                                                           value="{{$each_user->signature }}">
                                                </div>
                                            </div>
                                            <small class="text-info">@translate(Signature image must be transparent or
                                                80*45 size)</small><br>
                                        @endif
                                    </div>
                                    <div class="em-separator separator-dashed">
                                    <div class="text-right">
                                        <button class="btn btn-shadow btn-primary" type="submit">@translate(Save Changes)</button>

                                    </div>

                                    </form>


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
