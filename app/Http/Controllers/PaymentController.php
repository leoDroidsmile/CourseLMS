<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use App\Model\AdminEarning;
use App\Model\PackagePurchaseHistory;
use App\Model\VerifyUser;
use App\Notifications\InstructorRegister;
use App\Notifications\VerifyNotifications;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;
use Stripe;

class PaymentController extends Controller
{
    public function stripePost(Request $request)
    {

        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create([
                "amount" => $request->amount * 100,
                "currency" => 'USD',
                "source" => $request->stripeToken,
                "description" => $request->name . " payment from " . getSystemSetting('type_name')->value,
            ]);

            /*put session*/
            Session::forget('coupon');
            $request->session()->put('payment', 'Stripe');

            return redirect()->route('checkout');
        } catch (\Throwable $th) {
            return back()->with('Something went wrong', 'success');
        }
        
    }

    /*this is for paypal payment*/
    public function paypalPayment(Request $request)
    {
        /*put session*/
        Session::forget('coupon');
        $request->session()->put('payment', 'Paypal');
        return redirect()->route('checkout');
    }


    /*this is for free if amount is zero*/
    public function freePayment(Request $request)
    {

        /*put session*/
        $request->session()->put('payment', 'Free');

        if (walletActive()) {
            // Registration Point
            addWallet(freePoint(), translate('Free Course Enrollment Point'));
        }

        return redirect()->route('checkout');
    }


    /*instructor instructorStripe*/
    public function instructorStripe(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $request->amount * 100,
            "currency" =>'USD',
            "source" => $request->stripeToken,
            "description" => $request->name . " payment from " . getSystemSetting('type_name')->value,
        ]);

        //add purchase history
        $purchase = new PackagePurchaseHistory();
        $purchase->amount = $request->amount_g;
        $purchase->payment_method = "Stripe";
        $purchase->package_id = $request->package_id;
        $purchase->user_id = $request->user_id;
        $purchase->save();


        //todo::admin Earning calculation
        $admin = new AdminEarning();
        $admin->amount = $request->amount_g;
        $admin->purposes = "Sale Package";
        $admin->save();

        try {
            $user = User::find($request->user_id);
            $user->notify(new InstructorRegister());
            //verify email
            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            //send verify mail
            $user->notify(new VerifyNotifications($user));
        } catch (\Exception $exception) {

        }

        return redirect()->route('login');
    }

    /*instructorPaypal*/
    public function instructorPaypal(Request $request)
    {

        //add purchase history
        $purchase = new PackagePurchaseHistory();
        $purchase->amount = $request->amount_g;
        $purchase->payment_method = "Paypal";
        $purchase->package_id = $request->package_id;
        $purchase->user_id = $request->user_id;
        $purchase->save();


        //todo::admin Earning calculation
        $admin = new AdminEarning();
        $admin->amount = $request->amount_g;
        $admin->purposes = "Sale Package";
        $admin->save();

        try {
            $user = User::find($request->user_id);
            $user->notify(new InstructorRegister());
            //verify email
            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            //send verify mail
            $user->notify(new VerifyNotifications($user));
        } catch (\Exception $exception) {

        }
        return redirect()->route('login');
    }
    //END
}
