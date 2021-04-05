@extends('rumbok.app')
@section('content')

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
                    <h2>@translate(cart)</h2>
                    <div class="breadcrumb-link margin-top-10">
                        <span><a href="{{route('homepage')}}">@translate(home)</a> / @translate(cart)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Cart Section Starts -->
    <section class="cart-section padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @php
                        $total_price = 0;
                    @endphp
                    @foreach($carts as $item)

                        <div class="single-cart-item">
                            <div class="row align-items-center">
                                <div class="col-lg-5">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <a href="{{route('course.single',$item->course->slug)}}">
                                                <img src="{{filePath($item->course->image)}}"
                                                     alt="{{$item->course->title}}"></a>
                                        </div>
                                        <div class="col-lg-8">
                                            <h5>
                                                <a href="{{route('course.single',$item->course->slug)}}">{{$item->course->title}}</a>
                                            </h5>
                                            <span>@translate(by) <a
                                                    href="#">{{$item->course->relationBetweenInstructorUser->name}}</a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <ul>
                                        <li>
                                            @if($item->course->is_free)
                                                <h5>@translate(Free)</h5>
                                            @else
                                                @if($item->course->is_discount)
                                                    <h5>{{formatPrice($item->course->discount_price)}}</h5>
                                                    <input type="hidden"
                                                           value="{{$total_price+=$item->course->discount_price}}">
                                                @else
                                                    <input type="hidden" value="{{$total_price+=$item->course->price}}">
                                                    <h5>{{formatPrice($item->course->price)}}</h5>
                                                @endif
                                            @endif
                                        </li>
                                        <li><a href="{{route('cart.remove',$item->id)}}"
                                               class="btn btn-success ">@translate(remove)</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="cart-bottom-button margin-top-20 d-flex justify-content-between">
                        <a href="{{route('course.filter')}}" class="template-button">@translate(keep shopping)</a>
                        <a href="" class="template-button-2 d-none">@translate(update cart)</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Section Starts -->
    <section class="Payment-section padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="coupon-part d-none">
                        <h3>coupon code</h3>
                        <p class="margin-top-20">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum
                            corporis dolor aperiam aut molestias eveniet sequi.</p>
                        <div class="coupon-code margin-top-30">
                            <div class="header-search">
                                <form action="#">
                                    <input type="text" placeholder="Enter Coupon Code">
                                    <button type="submit"><i class="fa fa-plus"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    {{--new--}}
                    <div class="payment-part">
                        <h3>cart total : {{formatPrice($total_price)}}</h3>
                        <h5 class="d-none">tax : $100</h5>
                        <p class="margin-top-20 d-none">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsum
                            corporis dolor aperiam aut molestias eveniet sequi.</p>
                        @if(onlyPrice($total_price) == 0)
                            <div class="btn-box mt-4">
                                <a href="{{route('free.payment')}}" class="theme-btn theme-btn-light">@translate(Checkout)</a>
                            </div>
                        @else
                            <div class="payment-tab margin-top-20">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5>@translate(select payment method)</h5>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="tab">
                                            <ul>
                                                @if (env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL)
                                                    <li class="tab-one active">
                                                        <img src="{{ filePath('asset_rumbok/images/stripe.png') }}"
                                                             alt="logo">
                                                    </li>
                                                @endif

                                                @if (env('PAYTM_ACTIVE') != 'NO' && env('PAYTM_MERCHANT_ID') != NULL  && env('PAYTM_MERCHANT_KEY') != NULL)
                                                    <li class="tab-second">
                                                        <img src="{{ filePath('asset_rumbok/images/paytm.png') }}"
                                                             alt="logo">
                                                    </li>
                                                @endif

                                                @if (env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_APP_SECRET') != NULL)
                                                    <li class="tab-three">
                                                        <img src="{{ filePath('asset_rumbok/images/paypal.png') }}"
                                                             alt="logo">
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tab-content margin-top-30">
                                            @php
                                             $havePaymentMethod = true;
                                            @endphp
                                            @if (env('STRIPE_KEY') != NULL && env('STRIPE_SECRET') != NULL)
                                                <div class="tab-one-content lost active">
                                                    <form role="form"
                                                          action="{{ route('stripe.post') }}"
                                                          method="post"
                                                          class="require-validation"
                                                          data-cc-on-file="false"
                                                          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                                          id="payment-form">
                                                        @csrf

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
                                                                   value="{{ Auth::user()->name }}">
                                                            <input type="hidden"
                                                                   name="amount"
                                                                   value="{{ onlyPrice($total_price) }}">
                                                        </div>

                                                        <button type="submit"
                                                                class="template-button">
                                                            @translate(Proceed)({{formatPrice($total_price)}})
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                            @if (env('PAYTM_ACTIVE') != 'NO' && env('PAYTM_MERCHANT_ID') != NULL  && env('PAYTM_MERCHANT_KEY') != NULL)
                                                <div class="tab-second-content lost">
                                                    <form action="{{ route('paytm.payment') }}"
                                                          method="POST" id="payTmForm">
                                                        @csrf
                                                        <input type="hidden" name="amount"
                                                               value="{{ onlyPrice($total_price) }}">
                                                    </form>

                                                    <a href="javascript:void()" title="Pay via PayTM" class="template-button"
                                                       onclick="paytmPay()">  @translate(Proceed)({{formatPrice($total_price)}})</a>
                                                </div>
                                            @endif
                                            @if (env('PAYPAL_CLIENT_ID') != NULL && env('PAYPAL_APP_SECRET') != NULL)
                                                <div class="tab-three-content lost">


                                                    <div class="card">
                                                        <div id="paypal-button"></div>
                                                    </div>
                                                    <form id="paypal-form" method="post"
                                                          action="{{route('paypal.paymnet')}}"
                                                          class="invisible">
                                                        @csrf
                                                        <input type="hidden" name="orderID" id="orderID">
                                                        <input type="hidden" name="payerID" id="payerID">
                                                        <input type="hidden" name="paymentID"
                                                               id="paymentID">
                                                        <input type="hidden" name="paymentToken"
                                                               id="paymentToken">
                                                        <input type="hidden" value="{{$total_price}}"
                                                               name="amount" id="amount">
                                                    </form>
                                                </div>
                                            @endif

                                            @if($havePaymentMethod)
                                                <button  type="button" class="btn btn-secondary btn-lg disabled"   aria-disabled="true" title="No Payment is setup">@translate(Checkout)</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

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


    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        "use strict"
        paypal.Button.render({
            // Configure environment
            env: '{{env('PAYPAL_ENVIRONMENT')}}',
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
                            total: '{{$total_price}}',
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

    {{-- PAYTM START --}}

    @if(env('PAYTM_MERCHANT_ID') != "" &&  env('PAYTM_MERCHANT_KEY') != "" &&  env('PAYTM_ACTIVE') != "NO" && paytmRouteForBlade())

        <script>
            function paytmPay() {
                $('#payTmForm').submit();
            }
        </script>

    @endif

    {{-- PAYTM END --}}
@endsection
