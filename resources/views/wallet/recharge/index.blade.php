@extends('wallet.recharge.app')

@section('body')
<div class="card mt-50 mb-50" style="background-image: url({{ asset('wallet_bg.png') }});">

    <div class="wallet_logo text-center">
        <img src="{{ filePath(getSystemSetting('type_logo')->value) }}" class="w-75" alt="">
    </div>

    <div class="card-title mx-auto mb-50"> Top up {{ walletName() }} </div>


    <div class="wallet-box">


        <form action="{{ route('wallet.gateway') }}" method="GET">

            <div>
                <div class="row row-2">
                    <label for="">Enter {{ walletName() }} amount:</label>
                    <input type="number" min="10" class="form-control" id="wallet-amount" name="amount"
                        placeholder="Enter amount" required>

                    @error('amount')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror

                </div>
            </div>


            <div class="mt-3">
                <div class="row row-2">
                    <label for="">Payable Amount</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="h1">$</span>
                        </div>

                        <h1 class="wallet-pay">0</h1>

                        <input type="hidden" readonly class="form-control" id="wallet-pay" name="payment" disabled
                            placeholder="Payable Amount" required>

                    </div>
                    @error('payment')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror

                </div>
            </div>

            <button type="submit" class="btn d-flex mx-auto"><b>Next</b></button>
        </form>

    </div>
</div>

<input type="hidden" value="{{ route('wallet.amount') }}" id="url">

@endsection