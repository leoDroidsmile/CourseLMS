@extends('layouts.master')
@section('title','Setup Affiliate Setting')
@section('parentPageTitle', 'All')


@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 px-5">
            <div class="card m-2">
                <div class="card-header">
                    <h3>@translate(Affiliate  Setting)</h3>
                </div>
                <div class="card-body mx-5">
                    <form method="post" action="{{route('affiliate.setting.update')}}" enctype="multipart/form-data">
                    @csrf


                    <!--commission-->
                        <label class="label">@translate(Affiliate commission)</label>
                        <input type="hidden" value="commission" name="type_commission">
                        <input type="text" value="{{getSystemSetting('commission')->value}}" name="commission"
                               class="form-control mb-2">

                        <!--withdraw_limit-->
                        <label class="label">@translate(Withdraw Limit)</label>
                        <input type="hidden" value="withdraw_limit" name="type_withdraw_limit">
                        <input type="text" value="{{getSystemSetting('withdraw_limit')->value}}" name="withdraw_limit"
                               class="form-control mb-2">

                        <!--cookies_limit-->
                        <label class="label">@translate(Cookies Limit)(@translate(day))</label>
                        <input type="hidden" value="cookies_limit" name="type_cookies_limit">
                        <input type="text" value="{{getSystemSetting('cookies_limit')->value}}" name="cookies_limit"
                               class="form-control mb-2">


                        <div class="m-2 float-right">
                            <button class="btn btn-primary" type="submit">@translate(Save)</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection




