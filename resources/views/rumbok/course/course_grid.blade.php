@extends('rumbok.app')

@section('content')


    {{--new design--}}

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape" class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>
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
                    <div class="breadcrumb-link margin-top-10">
                        <span>
                            <a href="{{ route('homepage') }}">@translate(home)</a> /
                             @for($i = 1; $i <= count(Request::segments()); $i++)
                            <a href="{{ URL::to( implode( '/', array_slice(Request::segments(), 0 ,$i, true)))}}">{{str_replace('-', ' ',ucfirst(Request::segment($i)))}}</a></span>
                        @endfor
                        @if($breadcrumb != null)
                            <li>{{$breadcrumb}}</li>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Category Section Starts -->
    <section class="course-category-section padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="course-category-sidebar">
                        <form method="get" action="{{route('course.filter')}}" id="filter">
                        <div class="lms-single-widget">
                            <div class="lms-widget-title">
                                <h4>@translate(all categories)</h4>
                            </div>
                            <ul>
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


                        <div class="lms-single-widget">
                            <div class="lms-widget-title">
                                <h4>@translate(level)</h4>
                            </div>
                            <ul>
                                <li class="active">
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


                        <div class="lms-single-widget">
                            <div class="lms-widget-title">
                                <h4>@translate(language)</h4>
                            </div>
                            <select class="select2-lan selectpicker" id="language"  data-live-search="true" onchange="submitForm()" name="language">
                                <option value="">@translate(All Language)</option>
                                @foreach($languages as $item)
                                    <option
                                        value="{{$item->name}}" {{Request::get('language') ==$item->name ? 'selected':null }}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="lms-single-widget">
                            <div class="lms-widget-title">
                                <h4>instructor</h4>
                            </div>
                            <select class="sort-ordering-select select2-instructor selectpicker"
                                    name="instructor" data-live-search="true" onchange="submitForm()" id="instructor">
                                <option value="">@translate(All Instructor)</option>
                                @foreach(\App\User::where('user_type','Instructor')->where('banned',0)->get() as $item)
                                    <option
                                        value="{{$item->id}}" {{Request::get('instructor') ==$item->id ? 'selected':null }}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        @forelse($courses as $course)
                            <div class="col-md-6">
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
                                                <span
                                                    class="la la-heart-o love-span-{{$course->id}} love-{{$course->id}}" onclick="addToCart({{$course->id}},'{{route('add.to.wishlist')}}')"></span>

                                                <a href="#!"
                                                   onclick="addToCart({{$course->id}},'{{route('add.to.wishlist')}}')"
                                                   class="invisible love-{{$course->id}}"><span
                                                        class="la la-heart-o love-span-{{$course->id}}"></span></a>
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
                                                        to cart)</a>
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
                            {{ $courses->links('rumbok.include.paginate') }}

                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
