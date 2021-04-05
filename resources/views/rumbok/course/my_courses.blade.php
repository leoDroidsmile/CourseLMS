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
                    <h2>@translate(my course)</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> / @translate(my course)</span>
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
                                <li class="active">
                                    <a href="{{route('my.courses')}}" class="active pointer">@translate(All Courses)</a>
                                </li>
                                <li>
                                    <a href="{{route('my.wishlist')}}" class="pointer">@translate(Wishlist)</a>
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
                <input type="hidden" id="myCourseCount" value="{{$enrolls->count()}}">
                @foreach($enrolls as $item)
                    <div class="col-lg-4 col-sm-6">
                        <div class="course-single-item">
                            <div class="course-image">
                                <img src="{{filePath($item->enrollCourse->image)}}" alt="image">
                                <div class="course-video-part">
                                    <div class="heart-icon">
                                        <a href="{{route('course.single',$item->enrollCourse->slug)}}"
                                           class="button-video">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="course-content">
                                <h4><a href="#">{{Str::limit($item->enrollCourse->title,58)}}</a></h4>
                                <p class="margin-top-20 d-none">Learn WordPress like a Professional! Start from the
                                    basics and go way to creating.</p>

                                <div class="signle-progressbar margin-top-20">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <div class="progressbar-text">
                                                <h6>{{\App\Http\Controllers\FrontendController::seenCourse($item->id,$item->enrollCourse->id) }}%</h6>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <div  class="barfiller" id="bar{{$loop->index++}}">
                                               <span class="fill"
                                                data-percentage="{{\App\Http\Controllers\FrontendController::seenCourse($item->id,$item->enrollCourse->id) }}"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="cotent-bottom margin-top-20 margin-bottom-50px">
                                    <div class="content-left">
                                        <a href="{{route('course.single',$item->enrollCourse->slug) }}"
                                           class="btn btn-outline-success mt-2 pointer">@translate(Course details)</a>
                                    </div>
                                    <div class="content-right">
                                        <a href="{{ route('lesson_details',$item->enrollCourse->slug) }}"
                                           class="btn btn-success mt-2 pointer">@translate(Start lesson)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="template-pagination margin-top-20">
                        {{ $enrolls->links('rumbok.include.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
