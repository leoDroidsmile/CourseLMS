@extends('layouts.master')
@section('title','Message List')
@section('parentPageTitle', 'All Ticket')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="">@translate(Student Message Outbox)</h2>
            </div>

            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")

            <div class="float-right">
                <div class="row">
                    <a href="#!"
                        onclick="forModal('{{route('messages.create', 0)}}','@translate(To All Students)')"
                        class="btn btn-primary">
                        <i class="la la-mail"></i>
                        @translate(Send Message to All Students)
                    </a>
                </div>
            </div>
            @endif
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    {{-- <th>S/L</th> --}}
                    <th>@translate(To Student)</th>
                    <th>@translate(Message)</th>
                    <th>@translate(Date)</th>
                    {{-- <th>@translate(Action)</th> --}}
                </tr>
                </thead>
                <tbody>
                @forelse($messages as $item)
                    <tr>
                        {{-- <td>{{ ($loop->index+1) + ($enroll->currentPage() - 1)*$enroll->perPage() }}</td> --}}
                        <td>
                          {{studentDetails($item->user_id)->name ?? 'N/A'}}
                        </td>
                        <td>
                            {!! $item->content !!}
                        </td>
                        <td>
                            {{date('d-M-y',strtotime($item->created_at))}}
                        </td>
                        {{-- <td>
                            <div class="kanban-menu">
                                <div class="dropdown"> --}}
                                    {{-- <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button> --}}
                                    {{-- <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end"> --}}

                                        {{-- <a class="dropdown-item" href="{{ route('comments.delete', $item->id) }}">
                                            <i class="feather icon-delete mr-2"></i>@translate(Delete Message)</a> --}}

                                        {{-- <a class="dropdown-item" href="{{ route('messages.show', $item->id) }}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Messages)</a> --}}

                                        {{-- <a class="dropdown-item" onclick="forModal('{{route('messages.create', $item->user_id)}}','@translate(New Message)')">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Reply)</a> --}}
                                    {{-- </div>
                                </div>
                            </div>
                        </td> --}}
                    </tr>
                    
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <h4>@translate(NO Student Message FOUND)</h4>
                        </td>
                    </tr>
                @endforelse
                </tbody>
                {{-- <div class="float-left">
                    {{ $enroll->links() }}
                </div> --}}
            </table>
        </div>
    </div>

@endsection
