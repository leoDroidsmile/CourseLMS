<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\InstructorAccount;
use App\Model\Instructor;
use App\Model\Payment;
use App\User;
use Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\NotificationUser;


class PaymentController extends Controller
{

    function userNotify($user_id,$details)
    {
        $notify = new NotificationUser();
        $notify->user_id = $user_id;
        $notify->data = $details;
        $notify->save();
    }

    public function __construct()
    {
        $this->middleware('auth');
    }


    /*All Payment List*/
    public function index(Request $request)
    {
        if (Auth::user()->user_type == "Admin") {
            if ($request->has('id')){
                $payments = Payment::where('user_id',$request->id)->latest()->paginate(10);
            }else{
                $payments = Payment::latest()->paginate(10);
            }
            $instructors = User::where('user_type','Instructor')->get();
            return view('module.payment.admin_index',compact('instructors','payments'));
        } else {
            $payments = Payment::where('user_id', Auth::id())
                ->latest()
                ->paginate(10);
        }
        return view('module.payment.index', compact('payments'));
    }

    /*Instructor payment request form*/
    public function create()
    {
        $instructor = Instructor::where('user_id', Auth::id())->firstOrFail();
        return view('module.payment.create', compact('instructor'));
    }

    /*Payment request*/
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'amount' => 'required',
        ],
            [
                'amount.required' => translate('Amount is required'),
            ]);

        if ($request->amount < 10) {
            notify()->warning(translate('You minimum Withdrawal 10 Money ,'));
            return back();
        }

        $account = InstructorAccount::where('user_id', Auth::id())->first();
        if ($account == null) {
            notify()->warning(translate('Please Insert the withdrawal method ,'));
            return back();
        }
        $ins = Instructor::where('user_id', Auth::id())->first();
        if ($ins->balance < $request->amount) {
            notify()->warning(translate('Please insert the valid withdrawal amount ,'));
            return back();
        }

        $payment = new Payment();
        $payment->amount = $request->amount;
        $payment->process = $request->process;
        $payment->description = $request->description;
        $payment->status = $request->status;
        $payment->status_change_date = Carbon::now();
        $payment->user_id = Auth::id();
        $payment->account_id = $account->id;
        $payment->saveOrFail();

        $details = [
            'body' => translate('Your payment request is successfully done.'),
        ];

        /* sending instructor notification */
        $this->userNotify(Auth::user()->id, $details);

        notify()->success(translate('Payment request sent successfully,'));
        return back();
    }

    public function destroy($id)
    {
        Payment::where('id', $id)->delete();
        notify()->success(translate('Payment request deleted successfully'));
        return redirect()->route('payments.index');
    }

//    If payment is confirm, then status is change
    public function status($id)
    {
        $payment = Payment::where('id', $id)->first();
        $payment->status = 'Confirm';
        $payment->status_change_date = Carbon::now();

        //change the instructor balance'
        $ins = Instructor::where('user_id', $payment->user_id)->first();

        //payment
        $payment->current_balance = $ins->balance;
        $ins->balance -= $payment->amount;//update the balance

        $payment->save();
        $ins->save();
        notify()->success(translate('Payment status is updated'));
        return back();
    }

    /*instructor payment account*/
    public function accountSetup()
    {
        $account = InstructorAccount::where('user_id', Auth::id())->first();
        if ($account == null) {
            return view('module.account.create', compact('account'));
        }
        return view('module.account.create', compact('account'));
    }

    /*update the account details*/
    public function accountUpdate(Request $request)
    {
        if ($request->has('id')) {
            $account = InstructorAccount::where('id', $request->id)->where('user_id', Auth::id())->first();
            $account->bank_name = $request->bank_name;
            $account->account_name = $request->account_name;
            $account->account_number = $request->account_number;
            $account->routing_number = $request->routing_number;
            $account->paypal_acc_name = $request->paypal_acc_name;
            $account->paypal_acc_email = $request->paypal_acc_email;
            $account->stripe_acc_name = $request->stripe_acc_name;
            $account->stripe_acc_email = $request->stripe_acc_email;
            $account->stripe_card_holder_name = $request->stripe_card_holder_name;
            $account->stripe_card_number = $request->stripe_card_number;
            $account->save();
        } else {
            $account = new InstructorAccount();
            $account->bank_name = $request->bank_name;
            $account->account_name = $request->account_name;
            $account->account_number = $request->account_number;
            $account->routing_number = $request->routing_number;
            $account->paypal_acc_name = $request->paypal_acc_name;
            $account->paypal_acc_email = $request->paypal_acc_email;
            $account->stripe_acc_name = $request->stripe_acc_name;
            $account->stripe_acc_email = $request->stripe_acc_email;
            $account->stripe_card_holder_name = $request->stripe_card_holder_name;
            $account->stripe_card_number = $request->stripe_card_number;
            $account->user_id = Auth::id();
            $account->save();
        }

        $details = [
            'body' => translate('You upaded payment account information'),
        ];

        /* sending instructor notification */
        $notify = $this->userNotify(Auth::user()->id, $details);

        notify()->success(translate('Payment account setup done successfully'));
        return back();
    }

    /*get the account details*/
    public function accountDetails($id, $userId, $method, $payId)
    {
        $account = InstructorAccount::where('id', $id)->where('user_id', $userId)->first();
        $payment = Payment::where('id', $payId)->first();
        return view('module.payment.details', compact('method', 'account', 'payment'));
    }
    //END
}
