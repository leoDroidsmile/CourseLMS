@extends('layouts.master')
@section('title','Setup App Setting')
@section('parentPageTitle', 'All')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1 px-3">
            <div class="card m-2">
                <div class="card-header">
                    <h2 class="card-title">@translate(Setup App Settings)</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('app.update')}}" enctype="multipart/form-data">
                        @csrf

                        <label class="label">@translate(Google Api Client Id) <a href="https://developers.google.com/identity/one-tap/web/guides/get-google-api-clientid" target="_blank"><i class="fa fa-info text-warning"></i></a></label>
                        <input type="hidden" name="types[]" value="GOOGLE_CLIENT_ID">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('GOOGLE_CLIENT_ID')}}"
                               name="GOOGLE_CLIENT_ID"
                               class="form-control mb-2">

                        <label class="label">@translate(Google App Secret)</label>
                        <input type="hidden" name="types[]" value="GOOGLE_SECRET">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('GOOGLE_SECRET')}}"
                               name="GOOGLE_SECRET"
                               class="form-control mb-2">

                        <input type="hidden" name="types[]" value="GOOGLE_CALLBACK">
                        <input type="hidden" placeholder="@translate(Enter the data)" value="{{env('APP_URL').'/callback/google'}}"
                               name="GOOGLE_CALLBACK"
                               class="form-control mb-2">
                        <hr class="py-2">
                        <label class="label">@translate(PAYPAL CLIENT ID)(Business account) <a href="https://developer.paypal.com/docs/api-basics/manage-apps/" target="_blank"><i class="fa fa-info text-warning"></i></a></label>
                        <input type="hidden" name="types[]" value="PAYPAL_CLIENT_ID">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('PAYPAL_CLIENT_ID')}}"
                               name="PAYPAL_CLIENT_ID"
                               class="form-control mb-2">

                        <label class="label">@translate(PAYPAL APP SECRET)</label>
                        <input type="hidden" name="types[]" value="PAYPAL_APP_SECRET">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('PAYPAL_APP_SECRET')}}"
                               name="PAYPAL_APP_SECRET"
                               class="form-control mb-2">

                        <hr class="py-2">
                        <label class="label">@translate(STRIPE KEY) <a href="https://stripe.com/docs/development/quickstart" target="_blank"><i class="fa fa-info text-warning"></i></a></label>
                        <input type="hidden" name="types[]" value="STRIPE_KEY">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('STRIPE_KEY')}}"
                               name="STRIPE_KEY"
                               class="form-control mb-2">

                        <label class="label">@translate(STRIPE SECRET)</label>
                        <input type="hidden" name="types[]" value="STRIPE_SECRET">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('STRIPE_SECRET')}}"
                               name="STRIPE_SECRET"
                               class="form-control mb-2">
                        <hr class="py-2">
                        {{-- Paytm --}}

                         @if(env('PAYTM_MERCHANT_ID') != "" &&  env('PAYTM_MERCHANT_KEY') != "" &&  env('PAYTM_ACTIVE') != "NO" && paytmRouteForBlade())

                        <label class="label">@translate(PAYTM_ENVIRONMENT)(Production Environment Only) <a href="https://developer.paytm.com/" target="_blank"><i class="fa fa-info text-warning"></i></a></label>
                        <input type="hidden" name="types[]" value="PAYTM_ENVIRONMENT">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('PAYTM_ENVIRONMENT')}}"
                               name="PAYTM_ENVIRONMENT"
                               class="form-control mb-2">

                        <label class="label">@translate(PAYTM_MERCHANT_ID)</label>
                        <input type="hidden" name="types[]" value="PAYTM_MERCHANT_ID">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('PAYTM_MERCHANT_ID')}}"
                               name="PAYTM_MERCHANT_ID"
                               class="form-control mb-2">

                        <label class="label">@translate(PAYTM_MERCHANT_KEY)</label>
                        <input type="hidden" name="types[]" value="PAYTM_MERCHANT_KEY">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('PAYTM_MERCHANT_KEY')}}"
                               name="PAYTM_MERCHANT_KEY"
                               class="form-control mb-2">

                        <label class="label">@translate(PAYTM_MERCHANT_WEBSITE)</label>
                        <input type="hidden" name="types[]" value="PAYTM_MERCHANT_WEBSITE">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('PAYTM_MERCHANT_WEBSITE')}}"
                               name="PAYTM_MERCHANT_WEBSITE"
                               class="form-control mb-2">

                        <label class="label">@translate(PAYTM_CHANNEL)</label>
                        <input type="hidden" name="types[]" value="PAYTM_CHANNEL">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('PAYTM_CHANNEL')}}"
                               name="PAYTM_CHANNEL"
                               class="form-control mb-2">

                        <label class="label">@translate(PAYTM_INDUSTRY_TYPE)</label>
                        <input type="hidden" name="types[]" value="PAYTM_INDUSTRY_TYPE">
                        <input type="text" placeholder="@translate(Enter the data)" value="{{env('PAYTM_INDUSTRY_TYPE')}}"
                               name="PAYTM_INDUSTRY_TYPE"
                               class="form-control mb-2">

                         @endif

                        {{-- Paytm:END --}}
                        <hr class="py-2">
                        <div class="m-2 float-right">
                            <button class="btn btn-primary" type="submit">@translate(Save)</button>
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


