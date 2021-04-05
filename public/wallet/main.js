"use strict"

 $(document).ready(function() {
	$('#wallet-amount').on('keyup',function() {
	    var wallet_amount = $(this).val();
	    var url = $('#url').val();

	    // ajax setup

	    $.ajaxSetup({
		headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	    });

	    // ajax setup request start

	    $.ajax({
		type: 'GET',
		url: url,
		data: {
		    wallet_amount: wallet_amount
		},
		success: function(data) {
		    $('#wallet-pay').val(data);
		    $('.wallet-pay').text(data);
		}
	    });

	    // ajax setup request end

	});
    });


	function stripe()
	{
		$('.gateways').addClass('d-none');
		$('.wallet-box').addClass('mt-4');
		$('.select-payment').addClass('d-none');
		$('.stripe-card').removeClass('d-none')
	}

	function paypal()
	{
		$('.gateways').addClass('d-none');
		$('.wallet-box').addClass('mt-4');
		$('.select-payment').addClass('d-none');
		$('.paypal-card').removeClass('d-none')
	}
	function paytm()
	{
		$('.gateways').addClass('d-none');
		$('.wallet-box').addClass('mt-4');
		$('.select-payment').addClass('d-none');
		$('.paytm-card').removeClass('d-none')
	}