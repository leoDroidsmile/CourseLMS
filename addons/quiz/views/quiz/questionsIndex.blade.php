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
        <div class="row p-3">
            <div class="col-md-6 border border-info">
                <div class="card">
                   <h3><strong>@translate(Quiz Name)</strong></h3>
                    <h4>{{$quiz->name}}</h4>
                </div>
            </div>
            <div class="col-md-3 border border-info">
                <div class="p-3 card">
                    <h3><strong>@translate(Pass mark)</strong></h3>
                    <h4>{{$quiz->pass_mark}}</h4>
                </div>
            </div>
            <div class="col-md-3 border border-info">
                <div class="p-3 card">
                    <h3><strong>@translate(quiz_time)</strong></h3>
                    <h4>{{$quiz->quiz_time ?? 'infinity'}}</h4>
                </div>
            </div>
        </div>
        <h4 class="card-header">@translate(Create New Questions)</h4>
        <div class="card-body mx-3">
            <form action="{{route('questions.store')}}" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="quiz_id" value="{{$quiz->id}}" >
                @csrf
                <div class="row">

                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-title">
                            @translate(Questions Title) <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" required
                                   value="{{ old('title') }}"
                                   class="form-control @error('title') is-invalid @enderror"
                                   name="title" placeholder="@translate(Enter Questions Title)" aria-required="true"
                                   autofocus>
                            @error('title') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6 p-3">
                        <label class="" for="val-title">
                            @translate(Correct Answer Mark)</label>
                        <div class="">
                            <input type="number" required
                                   value=""
                                   class="form-control"
                                   name="grade" placeholder="@translate(Correct Answer Mark)" aria-required="true"
                                   autofocus>
                        </div>
                    </div>
                </div>

                {{--here the question answer field--}}
                <hr>
                <div class="text-right">
                    <button class="btn btn-sm btn-outline-success p-2 m-3" id="add-answer" type="button"><i
                            class="fa fa-plus-circle"></i> @translate(Add Question) </button>

                </div>
                <div class="row">
                    <table class="table table-bordered answer-form-table">
                        <tbody class="input-append">
                        <tr class="border border-primary">
                            <td>
                                <div class="form-group">
                                    <label>@translate(Question Answer)</label>
                                    <input type="text" required
                                           class="form-control" name="answer[]" placeholder="@translate(Write Answer)">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label>@translate(Image)</label>
                                    <input type="file" class="form-control-file" placeholder="Select Image"
                                           name="image[]">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label>@translate(Correct)</label>
                                    <select class="form-control" name="correct[]" required>
                                        <option value="false">@translate(False)</option>
                                        <option value="true">@translate(True)</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <button id="" class="btn btn-sm btn-danger remove p-2" onclick="deleteTr(this.id)"
                                            type="button"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <button class="btn btn-outline-success" type="submit"> @translate(Submit)</button>
            </form>
        </div>
    </div>
    <!-- END:content -->
    <div class="card m-b-30">
        <h4 class="card-header">@translate(All Questions)</h4>
        <div class="card-body mx-3">
                        <table class="table table-striped- table-bordered table-hover text-center">
                            <thead>
                            <tr>
                                <th>S/L</th>
                                <th>@translate(Questions)</th>
                                <th>@translate(Grade)</th>
                                <th>@translate(Action)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($questions as  $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>

                                    <td>{{$item->question}}</td>
                                    <td>{{$item->grade ?? 'N/A'}}</td>


                                    <td>
                                        <div class="switchery-list">
                                            <input type="checkbox" data-url="{{route('questions.published')}}"
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
                                                    <a class="dropdown-item" onclick="forModal('{{route('questions.edit',$item->id)}}','@translate(Edit Question)')">
                                                        <i class="feather icon-edit mr-2"></i>@translate(Edit)
                                                    </a>
                                                    <a class="dropdown-item"
                                                       onclick="confirm_modal('{{ route('questions.delete', $item->id) }}')"
                                                       href="#!">
                                                        <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty

                                <tr></tr>

                                <tr>
                                    <td><h3 class="text-center">@translate(No Data Found)</h3></td>
                                </tr>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>

                            @endforelse
                            </tbody>
                        </table>
        </div>
    </div>
@endsection
@section('js-link')
    @include('layouts.include.form.form_js')
@stop
@section('page-script')
    <script type="text/javascript" src="{{ asset('assets/js/custom/course.js') }}"></script>
    <script>
        "use strict"
        var count = 0;
        $('#add-answer').on('click', function () {
            count++;
            var clone = $(".answer-form-table tbody tr:first").clone();
            clone.attr({
                id: "emlRow_" + count,
            });
            clone.find(".remove").each(function () {
                $(this).attr({
                    id: $(this).attr("id") + count,
                });
            });

            $(".answer-form-table  tbody").append(clone);
        });

        function deleteTr(id) {
            $('#emlRow_' + id).remove();
        }
    </script>
@stop
