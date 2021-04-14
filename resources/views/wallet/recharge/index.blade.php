@extends('wallet.recharge.app')

@section('body')
<div class="card mt-50 mb-50" style="background-image: url({{ asset('wallet_bg.png') }});">

    <div class="wallet_logo text-center">
        <img src="{{ filePath(getSystemSetting('type_logo')->value) }}" class="w-75" alt="">
    </div>

    <div class="card-title mx-auto mb-50"> Top up {{ walletName() }} </div>


    <div class="wallet-box">


        <div>
            <div class="row row-2">
                <label for="">Enter Couon Code:</label>
                <input type="text" class="form-control" name="code"
                    placeholder="Enter Code" required id="edit_code">

                @error('amount')
                <p class="text-danger">{{ $message }}</p>
                @enderror

            </div>
        </div>

        <button class="btn d-flex mx-auto" id="btn_charge"><b>Charge</b></button>

    </div>
</div>
@endsection

@section("js")

<script>
    $(document).ready(function(){
        $("#btn_charge").click(function () {
            var url = "/api/v1/charge";
            var code = $("#edit_code").val();
            var user_id = "{{ Auth::user()->id }}"
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: url,
                data: { code: code, user_id : user_id },
                method: "POST",
                success: function (result) {
                    if(result.error){
                        $.notify(result.error, 'error')
                    }

                    if(result.success){
                        $.notify(result.success, 'success');
                        location.href = "/student/profile"
                    }
                }
            });
            
        });
    }) 
    </script>

@endsection
