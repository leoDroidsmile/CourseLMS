@extends('rumbok.app')
@section('content')
    <!-- ================================
START SIGN UP AREA
================================= -->
    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-shape">
            <img src="{{asset('asset_rumbok/images/round-shape-2.png')}}" alt="shape"
                 class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('asset_rumbok/images/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>@translate(Instructor Registration payment)</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> /@translate(Instructor Registration payment)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sign-up section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title text-center">
                            <h3 class="widget-title font-size-35">@translate(Create an Account and) <br>
                                @translate(Start Teaching)!</h3>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-info text-center">{{ Session::get('message') }}</div>
                        @endif
                        <div class="card-box-shared-body">
                            <div class="contact-form-action">
                                <div class="row">
                                    {{--Radio button--}}
                                    <div class="m-auto text-center pt-5">
                                        <div class="post-card theme-bg text-white">
                                            <div class="post-card-content">
                                                @if($user->relationBetweenPackage->image ?? false)
                                                    <img src="{{filePath($user->relationBetweenPackage->image)}}" alt=""
                                                         class="img-fluid">
                                                    <h2 class="widget-title mt-4 mb-2">
                                                        @endif
                                                        @translate(Price):{{onlyPrice($user->relationBetweenPackage->price)}}</h2>
                                                    <p>{{getSystemSetting('type_name')->value}} @translate(Commission
                                                        is):{{$user->relationBetweenPackage->commission}}%</p>
                                            </div><!-- end post-card-content -->
                                            @error('package')
                                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12 ">
                                        <div class="input-box">
                                            <div class="card-box-shared">
                                                <div class="card-box-shared-title">
                                                    <h3 class="widget-title">@translate(Select Payment Method)</h3>
                                                </div>
                                                <div class="card-box-shared-body p-0">
                                                    <div class="payment-method-wrap">
                                                        <div class="checkout-item-list">
                                                            <div class="accordion" id="paymentMethodExample">
                                                                {{-- Stripe --}}
                                                                <div class="card">
                                                                    <div class="card-header w-55" id="headingThree">
                                                                        <div
                                                                            class="checkout-item d-flex align-items-center justify-content-between">
                                                                            <label for="radio-8 stripe-label"
                                                                                   class="radio-trigger collapsed mb-0 w-100"
                                                                                   data-toggle="collapse"
                                                                                   data-target="#collapseTwo"
                                                                                   aria-expanded="false"
                                                                                   aria-controls="collapseTwo">
                                        <span class="theme-btn font-size-18 stripe-btn d-block text-center">
                                      <h3>Stripe</h3>
                                       </span>
                                                                            </label>

                                                                        </div>
                                                                    </div>

                                                                    <div id="collapseTwo" class="collapse"
                                                                         aria-labelledby="headingThree"
                                                                         data-parent="#paymentMethodExample">
                                                                        <div class="card-body">
                                                                            <div
                                                                                class="contact-form-action stripe-margin">
                                                                                <form role="form"
                                                                                      action="{{ route('instructor.stripe.payment') }}"
                                                                                      method="post"
                                                                                      class="require-validation"
                                                                                      data-cc-on-file="false"
                                                                                      data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                                                      id="payment-form">
                                                                                    @csrf
                                                                                    <input type="hidden" name="user_id"
                                                                                           value="{{$user->user_id}}">
                                                                                    <input type="hidden"
                                                                                           name="package_id"
                                                                                           value="{{$user->package_id}}">
                                                                                    <div class="input-box">
                                                                                        <label class="label-text">@translate(Name
                                                                                            on Card) <span
                                                                                                class="primary-color-2 ml-1">*</span></label>
                                                                                        <div class="form-group">
                                          <span
                                              class="la la-pencil input-icon"></span>
                                                                                            <input class="form-control"
                                                                                                   placeholder="Card Name"
                                                                                                   type="text"
                                                                                                   name="text"
                                                                                                   required="">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="input-box">
                                                                                        <label class="label-text">@translate(Card
                                                                                            Number)<span
                                                                                                class="primary-color-2 ml-1">*</span></label>
                                                                                        <div class="form-group">
                                            <span
                                                class="la la-pencil input-icon"></span>
                                                                                            <input
                                                                                                class="form-control card-number"
                                                                                                name="text"
                                                                                                placeholder="1234  5678  9876  5432"
                                                                                                required="" type="text">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="input-box">
                                                                                        <label class="label-text">@translate(Expiry
                                                                                            Month)<span
                                                                                                class="primary-color-2 ml-1">*</span></label>
                                                                                        <div class="form-group">
                                              <span
                                                  class="la la-pencil input-icon"></span>
                                                                                            <input
                                                                                                class="form-control card-expiry-month"
                                                                                                placeholder="MM"
                                                                                                required=""
                                                                                                name="text" type="text">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="input-box">
                                                                                        <label class="label-text">@translate(Expiry
                                                                                            Year)<span
                                                                                                class="primary-color-2 ml-1">*</span></label>
                                                                                        <div class="form-group">
                                                <span
                                                    class="la la-pencil input-icon"></span>
                                                                                            <input
                                                                                                class="form-control card-expiry-year"
                                                                                                placeholder="YY"
                                                                                                required=""
                                                                                                name="text" type="text">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="input-box">
                                                                                        <label class="label-text">@translate(CVC)<span
                                                                                                class="primary-color-2 ml-1">*</span></label>
                                                                                        <div class="form-group">
                                                  <span
                                                      class="la la-pencil input-icon"></span>
                                                                                            <input
                                                                                                class="form-control card-cvc"
                                                                                                placeholder="CVC"
                                                                                                required=""
                                                                                                name="text" type="text">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="input-box">
                                                                                        <input type="hidden" name="name"
                                                                                               value="{{$user->name }}">
                                                                                        <input type="hidden"
                                                                                               name="amount_g"
                                                                                               value="{{$user->relationBetweenPackage->price}}">
                                                                                        <input type="hidden"
                                                                                               name="amount"
                                                                                               value="{{$user->relationBetweenPackage->price}}">
                                                                                    </div>

                                                                                    <button type="submit"
                                                                                            class="theme-btn d-block text-center m-auto">
                                                                                        @translate(Proceed)({{formatPrice($user->relationBetweenPackage->price)}}
                                                                                        )
                                                                                    </button>
                                                                                </form>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end card -->
                                                            {{-- Stripe::END --}}


                                                            <!-- end card -->
                                                                <div class="card">
                                                                    <div id="paypal-button"></div>
                                                                </div><!-- end card -->

                                                                <form id="paypal-form" method="post"
                                                                      action="{{route('instructor.paypal.payment')}}">
                                                                    @csrf
                                                                    <input type="hidden" name="orderID" id="orderID">
                                                                    <input type="hidden" name="amount_g"
                                                                           value="{{$user->relationBetweenPackage->price}}">
                                                                    <input type="hidden" name="package_id"
                                                                           value="{{$user->package_id}}">
                                                                    <input type="hidden" name="user_id"
                                                                           value="{{$user->user_id}}">
                                                                    <input type="hidden" name="paymentID"
                                                                           id="paymentID">
                                                                    <input type="hidden" name="paymentToken"
                                                                           id="paymentToken">
                                                                    <input type="hidden"
                                                                           value="{{$user->relationBetweenPackage->price}}"
                                                                           name="amount" id="amount">
                                                                </form>

                                                            </div><!-- end accordion -->
                                                        </div>
                                                    </div><!-- end payment-method-wrap -->
                                                </div><!-- end card-box-shared-body -->
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->

                                </div><!-- end row -->
                            </div><!-- end contact-form -->
                        </div>
                    </div>
                </div><!-- end col-md-7 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end sign-up -->
    <!-- ================================
    START SIGN UP AREA
    ================================= -->
@endsection
@section('js')
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


    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        "use strict"
        paypal.Button.render({
            // Configure environment
            env: 'sandbox',
            client: {
                production: '{{env('PAYPAL_CLIENT_ID')}}'
            },
            //Todo::must be  env data in client
            // Customize button (optional)
            locale: 'en_US',
            style: {
                size: 'responsive',
                color: 'gold',
                shape: 'pill',
                label: 'checkout',
            },

            // Enable Pay Now checkout flow (optional)
            commit: true,

            // Set up a payment
            payment: function (data, actions) {
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: '{{ $user->relationBetweenPackage->price }}',
                            currency: 'USD'
                        }
                    }]
                });
            },
            // Execute the payment
            onAuthorize: function (data, actions) {
                return actions.payment.execute().then(function () {
                    // Show a confirmation message to the buyer
                    /*append data in input form*/
                    $('#orderID').val(data.orderID);
                    $('#payerID').val(data.payerID);
                    $('#paymentID').val(data.paymentID)
                    $('#paymentToken').val(data.paymentToken)
                    $('#paypal-form').submit();
                });
            }
        }, '#paypal-button');

    </script>
@endsection
