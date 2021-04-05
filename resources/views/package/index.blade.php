@extends('layouts.master')
@section('title','Package List')
@section('parentPageTitle', 'All Package')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Package List)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <a href="#!"
                           onclick="forModal('{{ route("packages.create") }}', '@translate(Packages Create)')"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Create New Package)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>@translate(Image)</th>
                    <th>@translate(Price)</th>
                    <th>@translate(Commission) %</th>
                    <th>@translate(Info)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($packages as  $item)
                    <tr>
                        <td>{{ ($loop->index+1)}}</td>
                        <td><img src="{{filePath($item->image)}}" alt="image" class="rounded-circle avatar-lg"></td>
                        <td>
                            {{formatPrice($item->price)}}
                        </td>
                        <td>
                            {{$item->commission}}%
                        </td>
                        <td class="font-weight-bold">
                            @translate(Admin will get) {{$item->commission}}% @translate(from each enrollment of a course)
                        </td>

                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item"
                                           onclick="forModal('{{ route('packages.edit', $item->id) }}','@translate(Package Update)')"
                                           href="#!">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <a class="dropdown-item"
                                           onclick="confirm_modal('{{ route('packages.destroy', $item->id) }}')"
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
