@extends('layouts.master')
@section('title','Course Create')
@section('parentPageTitle', 'Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
    <!-- BEGIN:content -->
    <div class="card m-b-30">
        <h4 class="card-header">@translate(Create New Quiz)</h4>
        <div class="card-body mx-3">
            <form action="{{route('quiz.store')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-title">
                            @translate(Quiz Name) <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" required
                                   value="{{ old('name') }}"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" placeholder="@translate(Enter Quiz Name)" aria-required="true" autofocus>
                            @error('name') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-title">
                            @translate(Quiz Time)(Minutes) Ex:10</label>
                        <div class="">
                            <input type="number"
                                   value=""
                                   class="form-control"
                                   name="quiz_time" placeholder="@translate(Default infinity)" aria-required="true"
                                   autofocus>
                        </div>
                    </div>

                    <div class="form-group col-md-4 p-3">
                        <label class="" for="val-provider">@translate(Select Course) </label>
                        <div class="col-lg-9">
                            <select class="form-control" name="course_id" required>
                                <option value="">@translate(Select Course)</option>
                                @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-4 p-3">
                        <label class="" for="val-title">
                            @translate(Pass Mark)</label>
                        <div class="">
                            <input type="number" step="0.01" required
                                   value=""
                                   class="form-control"
                                   name="pass_mark" placeholder="@translate(Pass Mark)" aria-required="true" autofocus>
                        </div>
                    </div>


                    <div class="form-group col-md-4 p-3">
                        <label class="" for="val-provider">
                            @translate(Status) </label>
                        <div class="col-lg-9">
                            <select class="form-control" name="status" required>
                                <option value="1">
                                    @translate(Active)
                                </option>
                                <option value="0">
                                    @translate(Deactivate)
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-outline-success" type="submit"> @translate(Submit)</button>
            </form>
        </div>
    </div>
    <!-- END:content -->
    @if(request()->is('dashboard/quiz/list'))
        <div class="card m-b-30">
            <h4 class="card-header">@translate(All Quiz)</h4>
            <div class="card-body mx-3">
                <table class="table table-striped- table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>@translate(Name)</th>
                        <th>@translate(Course)</th>
                        <th>@translate(Quiz Time)</th>
                        <th>@translate(Pass Mark)</th>
                        <th>@translate(Status)</th>
{{--                        <th>@translate(Questions)</th>--}}
                        <th>@translate(Action)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($quiz as  $item)
                        <tr>
                            <td>{{ ($loop->index+1) + ($quiz->currentPage() - 1)*$quiz->perPage() }}</td>

                            <td>{{$item->name}}</td>
                            <td>{{$item->course->title ?? 'N/A'}}</td>
                            <td>{{$item->quiz_time ?? 'infinite'}} (Minutes)</td>
                            <td>{{$item->pass_mark ?? 'infinite'}}</td>

                            <td>
                                <div class="switchery-list">
                                    <input type="checkbox" data-url="{{route('quiz.published')}}"
                                           data-id="{{$item->id}}"
                                           class="js-switch-success"
                                           id="category-switch" {{$item->status == true ? 'checked' : null}} />
                                </div>
                            </td>

                            <td>
                                <div class="kanban-menu">
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right action-btn"
                                             aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                            <a class="dropdown-item" href="{{ route('question.add', $item->id) }}">
                                                <i class="fa fa-question-circle mr-2"></i>@translate(Questions)</a>

                                            <a class="dropdown-item" href="#!"
                                               onclick="forModal('{{ route('quiz.edit', $item->id) }}', '@translate(Quiz Edit)')">
                                                <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                            <a class="dropdown-item"
                                               onclick="confirm_modal('{{ route('quiz.delete', $item->id) }}')"
                                               href="#!">
                                                <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty

                        <tr></tr>
                        <tr></tr>
                        <tr>
                            <td><h3 class="text-center">@translate(No Data Found)</h3></td>
                        </tr>
                        <tr></tr>
                        <tr></tr>
                        <tr></tr>

                    @endforelse
                    </tbody>
                    <div class="float-left">
                        {{ $quiz->links() }}
                    </div>
                </table>
            </div>
        </div>
    @endif
@endsection
@section('js-link')
    @include('layouts.include.form.form_js')
@stop
@section('page-script')
    <script type="text/javascript" src="{{ asset('assets/js/custom/course.js') }}"></script>
@stop
