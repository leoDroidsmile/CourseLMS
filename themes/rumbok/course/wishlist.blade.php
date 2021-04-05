@extends('rumbok.app')
@section('content')

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                 class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>@translate(Wishlist)</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> / @translate(Wishlist)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (Session::has('message'))
        <div class="alert alert-info text-center">{{ Session::get('message') }}</div>
    @endif
    <!-- Course Section Starts -->
    <div class="course-page-content padding-120">
        <div class="container">
            <div class="page-content-top margin-bottom-40">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="course-tab">
                            <ul>
                                <li>
                                    <a href="{{route('my.courses')}}" class=" pointer">@translate(All Courses)</a>
                                </li>
                                <li class="active">
                                    <a href="{{route('my.wishlist')}}" class="active pointer">@translate(Wishlist)</a>
                                </li>
                                @if(env('SUBSCRIPTION_ACTIVE') == "YES")
                                    <li>
                                        <a href="{{route('my.subscription')}}" class="pointer">
                                            @translate(Subscription Courses)
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                @forelse($wishlists as $item)
                    <div class="col-md-4" id="wish-{{$item->id}}">
                        <div class="single-course-item">
                            <div class="course-image">
                                <img src="{{ filePath($item->course->image) }}" alt="image">
                            </div>
                            <div class="course-content margin-top-30">
                                <div class="course-title">
                                    <h4>{{ Str::limit($item->course->title,50) }}</h4>
                                </div>
                                <div class="course-instructor-rating margin-top-20">
                                    <div class="course-instructor">
                                        <img src="{{filePath($item->course->relationBetweenInstructorUser->image)}}"
                                             alt="instructor">
                                        <h6>{{$item->course->relationBetweenInstructorUser->name}}</h6>
                                    </div>
                                    <div class="course-rating">
                                        <ul>
                                            @for ($i = 0; $i < enrolmentStare(\App\Model\Enrollment::where('course_id',$item->course->id)->count()); $i++)
                                                <li><i class="fa fa-star"></i></li>
                                            @endfor
                                        </ul>
                                        <span>{{number_format(enrolmentStare(\App\Model\Enrollment::where('course_id',$item->course->id)->count()),1)}}({{\App\Model\Enrollment::where('course_id',$item->course->id)->count()}})</span>
                                    </div>
                                </div>
                                <div class="course-info margin-top-20">

                                    <div class="course-video">
                                        <i class="fa fa-play-circle-o"></i>
                                        <span>{{$item->course->classes->count()}} @translate(lectures)</span>
                                    </div>
                                    <div class="course-time">
                                        @php
                                            $total_duration = 0;
                                            foreach ($item->course->classes as $items){
                                                $total_duration +=$items->contents->sum('duration');
                                            }
                                        @endphp
                                        <i class="fa fa-clock-o"></i>
                                        <span>{{duration($total_duration)}}</span>
                                    </div>
                                </div>
                                <div class="course-price-cart margin-top-20">
                                    <div class="course-price">
                                        @if($item->course->is_free)
                                            <span
                                                class="span-big">@translate(Free)</span>
                                        @else
                                            @if($item->course->is_discount)
                                                <span
                                                    class="span-big">{{formatPrice($item->course->discount_price)}}</span>
                                                <span class="span-cross">{{formatPrice($item->course->price)}}</span>
                                            @else
                                                <span
                                                    class="span-big">{{formatPrice($item->course->price)}}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="hover-state">
                                        <span class="heart-icon">
                                            @auth()
                                                <span
                                                    class="la icon-color la-heart-o love-span-{{$item->course->id}} love-{{$item->course->id}}"
                                                    onclick="removeToWishlist({{$item->id}},'{{route('remove.wishlist',$item->id)}}')"></span>

                                            @endauth
                                        </span>
                                <span class="title-tag">@translate(by instructor)</span>
                                <div class="course-title margin-top-10">
                                    <h4>
                                        <a href="{{route('course.single',$item->course->slug)}}">{{ Str::limit($item->course->title,58) }}</a>
                                    </h4>
                                </div>
                                <div class="course-price-info margin-top-20">
                                    @if(bestSellingTags($item->course->id))
                                        <span class="best-seller">@translate(best seller)</span>
                                    @endif
                                    <span class="course-category"><a
                                            href="{{route('course.category',$item->course->category->slug)}}">{{$item->course->category->name}}</a></span>
                                    <span class="course-price">
                                                @if($item->course->is_free)
                                            <span
                                                class="span-big">@translate(Free)</span>
                                        @else
                                            @if($item->course->is_discount)
                                                <span
                                                    class="span-big">{{formatPrice($item->course->discount_price)}}</span>
                                            @else
                                                <span
                                                    class="span-big">{{formatPrice($item->course->price)}}</span>
                                            @endif
                                        @endif
                                            </span>
                                </div>
                                <div class="course-info margin-top-30">
                                    <div class="course-enroll">
                                        <span>@translate(enrolled) {{\App\Model\Enrollment::where('course_id',$item->course->id)->count()}}</span>
                                    </div>
                                    <div class="course-video">
                                        <i class="fa fa-play-circle-o"></i>
                                        <span>{{$item->course->classes->count()}} @translate(lectures)</span>
                                    </div>
                                    <div class="course-time">
                                        <i class="fa fa-clock-o"></i>
                                        @php
                                            $total_duration = 0;
                                            foreach ($item->course->classes as $itemd){
                                                $total_duration +=$itemd->contents->sum('duration');
                                            }
                                        @endphp
                                        <span>{{duration($total_duration)}}</span>
                                    </div>
                                </div>
                                <ul class="margin-top-20">
                                    @foreach(json_decode($item->course->requirement) as $requirement)
                                        <li><i class="fa fa-circle-o"></i><span>{{$requirement}}.</span></li>
                                    @endforeach
                                </ul>
                                <div class="preview-button margin-top-20">
                                    <a href="{{route('course.single',$item->course->slug)}}" class="template-button">@translate(course
                                        preview)</a>

                                    @auth()
                                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                            <a href="#!"
                                               class="template-button margin-left-10 addToCart-{{$item->course->id}}"
                                               onclick="addToCart({{$item->course->id}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
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
                @empty

                    <div class="col-12 m-5">
                        <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
                    </div>

                @endforelse
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="template-pagination margin-top-20">
                        {{ $wishlists->links('rumbok.include.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
