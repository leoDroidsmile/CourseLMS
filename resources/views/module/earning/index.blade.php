@extends('layouts.master')
@section('title','Earning List')
@section('parentPageTitle', 'All Student')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Admin Earning List)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Purposes)" value="{{Request::get('search')}}">
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
            <table class="table table-striped- table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>@translate(Amount)</th>
                    <th class="text-left">@translate(Purposes)</th>
                    <th>@translate(Date)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($earning as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) + ($earning->currentPage() - 1)*$earning->perPage() }}</td>
                        <td>{{formatPrice($item->amount)}}</td>
                        <td class="text-left">
                            {{$item->purposes ?? 'N/A'}}
                        </td>
                        <td>
                            {{date('d-M-y',strtotime($item->created_at)) ?? 'N/A'}}
                        </td>

                    </tr>
                @empty
                    <tr></tr>
                    <tr>
                        <td><h3 class="text-center">@translate(No Data Found)</h3></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                @endforelse
                </tbody>
                <div class="float-left">
                    {{ $earning->links() }}
                </div>
            </table>
        </div>
    </div>

@endsection
