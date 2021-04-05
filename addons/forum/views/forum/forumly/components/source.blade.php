<!-- Start Document Source Area -->
    <section>
        <div class="document-source-area themeix-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="single-box">
                            <div class="box-inner">
                                <img src="{{ asset('forum/forumly/images/icon1.png') }}" alt="box img">
                                <h3>@translate(QA Section)</h3>
                                <p>{{ forumPostCount() }} @translate(Questions) / {{ forumPostReplyCount() }} @translate(Answers)</p>
                                <a href="{{ route('forum.all.posts') }}" class="themeix-btn danger-bg">@translate(See All Questions)</a>
                            </div>
                            <div class="box-flip">
                              <div class="flip-box-innner">
                                <h3>@translate(Question Answer Section)</h3>
                                <p>@translate(There are questions that should be answered with a counter-question. There are questions that should be put aside.)</p>
                                <a href="{{ route('forum.all.posts') }}" class="themeix-btn danger-bg">@translate(See All Questions)</a>
                              </div>
                            </div>
                        </div>
                    </div>
                 
                    <div class="col-sm-6">
                        <div class="single-box">
                            <div class="box-inner">
                                <img src="{{ asset('forum/forumly/images/icon3.png') }}" alt="box img">
                                <h3>@translate(Latest Updates)</h3>
                                <p>{{ latestForumPostCount() }} @translate(Updates) / {{ latestFostReplyCount() }} @translate(Comments)</p>
                            </div>
                            <div class="box-flip">
                               <div class="flip-box-innner">
                                <h3>@translate(Latest Updates)</h3>
                                <p>@translate(Get the latest updated questions ans answers from forum.)</p>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Document Source Area -->