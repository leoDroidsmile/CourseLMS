@extends('frontend.app')

@section('content')

    <!--======================================
          START breadcrumb AREA
  ======================================-->

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">

                        <div class="section-heading">
                            <h2 class="section__title">

                                @php
                                    $x = 2;
                                @endphp
                                @if ($x <= count(Request::segments()))
                                    {{str_replace('-', ' ',ucfirst(Request::segment(2)))}}
                                @else
                                    @if($breadcrumb != null)
                                        {{$breadcrumb}}
                                        @else
                                        {{str_replace('-', ' ',ucfirst(Request::segment(1)))}}
                                    @endif
                                @endif


                            </h2>
                        </div>

                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('homepage') }}">@translate(Home)</a></li>
                            @for($i = 1; $i <= count(Request::segments()); $i++)
                                <li class="bread-item">
                                    <a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">

                                        {{str_replace('-', ' ',ucfirst(Request::segment($i)))}}
                                    </a>
                                </li>
                            @endfor

                            @if($breadcrumb != null)
                                <li>{{$breadcrumb}}</li>
                            @endif
                        </ul>

                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <!--======================================
            END breadcrumb AREA
    ======================================-->


    <!--======================================
            START COURSE AREA
    ======================================-->
    <section class="course-area padding-top-80px padding-bottom-120px">
        <div class="course-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filter-bar d-flex justify-content-between align-items-center">

                            <ul class="filter-bar-tab nav nav-tabs align-items-center" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <span title="grid view">
                                      <i class="la la-th-large nav-link icon-element active"></i>
                                  </span>
                                </li>

                                @if($courses->count() != 0)
                                    <li class="nav-item"> @translate(Showing) {{ $courses->firstItem() }}
                                        -{{ $courses->count() < 10 ? $courses->count(): $courses->perPage() }}
                                        @translate(of) {{ $courses->total() }} @translate(results)
                                    </li>
                                @else
                                    <li class="nav-item"> @translate(No Course Found)</li>
                                @endif
                            </ul>

                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="course-content-wrapper mt-4">
                    <div class="row">

                        {{-- sidebar --}}
                        <div class="col-lg-4">
                            <div class="sidebar">
                                <form method="get" action="{{route('course.filter')}}" id="filter">
                                    <!--Category -->
                                    <div class="sidebar-widget">
                                        <h3 class="widget-title">@translate(Categories)</h3>
                                        <span class="section-divider"></span>
                                        <ul class="filter-by-category">
                                            <input value="{{$categories->first()->slug ?? ''}}" type="hidden"
                                                   name="slug">
                                            @foreach(categories() as $item)
                                                <li>
                                                    <div class="custom-checkbox">
                                                        <input onclick="submitForm()"
                                                               {{Request::get('categories') == $item->id ? 'checked':null }} value="{{$item->id}}"
                                                               type="radio" id="chb-{{$item->id}}" name="categories">
                                                        <label for="chb-{{$item->id}}"
                                                               class="course-hvr {{Request::get('categories') == $item->id ? 'category-active':null }}">{{$item->name}}
                                                            <span class="ml-2 font-size-14 primary-color-3">({{$item->courses->count()}})</span>
                                                        </label>
                                                    </div>
                                                    @if($item->child->count() != 0)
                                                        <ul class="sub-menu">
                                                            @foreach($item->child as $child)
                                                                <li class="pl-2">
                                                                    <div class="custom-checkbox">
                                                                        <input onclick="submitForm()"
                                                                               {{Request::get('categories') == $child->id ? 'checked':null }} value="{{$child->id}}"
                                                                               type="radio" id="chb-{{$child->id}}"
                                                                               name="categories">
                                                                        <label for="chb-{{$child->id}}"
                                                                               class="course-hvr {{Request::get('categories') == $child->id ? 'category-active':null }}">{{$child->name}}
                                                                            <span
                                                                                class="ml-2 font-size-14 primary-color-3">({{$child->courses->count()}})</span>
                                                                        </label>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>


                                    <!--Level-->
                                    <div class="sidebar-widget">
                                        <h3 class="widget-title">@translate(Level)</h3>
                                        <span class="section-divider"></span>
                                        <ul class="filter-by-level">
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input onclick="submitForm()"
                                                           {{Request::get('level') =="All Levels" ? 'checked':null }} value="All Levels"
                                                           type="radio" id="chb19" name="level">
                                                    <label for="chb19" class="course-hvr">@translate(All Levels)<span
                                                            class="ml-2 font-size-14 primary-color-3"></span></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input onclick="submitForm()"
                                                           {{Request::get('level') =="Beginner" ? 'checked':null }} type="radio"
                                                           id="chb20" value="Beginner" name="level">
                                                    <label for="chb20" class="course-hvr">@translate(Beginner)<span
                                                            class="ml-2 font-size-14 primary-color-3"></span></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input onclick="submitForm()"
                                                           {{Request::get('level') =="Advanced" ? 'checked':null }} type="radio"
                                                           id="chb21" value="Advanced" name="level">
                                                    <label for="chb21" class="course-hvr">@translate(Advanced)<span
                                                            class="ml-2 font-size-14 primary-color-3"></span></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <!---Language-->
                                    <div class="sidebar-widget">
                                        <h3 class="widget-title">@translate(Language)</h3>
                                        <span class="section-divider"></span>
                                        <div class="sort-ordering">
                                            <select class="select2-lan selectpicker form-control w-100" name="language"
                                                    data-live-search="true" onchange="submitForm()">
                                                <option value="">@translate(All Language)</option>
                                                @foreach($languages as $item)
                                                    <option
                                                        value="{{$item->name}}" {{Request::get('language') ==$item->name ? 'selected':null }}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <!--Cast--->
                                    <div class="sidebar-widget">
                                        <h3 class="widget-title">@translate(By Cost)</h3>
                                        <span class="section-divider"></span>
                                        <ul class="filter-by-price">
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input onclick="submitForm()"
                                                           {{Request::get('cost') =="all" ? 'checked':null }} value="all"
                                                           type="radio" id="chb23" name="cost">
                                                    <label for="chb23">@translate(All)<span
                                                            class="ml-2 font-size-14 course-hvr">({{\App\Model\Course::Published()->get()->count()}})</span></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input onclick="submitForm()"
                                                           {{Request::get('cost') =="free" ? 'checked':null }} value="free"
                                                           type="radio" id="chb24" name="cost">
                                                    <label for="chb24">@translate(Free)<span
                                                            class="ml-2 font-size-14 course-hvr">({{\App\Model\Course::Published()->where('is_free',true)->get()->count()}})</span></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-checkbox">
                                                    <input onclick="submitForm()"
                                                           {{Request::get('cost') =="paid" ? 'checked':null }} value="paid"
                                                           type="radio" id="chb25" name="cost">
                                                    <label for="chb25">@translate(Paid)<span
                                                            class="ml-2 font-size-14 course-hvr">({{\App\Model\Course::Published()->where('is_free',false)->get()->count()}})</span></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>


                                    <!-- All instructor -->
                                    <div class="sidebar-widget">
                                        <h3 class="widget-title">@translate(Instructors)</h3>
                                        <span class="section-divider"></span>
                                        <div class="sort-ordering">

                                            <select class="sort-ordering-select select2-instructor selectpicker"
                                                    name="instructor" data-live-search="true" onchange="submitForm()">
                                                <option value="">@translate(All Instructor)</option>
                                                @foreach(\App\User::where('user_type','Instructor')->where('banned',0)->get() as $item)
                                                    <option
                                                        value="{{$item->id}}" {{Request::get('instructor') ==$item->id ? 'selected':null }}>{{$item->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div><!-- end sidebar-widget -->
                                </form>
                            </div>
                        </div>

                        {{-- sidebar END --}}
                        <div class="col-lg-8">

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active show">
                                    <div class="row">
                                        @forelse($courses as $course)
                                            <div class="col-lg-6">
                                                <div class="column-td-half">
                                                    <div class="card-item card-preview"
                                                         data-tooltip-content="#tooltip_content_{{$course->id}}">
                                                        <div class="card-image">
                                                            <a href="{{route('course.single',$course->slug)}}"
                                                               class="card__img"><img
                                                                    data-original="{{ filePath($course->image) }}"
                                                                    alt="{{$course->title}}"></a>
                                                            @if(bestSellingTags($course->id))
                                                                <div class="card-badge">
                                                                    <span
                                                                        class="badge-label">@translate(bestseller)</span>
                                                                </div>
                                                            @endif
                                                        </div><!-- end card-image -->
                                                        <div class="card-content">
                                                            <p class="card__label">
                                                                <span class="card__label-text">{{$course->level}}</span>
                                                                @auth()
                                                                    <a href="#!"
                                                                       onclick="addToCart({{$course->id}},'{{route('add.to.wishlist')}}')"
                                                                       class="card__collection-icon love-{{$course->id}}"><span

                                                                            class="la la-heart-o  love-span-{{$course->id}} "></span></a>
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
                                                                <a href="{{route('course.single',$course->slug)}}"
                                                                   title="{{$course->title}}">{{ Str::limit($course->title,58) }}</a>
                                                            </h3>
                                                            <p class="card__author">
                                                                <a href="{{route('single.instructor',$course->relationBetweenInstructorUser->slug)}}">{{$course->relationBetweenInstructorUser->name}}</a>
                                                            </p>
                                                            <div class="rating-wrap d-flex mt-2 mb-3">
                                                    <span class="star-rating-wrap">
                                                     @translate(Enrolled) <span
                                                            class="star__count">{{\App\Model\Enrollment::where('course_id',$course->id)->count()}}</span>
                                                  </span>
                                                            </div><!-- end rating-wrap -->
                                                            <div class="card-action">
                                                                <ul class="card-duration d-flex justify-content-between align-items-center">
                                                                    <li>
                                                          <span class="meta__date">
                                                              <i class="la la-play-circle"></i> {{$course->classes->count()}} @translate(Classes)
                                                          </span>
                                                                    </li>
                                                                    <li>
                                                          <span class="meta__date">
                                                              @php
                                                                  $total_duration = 0;
                                                                  foreach ($course->classes as $item){
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
                                                                @if($course->is_free)
                                                                    <span class="card__price">@translate(Free)</span>
                                                                @else
                                                                    @if($course->is_discount)
                                                                        <span class="card__price">{{formatPrice($course->discount_price)}}</span>
                                                                        <span class="card__price"><del>{{formatPrice($course->price)}}</del></span>

                                                                    @else
                                                                        <span
                                                                            class="card__price">{{formatPrice($course->price)}}</span>
                                                                    @endif
                                                                @endif
                                                            <!--there are the login-->
                                                                @auth()
                                                                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == 'Student')
                                                                        <a href="#!"
                                                                           class="text-btn addToCart-{{$course->id}}"
                                                                           onclick="addToCart({{$course->id}},'{{route('add.to.cart')}}')">@translate(Add to cart)</a>
                                                                    @else
                                                                        <a href="{{route('login')}}" class="text-btn">@translate(Add to cart)</a>
                                                                    @endif
                                                                @endauth

                                                                @guest()
                                                                    <a href="{{route('login')}}" class="text-btn">@translate(Add to cart)</a>
                                                                @endguest


                                                            </div><!-- end card-price-wrap -->
                                                        </div><!-- end card-content -->
                                                    </div>
                                                </div>
                                            </div><!-- end col-lg-4 -->


                                        @empty
                                            <div class="col-12 m-5">
                                                <img data-original="{{asset('no_data.png')}}" class="w-100 img-fluid">
                                            </div>
                                        @endforelse

                                        @foreach($courses as $c_tooltip)
                                            <div class="tooltip_templates">
                                                <div id="tooltip_content_{{$c_tooltip->id}}">
                                                    <div class="card-item">
                                                        <div class="card-content">
                                                            <p class="card__author">
                                                                @translate(By) <a
                                                                    href="{{route('single.instructor',$c_tooltip->relationBetweenInstructorUser->slug)}}">{{$c_tooltip->relationBetweenInstructorUser->name}}</a>
                                                            </p>
                                                            <h3 class="card__title">
                                                                <a href="{{route('course.single',$c_tooltip->slug)}}"
                                                                   title="{{$c_tooltip->title}}">{{\Illuminate\Support\Str::limit($c_tooltip->title,58)}}</a>
                                                            </h3>
                                                            <p class="card__label">
                                                                <span class="mr-1">@translate(in)</span><a
                                                                    href="{{route('course.category',$c_tooltip->category->slug)}}"
                                                                    class="mr-1">{{$c_tooltip->category->name}}</a>
                                                            </p>
                                                            <div class="rating-wrap d-flex mt-2 mb-3">

                                                            <span class="star-rating-wrap">
                                                     @translate(Enrolled) <span
                                                                    class="star__count">{{\App\Model\Enrollment::where('course_id',$c_tooltip->id)->count()}}</span>
                                                </span>
                                                            </div><!-- end rating-wrap -->
                                                            <ul class="list-items mb-3 font-size-14">
                                                                @foreach(json_decode($c_tooltip->requirement) as $requirement)
                                                                    <li>{{$requirement}}</li>
                                                                @endforeach
                                                            </ul>
                                                            <div class="card-action">
                                                                <ul class="card-duration d-flex justify-content-between align-items-center">
                                                                    <li><span class="meta__date"><i
                                                                                class="la la-play-circle"></i> {{$c_tooltip->classes->count()}} @translate(Classes)</span>
                                                                    </li>
                                                                    <li><span class="meta__date">
                                                            @php
                                                                $total_duration = 0;
                                                                foreach ($c_tooltip->classes as $item){
                                                                    $total_duration +=$item->contents->sum('duration');
                                                                }
                                                            @endphp
                                                            <i class="la la-clock-o"></i>{{duration($total_duration)}}</span>
                                                                    </li>
                                                                </ul>
                                                            </div><!-- end card-action -->
                                                            <div class="btn-box w-100 text-center mb-3">
                                                                <a href="{{route('course.single',$c_tooltip->slug)}}"
                                                                   class="theme-btn d-block">
                                                                    @translate(Preview this course)</a>
                                                            </div>
                                                        </div><!-- end card-content -->
                                                    </div><!-- end card-item -->
                                                </div>
                                            </div><!-- end tooltip_templates -->

                                        @endforeach
                                    </div>
                                </div>

                            </div><!-- end tab-content -->


                        </div><!-- end col-lg-8 -->
                    </div><!-- end row -->
                    {{ $courses->links('frontend.include.paginate') }}
                </div><!-- end card-content-wrapper -->
            </div><!-- end container -->
        </div><!-- end course-wrapper -->
    </section><!-- end courses-area -->
    <!--======================================
            END COURSE AREA
    ======================================-->
@endsection
