@extends('layouts.master')
@section('title','Paytm Account Setup')
@section('parentPageTitle', 'Paytm Account Setup')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-2">
                    <div class="card-header">
                       
                            <span class="h1 card-title">@translate(Paytm Account Setup)</span>

                    </div>
                    <div class="card-body t-div">
                        <div class="container m-auto">
  <div class="row my-4">
    <div class="col-12">



        
      <form action="{{ route('addon.paytm.account.setup') }}" 
            method="POST" 
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="addon_name" value="{{ $addon_name }}" required>
            <input type="hidden" name="purchase_code" value="{{ $purchase_code }}" required>

        <div class="form-row">

          <div class="form-group col-md-12">
            <label for="inputEmail4">PAYTM_ENVIRONMENT</label>
            <input type="text" name="paytm_environment" value="{{ env('PAYTM_ENVIRONMENT') ?? '' }}" class="form-control" placeholder="Enter Paytm Environment" required>
          </div>

          <div class="form-group col-md-12">
            <label for="inputEmail4">PAYTM_MERCHANT_ID</label>
            <input type="text" name="paytm_merchant_id" class="form-control" value="{{ env('PAYTM_MERCHANT_ID') ?? '' }}" placeholder="Enter Paytm Merchant ID" required>
          </div>

          <div class="form-group col-md-12">
            <label for="inputEmail4">PAYTM_MERCHANT_KEY</label>
            <input type="text" name="paytm_merchant_key" class="form-control" value="{{ env('PAYTM_MERCHANT_KEY') ?? '' }}" placeholder="Enter Paytm Merchant Key" required>
          </div>

          <div class="form-group col-md-12">
            <label for="inputEmail4">PAYTM_MERCHANT_WEBSITE</label>
            <input type="text" name="paytm_merchant_website" class="form-control" value="{{ env('PAYTM_MERCHANT_WEBSITE') ?? '' }}" placeholder="Enter Paytm Merchant Website" required>
          </div>

          <div class="form-group col-md-12">
            <label for="inputEmail4">PAYTM_CHANNEL</label>
            <input type="text" name="paytm_channel" class="form-control" value="{{ env('PAYTM_CHANNEL') ?? '' }}" placeholder="Enter Paytm Channel" required>
          </div>

          <div class="form-group col-md-12">
            <label for="inputEmail4">PAYTM_INDUSTRY_TYPE</label>
            <input type="text" name="paytm_industry_type" class="form-control" value="{{ env('PAYTM_INDUSTRY_TYPE') ?? '' }}" placeholder="Enter Paytm Inductry Type" required>
          </div>

        </div>

        <button type="submit" class="btn btn-success">Save Account</button>

      </form>


      

    </div>
  </div>
</div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <hr>

@endsection
