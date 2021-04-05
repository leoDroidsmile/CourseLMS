@extends('rumbok.app')
@section('content')

  <!--======================================
          START breadcrumb AREA
  ======================================-->

  <section class="breadcrumb-section">
      <div class="breadcrumb-shape">
          <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape" class="hero-round-shape-2 item-moveTwo">
          <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
      </div>
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <h2>{{$page->title}}</h2>
                  <div class="breadcrumb-link margin-top-10">
                      <span><a href="{{route('homepage')}}">@translate(home)</a> / {{$page->title}}</span>
                  </div>
              </div>
          </div>
      </div>
  </section>


  <!--======================================
          END breadcrumb AREA
  ======================================-->

  <section class="welcome-content">
      <div class="container">
          <div class="section-heading">
              @foreach ($page->content as $item)
                  <p class="section__desc text-justify">
                  {!! $item->body !!}

              @endforeach
          </div><!-- end section-heading -->
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
                                  <h3 class="title counter">{{\App\User::where('user_type','Instructor')->get()->count()}}</h3>
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
              @foreach(\App\Model\Category::Published()->where('is_popular', 1)->get() as $item)
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
              @foreach(\App\Model\Instructor::with('courses')->get()->shuffle()->take(3) as $instructor)
                  <div class="col-lg-3 col-md-6">
                      <div class="single-instructor">
                          <span class="instructor-sign">{{$instructor->name}}</span>
                          <div class="instructor-image">
                              <a href="{{route('single.instructor',$instructor->user->slug)}}"><img
                                      src="{{filePath($instructor->image)}}" alt="image"></a>
                          </div>
                          <div class="instructor-content">
                              <h4><a href="{{route('single.instructor',$instructor->user->slug)}}">{{$instructor->name}}</a></h4>
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
                                      <li><a href="{{ $instructor->linked }}"><i class="fa fa-linkedin"></i></a></li>
                                  @endif

                                  @if($instructor->skype)
                                      <li><a href="{{ $instructor->skype }}"><i class="fa fa-skype"></i></a></li>
                                  @endif
                              </ul>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </section>

@endsection
