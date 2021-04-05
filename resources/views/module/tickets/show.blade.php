@extends('layouts.master')
@section('title','Support Ticket')
@section('parentPageTitle', 'All Ticket')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Support Ticket Chat)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                    <h2 class="card-title pr-5">@translate(Subject) : {{$ticket->subject ?? 'N/A'}}</h2>
                </div>
            </div>
        </div>

        <div class="card-body">
            <!-- Start col -->
            <div class="">
                <div class="chat-detail">

                    <div class="chat-body">
                        <div class="chat-day text-center mb-3">
                            <span class="badge badge-secondary">@translate(First Content)</span>
                        </div>
                        <div class="chat-day text-center mb-3">
                            <div class="chat-message-text badge badge-dark-inverse">
                                <span class="h5">{!! $ticket->content !!}</span>
                            </div>
                            <div class="chat-message-meta">
                                <span>{{date('H:i',strtotime($ticket->created_at))}}</span>
                            </div>
                        </div>
                        @foreach($ticket->replays as $item)
                            <div
                                class="chat-message {{$item->user_id == \Illuminate\Support\Facades\Auth::id() ? 'chat-message-right' : 'chat-message-left'}}">
                                <div class="chat-message-text">
                                    <span>{{$item->content}}</span>
                                </div>
                                <div class="chat-message-meta">
                                    <span>{{date('H:i',strtotime($item->created_at))}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="chat-bottom">
                        <div class="chat-messagebar">
                            <form action="{{route('tickets.replay')}}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input name="ticket_id" type="hidden" value="{{$ticket->id}}">
                                    <input type="text" name="contents" class="form-control @error('contents') is-invalid @enderror"
                                           placeholder="@translate(Type a message...)" aria-label="Text" value="{{old('contents')}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-round btn-primary-rgba" type="submit"
                                                id="button-addonsend"><i class="feather icon-send"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End col -->
        </div>
    </div>

@endsection
