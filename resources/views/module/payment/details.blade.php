

<div class="card-body">
    @if($payment->status != "Confirm" )
    <form action="{{route('payments.status',$payment->id)}}" method="get" enctype="multipart/form-data">
        @csrf
        @endif
        <input type="hidden" name="status" value="Request">
        <div class="form-group">
            <label>@translate(Withdrawal Amount)</label>
            <input class="form-control" value="{{$payment->amount}}"   readonly>
        </div>
        <div class="form-group">
            <label>@translate(Description)</label>
            <textarea  class="form-control" readonly>{!! $payment->description !!}</textarea>
        </div>

        <hr/>
        <p>@translate(Payment Details)</p>

        @if($account->stripe == $payment->process)
            <div class="card-body">
                <div class="form-group">
                    <label class="label">@translate(Stripe Account Name)</label>
                    <input type="text" readonly
                           value="{{$account->stripe_acc_name ?? 'Account is Not Found'}}"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label class="label">@translate(Stripe Account Email)</label>
                    <input type="email" readonly
                           value="{{$account->stripe_acc_email ?? ''}}"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label class="label">@translate(Stripe Card Holder Name)</label>
                    <input type="text" readonly
                           value="{{$account->stripe_card_holder_name ?? ''}}"

                           class="form-control">
                </div>
                <div class="form-group">
                    <label class="label">@translate(Stripe Card Number)</label>
                    <input type="number" readonly
                           value="{{$account->stripe_card_number ?? ''}}"
                           class="form-control">
                </div>

            </div>
        @elseif($account->paypal == $payment->process)
            <div class="card-body">
                <div class="form-group">
                    <label class="label">@translate(Paypal Account Name)</label>
                    <input type="text" readonly
                           value="{{$account->paypal_acc_name ?? ''}}"
                           class="form-control">
                </div>
                <div class="form-group ">
                    <label class="label">@translate(Paypal Account Email)</label>
                    <input type="email"readonly
                           value="{{$account->paypal_acc_email ?? ''}}"
                           class="form-control">
                </div>

            </div>
        @else
            <div class="card-body">
                <div class="form-group ">
                    <label class="label">@translate(Bank Name)</label>
                    <input type="text" readonly
                           value="{{$account->bank_name ?? ''}}"
                           class="form-control">


                    <div class="form-group">
                        <label class="label">@translate(Account Name)</label>
                        <input type="text" readonly
                               value="{{$account->account_name ?? ''}}"
                               class="form-control">
                    </div>

                    <div class="form-group ">
                        <label class="label">@translate(Account Number)</label>
                        <input type="text" readonly
                               value="{{$account->account_number ?? ''}}"
                               class="form-control">
                    </div>
                    <div class="form-group ">
                        <label class="label">@translate(Routing Number)</label>
                        <input type="number" readonly
                               value="{{$account->routing_number ?? ''}}"
                               class="form-control">
                    </div>

                </div>
            </div>
            @endif
        @if($payment->status != "Confirm" )
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Confirm)</button>
        </div>

    </form>
    @endif
</div>





