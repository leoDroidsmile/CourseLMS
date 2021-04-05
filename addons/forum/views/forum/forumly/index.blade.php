@extends('forum.forumly.layouts.app')
@section('forum_title')
    @translate(Forum)
@endsection

@section('content')

@includeWhen(true, forumComp('slider'))
@includeWhen(true, forumComp('source'))
@includeWhen(true, forumComp('topics'))


 @php
        $topics = App\Forum::latest()->take(6)->get();
        $all_topics = App\Forum::latest()->paginate(20);
    @endphp


    <!-- Start Questions Area -->
    <div class="question-area themeix-ptb">

        

        <div class="container">

             <div class="themeix-section-title">
                            <h2>@translate(Explore Questions)</h2>
                        </div>

            <div class="row">
                <!-- Start Question -->
                <div class="col-md-12">

                   

                    <div class="questions-wrapper">

                        

                        <div class="dwqa-container">
                            <div class="dwqa-questions-archive">
                                <form id="dwqa-search" action="{{ route('forum.search') }}" method="GET" class="dwqa-search">
                                    <input data-nonce="fc987a6f77" id="search" type="text" placeholder="What do you want to know?" name="qs" class="ui-autocomplete-input" autocomplete="off" required>
                                    <button type="search"><i class="fa fa-search"></i></button>
                                </form>


                                <div class="dwqa-questions-list">

                                    @foreach ($all_topics as $all_topic)
                                    <div class="dwqa-question-item">
                                        <header class="dwqa-question-title">
                                            <a href="{{ route('forum.single', $all_topic->id) }}">{{ $all_topic->title }}</a>
                                        </header>
                                        <div class="dwqa-question-meta">
                                            <span class="dwqa-status dwqa-status-open" title="Open">Open</span>
                                            <span><a href="javascript:;">{{ $all_topic->username->name }}</a> @translate(created at) {{ $all_topic->created_at->diffForHumans() }}</span>
                                            <span class="dwqa-question-category"> • <a href="{{ route('forum.category.posts', [$all_topic->categoryName->id, $all_topic->categoryName->slug]) }}" rel="tag">{{ $all_topic->categoryName->name }}</a></span>
                                        </div>
                                        <div class="dwqa-question-stats">
                                            <span class="dwqa-views-count"><strong>{{ post_views_count($all_topic->id) }}</strong>@translate(views)</span>
                                            <span class="dwqa-answers-count"><strong>{{ post_replies_count($all_topic->id) }}</strong>@translate(answers)</span>
                                            <span class="dwqa-votes-count"><strong>{{ helpful_count($all_topic->id) }}</strong>@translate(votes)</span>
                                        </div>
                                    </div>
                                    @endforeach

                                   
                                </div>


                                <div class="dwqa-questions-footer">
                                    <div class="dwqa-pagination">
                                        {{ $all_topics->links() }}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Question -->
             
            </div>
        </div>
    </div>
    <!-- End  Questions Area -->
   
@endsection