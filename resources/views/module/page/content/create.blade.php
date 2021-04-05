@extends('layouts.master')
@section('title','Page Content')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Page Content Create)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <a href="{{route('pages.content.index',$id)}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Content List)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="card-body">
                <form action="{{route('pages.content.store',$id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="page_id" type="hidden" value="{{$id}}">
                    <div class="form-group">
                        <label>@translate(Content Title) <span class="text-danger">*</span></label>
                        <input placeholder="@translate(Enter Content Title)" class="form-control @error('title') is-invalid @enderror" type="text"
                               value="{{ old('title') }}" name="title">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="val-suggestions">
                            @translate(Content Description)</label>
                        <textarea required class="form-control summernote @error('body') is-invalid @enderror"
                                  name="body" rows="5" aria-required="true">{!! old('body') !!}</textarea>
                        @error('body') <span class="invalid-feedback"
                                             role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                    </div>

                    <div class="float-right">
                        <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection


