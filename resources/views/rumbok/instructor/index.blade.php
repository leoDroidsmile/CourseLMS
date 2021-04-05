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
                    <h2>@translate(about instructor)</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> / @translate(about instructor)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructor Details Section Starts -->
    <section class="instructor-details-section padding-top-120">
        <div class="container">
            <div class="instructor-content-top">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="instructor-image">
                            <img src="{{ filePath($instructor->image) }}" alt="instructor">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="instructor-info">
                            <h3>{{ $instructor->name }}</h3>
                            <span class="instructor-tag d-none">UI & UX teacher</span>
                            <div class="instructor-social-link">
                                <ul>
                                    @if($instructor->fb)
                                        <li><a href="{{ $instructor->fb }}"><i class="fa fa-facebook"></i></a>
                                        </li>
                                    @endif
                                    @if($instructor->tw)
                                        <li><a href="{{ $instructor->tw }}"><i class="fa fa-twitter"></i></a>
                                        </li>
                                    @endif

                                    @if($instructor->linked )
                                        <li><a href="{{ $instructor->linked }}"><i
                                                    class="fa fa-linkedin"></i></a>
                                        </li>
                                    @endif

                                    @if($instructor->skype)
                                        <li><a href="{{ $instructor->skype }}"><i
                                                    class="fa fa-skype"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <p class="margin-top-20 d-none">Blanche has always been a passionate educator and instructor for students who have a talent for languages and technical science. founded SoftTech-IT in 1988 and trained over 5000 students online, many of whom are now successful businessmen, educators & technicians.</p>
                            <div class="instructor-education margin-top-20 d-none">
                                <h5>education</h5>
                                <ul>
                                    <li><i class="fa fa-arrow-circle-right"></i>MBA, Milstone School of Management, Milstone University.</li>
                                    <li><i class="fa fa-arrow-circle-right"></i>BSC, engineering, Technical University of Dhaka.</li>
                                </ul>
                            </div>
                            <div class="instructor-asset margin-top-30 text-center">
                                <div class="single-asset d-none">
                                    <div class="asset-image">
                                        <img src="assets/images/category-icon-3.png" alt="image">
                                    </div>
                                    <div class="assets-content">
                                        <h4>500</h4>
                                        <h6>total sdutent</h6>
                                    </div>
                                </div>
                                <div class="single-asset">
                                    <div class="asset-image">
                                        <img src="{{asset('asset_rumbok/images/counter-image-2.png')}}" alt="image">
                                    </div>
                                    <div class="assets-content">
                                        <h4>{{ App\Model\Course::where('user_id',$instructor->user_id)->count() }}</h4>
                                        <h6>@translate(courses)</h6>
                                    </div>
                                </div>
                                <div class="single-asset d-none">
                                    <div class="asset-image">
                                        <img src="assets/images/counter-image-1.png" alt="image">
                                    </div>
                                    <div class="assets-content">
                                        <h4>4.4</h4>
                                        <h6>reviews</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="instructor-content-bottom margin-top-60">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="bottom-left-part">
                            <div class="bottom-content-title">
                                <h4>@translate(about me)</h4>
                            </div>
                            <p>{!! $instructor->about !!}.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none">
                        <div class="instructor-skill-part">
                            <div class="bottom-content-title">
                                <h4>my skills</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-skill-item">
                                        <div class="progress-info d-flex justify-content-between">
                                            <div class="progress-info-left">
                                                <span>UI & UX design</span>
                                            </div>
                                            <div class="progress-info-right">
                                                <span>80%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-skill-item">
                                        <div class="progress-info d-flex justify-content-between">
                                            <div class="progress-info-left">
                                                <span>wordPress</span>
                                            </div>
                                            <div class="progress-info-right">
                                                <span>90%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-skill-item">
                                        <div class="progress-info d-flex justify-content-between">
                                            <div class="progress-info-left">
                                                <span>technology</span>
                                            </div>
                                            <div class="progress-info-right">
                                                <span>70%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-skill-item">
                                        <div class="progress-info d-flex justify-content-between">
                                            <div class="progress-info-left">
                                                <span>marketing</span>
                                            </div>
                                            <div class="progress-info-right">
                                                <span>60%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructor Courses Section Starts -->
    <section class="instructor-courses padding-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>@translate(courses by) <span>{{ $instructor->name }}</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse($courses as $course)
                    <div class="col-lg-4 col-md-6">
                        <div class="course-single-item single-course-item {{$loop->index++ %2 == 0 ? 'diffrent-bg' :'rumon'}}">
                            <div class="course-image">
                                <img src="{{ filePath($course->image) }}" alt="image">
                            </div>
                            <div class="course-content margin-top-30">
                                <div class="course-title">
                                    <h4>{{ Str::limit($course->title,50) }}</h4>
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
                                                <a href="#!"
                                                   onclick="addToCart({{$course->id}},'{{route('add.to.wishlist')}}')"
                                                   class="love-{{$course->id}}"><span
                                                        class="la icon-color la-heart-o icon-color love-span-{{$course->id}}"></span></a>
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
                                               onclick="addToCart({{$course->id}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
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
                    <div class="col-lg-4 col-md-6 m-5">
                        <img src="{{asset('no_data.png')}}" class="w-100 img-fluid">
                    </div>
                @endforelse
            </div>
            <div class="text-center">
                {{ $courses->links('rumbok.include.paginate') }}
            </div>
        </div>
    </section>


@endsection
