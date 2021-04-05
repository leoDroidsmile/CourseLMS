@extends('layouts.master')
@section('title','Know About content')
@section('parentPageTitle', 'All Sliders')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Know About Content)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <a href="#!" onclick="forModal('{{ route("know.create") }}', '@translate(Content Create)')"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Add New content)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped- table-bordered table-hover">
                <thead class=" text-center">
                <tr>
                    <th>S/L</th>
                    <th>@translate(Icon)</th>
                    <th>@translate(Title)</th>
                    <th>@translate(Description)</th>
                    <th>@translate(alignment)</th>
                    <th>@translate(video link)</th>
                    <th>@translate(Image)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($knowAbouts as  $item)
                    <tr>
                        <td class=" text-center">{{ ($loop->index+1) }}</td>
                        <td><i class="{{$item->icon}}"></i></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->desc}}</td>
                        <td>{{$item->align}}</td>
                        <td>
                            @if($item->video)
                            <a href="{{$item->video}}" target="_blank" class="nav-link">@translate(show link)</a>
                            @endif
                        </td>
                        <td>
                            @if($item->image != null)
                            <img src="{{filePath($item->image)}}" class="img-fluid avatar-lg rounded-sm" ></td>
                           @endif

                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="#!"
                                           onclick="forModal('{{ route('know.edit', $item->id) }}', '@translate(Content Edit)')">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <a class="dropdown-item"
                                           onclick="confirm_modal('{{ route('know.destroy', $item->id) }}')"
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
                @endforelse
            </table>
        </div>
    </div>

@endsection
