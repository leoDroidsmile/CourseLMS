@extends('frontend.app')
@section('content')
    <!-- ================================
      START DASHBOARD AREA
  ================================= -->
    <section class="dashboard-area">
        @include('frontend.dashboard.sidebar')
        <div class="dashboard-content-wrap">
            <div class="container-fluid">
                @if($affiliate)
                    @if($affiliate->is_confirm == true)
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{route('student.affiliate.request')}}" class="btn btn-success">@translate(Affiliate payment account update)</a>
                            </div>
                            <div class="col-md-12 m-2"></div>
                            <div class="col-md-12 ">

                             <span class="fa font-size-25 badge badge-success">{{formatPrice($affiliate->balance)}}
                             </span>
                                @if(withdrawLimit() <= $affiliate->balance)
                                    <a class="fa font-size-25 btn btn-outline-success mb-2" href="#!" onclick="forModal('{{route('student.payment.request')}}','@translate(Withdraw amount)')">@translate(withdraw)</a>
                                @endif
                            </div>
                        </div>

                        <div>
                            <p>@translate(Your affiliate ID is) : <span class="font-weight-bold">{{$affiliate->refer_id}}</span></p>
                            <p>@translate(Your affiliate URL is) : <span class="font-weight-bold">{{url('/').'?ref='.$affiliate->refer_id}}</span></p>
                            <h3>@translate(Referral URL Generator)</h3>
                            <small>@translate(Enter any URL from this website in the form below to generate a referral link!)</small>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label>@translate(Page Url)</label>
                                <input type="text" class="form-control" id="url" value="">
                                <input type="hidden" class="form-control" id="default_url" value="{{url('/').'?ref='.$affiliate->refer_id}}">
                                <small class="text-success">@translate(this is your affiliate link)</small>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <input type="hidden" name="ref" id="ref" value="?ref={{$affiliate->refer_id}}">
                                <label>@translate(Campaign Name )(@translate(optional))</label>
                                <input type="text" class="form-control" name="campaign" id="campaign" placeholder="@translate(Campaign Name)">
                            </div>
                            <button class="btn btn-success col-6 offset-3" id="genurl">@translate(Generate URL)</button>
                            <div class="form-group col-md-12 col-sm-12">
                                <label>@translate(Referral Url)</label>
                                <input type="text" class="form-control" value="" id="link" placeholder="@translate(Copy the link)">
                                <small class="text-success">@translate(now copy this link and share it anywhere)</small>
                            </div>
                        </div>
                    {{--affiliate history--}}
                        <div class="row">
                            <div class="col-lg-12 column-lmd-2-half column-md-full">
                                <div class="card m-2">
                                    <div class="m-2">
                                        <div class="float-left">
                                            <h4 class="card-title">@translate(Affiliate history)</h4>
                                        </div>
                                    </div>

                                    <div class="card-body t-div">
                                        <table class="table table-bordered  affiliate-history w-100">
                                            <thead>
                                            <tr>
                                                <th>S/L</th>
                                                <th>@translate(Refer Id)</th>
                                                <th>@translate(Name)</th>
                                                <th class="text-left">@translate(Amount)</th>
                                                <th>@translate(Date)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($history as  $item)
                                                <tr>
                                                    <td>{{ ($loop->index+1) + ($history->currentPage() - 1)*$history->perPage() }}</td>
                                                    <td>{{$item->refer_id}}</br></td>
                                                    <td>{{$item->user->name}}<br>{{$item->user->email}}</td>
                                                    <td>{{formatPrice($item->amount)}}</td>
                                                    <td>{{date('d-M-y',strtotime($item->updated_at)) ?? 'N/A'}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5"><h3 class="text-center">@translate(No Data Found)</h3></td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        {{ $history->links('frontend.include.paginate') }}
                                    </div>
                                </div>
                            </div><!-- end col-lg-5 -->
                        </div><!-- end row -->

                    {{--payment recived--}}
                        <div class="row">
                            <div class="col-lg-12 column-lmd-2-half column-md-full">
                                <div class="card m-2">
                                    <div class="m-2">
                                        <div class="float-left">
                                            <h4 class="card-title">@translate(Payment received)</h4>
                                        </div>
                                    </div>

                                    <div class="card-body t-div">
                                        <table  class="table table-bordered payment-received w-100">
                                            <thead>
                                            <tr>
                                                <th>S/L</th>
                                                <th>@translate(Paid Payment )</th>
                                                <th>@translate(Name)</th>
                                                <th class="text-left">@translate(Amount)</th>
                                                <th>@translate(Date)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($payment as  $item)
                                                <tr>
                                                    <td>{{ ($loop->index+1) + ($payment->currentPage() - 1)*$payment->perPage() }}</td>
                                                    <td> <span class="btn btn-success"> @translate(Paid on)
                                                      {{$item->process ?? 'N/A'}}</span></td>
                                                    <td>{{$item->user->name}}<br>{{$item->user->email}}</td>
                                                    <td>{{formatPrice($item->amount)}}</td>
                                                    <td>{{date('d-M-y',strtotime($item->status_change_date)) ?? 'N/A'}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5"><h3 class="text-center">@translate(No Data Found)</h3></td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        {{ $payment->links('frontend.include.paginate') }}
                                    </div>
                                </div>
                            </div><!-- end col-lg-5 -->
                        </div><!-- end row -->
                    @else
                        <div class="col-lg-12 alert alert-success text-center">
                            @translate(Wait for admin confirmation)
                        </div>
                    @endif
                @else
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <a href="{{route('student.affiliate.request')}}" class="btn btn-outline-success btn-block">@translate(Affiliate Payment account Setup)</a>
                        </div>
                    </div>
                @endif



                @include('frontend.dashboard.footer')

            </div><!-- end container-fluid -->
        </div><!-- end dashboard-content-wrap -->
    </section><!-- end dashboard-area -->
    <!-- ================================
        END DASHBOARD AREA
    ================================= -->
@endsection
