@extends('layouts.master')
@section('title','Language')
@section('parentPageTitle', 'All')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h2 class="card-title">@translate(Language List)</h2>
                </div>
                <div class="card-body table-responsive">
                    <!--begin: Datatable -->
                    <table class="table table-striped- table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>S/L</th>
                            <th>@translate(Code)</th>
                            <th>@translate(Name)</th>
                            <th>@translate(Logo)</th>
                            <th>@translate(Action)</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($languages as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->code}}</td>
                                <td>
                                    {{$item->name ?? 'N/A'}}
                                </td>
                                <td>
                                <span class="kt-nav__link-icon"><img
                                        src="{{asset('uploads/lang/'.$item->image)}}" class="" height="30px"
                                        alt=""/></span>
                                </td>
                                <td>
                                    <div class="kanban-menu">
                                        <div class="dropdown">
                                            <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                    id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i class="feather icon-more-vertical-"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right action-btn"
                                                 aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                <a class="dropdown-item"
                                                   href="{{route('language.translate',$item->id)}}">
                                                    <i class="feather icon-refresh-ccw mr-2"></i>
                                                    @translate(Translate)
                                                </a>
                                                <a class="dropdown-item" href="{{route('language.default',$item->id)}}">
                                                    <i class="feather icon-edit-2 mr-2"></i>@translate(Set Default)</a>
                                                <a class="dropdown-item"
                                                   onclick="confirm_modal('{{ route('language.destroy', $item->id) }}')"
                                                   href="javascript:void()">
                                                    <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable -->
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">@translate(Language Setup)</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('language.store') }}"
                          method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="">
                                <label class="control-label">@translate(Name) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <input type="text" class="form-control" name="name" required
                                       placeholder="@translate(Ex: English)">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <label class="control-label">@translate(Code) <span class="text-danger">*</span></label>
                            </div>
                            <div class="">
                                <input type="text" class="form-control" name="code" required
                                       placeholder="@translate(Ex: en for english)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">@translate(Select Country) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control lang" name="image" required>
                                    <option value=""></option>
                                    @foreach(readFlag() as $item)
                                        @if ($loop->index >1)
                                            <option value="{{$item}}"
                                                    data-image="{{asset('uploads/lang/'.$item)}}"> {{flagRenameAuto($item)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12 text-right">
                                <button class="btn btn-primary btn-block" type="submit">@translate(Save)</button>
                            </div>
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


