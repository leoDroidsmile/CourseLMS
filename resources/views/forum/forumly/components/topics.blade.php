    @php
        $topics = App\Forum::latest()->take(6)->get();
    @endphp
    <!-- Start Topics Section Area -->
    <section>
        <div class="topics-section-area themeix-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <!-- Start Topics Link Area -->
                        <div class="topics-links">
                            <div class="themeix-section-title">
                                <h2>@translate(Explore Topics)</h2>
                            </div>
                            <div class="row">


                                @forelse ($topics as $topic)

                                <div class="col-md-4">
                                    <div class="single-links">
                                        <h4 class="list-title">{{ $topic->categoryName->name }} ({{ forumCategoryCount($topic->category) }})</h4>
                                        <ul>
                                            @foreach (forumCategory($topic->category)->take(12) as $post)
                                                <li>
                                                    <a href="{{ route('forum.single', $post->id) }}">{{ $post->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                    
                                @empty

                                <img src="{{ asset('forum/forumly/images/no-topic.jpg') }}" alt="NO TOPIC FOUND">
                                    
                                @endforelse

                                
                                
                                   
                                
                            </div>

                            <div class="topics-btn">
                                <a href="{{ route('forum.all.categories') }}" class="themeix-btn hover-bg">@translate(See All Topics)</a>
                                <a href="{{ route('forum.create') }}" class="themeix-btn primary-bg">@translate(Ask Question)</a>
                            </div>

                        </div>
                        <!-- End Topics Link Area -->
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- End Topics Section Area -->