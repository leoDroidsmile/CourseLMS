<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\InstructorResourse;
use App\Http\Resources\PackageResource;
use App\Jobs\InstructorRegisterJob;
use App\Jobs\NewRegisterJob;
use App\Mail\VerifyMail;
use App\Model\AdminEarning;
use App\Model\Course;
use App\Model\Instructor;
use App\Model\Package;
use App\Model\PackagePurchaseHistory;
use App\Model\VerifyUser;
use App\Notifications\InstructorRegister;
use App\Notifications\VerifyNotifications;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class InstructorApiController extends Controller
{

    /*ALl instructor*/
    public function instructors(){
        $instructors = User::where('user_type','Instructor')->paginate(10);
        return InstructorResourse::collection($instructors)->additional(['success'=>true,'status'=>200]);
    }

    /*Instructor ways course*/
    public function instructorCourses($id){
        $course = Course::Published()->where('user_id',$id)->paginate(10);
        return CourseResource::collection($course)->additional(['success'=>true,'status'=>200]);
    }

    /*SHow all package*/
    public function packages(){
        $package = Package::where('is_published',true)->get();
        return PackageResource::collection($package)->additional(['success'=>true,'status'=>200]);
    }

    /*Instructor Register */
    public function instructorRegister(Request  $request){
        $rules=[
            'package_id'=>'required',
            'name'=>'required',
            'email'=>['required','unique:users'],
            'password'=>['required','max:8'],
            'amount'=>'required',
        ];
        $customMessages = [
            'package_id.required' => 'The Package is required.',
            'name.required' => 'The Name  is required.',
            'email.required' => 'The Email  is required or unique.',
            'password.required' => 'The Password  is required.',
            'amount.required' => 'The Amount  is required.',
        ];

        $validator = Validator::make($request->all(), $rules,$customMessages);
        /*IF the validators fail*/
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }
        //create user for login
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 'Instructor';
        $user->save();

        //save data in instructor
         $instructor = new Instructor();
         $instructor->name = $request->name;
         $instructor->email = $request->email;
         $instructor->package_id = $request->package_id;
         $instructor->user_id = $user->id;
         $instructor->save();

        //add purchase history
        $purchase = new PackagePurchaseHistory();
        $purchase->amount = $request->amount;
        $purchase->payment_method = $request->payment_method;
        $purchase->package_id = $request->package_id;
        $purchase->user_id = $user->id;
        $purchase->save();


        //todo::admin Earning calculation
        $admin = new AdminEarning();
        $admin->amount =  $request->amount;
        $admin->purposes = "Sale Package";
        $admin->save();

        try {

            $user->notify(new InstructorRegister());
            //verify email
            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);
            //send verify mail
            $user->notify(new VerifyNotifications($user));
        }catch (\Exception $exception){

        }

        return response()->json(['message' => 'Instructor Register Successfully, Please Check your mail'], 200);

    }

    //END
}
