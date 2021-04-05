<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Auth;
use App\User;
use App\Wallet;
use App\RedeemCoursePoint;
use Stripe;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use PaytmWallet;

class WalletController extends Controller
{

    private $_api_context;

     public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    /**
    * FRONTEND
    */

    /**
     * REDEEM
     */

     public function redeem($id)
     {
        try {
             if(checkStudentEnroll($id))
                {
                    if (walletActive()) {
                        $redeem = new RedeemCoursePoint;
                        $redeem->course_id = $id;
                        $redeem->user_id = Auth::user()->id;
                        $redeem->save();

                        // Registration Point
                        addWallet(courseCompletePoint(), translate('Course Complete point'));
                        Alert::success('Congratulations', 'Course Complete Point Redeemed');
                        return back();
                    }
                }else{
                    Alert::warning('Whoops', 'Course is not enrolled');
                    return back();
                }
         } catch (\Throwable $th) {
            Alert::error('Whoops', 'Something went wrong');
            return back();
         }
     }

     /**
      * History
      */

      public function history()
      {
        $user = User::where('id', Auth::user()->id)->first();
        $user->transactions;
        $histories = $user['transactions'] = $user->transactions()->paginate(15);
        return view('wallet.frontend.history', compact('histories'));
      }

    /**
    * FRONTEND::END
    */


    /**
     * BACKEND
     */

      public function index()
      {
          return view('wallet.backend.index');
      }

      public function update(Request $request)
      {

        $request->validate([
            'wallet_name' => 'required',
            'wallet_icon' => 'required',
            'wallet_rate' => 'required|numeric',
            'redeem_limit' => 'required|numeric',
            'registration_point' => 'required|numeric',
            'free_course_point' => 'required|numeric',
            'paid_course_point' => 'required|numeric',
            'course_complete_point' => 'required|numeric',
        ],[
            'wallet_name.required' => 'Wallet name is required',
            'wallet_icon.required' => 'Wallet icon is required',
            'wallet_rate.required' => 'Wallet rate is required',
            'redeem_limit.required' => 'Redeem Limit is required',
            'registration_point.required' => 'New user registration point is required',
            'free_course_point.required' => 'Free course point is required',
            'paid_course_point.required' => 'Paid course point is required',
            'course_complete_point.required' => 'Course complete point is required',
        ]);

        try {
            $wallet = Wallet::first();
            $wallet->wallet_name = $request->wallet_name;
            $wallet->wallet_icon = $request->wallet_icon;
            $wallet->wallet_rate = $request->wallet_rate;
            $wallet->redeem_limit = $request->redeem_limit;
            $wallet->registration_point = $request->registration_point;
            $wallet->free_course_point = $request->free_course_point;
            $wallet->paid_course_point = $request->paid_course_point;
            $wallet->course_complete_point = $request->course_complete_point;
            $wallet->save();
            Alert::success('Updated', 'Wallet Options Updated');
            return back();
        } catch (\Throwable $th) {
            Alert::error('Whoops', 'Something went wrong');
            return back();
        }   
      }


      /**
       * PAYMENT
       */

       function payment(Request $request)
       {

        $amount = $request->amount;

        subWallet($amount, translate('New Course Purchased'));

           $request->session()->put('payment', walletName());
           return redirect()->route('checkout');
       }

     /**
     * BACKEND::END
     */



     /**
      * RECHARGE
      */
       public function recharge()
       {
           return view('wallet.recharge.index');
       }

       public function getAmount(Request $request)
       {
            return buyWallet($request->wallet_amount);
       }

       public function gateway(Request $request)
       {
            $request->validate([
                'amount' => 'bail|required|numeric|gt:10',
                'payment' => 'numeric'
            ],[
                'amount.required' => 'Amount field is required',
                'amount.numeric' => 'Amount field value must be numeric',
                'amount.gt' => 'Amount must be greater than 10',
                'payment.numeric' => 'Payment field value must be numeric',
            ]);

            $amount = $request->amount;
            $payment = WalletPrice($request->amount);
            return view('wallet.recharge.gateway', compact('amount','payment'));

       }

       /**
        * PAYMENT--------------------------------------------------------------------
        */
        
        /**
         * STRIPE
         */

         public function stripePay(Request $request)
         {
             try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create([
                "amount" => $request->payment * 100,
                "currency" => 'USD',
                "source" => $request->stripeToken,
                "description" => $request->name . " payment from " . getSystemSetting('type_name')->value,
            ]);

            addWallet($request->amount, 'Purchased through Stripe');
            Alert::success('success', 'Payment successfully done');
            return redirect()->route('student.profile');
            } catch (\Throwable $th) {
                Alert::error('Whoops', 'Something went wrong');
                return back();
            }
         }
        
        /**
         * STRIPE::END
         */

         /**
          * PAYPAL
          */
 public function payWithpaypal(Request $request)
    {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
     
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
            }
        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');

    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('error', 'Payment failed');
            return Redirect::to('/');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            addWallet($request->amount, 'Purchased through PayPal');
            \Session::put('success', 'Payment success');
            return redirect()->route('student.profile');

        }

        \Session::put('error', 'Payment failed');
        return Redirect::to('/');

    }
         /**
          * PAYPAL::END
          */


          /**
           * PAYTM
           */

            public function payWithpaytm(Request $request)
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
                    'amount' => $input['payment'], // paid amount
                    'callback_url' => route('wallet.paytm.callback')
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
            
                // update the db data as per result from api call
                if ($transaction->isSuccessful()) {
                    /*put session*/

                addWallet($request->amount, 'Purchased through payTm');
                return redirect()->route('student.profile');

                } else if ($transaction->isFailed()) {
                    notify()->error(translate('Your payment is failed.'));
                    return redirect(route('student.profile'));
                    
                }
                $transaction->getResponseMessage(); //Get Response Message If Available
            }

          /**
           * PAYTM::END
           */
        
        /**
         * PAYMENT::END--------------------------------------------------------------------
         */

     /**
      * RECHARGE::END
      */

    //END
}
