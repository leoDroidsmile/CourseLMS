@extends('frontend.app')
@section('content')
    <!-- ================================
      START DASHBOARD AREA
  ================================= -->
    <section class="dashboard-area">
        @include('frontend.dashboard.sidebar')
        <div class="dashboard-content-wrap">
            <div class="container-fluid">
                <div class="m-2">
                    <form method="post" action="{{route('student.account.update')}}" enctype="multipart/form-data">
                        @csrf
                        @if($account != null)
                            <input type="hidden" name="id" value="{{$account->id}}">
                        @endif

                        <div class="card m-3">
                            <div class="card-header">
                                <p class="font-weight-bold">@translate(Bank Setup)</p>
                            </div>
                            <div class="card-body">
                                <div class="form-group m-2">
                                    <label class="label">@translate(Bank Name)</label>
                                    <input type="text" placeholder="@translate(Enter Bank Name)"
                                           value="{{$account->bank_name ?? ''}}" name="bank_name"
                                           class="form-control">
                                </div>

                                    <div class="form-group m-2">
                                        <label class="label">@translate(Account Name)</label>
                                        <input type="text" placeholder="@translate(Enter Account Name)"
                                               value="{{$account->account_name ?? ''}}" name="account_name"
                                               class="form-control">
                                    </div>

                                    <div class="form-group m-2">
                                        <label class="label">@translate(Account Number)</label>
                                        <input type="text" placeholder="@translate(Enter Account Number)"
                                               value="{{$account->account_number ?? ''}}" name="account_number"
                                               class="form-control">
                                    </div>
                                    <div class="form-group m-2">
                                        <label class="label">@translate(Routing Number)</label>
                                        <input type="number" placeholder="@translate(Enter Routing Number)"
                                               value="{{$account->routing_number ?? ''}}" name="routing_number"
                                               class="form-control">
                                    </div>


                            </div>
                        </div>
                        <div class="card m-3">
                            <div class="card-header">
                                <p class="font-weight-bold">@translate(PayPal Setup) </p>
                            </div>
                            <div class="card-body">
                                <div class="form-group m-2">
                                    <label class="label">@translate(Paypal Account Name)</label>
                                    <input type="text" placeholder="@translate(Enter Paypal Acc Name)"
                                           value="{{$account->paypal_acc_name ?? ''}}" name="paypal_acc_name"
                                           class="form-control">
                                </div>
                                <div class="form-group m-2">
                                    <label class="label">@translate(Paypal Account Email)</label>
                                    <input type="email" placeholder="@translate(Enter Paypal Acc Email)"
                                           value="{{$account->paypal_acc_email ?? ''}}" name="paypal_acc_email"
                                           class="form-control">
                                </div>

                            </div>
                        </div>

                        <div class="card m-3">
                            <div class="card-header">
                                <p class="font-weight-bold">@translate(Stripe Setup) </p>
                            </div>
                            <div class="card-body">
                                <div class="form-group m-2">
                                    <label class="label">@translate(Stripe Account Name)</label>
                                    <input type="text" placeholder="@translate(Enter Stripe Acc Name)"
                                           value="{{$account->stripe_acc_name ?? ''}}" name="stripe_acc_name"
                                           class="form-control">
                                </div>
                                <div class="form-group m-2">
                                    <label class="label">@translate(Stripe Account Email)</label>
                                    <input type="email" placeholder="@translate(Enter Stripe Acc Email)"
                                           value="{{$account->stripe_acc_email ?? ''}}" name="stripe_acc_email"
                                           class="form-control">
                                </div>
                                <div class="form-group m-2">
                                    <label class="label">@translate(Stripe Card Holder Name)</label>
                                    <input type="text" placeholder="@translate(Enter Stripe Card Holder Name)"
                                           value="{{$account->stripe_card_holder_name ?? ''}}"
                                           name="stripe_card_holder_name"
                                           class="form-control">
                                </div>
                                <div class="form-group m-2">
                                    <label class="label">@translate(Stripe Card Number)</label>
                                    <input type="number" placeholder="@translate(Enter Stripe Card Number)"
                                           value="{{$account->stripe_card_number ?? ''}}" name="stripe_card_number"
                                           class="form-control">
                                </div>

                                <div class="text-center ">
                                    <button class="btn theme-btn" type="submit">@translate(Save)</button>
                                </div>
                            </div>
                        </div>


                    </form>

                </div>
            </div><!-- end dashboard-content-wrap -->
            </div><!-- end dashboard-content-wrap -->
    </section><!-- end dashboard-area -->
    <!-- ================================
        END DASHBOARD AREA
    ================================= -->
@endsection

