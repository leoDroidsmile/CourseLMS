@extends('wallet.recharge.app')
@section('css')
        <link rel="stylesheet" href="{{ asset('wallet/gateway.css') }}">
@endsection

@section('body')
<div class="card mt-50 mb-50" style="background-image: url({{ asset('wallet_bg.png') }});">

    <div class="wallet_logo text-center">
        <img src="{{ filePath(getSystemSetting('type_logo')->value) }}" class="w-75" alt="">
    </div>


    <div class="card-title select-payment mx-auto mb-30"> @translate(Select Payment Gateway) </div>

    <div class="wallet-box">

<div class="row gateways">

    @if (env('STRIPE_KEY') != NULL || env('STRIPE_SECRET') != NULL)
        <a class='button--inverse w-100' onclick="stripe()">Stripe</a>
    @endif

   @if (env('PAYPAL_CLIENT_ID') != NULL || env('PAYPAL_APP_SECRET') != NULL)
        <a class='button--inverse w-100' onclick="paypal()">PayPal</a>
    @endif

   @if(env('PAYTM_MERCHANT_ID') != "" &&  env('PAYTM_MERCHANT_KEY') != "" &&  env('PAYTM_ACTIVE') != "NO" && paytmRouteForBlade())
        <a class='button--inverse w-100' onclick="paytm()">PayTm</a>
    @endif
</div>

@if (env('STRIPE_KEY') != NULL || env('STRIPE_SECRET') != NULL)
<div class="stripe-card d-none">
        <form role="form"
                action="{{ route('wallet.stripe') }}"
                method="post" class="require-validation"
                data-cc-on-file="false"
                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                id="payment-form">
            @csrf

            <div class="input-box">
                <label class="label-text">@translate(Name on Card) <span
                        class="primary-color-2 ml-1">*</span></label>
                <div class="form-group">
                    <span
                        class="la la-pencil input-icon"></span>
                    <input class="form-control"
                            placeholder="Card Name"
                            type="text" name="text"
                            value=""
                            required="">
                </div>
            </div>
            <div class="input-box">
                <label class="label-text">@translate(Card Number)<span
                        class="primary-color-2 ml-1">*</span></label>
                <div class="form-group">
                    <span
                        class="la la-pencil input-icon"></span>
                    <input class="form-control card-number"
                            name="text"
                            placeholder="1234  5678  9876  5432"
                            required=""
                            value=""
                            type="text">
                </div>
            </div>
            <div class="input-box">
                <label class="label-text">@translate(Expiry Month)<span
                        class="primary-color-2 ml-1">*</span></label>
                <div class="form-group">
                    <span
                        class="la la-pencil input-icon"></span>
                    <input
                        class="form-control card-expiry-month"
                        placeholder="MM" required=""
                        value=""
                        name="text" type="text">
                </div>
            </div>
            <div class="input-box">
                <label class="label-text">@translate(Expiry Year)<span
                        class="primary-color-2 ml-1">*</span></label>
                <div class="form-group">
                    <span
                        class="la la-pencil input-icon"></span>
                    <input
                        class="form-control card-expiry-year"
                        placeholder="YY" required=""
                        value=""
                        name="text" type="text">
                </div>
            </div>
            <div class="input-box">
                <label class="label-text">@translate(CVC)<span
                        class="primary-color-2 ml-1">*</span></label>
                <div class="form-group">
                    <span
                        class="la la-pencil input-icon"></span>
                    <input class="form-control card-cvc"
                            placeholder="CVC" required=""
                            value=""
                            name="text" type="text">
                </div>
            </div>

            <div class="input-box">

                <input type="hidden" name="name"
                        value="{{ Auth::user()->name }}">

                
                <input type="hidden" 
                        name="payment"
                        value="{{ StripePrice($payment) }}">
                
                <input type="hidden" 
                        name="amount"
                        value="{{ $amount }}">

            </div>



            <button type="submit"
                    class="btn btn-primary d-block text-center m-auto">
                    @translate(Pay now) ({{ formatPrice($payment) }})
            </button>

        </form>
</div>
@endif

@if (env('PAYPAL_CLIENT_ID') != NULL || env('PAYPAL_APP_SECRET') != NULL)
<div class="paypal-card d-none">


    <table class="table">
  <thead>
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{ walletName() }}</th>
      <td>{{ $amount }}</td>
    </tr>
    <tr>
      <th scope="row">@translate(Payment)</th>
      <td>{{ formatPrice($payment) }}</td>
    </tr>
  
  </tbody>
</table>

        <form class=""
                                            enctype="multipart/form-data"
                                            action="{{ route('wallet.paypal') }}"
                                            method="POST">
                                            
                                            @csrf

                                            <input type="hidden" 
                                            name="amount"
                                            value="{{ PaypalPrice($payment) }}">

                                            <input 
                                            type="hidden" 
                                            name="amount" 
                                            value="{{ $amount }}">

                                                <button type="submit"
                                                    class="btn btn-primary">@translate(Checkout Now)</button>
                                        </form>
</div>
@endif

@if(env('PAYTM_MERCHANT_ID') != "" &&  env('PAYTM_MERCHANT_KEY') != "" &&  env('PAYTM_ACTIVE') != "NO" && paytmRouteForBlade())
<div class="paytm-card d-none">


    <table class="table">
  <thead>
    <tr>
      <th scope="col">@translate(Item)</th>
      <th scope="col">@translate(Amount)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{ walletName() }}</th>
      <td>{{ $amount }}</td>
    </tr>
    <tr>
      <th scope="row">@translate(Payment)</th>
      <td>{{ formatPrice($payment) }}</td>
    </tr>
  
  </tbody>
</table>

        <form action="{{ route('wallet.paytm') }}" method="POST">
            @csrf
                <input type="hidden" name="name"
                        value="{{ Auth::user()->name }}">

                
                <input type="hidden" 
                        name="payment"
                        value="{{ PaytmPrice($payment) }}">
                
                <input type="hidden" 
                        name="amount"
                        value="{{ $amount }}">

                <button type="submit"
                                                    class="btn btn-primary">@translate(Checkout Now)</button>

        </form>

</div>
@endif


    </div>
</div>



@endsection

@section('js')
     {{-- stripe --}}
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        "use strict"
        $(function () {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
// token contains id, last4, and card type
                    var token = response['id'];
// insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });


    </script>

@endsection