@extends('layouts.master')
@section('title','Certificate Create')
@section('parentPageTitle', 'Certificate')

@section('page-style')
@stop
@section('content')
    <!-- BEGIN:content -->
    <form action="{{route('template.text')}}" method="post" enctype="multipart/form-data">
    <div class="card m-b-30">
        <h4 class="card-header">@translate(Certificate Template Text)</h4>
        @if($certificate != null)
        <div class="text-right">
            <a href="{{route('demo.certificate')}}" target="_blank" class="nav-link">@translate(show demos)</a>
        </div>
        @endif
        <div class="card-body mx-3">
                @csrf
            <div class="form-group p-3">
                <label class="" for="val-title">@translate(Certificate Template Top Text) <span
                        class="text-danger">*</span></label><br>
                <div class="">
                    <textarea class="form-control" name="top_text" >{{$certificate->top_text ?? ''}}</textarea>
                </div>
            </div>

            <div class="form-group p-3">
                <label class="" for="val-title">@translate(Certificate Template Header Text) <span
                        class="text-danger">*</span></label><br>
                <div class="">
                    <textarea class="form-control" name="header_text" >{{$certificate->header_text ?? ''}}</textarea>
                </div>
            </div>


            <div class="form-group p-3">
                <label class="" for="val-title">@translate(Certificate Template Footer Text) <span
                        class="text-danger">*</span></label><br>
                <div class="">
                    <textarea class="form-control" name="footer_text" >{{$certificate->footer_text ?? ''}}</textarea>
                </div>
            </div>

                <div class="form-group p-3">
                    <label class="" for="val-title">@translate(Certificate Template Text) <span
                            class="text-danger">*</span></label><br>
                    <small>N.B: "/br" for new line.</small>
                    <div class="">
                        <textarea class="form-control" name="template_text" >{{$certificate->template_text ?? ''}}</textarea>
                    </div>

                </div>

                <div class="form-group">
                    <label class="" for="val-title">@translate(Generate Barcode for Certificate) <span
                            class="text-danger">*</span></label><br>
                    <small>N.B: Print Barcode in Certificate</small>
                    <select class="select2" name="permissions" required>
                        <option value="NO" {{$certificate->permissions  == "NO" ? 'selected' : null}}>@translate(NO)</option>
                        <option value="YES" {{$certificate->permissions  == "YES" ? 'selected' : null}}>@translate(YES)</option>
                    </select>
                </div>
                <button class="btn btn-outline-success" type="submit">@translate(Save)</button>


        </div>
    </div>
    <!-- END:content -->

        <div class="card m-b-30">
            <h4 class="card-header">@translate(Certificate Badge)</h4>
            <div class="card-body mx-3">
                <div class="row">
                    <div class="col-md-6">
                        <input type="file" class="form-control-file" name="badge" value="{{$certificate->badge}}">
                        <small>Image Support 80×80 Resolution</small><br>
                        <button class="btn btn-outline-success m-4" type="submit">@translate(Save)</button>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <img src="{{filePath($certificate->badge)}}"  height="80" width="80">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card m-b-30">
            <h4 class="card-header">@translate(Certificate Logo)</h4>
            <div class="card-body mx-3">
                <div class="row">
                    <div class="col-md-6">
                        <input type="file" class="form-control-file" name="logo" value="{{$certificate->logo}}">
                        <small>Image Support 80×80 Resolution</small><br>
                        <button class="btn btn-outline-success m-4" type="submit">@translate(Save)</button>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <img src="{{filePath($certificate->logo)}}" height="80" width="80">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="card m-b-30">
        <h4 class="card-header">@translate(Certificate Template)</h4>
        <div class="card-body mx-3">
            <div class="row">
                <div class="col-md-6">
                    <label>
                        <input type="radio" name="image" {{$certificate->image == $c1 ? 'checked' : null}} value="{{$c1}}">
                        <img src="{{filePath($c1)}}" class="img-fluid">
                    </label>
                </div>

                <div class="col-md-6">
                    <label>
                        <input type="radio" name="image" {{$certificate->image == $c2 ? 'checked' : null}} value="{{$c2}}">
                        <img src="{{filePath($c2)}}" class="img-fluid">
                    </label>
                </div>

                <div class="col-md-6">
                    <label>
                        <input type="radio" name="image" {{$certificate->image == $c3 ? 'checked' : null}} value="{{$c3}}">
                        <img src="{{filePath($c3)}}" class="img-fluid">
                    </label>
                </div>

                <div class="col-md-6">
                    <label>
                        <input type="radio" name="image" {{$certificate->image == $c4 ? 'checked' : null}} value="{{$c4}}">
                        <img src="{{filePath($c4)}}" class="img-fluid">
                    </label>
                </div>

                <button class="btn btn-outline-success m-4" type="submit">@translate(Save)</button>
            </div>
        </div>
    </div>
    </form>
@endsection
@section('js-link')
    @include('layouts.include.form.form_js')
@stop


