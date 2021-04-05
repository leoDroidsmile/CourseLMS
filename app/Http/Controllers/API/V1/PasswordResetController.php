<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Model\ApiPasswordReset;
use App\Model\PasswordReset;
use App\Notifications\ApiPasswordResetRequest;
use App\Notifications\ApiPasswordResetSuccess;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    /*Create token and send to mail*/
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = User::where('email', $request->email)->where('user_type','Student')->first();
        if (!$user)
            return response()->json([
                'message' => 'We cannot find a user with that e-mail address.'
            ], 404);
        $passwordReset = ApiPasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60)
             ]
        );
        if ($user && $passwordReset)
            $user->notify(
                new ApiPasswordResetRequest($passwordReset->token)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }


    /*Find token password reset*/
    public function find($token)
    {
        $passwordReset = ApiPasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }

    /**
     * Reset password
     */
    public function reset(Request $request)
    {
        $rules =[
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ];
        $customMessages = [
            'email.required' => 'The Email  is required or unique.',
            'password.required' => 'The Password  is required.',
            'token.required' => 'The Token  is required.',
        ];

        $validator = Validator::make($request->all(), $rules,$customMessages);
        /*IF the validators fail*/
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }
        $passwordReset = ApiPasswordReset::where('token', $request->token)->where('email', $request->email)->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = User::where('email', $passwordReset->email)->where('user_type','Student')->first();
        if (!$user)
            return response()->json([
                'message' => 'We cannot find a user with that e-mail address.'
            ], 404);
        $user->password = Hash::make($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new ApiPasswordResetSuccess($passwordReset));
        return response()->json($user);
    }
}
