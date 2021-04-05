@extends('frontend.app')
@section('content')
    <!-- ================================
      START BREADCRUMB AREA
  ================================= -->
    <section class="breadcrumb-area instructor-breadcrumb-area text-left">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content instructor-bread-content d-flex align-items-center">
                        <div class="section-heading">
                            <h2 class="section__title font-size-50">{{ $instructor->name }}</h2>
                            <p class="section__desc mb-2">
                                @translate(Joined) {{ $instructor->created_at->diffForHumans() }}</p>
                        </div>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!--======================================
            START SPEAKER AREA
    ======================================-->
    <section class="team-detail-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-single-img">
                        <img src="{{ filePath($instructor->image) }}" alt="{{ $instructor->name }}" class="team__img">
                    </div><!-- end team-single-img -->
                </div><!-- end col-lg-4 -->
                <div class="col-lg-8">
                    <div class="team-single-wrap">

                        <div class="team-single-content padding-top-35px">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="team-single-item">
                                        <ul class="address-list">
                                            @if($instructor->phone)
                                            <li><a href="tel:{{ $instructor->phone }}"><i
                                                        class="la la-phone"></i>{{ $instructor->phone }}</a>
                                            </li>
                                            @endif
                                            @if($instructor->email)
                                            <li><a href="mailto:{{ $instructor->email }}"><i
                                                        class="la la-envelope-o"></i>{{ $instructor->email }}</a></li>
                                                @endif
                                        </ul>
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="team-single-item">
                                        <ul class="address-list">
                                            @if($instructor->fb)
                                                <li><a href="{{ $instructor->fb }}"><i class="fa fa-facebook"></i>@translate(Facebook)</a>
                                                </li>
                                            @endif
                                            @if($instructor->tw)
                                                <li><a href="{{ $instructor->tw }}"><i class="fa fa-twitter"></i>Twitter</a>
                                                </li>
                                            @endif

                                            @if($instructor->linked )
                                                <li><a href="{{ $instructor->linked }}"><i
                                                            class="fa fa-linkedin"></i>Linked In</a>
                                                </li>
                                            @endif

                                            @if($instructor->skype)
                                                <li><a href="{{ $instructor->skype }}"><i
                                                            class="fa fa-skype"></i>Skype</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row-->
                        </div>
                        <div class="team-single-content padding-top-35px text-center">
                            <div class="row">
                                <div class="col-lg-12 column-td-half">
                                    <div class="team-single-item">
                                        <h3 class="widget-title font-size-20 mb-3 widget-title-tooltip"><i
                                                class="la la-file-video-o"></i>@translate(Courses)</h3>
                                        <p class="number-count">
                                            <span
                                                class="counter">{{ App\Model\Course::where('user_id',$instructor->user_id)->count() }}</span>
                                        </p>
                                    </div><!-- end team-single-item -->
                                </div><!-- end col-lg-4 -->

                            </div><!-- end row-->
                        </div>


                    </div><!-- end team-single-wrap -->
                </div><!-- end col-lg-8 -->
            </div><!-- end row -->

            @if($instructor->about != null)
                <div class="row">
                    <div class="w-100">
                        <div class="col-lg-12">
                            <div class="about-tab-wrap padding-top-20px">
                                <div class="section-tab padding-bottom-30px">
                                    <ul class="nav nav-tabs" role="tablist" id="review">
                                        <li role="presentation">
                                            <a href="#about-me" role="tab" data-toggle="tab" class="theme-btn active"
                                               aria-selected="true">
                                                @translate(About me)
                                            </a>
                                        </li>

                                    </ul>
                                </div><!-- end section-tab -->

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active" id="about-me">
                                        <div class="pane-body w-100">
                                            <p class="pb-3">
                                              {!! $instructor->about !!}

                                            </p>

                                        </div>
                                    </div>
                                </div><!-- end tab-content -->

                            </div><!-- end about-tab-wrap -->
                        </div><!-- end col-lg-12 -->
                    </div>
                </div>
            @endif
            <div class="instructor-all-course padding-top-60px">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="widget-title pb-3">@translate(Courses Taught by) {{ $instructor->name }}</h3>
                        <div class="section-block"></div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="row mt-5">
                    @foreach($courses as $i_course)
                        <div class="col-lg-4">
                            <div class="column-td-half">
                                <div class="card-item card-preview"
                                     data-tooltip-content="#tooltip_content_{{$i_course->id}}">
                                    <div class="card-image">
                                        <a href="{{route('course.single',$i_course->slug)}}"
                                           class="card__img"><img
                                                src="{{ filePath($i_course->image) }}"
                                                alt="{{$i_course->title}}"></a>
                                        @if(bestSellingTags($i_course->id))
                                            <div class="card-badge">
                                                                    <span
                                                                        class="badge-label">@translate(bestseller)</span>
                                            </div>
                                        @endif
                                    </div><!-- end card-image -->
                                    <div class="card-content">
                                        <p class="card__label">
                                            <span class="card__label-text">{{$i_course->level}}</span>
                                            @auth()
                                                <a href="#!"
                                                   onclick="addToCart({{$i_course->id}},'{{route('add.to.wishlist')}}')"
                                                   class="card__collection-icon love-{{$i_course->id}}"><span

                                                        class=" love-span-{{$i_course->id}} la la-heart-o"></span></a>
                                            @endauth

                                            @guest()
                                                <a href="{{route('login')}}"
                                                   class="card__collection-icon"
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="Add to Wishlist"><span
                                                        class="la la-heart-o"></span></a>
                                            @endguest
                                        </p>
                                        <h3 class="card__title">
                                            <a href="{{route('course.single',$i_course->slug)}}">{{\Illuminate\Support\Str::limit($i_course->title,58)}}</a>

                                        </h3>
                                        <p class="card__author">
                                            <a href="{{route('single.instructor',$i_course->relationBetweenInstructorUser->slug)}}">{{$i_course->relationBetweenInstructorUser->name}}</a>
                                        </p>
                                        <div class="rating-wrap d-flex mt-2 mb-3">
                                                    <span class="star-rating-wrap">
                                                     @translate(Enrolled) <span
                                                            class="star__count">{{\App\Model\Enrollment::where('course_id',$i_course->id)->count()}}</span>
                                                  </span>
                                        </div><!-- end rating-wrap -->
                                        <div class="card-action">
                                            <ul class="card-duration d-flex justify-content-between align-items-center">
                                                <li>
                                                          <span class="meta__date">
                                                              <i class="la la-play-circle"></i> {{$i_course->classes->count()}} @translate(Classes)
                                                          </span>
                                                </li>
                                                <li>
                                                          <span class="meta__date">
                                                              @php
                                                                  $total_duration = 0;
                                                                  foreach ($i_course->classes as $item){
                                                                      $total_duration +=$item->contents->sum('duration');
                                                                  }
                                                              @endphp
                                                              <i class="la la-clock-o"></i>{{duration($total_duration)}}
                                                          </span>
                                                </li>
                                            </ul>
                                        </div><!-- end card-action -->
                                        <div
                                            class="card-price-wrap d-flex justify-content-between align-items-center">
                                            <!--if free-->
                                            @if($i_course->is_free)
                                                <span class="card__price">@translate(Free)</span>
                                            @else
                                                @if($i_course->is_discount)
                                                    <span class="card__price">{{formatPrice($i_course->discount_price)}}</span>
                                                    <span class="card__price"><del>{{formatPrice($i_course->price)}}</del></span>
                                                @else
                                                    <span
                                                        class="card__price">{{formatPrice($i_course->price)}}</span>
                                                @endif
                                            @endif
                                        <!--there are the login-->
                                            @auth()
                                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                    <a href="#!" class="text-btn addToCart-{{$i_course->id}}"
                                                       onclick="addToCart({{$i_course->id}},'{{route('add.to.cart')}}')">@translate(Add
                                                        to cart)</a>
                                                @else
                                                    <a href="{{route('login')}}" class="text-btn">@translate(Add to
                                                        cart)</a>
                                                @endif
                                            @endauth

                                            @guest()
                                                <a href="{{route('login')}}" class="text-btn">@translate(Add to
                                                    cart)</a>
                                            @endguest


                                        </div><!-- end card-price-wrap -->
                                    </div><!-- end card-content -->
                                </div>
                            </div>
                        </div><!-- end col-lg-4 -->

                    @endforeach

                    @foreach($courses as $i_tooltip)
                        <div class="tooltip_templates">
                            <div id="tooltip_content_{{$i_tooltip->id}}">
                                <div class="card-item">
                                    <div class="card-content">
                                        <p class="card__author">
                                            By <a
                                                href="{{route('single.instructor',$i_tooltip->relationBetweenInstructorUser->slug)}}">{{$i_tooltip->relationBetweenInstructorUser->name}}</a>
                                        </p>
                                        <h3 class="card__title">
                                            <a href="{{route('course.single',$i_tooltip->slug)}}">{{\Illuminate\Support\Str::limit($i_tooltip->title,58)}}</a>
                                        </h3>
                                        <p class="card__label">
                                            <span class="mr-1">@translate(in)</span><a
                                                href="{{route('course.category',$i_tooltip->category->slug)}}"
                                                class="mr-1">{{$i_tooltip->category->name}}</a>
                                        </p>
                                        <div class="rating-wrap d-flex mt-2 mb-3">

                                                                <span class="star-rating-wrap">
                                                         @translate(Enrolled) <span
                                                                        class="star__count">{{\App\Model\Enrollment::where('course_id',$i_tooltip->id)->count()}}</span>
                                                    </span>
                                        </div><!-- end rating-wrap -->
                                        <ul class="list-items mb-3 font-size-14">
                                            @foreach(json_decode($i_tooltip->requirement) as $requirement)
                                                <li>{{$requirement}}</li>
                                            @endforeach
                                        </ul>
                                        <div class="card-action">
                                            <ul class="card-duration d-flex justify-content-between align-items-center">
                                                <li><span class="meta__date"><i
                                                            class="la la-play-circle"></i> {{$i_tooltip->classes->count()}} @translate(Classes)</span>
                                                </li>
                                                <li><span class="meta__date">
                                                                @php
                                                                    $total_duration = 0;
                                                                    foreach ($i_tooltip->classes as $item){
                                                                        $total_duration +=$item->contents->sum('duration');
                                                                    }
                                                                @endphp
                                                                <i class="la la-clock-o"></i>{{duration($total_duration)}}
                                                          </span>
                                                </li>
                                            </ul>
                                        </div><!-- end card-action -->
                                        <div class="btn-box w-100 text-center mb-3">
                                            <a href="{{route('course.single',$i_tooltip->slug)}}"
                                               class="theme-btn d-block">
                                                @translate(Preview this course)</a>
                                        </div>
                                    </div><!-- end card-content -->
                                </div><!-- end card-item -->
                            </div>
                        </div><!-- end tooltip_templates -->
                    @endforeach

                </div>
                {{ $courses->links('frontend.include.paginate') }}
            </div>
        </div><!-- end container -->
    </section><!-- end team-detail-area -->
    <!--======================================
            END SPEAKER AREA
    ======================================-->
@endsection
