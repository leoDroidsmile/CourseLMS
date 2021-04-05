@extends('frontend.app')
@section('content')
    <!-- ================================
      START BREADCRUMB AREA
  ================================= -->
    <section class="breadcrumb-area my-courses-bread">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content my-courses-bread-content">
                        <div class="section-heading">
                            <h2 class="section__title">@translate(My courses)</h2>
                        </div>
                    </div><!-- end breadcrumb-content -->
                    <div class="my-courses-tab">
                        <div class="section-tab section-tab-2">
                            <ul class="nav nav-tabs" role="tablist" id="review">
                                <li role="presentation" class="padding-r-3">
                                    <a href="{{route('my.courses')}}">
                                        @translate(All Courses)
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="{{route('my.wishlist')}}" class="active padding-r-3">
                                        @translate(Wishlist)
                                    </a>
                                </li>
                                @if(env('SUBSCRIPTION_ACTIVE') == "YES")
                                <li role="presentation">
                                    <a href="{{route('my.subscription')}}">
                                        @translate(Subscription Courses)
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
        START FLASH MESSAGE
    ================================= -->

    @if (Session::has('message'))
        <div class="alert alert-info text-center">{{ Session::get('message') }}</div>
    @endif

    <!-- ================================
      END FLASH MESSAGE
  ================================= -->

    <!-- ================================
           START MY COURSES
    ================================= -->
    <section class="my-courses-area padding-top-30px padding-bottom-90px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="my-course-content-wrap">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active show" id="#all-course">
                                <div class="my-course-content-body">
                                    <div class="my-course-container">
                                        <div class="row">
                                            {{-- TODO::wishlist Loop --}}
                                            @foreach($wishlists as $item)
                                                <div class="col-lg-4" id="wish-{{$item->id}}">
                                                    <div class="column-td-half">
                                                        <div class="card-item card-preview">
                                                            <div class="card-image">
                                                                <a href="{{route('course.single',$item->course->slug)}}"
                                                                   class="card__img"><img
                                                                        src="{{ filePath($item->course->image) }}"
                                                                        alt="{{$item->course->title}}"></a>
                                                                @if(bestSellingTags($item->course->id))
                                                                    <div class="card-badge">
                                                                        <span
                                                                            class="badge-label">@translate(bestseller)</span>
                                                                    </div>
                                                                @endif
                                                            </div><!-- end card-image -->
                                                            <div class="card-content">
                                                                <p class="card__label">
                                                                    <span
                                                                        class="card__label-text">{{$item->course->level}}</span>
                                                                    @auth()
                                                                        <a href="#!"
                                                                           class="card__collection-icon primary-color-2"
                                                                           onclick="removeToWishlist({{$item->id}},'{{route('remove.wishlist',$item->id)}}')">
                                                                            <span class="la la-heart"></span></a>
                                                                    @endauth

                                                                </p>
                                                                <h3 class="card__title">
                                                                    <a href="{{route('course.single',$item->course->slug)}}">{{\Illuminate\Support\Str::limit($item->course->title,58)}}</a>
                                                                </h3>
                                                                <p class="card__author">
                                                                    <a href="{{route('single.instructor',$item->course->relationBetweenInstructorUser->slug)}}">{{$item->course->relationBetweenInstructorUser->name}}</a>
                                                                </p>
                                                                <div class="rating-wrap d-flex mt-2 mb-3">
                                                    <span class="star-rating-wrap">
                                                     @translate(Enrolled) <span
                                                            class="star__count">{{\App\Model\Enrollment::where('course_id',$item->course->id)->count()}}</span>
                                                  </span>
                                                                </div><!-- end rating-wrap -->
                                                                <div class="card-action">
                                                                    <ul class="card-duration d-flex justify-content-between align-items-center">
                                                                        <li>
                                                          <span class="meta__date">
                                                              <i class="la la-play-circle"></i> {{$item->course->classes->count()}} @translate(Classes)
                                                          </span>
                                                                        </li>
                                                                        <li>
                                                          <span class="meta__date">
                                                              @php
                                                                  $total_duration = 0;

                                                                  foreach ($item->course->classes as $time){
                                                                      $total_duration +=  $time->contents->sum('duration');
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
                                                                    @if($item->course->is_free)
                                                                        <span
                                                                            class="card__price">@translate(Free)</span>
                                                                    @else
                                                                        @if($item->course->is_discount)
                                                                            <span class="price-before">{{formatPrice($item->course->discount_price)}}</span>
                                                                            <span class="price-current"><del>{{formatPrice($item->course->price)}}</del></span>
                                                                        @else
                                                                            <span
                                                                                class="price-current">{{formatPrice($item->course->price)}}</span>
                                                                        @endif
                                                                    @endif

                                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                                        <a href="#!"
                                                                           class="text-btn addToCart-{{$item->id}}"

                                                                           onclick="addToCart({{$item->course->id}},'{{route('add.to.cart')}}')">@translate(Get
                                                                            Enrolled)</a>
                                                                    @endif


                                                                </div><!-- end card-price-wrap -->
                                                            </div><!-- end card-content -->
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                            {{-- TODO::wishlist Loop END --}}
                                        </div>
                                    </div>
                                    <div class="page-navigation-wrap mt-4 text-center">
                                        {{ $wishlists->links('frontend.include.paginate') }}
                                    </div><!-- end page-navigation-wrap -->
                                </div>
                            </div><!-- end tab-pane -->



                        </div>
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end my-courses-area -->
    <!-- ================================
           START MY COURSES
    ================================= -->
@endsection
