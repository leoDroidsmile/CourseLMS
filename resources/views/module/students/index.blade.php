@extends('layouts.master')
@section('title','Student')
@section('parentPageTitle', 'All Student')
@section('content')
    <div class="card mx-2 mb-3">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(All Students)</h3>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Search by name or email)"
                                       value="{{Request::get('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>@translate(Image)</th>
                    <th>@translate(Name)</th>
                    <th>@translate(Email)</th>
                    <th>@translate(Phone)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($students as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) + ($students->currentPage() - 1)*$students->perPage() }}</td>
                        <td>
                            @if($item->image != null)
                                <img src="{{filePath($item->image)}}" class="img-thumbnail rounded-circle avatar-lg"><br />
                            @else
                                <img src="" class="img-thumbnail rounded-circle avatar-lg" alt="avatar"><br />
                            @endif
                        </td>
                        <td>{{$item->name}}</td>
                        <td>
                            {{$item->email ?? 'N/A'}}
                        </td>
                        <td>
                            {{$item->phone ?? 'N/A'}}
                        </td>

                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="{{ route('students.show', $item->user_id) }}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Details)</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td><h3 class="text-center">No Data Found</h3></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                @endforelse
                </tbody>
                <div class="float-left">
                    {{ $students->links() }}
                </div>
            </table>
        </div>
    </div>

@endsection
