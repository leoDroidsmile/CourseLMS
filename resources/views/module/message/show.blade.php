@extends('layouts.master')
@section('title','Chat With Student')
@section('parentPageTitle', 'All Ticket')

@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Chat With Student)</h2>
            </div>
        </div>

        <div class="card-body">
            <!-- Start col -->
            <div class="">
                <div class="chat-detail">
                    <div class="chat-head">
                        <ul class="list-unstyled mb-0">
                            <li class="media">
                                <img class="align-self-center mr-3 text-center rounded-circle" height="auto" width="100"
                                     src="{{asset($student->image ?? 'assets/images/users/girl.svg')}}"
                                     alt="image">
                            </li>
                        </ul>
                    </div>
                    <div class="chat-body">
                        @foreach($messages as $item)
                            <div
                                class="chat-message {{$item->user_id == \Illuminate\Support\Facades\Auth::id() ? 'chat-message-right' : 'chat-message-left'}}">
                                <div class="chat-message-text">
                                    <span>{!! $item->content!!}</span>
                                </div>
                                <div class="chat-message-meta">
                                    <span>{{date('H:i',strtotime($item->created_at))}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="chat-bottom">
                        <div class="chat-messagebar">
                            <form action="{{route('messages.replay')}}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input name="enroll_id" type="hidden" value="{{$enroll_id}}">
                                    <input type="text" name="message" class="form-control @error('message') is-invalid @enderror"
                                           placeholder="@translate(Type a message...)" aria-label="Text" value="{{old('message')}}">
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
