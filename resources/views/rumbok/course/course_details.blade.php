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
                    <h2>{{ $s_course->title }}</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> / {{ $s_course->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Details Section Starts -->
    <section class="course-details-section padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="course-details-sidebar">
                        <div class="course-details-widget">
                            <div class="course-widget-title">
                                <h4>@translate(course details)</h4>
                            </div>
                            <div class="course-widget-items">
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-usd"></i> @translate(price)</span>
                                    </div>
                                    <div class="item-right">
                                        @if($s_course->is_free)
                                            {{-- free price --}}
                                            <span class="price-current">@translate(Free)</span>
                                        @else
                                            @if($s_course->is_discount)
                                                {{-- discounted price --}}
                                                <span
                                                    class="price-current f-24">{{formatPrice($s_course->discount_price)}}</span>
                                            @else
                                                {{-- actual price --}}
                                                <span
                                                    class="price-current f-24">{{formatPrice($s_course->price)}}</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-user-circle"></i> @translate(instructor)</span>
                                    </div>
                                    <div class="item-right">
                                        <span>{{ $s_course->relationBetweenInstructorUser->name }}</span>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-clock-o"></i> @translate(duration)</span>
                                    </div>
                                    <div class="item-right">
                                        @php
                                            $total_duration = 0;
                                            foreach ($s_course->classes as $item){
                                                $total_duration +=$item->contents->sum('duration');
                                            }

                                        @endphp

                                        <span>{{duration($total_duration)}}</span>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-file-video-o"></i> @translate(lecture)</span>
                                    </div>
                                    <div class="item-right">
                                        <span>{{$s_course->classes->count()}}</span>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-shopping-cart"></i> @translate(enrolled)</span>
                                    </div>
                                    <div class="item-right">
                                        <span>{{ number_format(App\Model\Enrollment::where('course_id',$s_course->id)->count()) }} @translate(student)</span>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-language"></i> @translate(language)</span>
                                    </div>
                                    <div class="item-right">
                                        <span>{{ $s_course->language }}</span>
                                    </div>
                                </div>
                                @if($s_course->classes->count() > 0)
                                    <div class="single-item">
                                        <div class="item-left">
                                            <span><i class="fa fa-calendar"></i> @translate(Last updated)</span>
                                        </div>
                                        <div class="item-right">
                                            @if(empty($s_course->classes->last()->contents->last()->created_at))
                                                <span> {{$s_course->classes->last()->created_at->format('d M, Y')}}</span>
                                            @else
                                                <span> {{$s_course->classes->last()->contents->last()->created_at->format('d M, Y')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-tags"></i> @translate(Tags)</span>
                                    </div>
                                    <div class="item-right">
                                        <ul class="list-items">
                                            {{-- course tags --}}
                                            @foreach(json_decode($s_course->tag) as $tag)
                                                <li><a href="javascript:void()">{{ $tag ?? '' }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>


                            </div>
                            <div class="course-widget-buttons">

                                @auth()
                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                        <a href="#!"
                                           class="template-button addToCart-{{$s_course->id}}"
                                           onclick="addToCart({{$s_course->id}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
                                    @else
                                        <a href="{{route('login')}}" class="template-button">@translate(Add to cart)</a>
                                    @endif
                                @endauth
                                @guest
                                    <a href="{{route('login')}}" class="template-button">@translate(Add to cart)</a>

                                @endguest
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="course-details-title">
                        <h2>{{ $s_course->title }}</h2>
                    </div>
                    <div class="course-details-tab">
                        <div class="tab">
                            <ul>
                                <li class="tab-one active">
                                    <span>@translate(overview)</span>
                                </li>
                                <li class="tab-two">
                                    <span>@translate(curriculum)</span>
                                </li>
                                <li class="tab-three">
                                    <span>@translate(instructor)</span>
                                </li>
                                <li class="tab-four d-none">
                                    <span>@translate(review)</span>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content margin-top-30">
                            <div class="tab-one-content tab-content-bg overview-content lost active">
                                <div class="overview-title margin-top-30">
                                    {!! $s_course->short_description !!}
                                </div>

                                <div class="overview-video margin-top-30">
                                    <img src="{{ filePath($s_course->image) }}" alt="thumbnail">
                                    <div class="video-play-button-2">
                                        <a href="javascript:void(0)" data-toggle="modal" class="button-video"
                                           data-target=".preview-modal-form">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="overview-title margin-top-20">
                                    <h4>@translate(requirements)</h4>
                                </div>
                                <ul class="require-item">
                                    @foreach(json_decode($s_course->requirement) as $requirement)
                                        <li><i class="fa fa-square"></i><span>{{ $requirement }}</span></li>
                                    @endforeach
                                </ul>

                                <h4>@translate(course description)</h4>
                                <p class="margin-top-20">  {!! $s_course->big_description !!}</p>
                            </div>

                            <div class="tab-two-content tab-content-bg curriculum-content lost">
                                <h4>@translate(course content)</h4>
                                <div class="curriculum-accordion margin-top-30">
                                    <div class="accordion-wrapper tab-margin-bottom-50" id="accordionExample">
                                        @forelse ($s_course->classes as $item)
                                            <div class="card">
                                                <div class="card-header" id="heading{{ $item->id }}">
                                                    <a href="#" role="button" data-toggle="collapse"
                                                       data-target="#collapse{{ $item->id }}" aria-expanded="true"
                                                       aria-controls="collapse{{ $item->id }}">{{ $item->title }} <span>{{ $item->contents->count() }} @translate(lectures)</span></a>
                                                </div>
                                                <div id="collapse{{ $item->id }}"
                                                     class="collapse {{ $loop->first ? 'show' : '' }}"
                                                     aria-labelledby="heading{{ $item->id }}"
                                                     data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        @forelse ($item->contents as $content)
                                                            <div class="single-course-video" {{$content->id}}>
                                                                @if ($content->is_preview == 1)
                                                                    <a href="javascript:void(0)"
                                                                       class="button-video"
                                                                       onclick="forModal('{{ route('content.video.preview', $content->id) }}', '{{$content->title}}')">
                                                                        <i class="fa fa-play-circle mr-2"></i>{{ $content->title }}
                                                                    </a>
                                                                    <span class="badge-label">@translate(Preview)</span>
                                                                @else
                                                                    <a class="button-video" href="javascript:void(0)"><i
                                                                            class="fa fa-play-circle mr-2"></i>{{ $content->title }}
                                                                    </a>
                                                                    <span class="locked">
                                                                        <a href="javascript:void(0)">@translate(Locked)</a></span>
                                                                @endif

                                                                <span>{{duration($content->duration)}}</span>
                                                            </div>
                                                        @empty
                                                            @translate(NO content)
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            @translate(No Items)
                                        @endforelse
                                    </div>
                                </div>
                                <div class="overview-title margin-top-30">
                                    <h4>@translate(requirements)</h4>
                                </div>
                                <ul class="require-item">
                                    @foreach(json_decode($s_course->requirement) as $requirement)
                                        <li><i class="fa fa-square"></i> <span>{{ $requirement }}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="tab-three-content tab-content-bg instructor-content lost">
                                <div class="row align-items-center">
                                    <div class="col-lg-5">
                                        <div class="instructor-author">
                                            <div class="single-instructor">
                                                <span
                                                    class="instructor-sign">{{$s_course->relationBetweenInstructorUser->name}}</span>
                                                <div class="instructor-image">
                                                    <a href="{{route('single.instructor',$s_course->relationBetweenInstructorUser->slug)}}">
                                                        <img
                                                            src="{{ filePath($s_course->relationBetweenInstructorUser->image) }}"
                                                            alt="image">
                                                    </a>
                                                </div>
                                                <div class="instructor-content">
                                                    <h4>
                                                        <a href="#">{{$s_course->relationBetweenInstructorUser->name}}</a>
                                                    </h4>
                                                </div>
                                                <div class="hover-state">
                                                    <ul>
                                                        @if($s_course->relationBetweenInstructorUser->fb)
                                                            <li>
                                                                <a href="{{ $s_course->relationBetweenInstructorUser->fb }}"><i
                                                                        class="fa fa-facebook"></i></a></li>
                                                        @endif
                                                        @if($s_course->relationBetweenInstructorUser->tw)
                                                            <li>
                                                                <a href="{{ $s_course->relationBetweenInstructorUser->tw }}"><i
                                                                        class="fa fa-twitter"></i></a></li>
                                                        @endif

                                                        @if($s_course->relationBetweenInstructorUser->linked )
                                                            <li>
                                                                <a href="{{ $s_course->relationBetweenInstructorUser->linked }}"><i
                                                                        class="fa fa-linkedin"></i></a></li>
                                                        @endif

                                                        @if($s_course->relationBetweenInstructorUser->skype)
                                                            <li>
                                                                <a href="{{ $s_course->relationBetweenInstructorUser->skype }}"><i
                                                                        class="fa fa-skype"></i></a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="instructor-about">
                                            <h4>
                                                @translate(about) {{$s_course->relationBetweenInstructorUser->name}}</h4>
                                            <p class="margin-top-20">{{$s_course->relationBetweenInstructorUser->relationBetweenInstructor->about}}</p>
                                            <div class="instructor-button margin-top-30">
                                                <a href="{{route('single.instructor',$s_course->relationBetweenInstructorUser->slug)}}"
                                                   class="template-button">@translate(know more)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="instructor-skill-part margin-top-30 d-none">
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
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                         role="progressbar" style="width: 80%" aria-valuenow="80"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
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
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                         role="progressbar" style="width: 90%" aria-valuenow="90"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
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
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                         role="progressbar" style="width: 70%" aria-valuenow="70"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
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
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                         role="progressbar" style="width: 60%" aria-valuenow="60"
                                                         aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-four-content tab-content-bg review-content lost d-none">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="rating-left">
                                            <h2>4.5</h2>
                                            <ul class="green-starts">
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star-half-o"></i></a></li>
                                            </ul>
                                            <span>average rating</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="rating-right">
                                            <div class="review-title">
                                                <h4>course reviews</h4>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 80%" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>80%</span>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 50%" aria-valuenow="50"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>50%</span>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 20%" aria-valuenow="20"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>20%</span>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 10%" aria-valuenow="10"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>10%</span>
                                                </div>
                                            </div>
                                            <div class="single-review">
                                                <div class="progress-part">
                                                    <div class="progress">
                                                        <div
                                                            class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar" style="width: 10%" aria-valuenow="10"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="start-part">
                                                    <ul class="yellow-starts">
                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="percentage-part">
                                                    <span>10%</span>
                                                </div>
                                            </div>
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




    {{--======================================= Course Preview: START =====================================--}}

    <div class="modal-form">
        <div class="modal fade preview-modal-form" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-top">
                        <h5 class="modal-title">@translate(Course Preview): {{ $s_course->title }}</h5>
                        <button type="button" class="close close-arrow" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="la la-close"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (isset($s_course->overview_url))
                            @if ($s_course->provider === "Youtube")

                                <iframe width="100%" height="600"
                                        src="https://www.youtube.com/embed/{{ Str::after($s_course->overview_url,'https://youtu.be/') }}"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>

                            @elseif($s_course->provider === "Vimeo")
                                <iframe
                                    src="https://player.vimeo.com/video/{{ Str::after($s_course->overview_url,'https://vimeo.com/') }}"
                                    width="100%" height="600" frameborder="0" allow="autoplay; fullscreen"
                                    allowfullscreen></iframe>
                            @else
                                <video controls crossorigin playsinline id="player">
                                    <source src="{{$s_course->overview_url}}"
                                            type="video/mp4" size="100%"/>

                                </video>
                            @endif

                        @endif

                    </div>
                </div>
            </div>
        </div><!-- end modal -->
    </div>

    {{--======================================= Course Preview: END =====================================--}}

@endsection
