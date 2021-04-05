@extends('layouts.master')
@section('title','Setup App Setting')
@section('parentPageTitle', 'All')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 px-3">
            <div class="card m-2">
                <div class="card-header">
                    <h2 class="card-title">@translate(Other App Settings)</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('other.update')}}" enctype="multipart/form-data">
                        @csrf

                        <label class="label">@translate(Active Blog)</label>
                        <input type="hidden" name="types[]" value="BLOG_ACTIVE">
                        <select class="form-control" name="BLOG_ACTIVE">
                            <option value="YES" @if (env('BLOG_ACTIVE') == "YES") selected @endif>
                                YES
                            </option>
                            <option value="NO" @if (env('BLOG_ACTIVE') == "NO") selected @endif>NO
                            </option>
                        </select>


                        {{-- Paytm:END --}}
                        <hr class="py-2">
                        <div class="m-2 float-right">
                            <button class="btn btn-primary" type="submit">@translate(Save)</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection



@section('js-link')

@stop

@section('page-script')
@stop


