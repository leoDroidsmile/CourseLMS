@extends('layouts.master')
@section('title','Support Ticket')
@section('parentPageTitle', 'All Ticket')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Support Ticket List)</h2>
            </div>
            <div class="float-right">
                @if(\Illuminate\Support\Facades\Auth::user()->user_type != 'Admin')
                <div class="row">
                    <div class="col-md-7">
                        <form method="get" action="">
                            <div class="input-group  mb-2">
                                <input type="text" name="search" class="form-control"
                                       placeholder="@translate(Search by subject)"
                                       value="{{Request::get('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                        <div class="col-md-5 col-sm-12">
                            <a href="#!"
                               onclick="forModal('{{ route("tickets.create") }}', '@translate(Support Ticket Create)')"
                               class="btn btn-primary support-margin">
                                <i class="la la-plus"></i>
                                @translate(Need support?)
                            </a>
                        </div>
                </div>
                    @else
                    <form method="get" action="">
                        <div class="input-group  mb-2">
                            <input type="text" name="search" class="form-control"
                                   placeholder="@translate(Search by subject)"
                                   value="{{Request::get('search')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">@translate(Search)</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped- table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>@translate(Member)</th>
                    <th>@translate(Subject)</th>
                    <th>@translate(Date)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tickets as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) + ($tickets->currentPage() - 1)*$tickets->perPage() }}</td>
                        <td>
                            <a href="{{route('instructors.show',$item->user_id)}}">{{instructorDetails($item->user_id)->name ?? 'N/A'}}</a>
                        </td>
                        <td>
                            {{$item->subject}}
                            @if(\App\Model\SupportTicketReplay::where('ticket_id',$item->id)->count() >0 )
                              <span class="badge badge-dark">
                                  {{\App\Model\SupportTicketReplay::where('ticket_id',$item->id)->latest()->first() != null ?\App\Model\SupportTicketReplay::where('ticket_id',$item->id)->latest()->first()->user_id == \Illuminate\Support\Facades\Auth::id() ? 'Send' : 'Replay' : null}}
                              </span>
                            @endif
                        </td>
                        <td>
                            {{date('d-M-y',strtotime($item->created_at))}}
                        </td>
                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="{{ route('tickets.show', $item->id) }}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Messages)</a>
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
                <div class="float-left">
                    {{ $tickets->links() }}
                </div>
            </table>
        </div>
    </div>

@endsection
