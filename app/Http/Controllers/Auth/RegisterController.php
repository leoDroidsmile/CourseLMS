<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Model\VerifyUser;
use App\Notifications\VerifyNotifications;
use App\Providers\RouteServiceProvider;
use App\User;
use Alert;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = translate("Your e-mail is verified. You can now login.");


                if (walletActive()) {
                    $authuser = User::where('id', $verifyUser->user_id)->first();
                    $amount = registrationPoint(); // (Double) Can be a negative value
                    $message = 'New User Registration Point'; //The reason for this transaction
                    $transaction = $authuser->addPoints($amount,$message);
                }


                $verifyUser->delete();

            } else {
                $status = translate("Your e-mail is already verified. You can now login.");
            }
        } else {
            return redirect('/login')->with('warning', translate("Sorry your email cannot be identified."));
        }
        return redirect('/login')->with('status', $status);
    }


    public function sendToken(Request $request){
        $verifyuser = VerifyUser::where('user_id',$request->id)->first();
        if ($verifyuser){
            $verifyuser->user->notify(new VerifyNotifications($verifyuser->user));
            $resent =  translate('A fresh verification link has been sent to your email address.');
        }else{
            $user = User::where('id',$request->id)->first();
            if ($user){
                //verify email
                $verifyUser = VerifyUser::create([
                    'user_id' => $user->id,
                    'token' => sha1(time())
                ]);
                $verifyuser = VerifyUser::where('user_id',$request->id)->first();
                $verifyuser->user->notify(new VerifyNotifications($verifyuser->user));
                $resent =  translate('A fresh verification link has been sent to your email address.');
            }else{
                $resent = translate('User is not Found');
            }

        }
        $id = $request->id;
        return view('auth.verify', compact('id'))->with('resent',$resent);
    }


}
