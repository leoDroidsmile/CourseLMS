@extends('layouts.master')
@section('title','Wallet Settings')
@section('parentPageTitle', 'All')

@section('css-link')
@stop

@section('page-style')
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 px-5">
            <div class="card m-2">
                <div class="card-header">
                    <h3>@translate(Wallet Options)</h3>
                </div>
                <div class="card-body mx-5">
                    <form method="post" action="{{route('wallet.update')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="mt-5">
                        <!--name-->
                        <label class="label">@translate(Wallet Name)</label>
                        <input type="text" value="{{getWalletSetting('wallet_name') ?? 'Coin'}}" name="wallet_name" placeholder="Wallet Name"
                               class="form-control mb-2">
                    </div>

                    <div class="mt-5">
                        <!--footer-->
                        <label class="label">@translate(Wallet Icon)</label>
                        <input type="text" value="{{getWalletSetting('wallet_icon') ?? 'fa fa-money'}}" name="wallet_icon" placeholder="Wallet Icon"
                               class="form-control mb-2">
                               <p>Get icons from <a href="https://fontawesome.com/v4.7.0/icons/" target="_blank">Font Awesome 4.7.0</a> </p>
                    </div>


                    <div class="mt-5">

                         <!--name-->
                        <label class="label">@translate(Wallet Rate)</label>
                        <input type="number" value="{{getWalletSetting('wallet_rate') ?? walletRate()}}" name="wallet_rate" placeholder="Wallet Rate"
                               class="form-control mb-2">
                        <p class="text-info font-weight-bold">@translate(Wallet rate based on USD. For example 1 USD = 1000 points)</p>
                    </div>


                    <div class="mt-5">
                         <!--name-->
                        <label class="label">@translate(Minimum Redeem Limit)</label>
                        <input type="number" value="{{getWalletSetting('redeem_limit') ?? walletRateLimit()}}" name="redeem_limit" placeholder="Redeem Limit"
                               class="form-control mb-2">
                    </div>

                    <div class="mt-5">

                         <!--name-->
                        <label class="label">@translate(New User Registration Point)</label>
                        <input type="number" value="{{registrationPoint() ?? registrationPoint()}}" name="registration_point" placeholder="New User Registration Point"
                               class="form-control mb-2">
                    </div>

                    <div class="mt-5">

                         <!--name-->
                        <label class="label">@translate(Free Course Enroll Point)</label>
                        <input type="number" value="{{freePoint()}}" name="free_course_point" placeholder="Free Course Enroll Point"
                               class="form-control mb-2">
                    </div>

                    <div class="mt-5">

                         <!--name-->
                        <label class="label">@translate(Paid Course Enroll Point)</label>
                        <input type="number" value="{{paidPoint()}}" name="paid_course_point" placeholder="Paid Course Enroll Point"
                               class="form-control mb-2">
                    </div>

                    <div class="mt-5">
                         <!--name-->
                        <label class="label">@translate(Course Complete Point)</label>
                        <input type="number" value="{{courseCompletePoint()}}" name="course_complete_point" placeholder="Course Complete Point"
                               class="form-control mb-2">
                    </div>

                    <div class="mt-5">

                        <div class="m-2 float-right">
                            <button class="btn btn-primary" type="submit">@translate(Save Changes)</button>
                        </div>

                    </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-link')
@stop

@section('page-script')
@stop