@extends('layouts.master')
@section('title','Course Index')
@section('parentPageTitle', 'All Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
    <!-- BEGIN:content -->
    <div class="card m-b-30">
        <div class="row px-3 pt-3">
            <h3 class="col-md-6">
                @translate(Instructor Wallet Courses)
            </h3>
            <div class="col-md-6">
                <form method="get" action="">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               placeholder="@translate(Search Courses)" value="{{Request::get('search')}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                @translate(Search)
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table foo-filtering-table text-center">
                    <thead class="text-center">
                    <tr class="footable-header">
                        <th data-breakpoints="xs" class="footable-first-visible">
                            @translate(S/L)
                        </th>
                        <th>
                            @translate(Category)
                        </th>
                        <th>
                            @translate(Title)
                        </th>
                        <th>
                            @translate(Student)
                        </th>
                        <th>
                            @translate(Price)
                        </th>
                        <th>
                            @translate(Date)
                        </th>
                        {{-- <th>@translate(Action)</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($histories as $history)
                        <tr>
                            <td class="footable-first-visible">
                                {{ ($loop->index+1) + ($histories->currentPage() - 1)*$histories->perPage() }}
                            </td>
                            <td>{{ $history->enrollment->enrollcourse->category->name }}</td>
                            <td>{{ $history->enrollment->enrollcourse->title }}</td>
                            <td>{{ $history->enrollment->student->name }}</td>
                            <td>{{ $history->enrollment->enrollcourse->price }}</td>
                            <td>{{ date('d-M-y',strtotime($history->created_at)) }}</td>
                            {{-- <td>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 font-18 float-right" type="button"
                                            id="widgetRevenue" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="feather icon-more-horizontal-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right st-drop"
                                         aria-labelledby="widgetRevenue" x-placement="bottom-end">

                                        @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin")
                                        <a class="dropdown-item font-13"
                                           href="{{ route('course.show',[$course->id,$course->slug])}}">
                                            @translate(Details)
                                        </a>
                                        <a class="dropdown-item font-13"
                                           href="{{ route('course.edit',[$course->id,$course->slug])}}">
                                            {{ Auth::user()->user_type == 'Admin' ? '@translate(Details)' : '@translate(Edit)' }}
                                        </a>
                                        @else
                                        <a class="dropdown-item"
                                        onclick="confirm_modal('{{ route('course.destroy', $course->id) }}')"
                                        href="#!">
                                        <i class="feather icon-trash mr-2"></i>@translate(Delete Course)</a>     

                                        <a class="dropdown-item"
                                        onclick="confirm_modal('{{ route('course.destroy.students', $course->id) }}')"
                                        href="#!">
                                        <i class="feather icon-trash mr-2"></i>@translate(Delete All Students)</a>     
                                        @endif
                                    </div>
                                </div>
                            </td> --}}
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <img src="{{ filePath('no-course-found.jpg') }}" class="img-fluid w-100" alt="#No COurse Found">
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

@stop
@section('page-script')
@stop
