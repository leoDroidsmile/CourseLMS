@extends('layouts.master')
@section('title','Users')
@section('parentPageTitle', 'sample')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')
    <!-- Content Header (Page header) -->



    <div class="card m-2">


        <div class="card-header">

            <div class="float-left">
                <h3>@translate(All Admins)</h3>
            </div>

            <div class="float-right">
                <a href="{{ route("users.create") }}" class="btn btn-primary">
                    <i class="la la-plus"></i>
                    @translate(Add New Admin User)
                </a>
            </div>
        </div>

        <div class="card-body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>@translate(Name)</th>

                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $item)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>@translate(Name) : {{$item->name}} <br> @translate(Email) : {{$item->email}}</td>

                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="{{ route('users.show', $item->id) }}">
                                            <i class="feather icon-eye mr-2"></i>@translate(Show)</a>
                                        <a class="dropdown-item" href="{{ route('users.edit', $item->id) }}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        @if($item->user_type == "Admin")
                                            @if(\Illuminate\Support\Facades\Auth::id() != $item->id)
                                            <a class="dropdown-item"
                                               onclick="confirm_modal('{{ route('users.destroy', $item->id) }}')"
                                               href="javascript:void()">
                                                <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                @endif
                                        @else

                                            @if($item->user_type == "Instructor")
                                                <form action="{{route('users.banned')}}" method="post">
                                                    @csrf
                                                    <input name="id" value="{{$item->id}}" type="hidden">

                                                    <div class="card-header">
                                                        @if($item->banned == false)
                                                            <div class="float-right">
                                                                <button type="submit" class="btn btn-blue btn-warning" href="">@translate(Disable Account)</button>
                                                            </div>
                                                        @else
                                                            <div class="float-right">
                                                                <button type="submit" class="btn btn-blue btn-primary">@translate(Active Account)</button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </form>
                                            @else


                                                @endif
                                            @endif

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

@endsection

@section('js-link')

@stop

@section('page-script')

@stop
