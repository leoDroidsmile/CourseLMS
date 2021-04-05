<div class="col-md-3">
                    <div class="row">
                        <div class="blog-sidebar">
                            <div class="col-md-12 col-sm-6">
                                <aside id="dwqa-categories-2" class="widget widget_categories dwqa_widget dwqa_widget_categories sidebar-list">
                                    <h2 class="widget-title">@translate(Topics Categories)</h2>
                                    <ul>
                                        @forelse ($topics as $topic)
                                        <li><a href="{{ route('forum.category.posts', [$topic->categoryName->id, $topic->categoryName->slug]) }}">{{ $topic->categoryName->name }} ({{ forumCategoryCount($topic->category) }})</a></li>
                                        @empty

                                        @endforelse
                                    </ul>
                                </aside>
                            </div>
                            <div class="col-md-12 col-sm-6">
                                <aside class="widget dwqa-widget dwqa-popular-question">
                                    <div class="sidebar-popular-post dwqa-popular-questions sidebar-list">
                                        <h2 class="widget-title">@translate(Popular Questions)</h2>
                                        <ul>

                                            @foreach (popularQuestion() as $popularQuestion)
                                                @foreach (popularQuestions($popularQuestion->post_id) as $question)
                                                    <li><a href="{{ route('forum.single', $question->id) }}">{{ $question->title }}</a> <span>@translate(asked by) {{ $question->username->name }}</span></li>
                                                @endforeach
                                            @endforeach

                                        </ul>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>