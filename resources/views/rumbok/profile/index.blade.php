@extends('rumbok.app')
@section('content')
    <!-- ================================
      START DASHBOARD AREA
  ================================= -->
    <section class="dashboard-area">
        @include('rumbok.dashboard.sidebar')
        <div class="dashboard-content-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div
                            class="breadcrumb-content dashboard-bread-content d-flex align-items-center justify-content-between">
                            <div class="user-bread-content d-flex align-items-center">
                                <div class="bread-img-wrap">

                                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->image == null
                                          ? asset('asset_rumbok/images/student.png')
                                          : filePath(\Illuminate\Support\Facades\Auth::user()->image) }}"
                                         alt="{{\Illuminate\Support\Facades\Auth::user()->name}}">

                                </div>
                                <div class="section-heading">
                                    <h2 class="section__title font-size-30">{{ $student->name }}</h2>
                                </div>
                            </div>

                            <div class="upload-btn-box">
                                <a href="{{ route('student.edit') }}" class="theme-btn">@translate(Edit Profile)</a>
                            </div>

                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="section-block"></div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <h3 class="widget-title">@translate(My Profile)</h3>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-8">
                        <div class="profile-detail pb-5">
                            <ul class="list-items">
                                <li><span class="profile-name">@translate(Registration Date):</span><span
                                        class="profile-desc">{{ $student->created_at->format('D d M Y, h:i:s A') }}</span>
                                </li>
                                <li><span class="profile-name">@translate(Full Name):</span><span
                                        class="profile-desc">{{ $student->name }}</span></li>
                                <li><span class="profile-name">@translate(Email):</span><span
                                        class="profile-desc">{{ $student->email }}</span></li>
                                <li><span class="profile-name">@translate(Phone Number):</span><span
                                        class="profile-desc">{{ $student->student->phone ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(Address):</span><span
                                        class="profile-desc">{{ $student->student->address ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(Facebook):</span><span
                                        class="profile-desc">{{ $student->student->fb ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(Twitter):</span><span
                                        class="profile-desc">{{ $student->student->tw ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(Linked in):</span><span
                                        class="profile-desc">{{ $student->student->linked ?? '' }}</span></li>
                                <li><span class="profile-name">@translate(About):</span><span
                                        class="profile-desc">{!! $student->student->about !!}</span></li>

                            </ul>
                        </div>
                    </div><!-- end col-lg-8 -->
                </div><!-- end row -->


                @include('rumbok.dashboard.footer')


            </div><!-- end container-fluid -->
        </div><!-- end dashboard-content-wrap -->

    </section><!-- end dashboard-area -->
    <!-- ================================
        END DASHBOARD AREA
    ================================= -->
@endsection
