<!-- Start Header -->
    <header>
        <!-- Start Mainmenu -->
        <div class="menu-area navbar-fixed-top ">
            <div class="container">
                <div class="row">
                    <div class="mainmenu-wrapper">
                        <!-- Start Header Logo -->
                        <div class="col-xs-12 col-md-3">
                            <div class="header-logo">
                                <a href="{{ route('homepage') }}">
                                    <img src="{{filePath(getSystemSetting('type_logo')->value)}}" alt="{{getSystemSetting('type_name')->value}}">
                                </a>
                            </div>
                        </div>
                        <!-- End Header Logo -->
                        <!-- Start Navigation -->
                        <div class="col-xs-12 col-md-9">
                            <div class="mainmenu">
                                <div class="navbar navbar-right">
                                    <div class="collapse navbar-collapse top-menu">
                                        <nav>
                                            <ul class="nav navbar-nav">
                                                <li><a href="{{ route('forum.index') }}">@translate(Forum)</a></li>
                                                <li><a href="{{ route('forum.all.posts') }}">@translate(All Questions)</a></li>
                                                <li><a href="{{ route('forum.create') }}">@translate(Ask Question)</a></li>
                                          
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Navigation -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu -->
        <!-- Start Mobile Menu Area -->
        <div class="col-xs-12 visible-xs">
            <div class="mobile-menu">
                <nav>
                    <ul class="nav navbar-nav">
                        <li><a href="blog.html">@translate(Forum)</a></li>
                        <li><a href="blog.html">@translate(All Questions)</a></li>
                        <li><a href="updates.html">@translate(Ask Question)</a></li>
                        <li><a href="contact.html">@translate(Blog)</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- End MObile Menu Area -->
    </header>
    <!-- End Header -->