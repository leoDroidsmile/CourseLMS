@extends('layouts.master')
@section('title','Purchase Code Verification')
@section('parentPageTitle', 'Purchase Code Verification')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-2">
                    <div class="card-header">
                       
                            <span class="h1 card-title">@translate(Purchase Code Verification)</span>

                    </div>

                  

                    
                    <div class="card-body t-div">
                        <div class="container m-auto">
  <div class="row my-4">
    <div class="col-12">

      <form action="{{ route('addons.purchase_code.verify','paytm') }}" 
            method="POST" 
            enctype="multipart/form-data">
            @csrf

        <div class="form-row">

          <div class="form-group col-md-12">
            <label for="inputEmail4">ITEM PURCHASE CODE <a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="The product purchase code is given from codecanyon, when you bought the application."> <i class="fa fa-info-circle" aria-hidden="true"></i></a> </label>
            <br>
            <small>The product purchase code is given from codecanyon, when you bought the application.</small>
            <input type="hidden" name="addon_name" value="{{ $addon }}">
            <input type="text" placeholder="PRODUCT PURCHASE CODE" name="purchase_code" class="form-control purchase_code" placeholder="Enter your purchase code" required>
          </div>
        
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-success w-25 btn-purchase_code">Verify Product</button>
        </div>


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
