<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;

use App\Model\AffiliatePayment;
use App\Model\Instructor;
use App\Model\Payment;
use App\Model\Student;
use App\Model\StudentAccount;
use App\Model\SystemSetting;
use App\Notifications\AffiliateActive;
use App\Notifications\AffiliatePaymentCancel;
use App\Notifications\AffiliateReject;
use App\User;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function GuzzleHttp\Psr7\try_fopen;

class AffiliateController extends Controller
{
    //

    /*affiliate setting view*/
    public function settingCreate(){
        return view('module.affiliate.setting');
    }

    /*affiliate setting store*/
    public function settingStore(Request $request){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        if ($request->has('commission')) {
            $system = SystemSetting::where('type', $request->type_commission)->first();
            $system->value = $request->commission;
            $system->save();
        }
        if ($request->has('withdraw_limit')) {
            $system = SystemSetting::where('type', $request->type_withdraw_limit)->first();
            $system->value = $request->withdraw_limit;
            $system->save();
        }
        if ($request->has('cookies_limit')) {
            $system = SystemSetting::where('type', $request->type_cookies_limit)->first();
            $system->value = $request->cookies_limit;
            $system->save();
        }
        notify()->success(translate('Affiliate Settings is done'));
        return back();
    }

    /*all affiliate request*/
    public function requestList(){
        $confirm = \App\Model\Affiliate::where('is_confirm',true)->paginate(10);
        $request = \App\Model\Affiliate::where('is_confirm',false)->where('is_cancel',false)->paginate(10);
        $cancel = \App\Model\Affiliate::where('is_cancel',true)->paginate(10);
        return view('module.affiliate.index',compact('confirm','request','cancel'));

    }

    /*affiliate reject*/
    public function reject($id){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $affiliate = \App\Model\Affiliate::where('id',$id)->with('user')->first();
        if ($affiliate){
            $affiliate->is_cancel = true;
            $affiliate->is_confirm = false;
            $affiliate->refer_id = null;
            $affiliate->save();
            $affiliate->user->notify(new AffiliateReject());
        }
        notify()->success(translate('Affiliate request is cancel'));
        return back();
    }

/*affiliate active*/
    public function active($id){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $affiliate = \App\Model\Affiliate::where('id',$id)->with('user')->first();
        if ($affiliate){
            $affiliate->is_confirm = true;
            $affiliate->is_cancel = false;
            $affiliate->refer_id = date('Y').$affiliate->user_id.random_int(10,100);
            $affiliate->save();

           try {
                $user = User::where('id',$affiliate->user_id)->first();
                $user->notify(new AffiliateActive());
           }catch (\Exception $exception){}
        }
        notify()->success(translate('Affiliate request is accepted'));
        return back();
    }


    /*affiliate payment request*/
    public function paymentRequest(){
        $request = AffiliatePayment::orderByDesc('id')->paginate(10);
        return view('module.affiliate.payment',compact('request'));
    }

    /*get the account details*/
    public function accountDetails($id, $userId, $method, $payId)
    {
        $account = StudentAccount::where('id', $id)->where('user_id', $userId)->first();
        $payment = AffiliatePayment::where('id', $payId)->first();
        return view('module.affiliate.paymentDetails', compact('method', 'account', 'payment'));
    }


    public function affiliateStatus($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $payment = AffiliatePayment::where('id', $id)->first();
        $payment->status = 'Confirm';
        $payment->status_change_date = Carbon::now();

        //change the instructor balance'
        $ins = \App\Model\Affiliate::where('user_id', $payment->user_id)->first();
        //payment
        $payment->current_balance = $ins->balance + $payment->amount;
        $payment->save();
        try {
            $user = User::where('id',$payment->user_id)->first();
            $user->notify(new \App\Notifications\AffiliatePayment());
        }catch (\Exception $exception){}
        notify()->success(translate('Payment status is updated'));
        return back();
    }



    /*cancel request*/
    public function affiliatePaymentCancel($id){

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $payment = AffiliatePayment::where('id',$id)->first();
        $ins = \App\Model\Affiliate::where('user_id', $payment->user_id)->first();
        $ins->balance += $payment->amount;
        $ins->save();
        /*delete payment request*/
        $payment->delete();
        try {
            $user = User::where('id',$payment->user_id)->first();
            $user->notify(new AffiliatePaymentCancel());
        }catch (\Exception $exception){}
        notify()->success(translate('Payment Request is cancel successfully'));
        return back();
    }


}


