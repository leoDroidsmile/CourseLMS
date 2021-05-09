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
    <div class="py-2 px-3">
        <div class="float-left">
            <h3>@translate(Student Details)</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row flex-row">
            <div class="col-xl-3">
                <!-- Begin Widget -->
                <div class="widget has-shadow">
                    <div class="widget-body">
                        <div class="text-center">

                            <img src="{{filePath($each_student->image)}}" alt="avatar" class="img-fluid rounded-circle avatar-xl">
                        </div>
                        <h3 class="text-center mt-3 mb-1">{{ $each_student->name }}</h3>
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
                        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                            <div class="widget-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    </thead>
                                    <tbody>

                                    <tr class="text-center">
                                        <td>@translate(Email)</td>
                                        <td>{{ $each_student->email }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Phone)</td>
                                        <td>{{ $each_student->phone }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(City)</td>
                                        <td>{{ $each_student->city }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td>@translate(Male)</td>
                                        <td>
                                            @if($each_student->male)
                                                {{ "Male" }}
                                            @else
                                                {{ "Female" }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>@translate(School)</td>
                                        <td>{{ $each_student->school }}</td>
                                    </tr>

                                    <tr class="text-center">
                                        <td>@translate(Major)</td>
                                        <td>{{ $each_student->major }}</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
</div>

<div class="card mb-3">
    <div class="py-2 px-3">
        <div class="float-left">
            <h3>@translate(Reset Password)</h3>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('students.reset.password')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="student_id" value="{{$each_student->user_id}}">
            <div class="row">
                <div class="form-group col-lg-6">
                    <input class="form-control" placeholder="@translate(New Password)" type="text"  name="password" required>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-primary" type="submit">@translate(Reset Password)</button>
                </div>
            </div>
    
        </form>
    </div>
</div>

<div class="card mb-3">
    <div class="py-2 px-3">
        <div class="float-left">
            <h3>@translate(Student Course Details)</h3>
        </div>
    </div>
    <div class="card-body">
        <div class="row flex-row">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@translate(S/L)</th>
                    <th>@translate(Instructor)</th>
                    <th>@translate(Course Name)</th>
                    <th>@translate(Payment Method)</th>
                    <th>@translate(Coupon Code)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>

                @forelse ($enrolls as $enroll)
                    <tr>
                        <td>{{ $loop->index++ + 1 }}</td>
                        <td>{{ $enroll->course->relationBetweenInstructorUser->name }}</td>
                        <td>{{ $enroll->course->title }}</td>
                        <td>{{ $enroll->history->payment_method }}</td>
                        <td>{{ $enroll->history->CouponCode() }}</td>
                        <td>
                            <a class="btn btn-primary ml-3" id="btn_download" style="float:right; color:white;" title="@translate(Delete)" href="{{ route("students.deleteCourse", $enroll->id) }}">
                                <i class="fa fa-remove"></i> @translate(Delete)
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <h4>@translate(NO Student Course FOUND)</h4>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
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
