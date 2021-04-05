@extends('layouts.master')
@section('title','Page Content List')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Page Content List)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <a href="{{route('pages.content.create',$id)}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Content Create)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped- table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@translate(Title)</th>
                    <th>@translate(Total Content)</th>
                    <th>@translate(Active)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($content as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) }}</td>
                        <td>{!! $item->title !!}</td>
                        <td>
                          {!! $item->body !!}

                        </td>
                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('pages.content.active')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-primary"
                                       id="category-switch" {{$item->active == true ? 'checked' : null}} />
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
                                        <a class="dropdown-item" href="{{route('pages.content.edit',$item->id)}}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <a class="dropdown-item"
                                           onclick="confirm_modal('{{ route('pages.content.destroy', $item->id) }}')"
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
                </tbody>

            </table>
        </div>
    </div>

@endsection
