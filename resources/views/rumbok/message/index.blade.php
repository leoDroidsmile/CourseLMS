@extends('rumbok.app')
@section('content')
    <!-- ================================
      START DASHBOARD AREA
  ================================= -->
    <section class="dashboard-area">
        @include('rumbok.dashboard.sidebar')
        <div class="dashboard-content-wrap">
            <div class="container-fluid">

                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="card-box-shared">
                            <div class="card-box-shared-title">
                                <h3 class="widget-title">@translate(Message)</h3>
                            </div>
                            <div class="card-box-shared-body">
                                <div class="row">
                                    @forelse($messages as $item)
                                        <div class="col-md-12 pb-5">
                                            <div class="dashboard-message-wrapper d-flex">
                                                <div class="message-content flex-grow-1">
                                                    <div class="message-header">
                                                        <div
                                                            class="mess__item justify-content-between align-items-center">
                                                            <div class="d-flex">
                                                                <div class="avatar">
                                                                    <img
                                                                        src="{{filePath($item->enrollCourse->relationBetweenInstructorUser->image)}}"
                                                                        alt="">
                                                                </div>
                                                                <div class="content">
                                                                    <h4 class="widget-title font-size-15 mb-0">{{$item->enrollCourse->relationBetweenInstructorUser->name}}</h4>
                                                                    <span
                                                                        class="time color-text font-size-12">{{$item->enrollCourse->title}}</span>
                                                                </div>
                                                            </div>
                                                        </div><!-- mess__item -->
                                                    </div><!-- message-header -->
                                                    <div class="conversation-wrap">
                                                        <div class="conversation-box">
                                                            @foreach($item->messages as $mess)
                                                                <div
                                                                    class="conversation-item {{$mess->user_id == \Illuminate\Support\Facades\Auth::id() ?'msg-sent':'msg-reply' }}">
                                                                    <div class="mess__body">
                                                                        <div class="mess__item">
                                                                            <div class="avatar">
                                                                                <!--avatar dot-status online-status-->
                                                                                <img
                                                                                    src="{{$mess->user->image != null ? filePath($mess->user->image) : asset('uploads/user/user.png') }}"
                                                                                    alt="Michelle Moreno">
                                                                            </div>
                                                                            <div class="content">
                                                                                <p class="text">{!! $mess->content !!}</p>
                                                                                <span
                                                                                    class="time">{{date('h:i',strtotime($mess->created_at))}}</span>
                                                                            </div>
                                                                        </div><!-- mess__item -->
                                                                    </div><!-- mess__body -->
                                                                </div><!-- conversation-item -->
                                                            @endforeach
                                                        </div><!-- conversation-box -->
                                                    </div><!-- conversation-wrap -->
                                                    <div class="message-reply-input">
                                                        <div class="contact-form-action">
                                                            <form action="{{route('message.sent')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="enroll_id"
                                                                       value="{{$item->id}}">
                                                                <input type="hidden" name="user_id"
                                                                       value="{{$item->user_id}}">
                                                                <div class="input-box d-flex align-items-center">
                                                                    <div class="form-group flex-grow-1 mb-0">
                                                                        <textarea
                                                                            class="message-control form-control mr-2"
                                                                            name="message"
                                                                            placeholder="@translate(Type a message)"></textarea>
                                                                        <button type="submit"
                                                                                class="theme-btn submit-btn border-0">
                                                                            <span class="la la-paper-plane"></span>
                                                                        </button>
                                                                    </div>
                                                                </div><!-- input-box -->
                                                            </form>
                                                        </div><!-- end contact-form-action -->
                                                    </div><!-- message-reply-input -->
                                                </div><!-- message-content -->
                                            </div><!-- end dashboard-message-wrapper -->
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <h3 class="text-center m-3">@translate(No Message)</h3>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-12 -->
                </div><!-- end row -->
                @include('rumbok.dashboard.footer')

            </div><!-- end container-fluid -->
        </div><!-- end dashboard-content-wrap -->

    </section><!-- end dashboard-area -->
    <!-- ================================
        END DASHBOARD AREA
    ================================= -->
@endsection
