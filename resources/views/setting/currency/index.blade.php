@extends('layouts.master')
@section('title','Currency')
@section('parentPageTitle', 'All')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card m-2">
            <div class="card-header">
                <h2 class="card-title">
                    @translate(Setup Currency Setting)</h2>
            </div>
            <div class="card-body col-md-6 offset-3">
                <form method="post" action="{{route('currencies.default')}}">
                    @csrf

                        <label class="label">@translate(Select Default)</label>
                        <input type="hidden" value="default_currencies" name="type_default">
                        <select class="form-control select2 w-75" name="default">
                            <option value=""></option>
                            @foreach($dCurrencies as $item)
                                <option
                                    value="{{$item->id}}" {{getSystemSetting('default_currencies')->value == $item->id ? 'selected' : null}}>{{$item->symbol}} {{$item->code}}</option>
                            @endforeach
                        </select>
                        <div class="m-2 float-right">
                            <button class="btn btn-primary" type="submit">@translate(Save)</button>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>
<div class="card m-2">
    <div class="card-header">
        <div class="float-left">
            <h2 class="card-title">
                @translate(Currency List)</h2>
        </div>
        <div class="float-right">
            <a href="javascript:void()" onclick="forModal('{{route("currencies.create") }}','@translate(Create Currency)')" class="btn btn-primary">
                <i class="la la-plus"></i>
                @translate(Create A Currency)
            </a>
        </div>
    </div>
    <div class="card-body table-responsive">
        <!-- there are the main content-->
        <table class="table table-striped- table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>S/L</th>
                    <th>
                        @translate(Name)</th>
                    <th>
                        @translate(Symbol)</th>
                    <th>
                        @translate(Code)</th>
                    <th>
                        @translate(Rate)</th>
                    <th>
                        @translate(Align)</th>
                    <th>
                        @translate(Publish)</th>
                    <th>
                        @translate(Action)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($currencies as $item)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->symbol}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{$item->rate}}</td>
                    <td>
                        <label class="rocker rocker-small">
                            <input type="checkbox" data-id="{{$item->id}}" data-url="{{route('currencies.align')}}" {{$item->align == true ? 'checked':null}}>
                            <span class="switch-left">@translate(Left)</span>
                            <span class="switch-right">@translate(Right)</span>
                        </label>
                    </td>
                    <td>
                        <input type="checkbox" data-id="{{$item->id}}" data-url="{{route('currencies.published')}}" class="js-switch-primary" {{$item->is_published == true ? 'checked':null}}>
                    </td>
                    <td>
                        <div class="kanban-menu">
                            <div class="dropdown">
                                <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button" id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                <div class="dropdown-menu dropdown-menu-right action-btn" aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                    <a class="dropdown-item" href="#!" onclick="forModal('{{ route('currencies.edit', $item->id) }}','@translate(Currency Update)')">
                                        <i class="feather icon-edit-2 mr-2"></i>
                                        @translate(Edit)</a>

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
                    <td>
                        <h3 class="text-center">
                            @translate(No data Found)</h3>
                    </td>
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



@section('js-link')

@stop
