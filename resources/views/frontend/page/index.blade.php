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
                        <h2 class="section__title">{{$page->title }}</h2>
                      </div>


                  </div><!-- end breadcrumb-content -->
              </div><!-- end col-lg-12 -->
          </div><!-- end row -->
      </div><!-- end container -->
  </section>

  <!--======================================
          END breadcrumb AREA
  ======================================-->

  <section class="story-area section--padding text-center">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="about-content-box">
                      <div class="section-heading">

                          @foreach ($page->content as $item)
                            <p class="section__desc text-justify">
{!! $item->body !!}

                          @endforeach
                      </div><!-- end section-heading -->
                  </div>
              </div><!-- end col-lg-12 -->
          </div><!-- end row -->
      </div><!-- end container -->
  </section>

@endsection
