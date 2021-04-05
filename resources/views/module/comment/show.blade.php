@extends('layouts.master')
@section('title','Comment')
@section('parentPageTitle', 'All Ticket')

@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Replay the Course Comment)
                    <a target="_blank" href="{{ route('course.show',[$comment->course->id,$comment->course->slug])}}">
                        @translate(Course is): <p>{{$comment->course->title ?? 'N/A'}}</p>
                    </a>
                </h2>
            </div>
        </div>

        <div class="card-body">
            <!-- Start col -->
            <div class="">
                <div class="chat-detail">
                    <div class="chat-body">
                        <div
                            class="chat-message {{$comment->user_id == \Illuminate\Support\Facades\Auth::id() ? 'chat-message-right' : 'chat-message-left'}}">
                            <a target="_blank" class="{{route('messages.show', $comment->user_id)}}">
                                <div>
                                    <img class="align-self-center mr-3 text-center rounded-circle"
                                         src="{{filePath($comment->user->image) ?? 'assets/images/users/girl.svg'}}"
                                         height="60" width="60">
                                    <p>{{$comment->user->name}}</p>
                                </div>
                            </a>
                            <div class="chat-message-text">
                                <span>{{$comment->comment}}</span>
                            </div>
                            <div class="chat-message-meta">
                                <span>{{date('H:i',strtotime($comment->created_at))}}</span>
                            </div>
                        </div>

                        @foreach(\App\Model\CourseComment::where('replay',$comment->id)->get() as $item)
                            <div
                                class="chat-message {{$item->user_id == \Illuminate\Support\Facades\Auth::id() ? 'chat-message-right' : 'chat-message-left'}}">
                                <a target="_blank" class="{{route('messages.show', $item->user_id)}}">
                                    <div>
                                        <img class="align-self-center mr-3 text-center rounded-circle"
                                             src="{{filePath($item->user->image) ?? 'assets/images/users/girl.svg'}}"
                                             height="60" width="60">
                                        <p>{{$item->user->name}}</p>
                                    </div>
                                </a>
                                <div class="chat-message-text">
                                    <span>{{$item->comment}}</span>
                                </div>
                                <div class="chat-message-meta">
                                    <span>{{date('H:i',strtotime($item->created_at))}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="chat-bottom">
                        <div class="chat-messagebar">
                            <form action="{{route('comments.replay')}}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input name="course_id" type="hidden" value="{{$comment->course_id}}">
                                    <input name="comment_id" type="hidden" value="{{$comment->id}}">

                                    <input type="text" name="comment" required
                                           class="form-control @error('comment') is-invalid @enderror"
                                           placeholder="@translate(Type a message...)" aria-label="Text"
                                           value="{{old('comment')}}">
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
