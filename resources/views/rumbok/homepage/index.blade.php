@extends('rumbok.app')
@section('content')


    <!--================================
         START SLIDER AREA
=================================-->

    <section class="hero-section">
        <div class="hero-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-4.png')}}" alt="shape"
                 class="hero-round-shape-4 item-moveTwo">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="hero-content">
                        <h1>{{$sliders->first()->title ?? ''}}</h1>
                        <span class="hero-tagline">{{$sliders->first()->sub_title ?? ''}}</span>
                        <div class="hero-button">
                            <a href="{{ route('course.filter') }}" class="template-button">@translate(browse course)</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <div class="hero-small-images">
                            <img src="{{asset('asset_rumbok/images/hero-small-image-1.png')}}" alt="image"
                                 class="hero-small-image-1">
                            <img src="{{asset('asset_rumbok/images/hero-small-image-2.png')}}" alt="image"
                                 class="hero-small-image-2">
                            <img src="{{asset('asset_rumbok/images/hero-small-image-3.png')}}" alt="image"
                                 class="hero-small-image-3">
                            <img src="{{asset('asset_rumbok/images/hero-small-image-4.png')}}" alt="image"
                                 class="hero-small-image-4">
                        </div>
                        <img style="background-image: url('{{filePath($sliders->first()->image)}}')" src="{{asset('asset_rumbok/images/hero-image-shape.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Feature Section Starts -->
    <section class="feature-section">
        <div class="container">
            <div class="row">
                @php
                    $color = array('green-icon','yellow-icon','blue-icon');
                    $i = 0;
                @endphp
                @foreach(\App\KnowAbout::where('align','top')->get()->take(3) as $topContent)
                <div class="col-lg-4">
                    <div class="single-feature-item feature-item-1">
                        <div class="feature-icon template-icon {{$color[$loop->index++]}}">
                            <i class="{{$topContent->icon}}"></i>
                        </div>
                        <div class="feature-content">
                            <h4>{{$topContent->title}}</h4>
                            <p>{{$topContent->desc}}.</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--================================
            END SLIDER AREA
    =================================-->
{{--    {{print_r(allBlogTags())}}--}}
    <!--======================================
                START CATEGORY AREA
        ======================================-->
    <!-- Category Section Starts -->
    <section class="category-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>@translate(popular) <span>@translate(categories)</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($popular_cat as $item)
                    <div class="col-lg-3 col-md-6">
                        <a href="{{route('course.category',$item->slug)}}">
                            <div class="single-category-item">
                                <div class="category-image">
                                    <img src="{{ filePath($item->icon) }}" alt="image">
                                    <img src="{{asset('asset_rumbok/images/round-shape-3.png')}}" alt="shape"
                                         class="feature-round-shape-3">
                                </div>
                                <div class="category-title margin-bottom-10">
                                    <h4>{{$item->name}}</h4>
                                </div>
                                <span>{{$item->courses->count()}} @translate(course(S))</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- end courses-area -->
    <!--======================================
            END CATEGORY AREA
    ======================================-->


    <!--======================================
            START COURSE AREA
    ======================================-->

    <section class="course-section gradient-bg padding-top-115 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center margin-bottom-40">
                        <h2>@translate(see our) <span>@translate(popular courses)</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="popular-course-tab">
                        <ul>
                            @php
                                $i=0;
                            @endphp
                            @foreach($cat as $item)
                                <li class="{{$i == 0 ? 'active':''}}"
                                    data-filter="{{$i == 0 ? '*':'.tab-'.$i}}">{{$item == "Best Selling" ? 'All Course' :$item }}</li>
                                <span class="invisible">{{$i++}}</span>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row grid h-500">
                @php
                    $j=1;
                @endphp
                @foreach($course as $items)
                    @if($items->count() > 0)
                        @foreach($items->take(2) as $course)
                            <div class="col-lg-4 col-md-6 grid-item tab-{{$j}}">
                                <div class="course-single-item single-course-item {{$loop->index++ %2 == 0 ? 'diffrent-bg' :'rumon'}}">
                                    <div class="course-image">
                                        <img src="{{ filePath($course->image) }}" alt="image">
                                    </div>
                                    <div class="course-content margin-top-30">
                                        <div class="course-title">
                                            <h4>{{ Str::limit($course->title, 50) }}</h4>
                                        </div>
                                        <div class="course-instructor-rating margin-top-20">
                                            <div class="course-instructor">
                                                <img src="{{filePath($course->relationBetweenInstructorUser->image)}}" alt="instructor">
                                                <h6>{{$course->relationBetweenInstructorUser->name}}</h6>
                                            </div>
                                            <div class="course-rating">
                                                <ul>
                                                    @for ($i = 0; $i < enrolmentStare(\App\Model\Enrollment::where('course_id',$course->id)->count()); $i++)
                                                        <li><i class="fa fa-star"></i></li>
                                                    @endfor
                                                </ul>
                                                <span>{{number_format(enrolmentStare(\App\Model\Enrollment::where('course_id',$course->id)->count()),1)}}({{\App\Model\Enrollment::where('course_id',$course->id)->count()}})</span>
                                            </div>
                                        </div>
                                        <div class="course-info margin-top-20">

                                            <div class="course-video">
                                                <i class="fa fa-play-circle-o"></i>
                                                <span>{{$course->classes->count()}} @translate(lectures)</span>
                                            </div>
                                            <div class="course-time">
                                                @php
                                                    $total_duration = 0;
                                                    foreach ($course->classes as $item){
                                                        $total_duration +=$item->contents->sum('duration');
                                                    }
                                                @endphp
                                                <i class="fa fa-clock-o"></i>
                                                <span>{{duration($total_duration)}}</span>
                                            </div>
                                        </div>
                                        <div class="course-price-cart margin-top-20">
                                            <div class="course-price">
                                                @if($course->is_free)
                                                    <span
                                                        class="span-big">@translate(Free)</span>
                                                @else
                                                    @if($course->is_discount)
                                                        <span
                                                            class="span-big">{{formatPrice($course->discount_price)}}</span>
                                                        <span class="span-cross">{{formatPrice($course->price)}}</span>
                                                    @else
                                                        <span
                                                            class="span-big">{{formatPrice($course->price)}}</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hover-state">
                                        <span class="heart-icon">
                                            @auth()
                                                <span
                                                    class="la icon-color la-heart-o love-span-{{$course->id}} love-{{$course->id}}" onclick="addToCart({{$course->id}},'{{route('add.to.wishlist')}}')"></span>
                                            @endauth

                                            @guest()
                                                <a href="{{route('login')}}"><i class="fa fa-heart-o"></i></a>
                                            @endguest
                                        </span>
                                        <span class="title-tag">@translate(by instructor)</span>
                                        <div class="course-title margin-top-10">
                                            <h4>
                                                <a href="{{route('course.single',$course->slug)}}">{{ Str::limit($course->title,58) }}</a>
                                            </h4>
                                        </div>
                                        <div class="course-price-info margin-top-20">
                                            @if(bestSellingTags($course->id))
                                                <span class="best-seller">@translate(best seller)</span>
                                            @endif
                                            <span class="course-category"><a
                                                    href="{{route('course.category',$course->category->slug)}}">{{$course->category->name}}</a></span>
                                            <span class="course-price">
                                                @if($course->is_free)
                                                    <span
                                                        class="span-big">@translate(Free)</span>
                                                @else
                                                    @if($course->is_discount)
                                                        <span
                                                            class="span-big">{{formatPrice($course->discount_price)}}</span>

                                                    @else
                                                        <span
                                                            class="span-big">{{formatPrice($course->price)}}</span>
                                                    @endif
                                                @endif
                                            </span>
                                        </div>
                                        <div class="course-info margin-top-30">
                                            <div class="course-enroll">
                                                <span>@translate(enrolled) {{\App\Model\Enrollment::where('course_id',$course->id)->count()}}</span>
                                            </div>
                                            <div class="course-video">
                                                <i class="fa fa-play-circle-o"></i>
                                                <span>{{$course->classes->count()}} @translate(lectures)</span>
                                            </div>
                                            <div class="course-time">
                                                <i class="fa fa-clock-o"></i>
                                                @php
                                                    $total_duration = 0;
                                                    foreach ($course->classes as $item){
                                                        $total_duration +=$item->contents->sum('duration');
                                                    }
                                                @endphp
                                                <span>{{duration($total_duration)}}</span>
                                            </div>
                                        </div>
                                        <ul class="margin-top-20">
                                            @foreach(json_decode($course->requirement) as $requirement)
                                                <li><i class="fa fa-circle-o"></i><span>{{$requirement}}.</span></li>
                                            @endforeach
                                        </ul>
                                        <div class="preview-button margin-top-20">
                                            <a href="{{route('course.single',$course->slug)}}" class="template-button">@translate(course preview)</a>

                                            @auth()
                                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                    <a href="#!"
                                                       class="template-button margin-left-10 addToCart-{{$course->id}}"
                                                       onclick="addToCart({{$course->id}},'{{route('add.to.cart')}}')">@translate(Add
                                                        to cart)</a href="#!">
                                                @else
                                                    <a href="{{route('login')}}"
                                                       class="template-button margin-left-10">@translate(Add to cart)</a>
                                                @endif
                                            @endauth
                                            @guest()
                                                <a href="{{route('login')}}"
                                                   class="template-button margin-left-10">@translate(Add to cart)</a>
                                            @endguest
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <span class="invisible">{{$j++}}</span>
                @endforeach

            </div>
        </div>
    </section>



    <!-- CounterUp Section Starts -->
    <section class="counterup-section">
        <div class="container">
            <div class="counterup-content common-section padding-top-60 padding-bottom-30">
                <div class="counter-shape">
                    <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape" class="round-shape-2">
                    <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="plus-sign item-rotate">
                    <img src="{{asset('asset_rumbok/images/round-shape-3.png')}}" alt="shape" class="round-shape-3">
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-4 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('asset_rumbok/images/counter-image-1.png')}}" alt="image">
                            </div>
                            <div class="single-counterup-content">
                                <div class="counter-number">
                                    <h3 class="title counter">{{\App\User::where('user_type','Instructor')->where('verified',true)->get()->count()}}</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <span>@translate(expert instructors)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('asset_rumbok/images/category-icon-3.png')}}" alt="image">
                            </div>
                            <div class="single-counterup-content">
                                <div class="counter-number">
                                    <h3 class="title counter">{{\App\Model\Enrollment::count()}}</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <span>@translate(students enrolled)</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('asset_rumbok/images/category-icon-6.png')}}" alt="image">
                            </div>
                            <div class="single-counterup-content">
                                <div class="counter-number">
                                    <h3 class="title counter">{{\App\Model\Course::Published()->count()}}</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <span>@translate(total course)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructor Section Starts -->
    <section class="instructor-section gradient-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>@translate(top online) <span>@translate(instructors)</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\App\Model\Instructor::with('courses')->get()->shuffle()->take(4) as $instructor)
                    @if(\App\User::where('id',$instructor->user_id)->first() != null)
                    @if(\App\User::where('id',$instructor->user_id)->first()->verified == true)
                        <div class="col-lg-3 col-md-6">
                            <div class="single-instructor {{$loop->index++ %2 == 0 ? 'diffrent-bg-color' : ''}}">
                                <span class="instructor-sign">{{$instructor->name}}</span>
                                <div class="instructor-image">
                                    <a  href="{{route('single.instructor',$instructor->user->slug)}}"><img style="background-image: url('{{filePath($instructor->image)}}')"
                                           class="ins-thum"
                                            src="{{$loop->index++ %2 == 0 ? asset('asset_rumbok/images/instructor-shape1.png') :asset('asset_rumbok/images/instructor-shape2.png')}}" alt="image"></a>
                                </div>
                                <div class="instructor-content">
                                    <h4>
                                        <a href="{{route('single.instructor',$instructor->user->slug)}}">{{$instructor->name}}</a>
                                    </h4>
                                    <span>{{$instructor->courses->first()->category->name ?? ''}}</span>
                                </div>
                                <div class="hover-state">
                                    <ul>
                                        @if($instructor->fb)
                                            <li><a href="{{ $instructor->fb }}"><i class="fa fa-facebook"></i></a></li>
                                        @endif
                                        @if($instructor->tw)
                                            <li><a href="{{ $instructor->tw }}"><i class="fa fa-twitter"></i></a></li>
                                        @endif

                                        @if($instructor->linked )
                                            <li><a href="{{ $instructor->linked }}"><i class="fa fa-linkedin"></i></a>
                                            </li>
                                        @endif

                                        @if($instructor->skype)
                                            <li><a href="{{ $instructor->skype }}"><i class="fa fa-skype"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!--======================================
           START SUBSCRIPTION AREA
   ======================================-->
    @if (subscriptionActive())
        <section class="package-area section--padding">
            <div class="container">
                <div class="row">

                    @foreach ($subscriptions as $subscription)
                        <div class="col-lg-4 column-td-half">
                            <div class="package-item package-item-active">

                                @if ($subscription->popular == true)
                                    <div class="package-tooltip">
                                        <span class="package__tooltip">@translate(Recommended)</span>
                                    </div><!-- end package-tooltip -->
                                @endif

                                <div class="package-title text-center">
                                    <h3 class="package__price"><span>{{ formatPrice($subscription->price) }}</span></h3>
                                    <h3 class="package__title">{{ $subscription->name }}</h3>
                                </div><!-- end package-title -->

                                <ul class="list-items margin-bottom-35px">
                                    @foreach (json_decode($subscription->description) as $item)
                                        <li><i class="la la-check"></i> {{ $item }}</li>
                                    @endforeach
                                </ul>

                                <div class="btn-box">
                                    <a href="{{ route('subscription.frontend', $subscription->duration) }}"
                                       class="theme-btn">{{ App\SubscriptionCourse::where('subscription_duration','LIKE','%'.$subscription->duration.'%')->count() }}
                                        Courses</a>
                                    <form action="{{ route('subscription.cart') }}" method="get">
                                        @csrf

                                        <input type="hidden" value="{{ $subscription->duration }}"
                                               name="subscription_package">
                                        <input type="hidden" value="{{ $subscription->price }}"
                                               name="subscription_price">
                                        <input type="hidden" value="{{ $subscription->id }}" name="subscription_id">
                                        @foreach (App\SubscriptionCourse::where('subscription_duration','LIKE','%'.$subscription->duration.'%')->get() as $item)
                                            <input type="hidden" name="course_id[]" value="{{ $item->course_id }}">
                                        @endforeach

                                        @auth
                                            @if (!App\SubscriptionEnrollment::where('user_id', Auth::user()->id)->where('subscription_package', $subscription->duration)->exists())
                                                <button type="submit" class="theme-btn mt-3">@translate(choose plan)
                                                </button>
                                            @else
                                                <button type="button" disabled class="theme-btn mt-3">
                                                    @translate(Purchased)
                                                </button>
                                            @endif
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}" class="theme-btn mt-3">@translate(choose
                                                plan)</a>
                                        @endguest


                                    </form>
                                    <p class="package__meta">@translate(no hidden charges)!</p>
                                </div>

                            </div><!-- end package-item -->
                        </div><!-- end col-lg-4 -->
                    @endforeach

                </div><!-- end row -->
            </div><!-- end container -->
        </section>
    @endif
    <!--======================================
            END SUBSCRIPTION AREA
    ======================================-->

    <!-- About Section Starts -->
    <section class="about-section padding-top-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>@translate(know about) <span>@translate(courses)</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="about-content-left">
                        @php
                            $color = array('green-icon','yellow-icon','blue-icon');
                            $i = 0;
                        @endphp
                        @foreach(\App\KnowAbout::where('align','left')->get()->take(3) as $leftContent)
                            <div class="about-single-content">
                                <div class="content-top">
                                    <div class="content-icon template-icon {{$color[$loop->index++]}}">
                                        <i class="{{$leftContent->icon}}"></i>
                                    </div>
                                    <h5>{{$leftContent->title}}</h5>
                                </div>
                                <p class="margin-top-10">{{$leftContent->desc}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4">
                    @php
                        $videoContent = \App\KnowAbout::where('align','center')->first()
                    @endphp
                    @if( $videoContent != null)
                        <div class="video-popup-area">
                            <div class="video-play-button">
                                <a href="{{$videoContent->video}}" class="button-video">
                                    <i class="fa fa-play item-ripple"></i>
                                </a>
                            </div>
                            <img
                                src="{{$videoContent->image == null ? filePath('asset_rumbok/images/about-image.png') : filePath($videoContent->image) }}"
                                alt="image">
                            <div class="image-absolute">
                                <img src="{{filePath('asset_rumbok/images/hero-small-image-4.png')}}" alt="image"
                                     class="top-absolute">
                                <img src="{{filePath('asset_rumbok/images/hero-small-image-2.png')}}" alt="image"
                                     class="bottom-absolute">
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="about-content-right">
                        @foreach(\App\KnowAbout::where('align','right')->get()->take(3) as $leftContent)
                            <div class="about-single-content">
                                <div class="content-top">
                                    <div class="content-icon template-icon {{$color[$loop->index++]}}">
                                        <i class="{{$leftContent->icon}}"></i>
                                    </div>
                                    <h5>{{$leftContent->title}}</h5>
                                </div>
                                <p class="margin-top-10">{{$leftContent->desc}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(env('BLOG_ACTIVE') === "YES")
    <!-- News Section Starts -->
    <section class="blog-section padding-top-80 padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>@translate(latest news) & <span>@translate(article)</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(\App\Blog::where('is_active',1)->orderBy('id')->get()->take(3) as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-single-item">
                        @if($blog->img != null)
                        <div class="single-blog-image">
                            <a href="{{route('blog.details',$blog->id)}}"><img src="{{filePath($blog->img)}}" alt="blog"></a>
                        </div>
                        @endif
                        <div class="blog-meta">
                            <ul>
                                <li><a href="#!"><i class="fa fa-contao"></i>{{$blog->category->name}}</a></li>
                                <li><a href="#!"><i class="fa fa-tags"></i>@foreach(json_decode($blog->tags) as $tag){{$tag}},@endforeach</a></li>
                            </ul>
                        </div>
                        <div class="single-blog-content">
                            <h4 class="title"><a href="{{route('blog.details',$blog->id)}}">{{$blog->title}}</a></h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-button text-center margin-top-20">
                        <a href="{{route('blog.all')}}" class="template-button">@translate(see more blog)</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif



@endsection


