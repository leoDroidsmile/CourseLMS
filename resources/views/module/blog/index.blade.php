@extends('layouts.master')
@section('title','blog')
@section('parentPageTitle', 'All Blog')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(All Blog)</h3>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Blog Title)" value="{{Request::get('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col">
                        <a href="{{route('blog.create')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Create Blog)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped- table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>@translate(Title)</th>
                    <th>@translate(Category)</th>
                    <th>@translate(Image)</th>
                    <th>@translate(Body)</th>
                    <th>@translate(Active)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($blog as  $item)
                    <tr>
                        <td>{{ ($loop->index+1)}}</td>
                        <td>
                            {{$item->title}}

                        </td>
                        <td>{{$item->category->name}}</td>
                        <td>
                            @if($item->img != null)
                                <img src="{{filePath($item->img)}}"
                                     class="img-thumbnail rounded-circle avatar-lg" alt="{{$item->img}}">
                            @endif
                        </td>
                        <td>
                            @foreach(json_decode($item->tags) as $tag)
                            <span class="badge badge-dark">{{$tag}}</span>
                            @endforeach
                        </td>
                        <td>{{\Illuminate\Support\Str::limit($item->body,50)}}</td>
                        <td>
                            <div class="switchery-list">
                                <input type="checkbox" data-url="{{route('blog.active')}}"
                                       data-id="{{$item->id}}"
                                       class="js-switch-success"
                                       id="category-switch" {{$item->is_active == true ? 'checked' : null}} />
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
                                        <a class="dropdown-item" href="{{route('blog.edit',$item->id)}}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <a class="dropdown-item" target="_blank" href="{{route('blog.details',$item->id)}}">
                                            <i class="feather flaticon-earth-globe mr-2"></i>@translate(Show The Post)</a>
                                        <a class="dropdown-item"
                                           onclick="confirm_modal('{{ route('blog.destroy', $item->id) }}')"
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
                    <tr></tr>
                    <tr>
                        <td><h3 class="text-center">@translate(No Data Found)</h3></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>

@endsection
