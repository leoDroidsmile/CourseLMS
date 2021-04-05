@extends('layouts.master')
@section('title','Payment Request List')
@section('parentPageTitle', 'All Student')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-2">
                    <div class="card-header">
                        <div class="float-left">
                            <h2 class="card-title">@translate(Affiliate Request list)</h2>
                        </div>
                    </div>
                    <div class="card-body t-div">
                        <table class="table table-bordered dataTable w-100">
                            <thead>
                            <tr>
                                <th>S/L</th>
                                <th>@translate(Name)</th>
                                <th>@translate(Date)</th>
                                <th>@translate(Status)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($request as  $item)
                                <tr>
                                    <td>{{ ($loop->index+1) + ($request->currentPage() - 1)*$request->perPage() }}</td>
                                    <td><a href="{{route('students.show',$item->user->id)}}">{{$item->user->name}}</a><br>
                                    {{$item->user->email}}</td>
                                    <td>{{date('d-M-y',strtotime($item->created_at)) ?? 'N/A'}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="dropdown-item text-danger"
                                               href="{{route('affiliate.reject',$item->id)}}">
                                                <i class="feather flaticon-cancel mr-2"></i>@translate(reject)</a>
                                            <a class="dropdown-item "
                                               href="{{route('affiliate.active',$item->id)}}">
                                                <i class="feather icon-check-circle mr-2"></i>@translate(Active)</a>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <div class="float-left">
                                {{ $request->links() }}
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="card m-2">
            <div class="card-header">
                <div class="float-left">
                    <h2 class="card-title">@translate(Affiliate confirm list)</h2>
                </div>
            </div>

            <div class="card-body t-div">
                <table class="table  table-bordered table-hover text-center dataTable w-100">
                    <thead>
                    <tr>
                        <th>S/L</th>
                        <th>@translate(Name)</th>
                        <th>@translate(Date)</th>
                        <th>@translate(action)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($confirm as  $item)
                        <tr>
                            <td>{{ ($loop->index+1) + ($confirm->currentPage() - 1)*$confirm->perPage() }}</td>
                            <td><a href="{{route('students.show',$item->user->id)}}">{{$item->user->name}}</a><br>
                                {{$item->user->email}}</td>
                            <td>{{date('d-M-y',strtotime($item->created_at)) ?? 'N/A'}}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="dropdown-item text-danger w-0"
                                       href="{{ route('affiliate.reject', $item->id) }}">
                                        <i class="feather flaticon-cancel mr-2">@translate(Reject)</i></a>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                    <div class="float-left">
                        {{ $confirm->links() }}
                    </div>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-2">
                    <div class="card-header">
                        <div class="float-left">
                            <h2 class="card-title">@translate(Affiliate  Rejected list)</h2>
                        </div>
                    </div>
                    <div class="card-body t-div">
                        <table class="table table-bordered  dataTable w-100">
                            <thead>
                            <tr>
                                <th>S/L</th>
                                <th>@translate(Name)</th>
                                <th>@translate(Date)</th>
                                <th>@translate(Status)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cancel as  $item)
                                <tr>
                                    <td>{{ ($loop->index+1) + ($cancel->currentPage() - 1)*$cancel->perPage() }}</td>
                                    <td><a href="{{route('students.show',$item->user->id)}}">{{$item->user->name}}</a><br>
                                        {{$item->user->email}}</td>
                                    <td>{{date('d-M-y',strtotime($item->created_at)) ?? 'N/A'}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="dropdown-item w-0"
                                               href="{{ route('affiliate.active', $item->id) }}">
                                                <i class="feather icon-check-circle mr-2"></i>@translate(Active)</a>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <div class="float-left">
                                {{ $cancel->links() }}
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
