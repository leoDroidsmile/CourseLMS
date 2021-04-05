@extends('rumbok.app')
@section('content')

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape" class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>@translate(blog)</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{url('/')}}">@translate(home)</a> / @translate(blog)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section class="blog-content-section padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-posts">
                        @foreach($blogs as $blog)
                        <div class="blog-single-post {{$loop->index++ %2 == 0 ? 'different-bg-color' :'rumon'}}">
                            @if($blog->img != null)
                            <div class="blog-thumbnail">
                                <a href="{{route('blog.details',$blog->id)}}">
                                    <img src="{{filePath($blog->img)}}" alt="thumbnail"></a>
                            </div>
                            @endif
                            <div class="blog-content-part">
                                <div class="blog-content-top">
                                    <div class="blog-date margin-right-20">
                                        <a href="#!">
                                            <i class="fa fa-calendar"></i>{{Carbon\Carbon::parse($blog->created_at)->format('d-M-Y')}}
                                        </a>
                                    </div>
                                    <div class="blog-tag margin-right-20">
                                        <a href="#!"><i class="fa fa-tags"></i>
                                        @foreach(json_decode($blog->tags) as $tag)
                                            {{$tag}},
                                            @endforeach
                                        </a>
                                    </div>
                                </div>
                                <div class="blog-title">
                                    <h3><a href="{{route('blog.details',$blog->id)}}">{{$blog->title}}</a></h3>
                                </div>
                                <div class="blog-content d-none">
                                    <p>Organizations today are in constant flux. Industries are consolidating, business
                                        models are emerging, new technologies are being developed, and consumer
                                        behaviors are evolving.</p>
                                </div>
                                <div class="blog-excerpt-link">
                                    <a href="{{route('blog.details',$blog->id)}}">@translate(read more)</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="template-pagination">
                        {{ $blogs->links('rumbok.include.paginate') }}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar">
                        <div class="single-widget author-widget">
                            @php
                                $user = \App\User::where('user_type','Admin')->first();
                            @endphp
                            @if($user->image != null)
                            <img src="{{filePath($user->image)}}" alt="image">
                            @endif
                            <div class="author-name margin-top-20">
                                <h4>{{$user->name}}</h4>
                            </div>
                            <div class="author-content margin-top-10 d-none">
                                Hi! I'm author of this post. Read my post, be in trend.
                            </div>
                            <div class="author-social-link margin-top-20">
                                <ul>
                                    @if(getSystemSetting('type_fb')->value != null)
                                        <li><a href="{{getSystemSetting('type_fb')->value}}" target="_blank"><i
                                                    class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if(getSystemSetting('type_tw')->value != null)
                                        <li><a href="{{getSystemSetting('type_tw')->value}}" target="_blank"><i
                                                    class="fa fa-twitter"></i></a></li>
                                    @endif
                                    @if(getSystemSetting('type_google')->value != null)
                                        <li><a {{getSystemSetting('type_google')->value}}><i class="fa fa-linkedin"></i></a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                        @if(request()->is('blog/posts'))
                        <div class="single-widget search-widget">
                            <div class="header-search">
                                <form method="get" action="">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                               placeholder="@translate(Blog search)" value="{{Request::get('search')}}">
                                        <button class="btn btn-primary" type="submit">
                                            @translate(Search)
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        <div class="single-widget recent-post-widget">
                            <div class="widget-title">
                                <h4>@translate(recent posts)</h4>
                            </div>
                            @foreach($blogs->take(4) as $blog)
                                <div class="single-recent-post">
                                    @if($blog->img != null)
                                    <div class="recent-post-image">
                                        <a href="{{route('blog.details',$blog->id)}}"><img
                                                src="{{filePath($blog->img)}}" alt="image"></a>
                                    </div>
                                    @endif
                                    <div class="recent-post-title">
                                        <div class="post-date">
                                            <a href="#!"><i class="fa fa-calendar"></i>
                                                {{Carbon\Carbon::parse($blog->created_at)->format('d-M-Y')}}
                                            </a>
                                        </div>
                                        <h5><a href="{{route('blog.details',$blog->id)}}">{{$blog->title}}</a></h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="single-widget category-widget">
                            <div class="widget-title">
                                <h4>@translate(all categories)</h4>
                            </div>
                            <div class="category-items">
                                <ul>
                                    @foreach($categories as $category)
                                        <li><a href="{{route('blog.category',$category->id)}}"
                                               class="{{$loop->index++ == 0 ? 'border-none' : null}}">
                                                <i class="fa fa-circle"></i>{{$category->name}}
                                                ({{\App\Blog::where('category_id',$category->id)->where('is_active',1)->count()}}
                                                )</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="single-widget tag-widget">
                            <div class="widget-title">
                                <h4>@translate(tags)</h4>
                            </div>

                            <div class="tag-items">
                                <ul>
                                    @foreach(allBlogTags() as $tag)
                                        <li><a href="{{route('blog.tag',$tag)}}">{{$tag}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="single-widget banner-widget d-none">
                            <div class="banner-widget-logo">
                                <a href="index.html"><img src="assets/images/logo-white.png" alt="logo"></a>
                            </div>
                            <div class="banner-widget-title text-center margin-top-20">
                                <h4>start course in yourself today</h4>
                            </div>
                            <div class="banner-widget-button text-center margin-top-30">
                                <a href="#" class="template-button">instructor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
