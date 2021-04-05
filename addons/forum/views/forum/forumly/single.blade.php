@extends('forum.forumly.layouts.app')
@section('forum_title')
    @translate(Forum)
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')

    @php
        $topics = App\Forum::latest()->take(6)->get();
        $all_topics = App\Forum::latest()->paginate(20);
    @endphp

<!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title">
                        <h2>{{ $single_post->title }}</h2>
                        <span class="sub-title"><a href="{{ route('forum.index') }}">Home </a> / {{ $single_post->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Pages Banner Area -->
    <!-- Start Answers Area -->
    <div class="answers-area themeix-ptb">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="answers-wrapper">
                        <div class="dwqa-single-question">
                            <div class="dwqa-breadcrumbs">
                                <a href="{{ route('forum.all.posts') }}">Questions</a>
                                <span class="dwqa-sep"> › </span>
                                <a href="{{ route('forum.category.posts', [$single_post->categoryName->id, $single_post->categoryName->slug]) }}">Category : {{ $single_post->categoryName->name }}</a>
                                <span class="dwqa-sep"> › </span>
                                <span class="dwqa-current">{{ $single_post->title }}</span>
                            </div>
                            <!-- Start Question Item -->
                            <div class="dwqa-question-item">
                                
                                <div class="dwqa-question-meta">
                                    <span>
                                    <a href="javascript:;">
                                        @if (isset($single_post->username->image))
                                        <img src="{{ asset($single_post->username->image) }}" class="avatar avatar-48 w-8 photo">
                                        @else
                                            <img src="{{ asset('favicon.png') }}" class="avatar avatar-48 w-8 photo">
                                        @endif
                                     
                                    {{ $single_post->username->name }}
                                    </a>
                                    {{ $single_post->created_at->diffForhumans() }}
                                    </span>
                                    <span class="dwqa-question-actions"></span>
                                </div>
                                <div class="dwqa-question-content">
                                    <p>{!! $single_post->discussion !!}</p>
                                </div>
                                <footer class="dwqa-question-footer">
                                    <div class="dwqa-question-meta"></div>
                                </footer>

                                
                            </div>
                            <!-- End Questions Ityem -->
                            <!-- Start Answer item -->
                            <div class="dwqa-answers mt-70">
                                <div class="dwqa-answers-title"><span>{{ $total_reply }} Answers</span></div>
                                <div class="dwqa-answers-list">

                                    @foreach ($post_replies as $post_reply)
                                        

                                    <div class="dwqa-answer-item dwqa-best-answer" id="answer-{{ $post_reply->id }}">
                                        <div class="dwqa-answer-vote">

                                            <span class="dwqa-vote-count">
                                                {{  App\HelpfulAnswer::where('post_reply_id', $post_reply->id)->where('post_id', $single_post->id)->count() }}
                                            </span>

                                            @if (App\HelpfulAnswer::where('post_reply_id', $post_reply->id)->where('post_id', $single_post->id)->where('user_id', Auth::user()->id)->count() == 0)
                                                <a class="dwqa-vote dwqa-vote-up" href="{{ route('vote.up', [$post_reply->id, $single_post->id, 'vote-up']) }}">Vote Up</a>
                                            @else
                                                <a class="dwqa-vote dwqa-vote-up vote-up" href="javascript:;">Vote Up</a>
                                                <a class="dwqa-vote dwqa-vote-down" href="{{ route('vote.down', [$post_reply->id, $single_post->id , 'vote-down']) }}">Vote Down</a>
                                            @endif
                                            
                                        </div>

                                        @if (helpfulReplyId() == $post_reply->id)
                                        <span class="dwqa-pick-best-answer">Best Answer</span>
                                        @endif

                                        <div class="dwqa-comments">
                                            <div class="dwqa-comments-list">

                                                <div class="dwqa-comment">
                                                    <div class="dwqa-comment-meta">
                                                        
                                                        

                                                        @if (isset($post_reply->user->image))
                                                            <img alt="author" src="{{ asset($post_reply->user->image) }}" class="avatar avatar-16 photo" />
                                                            <strong>
                                                                {{ $post_reply->user->name }}
                                                            </strong>
                                                        @else
                                                            <img src="="{{ asset('forum/forumly/images/author2.png') }}" class="avatar avatar-48 w-8 photo">
                                                        @endif


                                                        replied {{ $post_reply->created_at->diffForHumans() }}
                                                        <div class="dwqa-comment-actions">
                                                        </div>
                                                    </div>
                                                    <p>{!! $post_reply->reply !!}
                                                    </p>
                                                </div>
                                                <!-- #comment-## -->
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach

                                    <hr>

                                    <h3>@translate(Your Answer)</h3>

                                    @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                                    <form method="post" action="{{ route('forum.post.reply') }}">
                                        @csrf
                                        <input type="hidden" value="{{ $single_post->id }}" id="post_id" name="post_id">
                                        <textarea class="summernote" name="reply" required></textarea>
                                        <br>
                                        <button type="submit" class="btn btn-primary">@translate(Submit Answer)</button>
                                    </form>

                                    
                                    <!-- End Answer item -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                
    


                <!-- Start Blog Sidebar -->
                @includeWhen(true, forumComp('sidebar'))
                <!-- End Blog Sidebar -->


            </div>
        </div>
    </div>
    <!-- End Answers Area -->
   
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        "use strict"
        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Write your answer here',
                tabsize: 3,
                height: 300
            });
        });
    </script>

@endsection