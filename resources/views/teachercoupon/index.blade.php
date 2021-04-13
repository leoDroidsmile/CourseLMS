@extends('layouts.master')
@section('title','Instructor Account Setup')
@section('parentPageTitle', 'All')

@section('css-link')

<link type="text/javascript" src="{{ asset('assets/plugins/datepicker/datepicker.css') }}"/>

@stop

@section('page-style')

@stop
@section('content')



<div class="card">

    <div class="card-header">
        <span class="h1 card-title">@translate(Teacher Coupon Manager)</span>

        <a class="btn btn-primary ml-3" href="{{ route("teachercoupon.all") }}" title="@translate(Teacher Coupon Lists)">
            <i class="fa fa-align-left"></i> @translate(Teacher Coupon Lists)
        </a>

    </div>

        <!-- /.card-header -->
        <div class="card-body p-2 mt-2">
            <!-- Content starts here -->
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card-body">
                        <form method="post" action="{{route('teachercoupon.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>@translate(Teacher Coupon Code)</label>
                                <input type="text" name="code" value="{{ old('code') }}" class="form-control"
                                    placeholder="@translate(Teacher Coupon Code)" required>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="is_published" id="published">
                                <label for="published">@translate(Is published?)</label>
                            </div>

                            <div class="form-group">
                                <label class="control-label">@translate(Select Instructor) <span class="text-danger">*</span></label>
                                <div class="">
                                    <select class="form-control lang" name="user_id" id="select_instructor" required>
                                        <option value=""></option>
                                        @foreach($teachers as $item)
                                            <option value="{{$item->user_id}}"> {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">@translate(Select Course) <span class="text-danger">*</span></label>
                                <div class="">
                                    <select class="form-control lang" name="course_id" id="select_course" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>@translate(Vouchers)</label>
                                <input type="number" name="vouchers" value="{{ old('vouchers') }}" class="form-control"
                                    placeholder="@translate(Vouchers)" required>
                            </div>

                            <button type="submit" class="btn btn-primary">@translate(Submit)</button>

                        </form>
                    </div>
                </div>

            </div>

            <!-- Content starts here:END -->


        </div>

    </div>

@endsection



@section('js-link')
<script src="{{ asset('assets/plugins/datepicker/datepicker.js') }}"></script>
<script src="{{ asset('assets/plugins/datepicker/i18n/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-form-datepicker.js') }}"></script>

<script>
$(document).ready(function(){
    $("#select_instructor").change(function(){
        
        var url = "/api/v1/getCoursesWithInstructor";
        var user_id = $(this).val();
        
        $.ajax({
            url: url,
            method: 'GET',
            data: {user_id: user_id},
            success: function (result) {
                console.log(result);
                if(result.courses){
                    var html = '<option value=""></option>';
                    result.courses.forEach(element => {
                        html += '<option value="' + element.id + '">' + element.title + '</option>';
                    });
                    $("#select_course").html(html);
                }
            }
        });
    });
});
</script>
@stop

@section('page-script')


@stop





