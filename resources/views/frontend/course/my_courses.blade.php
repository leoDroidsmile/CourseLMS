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
                                    <a href="{{route('my.courses')}}" class="active">
                                        @translate(All Courses)
                                    </a>
                                </li>

                                <li role="presentation" class="padding-r-3">
                                    <a href="{{route('my.wishlist')}}">
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
                                            @foreach($enrolls as $item)
                                                <div class="col-lg-4 column-td-half">
                                                    <div class="card-item">
                                                        <div class="card-image">
                                                            <a href="{{route('lesson_details',$item->enrollCourse->slug)}}"
                                                               class="card__img">
                                                                <img data-original="{{filePath($item->enrollCourse->image)}}"
                                                                     alt="{{$item->enrollCourse->title}}">
                                                            </a>
                                                        </div><!-- end card-image -->
                                                        <div class="card-content p-4">
                                                            <h3 class="card__title mt-0">
                                                                <a href="{{route('course.single',$item->enrollCourse->slug)}}">{{Str::limit($item->enrollCourse->title,58)}}</a>
                                                            </h3>
                                                            <p class="card__author">
                                                                <a href="{{route('single.instructor',$item->enrollCourse->relationBetweenInstructorUser->slug)}}">{{$item->enrollCourse->relationBetweenInstructorUser->name}}</a>
                                                            </p>
                                                            <div class="course-complete-bar-2 mt-2">
                                                                <div class="progress-item mb-0">
                                                                    <p class="skillbar-title">@translate(Complete):</p>
                                                                    <div class="skillbar-box mt-1">
                                                                        <div class="skillbar">
                                                                            <div class="skillbar-bar skillbar-bar-1"
                                                                                 style="width: {{\App\Http\Controllers\FrontendController::seenCourse($item->id,$item->enrollCourse->id) }}%;"></div>
                                                                        </div> <!-- End Skill Bar -->
                                                                    </div>
                                                                    <div
                                                                        class="skill-bar-percent">{{\App\Http\Controllers\FrontendController::seenCourse($item->id,$item->enrollCourse->id)}}
                                                                        %
                                                                    </div>
                                                                </div>
                                                            </div><!-- end course-complete-bar-2 -->
                                                            <div class="text-center mt-3">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <a href="{{route('course.single',$item->enrollCourse->slug) }}"
                                                                           class="btn btn-outline-success mt-2">@translate(Course details)</a>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <a href="{{ route('lesson_details',$item->enrollCourse->slug) }}"
                                                                           class="btn btn-success mt-2">@translate(Start lesson)</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- end card-content -->
                                                    </div><!-- end card-item -->
                                                </div><!-- end col-lg-4 -->
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="page-navigation-wrap mt-4 text-center">
                                        {{ $enrolls->links('frontend.include.paginate') }}
                                    </div><!-- end page-navigation-wrap -->
                                </div>
                            </div><!-- end tab-pane -->

                            <div role="tabpanel" class="tab-pane fade" id="#wishlist">
                                <div class="my-wishlist-wrap">
                                    <div class="my-wishlist-card-body padding-top-35px">
                                        <div class="row">

                                        </div><!-- end row -->
                                    </div>

                                </div><!-- end my-wishlist-wrap -->
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
