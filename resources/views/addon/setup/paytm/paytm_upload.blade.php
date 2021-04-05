@extends('layouts.master')
@section('title','Paytm Addon Upload')
@section('parentPageTitle', 'Paytm Addon Upload')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card m-2">
                    <div class="card-header">
                        <span class="h1 card-title">@translate(Paytm Addon Upload)</span>
                    </div>

                    <div class="card-body t-div">
                        <div class="container m-auto">
                            <div class="row my-4">
                                <div class="col-12">

                                    <form action="{{ route('addon.install.index') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" value="{{ $addon_name }}" name="addon_name" required>
                                        <input type="hidden" value="{{ $purchase_code }}" name="purchase_code" required>
                                        <input type="hidden" value="{{ $paytm_environment }}" name="paytm_environment"
                                               required>
                                        <input type="hidden" value="{{ $paytm_merchant_id }}" name="paytm_merchant_id"
                                               required>
                                        <input type="hidden" value="{{ $paytm_merchant_key }}" name="paytm_merchant_key"
                                               required>
                                        <input type="hidden" value="{{ $paytm_merchant_website }}"
                                               name="paytm_merchant_website" required>
                                        <input type="hidden" value="{{ $paytm_channel }}" name="paytm_channel" required>
                                        <input type="hidden" value="{{ $paytm_industry_type }}"
                                               name="paytm_industry_type" required>

                                        <input type="file" class="dropify" name="addons">

                                        <div class="progress progress-height">
                                            <div
                                                class="progress-bar bg-success progress-bar-striped progress-bar-animated progBar addonProgressBar"
                                                role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                aria-valuemax="100">0%
                                            </div>
                                        </div>

                                        <div class="text-center mt-5">
                                            <button type="submit" class="btn btn-primary w-50 p-3"
                                                    onclick="addonLoader()">Install Addon
                                            </button>
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
