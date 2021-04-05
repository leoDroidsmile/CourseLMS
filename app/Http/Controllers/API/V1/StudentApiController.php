<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Mail\VerifyMail;
use App\Model\Student;
use App\Model\VerifyUser;
use App\Notifications\StudentRegister;
use App\Notifications\VerifyNotifications;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class StudentApiController extends Controller
{

    /*
     * Register Student for Account*/
    public function studentRegister(Request $request)
    {
        //validate for student register

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ];
        $customMessages = [
            'name.required' => 'The Name  is required .',
            'email.required' => 'The Email  is required.',

        ];

        $validator = Validator::make($request->all(), $rules,$customMessages);
        /*IF the validators fail*/
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }
        /*Add Student Details for Authentication*/
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = 'Student';
        if($request->provider_id != null){
            $user->provider_id = $request->provider_id;
        }else{
            if ($request->password == null){
                return response([
                    'error' => 'You Need password to register'
                ], 404);
            }
            $user->password = Hash::make($request->password);
        }

        $user->save();

        /*Save Details In Student details*/
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->user_id = $user->id;
        $student->save();


        try {
            $user->notify(new StudentRegister());

            //verify email

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            $user->notify(new VerifyNotifications($user));

        }catch (\Exception $exception){

        }

        return response()->json(['message' => 'Student Register Successfully,Check the Mail and verify the account',
                'user'=>new StudentResource(Student::where('user_id',$user->id)->first())], 200);
    }

    /*Student User Login */
    public function studentLogin(Request $request)
    {
        $rules = [
            'email' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        /*IF the validators fail*/
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }
        if ($request->provider_id != null){

            $user = User::where('email',$request->email)->where('provider_id',$request->provider_id)
                ->where('banned', false)
                ->where('user_type', 'Student')->first();
            if (!$user) {
                return response([
                    'error' => 'The Provided credentials are incorrect'
                ], 404);
            }

        }else{
            /*Check the user is Valid*/
            $user = \App\User::where('email', $request->email)
                ->where('banned', false)
                ->where('user_type', 'Student')->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'error' => 'The Provided credentials are incorrect'
                ], 404);
            }
        }


     //todo::there are problem when verify the student
        if ($user->verified == false){
            $verifyuser = VerifyUser::where('user_id',$user->id)->first();
            if ($verifyuser){
                $verifyuser->user->notify(new VerifyNotifications($verifyuser->user));
            }
            return response([
                'error' => 'Please verify Your account',
                'message' => 'A fresh verification link has been sent to your email address.'
            ]);
        }else{
            //there are the token generate
            $access_token = $user->createToken('Laravel Password Grant Client')->accessToken;
            return response(['access_token'=>$access_token,
                'user'=>new StudentResource(Student::where('user_id',$user->id)->first())]);
        }

    }
    /*
     *its for update student Profile
     *its match data id and email
     *  */
    public function studentUpdate(Request $request)
    {
        //fetch the student
        $student = Student::where('user_id', $request->id)->where('email', $request->email)->first();
        if (is_null($student)) {
            return response(['message' => 'Student is Not Found'], 404);
        }
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->about = $request->about;

        if ($request->file($request->image)) {
            $student->image = fileUpload($student->image, 'student');
        }

        $student->fb = $request->facebook;
        $student->tw = $request->twitter;
        $student->linked = $request->linkedin;
        $student->save();
        //update the Username
        $user = User::where('id', $student->user_id)->update([
            'name' => $student->name,
            ''
        ]);
        //Student resource need
        return response(['message' => 'Student Profile Update Successfully',
            'user'=>new StudentResource($student)], 200);

    }

    /*Verify the Student account and active it*/
    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
                $verifyUser->delete();
            } else {
                $status = "Your e-mail is already verified. You can now login.";
            }
        } else {
            return  response(['message' => 'Sorry your email cannot be identified.'], 200);
        }
        return response(['message' => $status], 200);
    }

    /*Student logout*/
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    //END
}
