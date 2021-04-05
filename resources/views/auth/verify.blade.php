@extends(themeManager().'.app')
@section('content')

    @if(themeManager() == 'rumbok')
        <!-- Breadcrumb Section Starts -->
        <section class="breadcrumb-section">
            <div class="breadcrumb-shape">
                <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                     class="hero-round-shape-2 item-moveTwo">
                <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape"
                     class="hero-plus-sign item-rotate">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>@translate(Verify )</h2>
                        <div class="breadcrumb-link margin-top-10">
                            <span><a href="{{url('/')}}">@translate(home)</a> / @translate(Verify )</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Login Section Starts -->
        <section class="login-section padding-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login-image">
                            <img src="{{asset('asset_rumbok/images/login-image.jpg')}}" alt="image">
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="login-form">
                            @if (isset($resent))
                                <div class="alert alert-success" role="alert">
                                    {{$resent}}
                                </div>
                            @endif

                            @translate(Before proceeding, please check your email for a verification link.)
                            @translate(If you did not receive the email)
                            <form class="d-inline" method="POST" action="{{ route('send.verify.token') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{$id}}">

                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">@translate(click here to request another)
                                </button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    @elseif(false)



    @else
        <div class="vertical-layout">
            <!-- Start Containerbar -->
            <div id="containerbar" class="containerbar authenticate-bg">
                <!-- Start Container -->
                <div class="container">
                    <div class="auth-box login-box">
                        <!-- Start row -->
                        <div class="d-flex justify-content-center no-gutters align-items-center justify-content-center">
                            <!-- Start col -->
                            <div class="col-md-8">
                                <!-- Start Auth Box -->
                                <div class="auth-box-right">

                                    <div class="card-box-shared">
                                        <div class="card-box-shared-title">@translate(Verify Your Email Address)</div>

                                        <div class="card-box-shared-body">
                                            @if (isset($resent))
                                                <div class="alert alert-success" role="alert">
                                                    {{$resent}}
                                                </div>
                                            @endif

                                            @translate(Before proceeding, please check your email for a verification link.)
                                            @translate(If you did not receive the email)
                                            <form class="d-inline" method="POST" action="{{ route('send.verify.token') }}">
                                                @csrf

                                                <input type="hidden" name="id" value="{{$id}}">

                                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">@translate(click here to request another)
                                                </button>

                                            </form>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>

                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
            <!-- /.login-box -->
        </div>
    @endif

@endsection
