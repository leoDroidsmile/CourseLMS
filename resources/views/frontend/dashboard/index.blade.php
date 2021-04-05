@extends('frontend.app')
@section('content')
    <!-- ================================
      START DASHBOARD AREA
  ================================= -->
    <section class="dashboard-area">
        @include('frontend.dashboard.sidebar')
        <div class="dashboard-content-wrap">
            <div class="container-fluid">

                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="section-block"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 column-lmd-2-half column-md-full">
                        <div class="dashboard-shared">
                            <div class="mess-dropdown">
                                <div class="dashboard-title margin-bottom-20px">
                                    <h4 class="widget-title font-size-18 d-flex align-items-center">
                                        @translate(Notifications)
                                        <a href="{{ route('mark_as_all_read', Auth::user()->id) }}" class="primary-color-3 ml-auto font-size-13">@translate(Mark all as read)</a>
                                    </h4>
                                </div><!-- end dashboard-title -->
                                @forelse ($notifications  as $notification)
                                    <div class="{{ $notification->is_read === 0 ? 'bg-ecf0f1' : '' }}">
                                        <div class="mess__item">
                                            <div class="icon-element bg-color-1 text-white">
                                                <i class="la la-bolt"></i>
                                            </div>
                                            @foreach ($notification->data as $item)
                                                <div class="content">
                                                    <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                    <p class="text">{{ @translate($item) }}</p>
                                                </div>
                                            @endforeach
                                        </div><!-- end mess__item -->
                                    </div><!-- end mess__item -->
                                @empty
                                    <div class="mess__body">
                                        <div>
                                            <div class="icon-element bg-color-1 text-white">
                                                <i class="la la-bolt"></i>
                                            </div>
                                            <div class="content">
                                                <p class="text">@translate(No new notification.)</p>
                                            </div>
                                        </div><!-- end mess__item -->
                                    </div>
                                @endforelse
                            </div><!-- end mess-dropdown -->
                        </div><!-- end dashboard-shared -->
                    </div><!-- end col-lg-5 -->
                </div><!-- end row -->

                @include('frontend.dashboard.footer')

            </div><!-- end container-fluid -->
        </div><!-- end dashboard-content-wrap -->
    </section><!-- end dashboard-area -->
    <!-- ================================
        END DASHBOARD AREA
    ================================= -->
@endsection
