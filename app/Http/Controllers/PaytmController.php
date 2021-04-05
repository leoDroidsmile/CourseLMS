<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PaytmWallet;
use Auth;
use Mail;
use Carbon\Carbon;
use PDF;
use Session;

class PaytmController extends Controller
{

    /**
     * Redirect the user to the Payment Gateway.
     *
     * @return Response
     */
    public function eventOrderGen(Request $request)
    {

        $order_number = rand(10000,99999);
        $phone_number = rand(10000,99999);
     

        $input = $request->all();
        
        // Store To DB into Order:END

        try {
            $payment = PaytmWallet::with('receive');
            $payment->prepare([
            'order' => $order_number, // order id
            'user' => Auth::user()->id, //user id
            'mobile_number' => $phone_number, // user phone number
            'email' => Auth::user()->email, //user email
            'amount' => $input['amount'], // paid amount
            'callback_url' => route('paytm.callback')
            ]);
            return $payment->receive();
        } catch (\Throwable $th) {
            notify()->info(translate('Something went wrong.Please try again later.'));
            return back();
        }
 
        
    }
 

     public function paymentCallback()
    {
        $transaction = PaytmWallet::with('receive');

        $response = $transaction->response();
        
        $order_id = $transaction->getOrderId(); // return a order id
      
        $transaction->getTransactionId(); // return a transaction id
    
        // update the db data as per result from api call
        if ($transaction->isSuccessful()) {
            /*put session*/
        $request->session()->put('payment', 'Paytm');

        notify()->success(translate('Your payment is successful.'));
        return redirect()->route('checkout');

        } else if ($transaction->isFailed()) {
             notify()->error(translate('Your payment is failed.'));
            return redirect(route('cart.list'));
            
        }
        $transaction->getResponseMessage(); //Get Response Message If Available
    }

    //END
}
