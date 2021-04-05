@extends('forum.forumly.layouts.app')
@section('forum_title')
    @translate(All Questions)
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
                        <h2>Searching For "{{ $searchingFor }}"</h2>
                        <span class="sub-title"><a href="{{ route('forum.index') }}">@translate(Forum) </a> / {{ $searchingFor }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Pages Banner Area -->
    <!-- Start Questions Area -->
    <div class="question-area themeix-ptb">
        <div class="container">
            <div class="row">
                <!-- Start Question -->
                <div class="col-md-9">
                    <div class="questions-wrapper">
                        <div class="dwqa-container">
                            <div class="dwqa-questions-archive">
                                <form id="dwqa-search" action="{{ route('forum.search') }}" method="GET" class="dwqa-search">
                                    <input data-nonce="fc987a6f77" id="search" type="text" placeholder="What do you want to know?" name="qs" class="ui-autocomplete-input" autocomplete="off" required>
                                    <button type="search"><i class="fa fa-search"></i></button>
                                </form>

                                <div class="dwqa-questions-list">

                                    @forelse ($results as $all_topic)
                                    <div class="dwqa-question-item">
                                        <header class="dwqa-question-title">
                                            <a href="#">{{ $all_topic->title }}</a>
                                        </header>
                                        <div class="dwqa-question-meta">
                                            <span class="dwqa-status dwqa-status-open" title="Open">Open</span>
                                            <span><a href="#">{{ $all_topic->username->name }}</a> @translate(created at) {{ $all_topic->created_at->diffForHumans() }}</span>
                                            <span class="dwqa-question-category"> • <a href="#" rel="tag">{{ $all_topic->categoryName->name }}</a></span>
                                        </div>
                                        <div class="dwqa-question-stats">
                                            <span class="dwqa-views-count"><strong>{{ post_views_count($all_topic->id) }}</strong>@translate(views)</span>
                                            <span class="dwqa-answers-count"><strong>{{ post_replies_count($all_topic->id) }}</strong>@translate(answers)</span>
                                            <span class="dwqa-votes-count"><strong>{{ helpful_count($all_topic->id) }}</strong>@translate(votes)</span>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="mt-2">
                                        <img src="{{ asset('forum/forumly/images/bg3.jpg') }}" alt="No Result Found">
                                    </div>
                                    @endforelse

                                   
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Question -->
                <!-- Start Blog Sidebar -->
                @includeWhen(true, forumComp('sidebar'))
                <!-- End Blog Sidebar -->
            </div>
        </div>
    </div>
    <!-- End  Questions Area -->

   
@endsection

@section('js')
 
@endsection