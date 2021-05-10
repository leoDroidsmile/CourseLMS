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
use App\Blog;
use Log;
use App\Model\Massage;
use App\TeacherCoupon;
use App\Model\Enrollment;
use App\Model\Instructor;
use App\Model\Category;
use App\Model\Course;
use App\Model\Slider;
use App\NotificationUser;

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
            'name.required' => 'The Name is required .',
            'email.required' => 'The Email  is required.',
        ];

        $validator = Validator::make($request->all(), $rules,$customMessages);
        /*IF the validators fail*/
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }
        /*Add Student Details for Authentication*/
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = 'Student';
        $user->verified = true;
        if($request->provider_id != null){
            $user->provider_id = $request->provider_id;
        }else{
            if ($request->password == null){
                return response()->json([
                    'success' => false,
                    'message' => 'You Need password to register'
                ], 200);
            }
            $user->password = Hash::make($request->password);
        }

        $user->save();

        /*Save Details In Student details*/
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->user_id = $user->id;
        $student->phone = $request->phone;
        $student->city = $request->city;
        $student->male = $request->male;
        $student->school = $request->school;
        $student->major = $request->major;
        $student->save();

        // try {
        //     $user->notify(new StudentRegister());

        //     //verify email

        //     $verifyUser = VerifyUser::create([
        //         'user_id' => $user->id,
        //         'token' => sha1(time())
        //     ]);
        //     $user->notify(new VerifyNotifications($user));

        // }catch (\Exception $exception){

        // }

        $user = User::findOrFail($user->id);
        $student = Student::where('user_id',$user->id)->first();
        $student->balance = $user->currentPoints();
        if(!$student->image)
            $student->image = $user->image;
        $user_resource = new StudentResource($student);

        $access_token = $user->createToken('Laravel Password Grant Client')->accessToken;
            
        return response()->json([
            'success' => true,
            'message' => 'Student Register Successfully',
            'user'      => $user_resource,
            'access_token'=>$access_token,
        ], 
        200);
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
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        if ($request->provider_id != null){

            $user = User::where('email',$request->email)->where('provider_id',$request->provider_id)
                ->where('banned', false)
                ->where('user_type', 'Student')->first();
            if (!$user) {
                return response([
                    'message' => 'The Provided credentials are incorrect'
                ], 404);
            }

        }else{
            /*Check the user is Valid*/
            $user = \App\User::where('email', $request->email)
                ->where('banned', false)
                ->where('user_type', 'Student')->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'The Provided credentials are incorrect'                    
                ], 200);
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
            $student = Student::where('user_id',$user->id)->first();
            $student->balance = $user->currentPoints();
            if(!$student->image)
                $student->image = $user->image;
                
            $user_resource = new StudentResource($student);
            return response([
                'success' => true,
                'access_token'=>$access_token,
                'user'=> $user_resource
                ]);
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


    public function resetPassword(Request $request){
        if (Hash::check($request->current_password, $request->user()->password)) {
            $request->user()->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            return response()->json([
                'success' => true,
                'message' => 'Successfully Reset Password'
            ]);
        }else
            return response()->json([
                'success' => false,
                'message' => 'Current Password is not matched'
            ]);
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
            'success' => true,
            'message' => 'Successfully logged out'
        ]);
    }


    // ***********      Student API for Vue Dashboard       ************ //

    public function getUserDetail(Request $request){
        $user = $request->user();
        if($user->image)
            $user->image = asset($user->image);

        $user->balance = $user->currentPoints();
        return response(
                    [
                        'success' => true,
                        'detail'  => $user,
                    ], 
                200);
    }

    public function getAllTeachers(Request $request){
        $teachers = Instructor::all();
        foreach ($teachers as $teacher){
            if(!$teacher->image)
                $teacher->image = asset('uploads/user/user.png');
        }
        return response(['teachers' => $teachers], 200);
    }

    public function getAllReceivers(Request $request){
        $teachers = Instructor::all();
        
        $admin = User::where("user_type", "Admin")->first();
        $admin_instructor = new Instructor();
        $admin_instructor->user_id = $admin->id;
        $admin_instructor->name = $admin->name;

        $teachers[] = $admin_instructor;

        return response(['receivers' => $teachers], 200);
    }

    public function getAllCategories(Request $request){
        $categories = Category::where('teacher_id', $request->teacher_id)->with('courses')->get();
        foreach ($categories as $key=>$item){
            foreach($item->courses as $course_key => $course){
                if($course->is_private)
                    unset($item->courses[$course_key]);
            }
            if(sizeof($item->courses) == 0){
                unset($categories[$key]);
                continue;
            }
                
            if($item->icon)
                $item->icon = asset($item->icon);
        }
        return response(['categories' => $categories], 200);
    }

    public function getTeacherCourses(Request $request){
        if($request->teacher_id == 0){
            // Free Courses
            if(!$request->search)
                $courses = Course::Published()
                      ->Public()
                      ->latest()
                      ->with('category')
                      ->with('classes')
                      ->where('is_free',true)
                      ->get();

            // Search Course with title or Teacher Coupon
            else{
                $courses = Course::Published()
                    ->Public()
                    ->latest()
                    ->with('category')
                    ->with('classes')
                    ->where('title', 'LIKE', '%'.$request->search.'%')
                    ->get();

                $teacherCoupon = TeacherCoupon::where('code', $request->search)->first();
                if($teacherCoupon){
                    $courses_coupon = Course::Published()
                            ->with('category')
                            ->with('classes')
                            ->where('id', $teacherCoupon->course_id)
                            ->first();

                    $courses[] = $courses_coupon;
                }
            }  
        }
        else
            $courses = Course::Published()
                    ->Public()
                    ->latest()
                    ->with('category')
                    ->with('classes')
                    ->where('user_id', $request->teacher_id)
                    ->where('category_id', $request->category_id)
                    ->get();

        foreach ($courses as $course){
            if($course->image)
                $course->image = asset($course->image);
        }
                    
        return response(['courses' => $courses], 200);
    }

    public function getCourseDetail(Request $request){
        $course = Course::Published()
            ->with('category')
            ->with('classes')
            ->where('id', $request->course_id)
            ->first();

        $course->image = asset($course->image);

        $enrollment = Enrollment::where('course_id', $request->course_id)
            ->where('user_id', $request->user()->id)
            ->first();

        if($enrollment)
            $course->enrollment_id = $enrollment->id;
        else
            $course->enrollment_id = false;
                
        return response(['course' => $course], 200);
    }

    // Check whether or not User's token expired
    public function checkAuth(Request $request){
        return response('', 200); 
    }

    public function getMyCourses(Request $request){
        $enrollments = Enrollment::where('user_id', $request->user()->id)
            ->with('course')
            ->get();

        $courses = [];
        foreach ($enrollments as $enrollment){
            if($enrollment->course->image)
                $enrollment->course->image = asset($enrollment->course->image);
            $courses[] = $enrollment->course;
        }
                    
        return response(['courses' => $courses], 200);
    }

    public function getNotifications(Request $request){
        if($request->is_read != 'all')
            $notifications = NotificationUser::where('user_id', $request->user()->id)
                ->where('is_read', false)
                ->get();
        else
            $notifications = NotificationUser::where('user_id', $request->user()->id)
                ->get();

        return response(['notifications' => $notifications], 200);
    }

    public function markAsRead(Request $request){
        $notification = NotificationUser::findOrFail($request->id);
        $notification->is_read = true;
        $notification->save();
        return response(['success' => true], 200);
    }

    public function getSliders(Request $request){
        $slider = Slider::findOrFail($request->id);
        if($slider)
            $slider->image = asset($slider->image);

        $sliders = [$slider, $slider]; 
        
        return response(['slider' => $sliders], 200);
    }

    public function getBlogs(Request $request){
        $blogs = Blog::all();
        foreach ($blogs as $blog){
            if($blog->img)
                $blog->img = asset($blog->img);
        }
        return response(['blogs' => $blogs], 200);
    }

    public function getBlogDetail(Request $request){
        $blog = Blog::findOrFail($request->id);
        if($blog->img)
            $blog->img = asset($blog->img);
        return response(['blog' => $blog], 200);
    }

    public function getUserProfile(Request $request){
        $student = Student::where('user_id',$request->user()->id)->first();
        $user = User::findOrFail($request->user()->id);

        if(!$student->image)
            $student->image = asset($user->image);

        return response()->json([
            'user'      => $student
        ], 
        200);
    }

    public function updateProfile(Request $request){
        $student = Student::where('user_id', $request->user()->id)->first();

        $student->email = $request->email;
        $student->name = $request->name;
        $student->city = $request->city;
        $student->phone = $request->phone;
        $student->male = $request->male;
        $student->school = $request->school;
        $student->major = $request->major;
        $student->save();

        return response()->json([
            'message'      => "Profile updated successfully."
        ], 
        200);
    }


    // Send Message to Admin or Teacher from Student
    public function sendMessage(Request $request){
        
        // Enrollment_id is Teacher ID 
        $message = new Massage();
        $message->enroll_id = $request->teacher_id;
        $message->user_id = $request->user()->id;
        $message->content = $request->content;
        $message->save();

        return response()->json([
            'message'      => "Message sent successfully."
        ], 
        200);
    }


    // Get All Messages sent to Student
    public function getAllMessages(Request $request){
        $sentMessages       = Massage::where('user_id', $request->user()->id)
            ->with('receiver')
            ->get();
            
        $receivedMessages    = Massage::where('enroll_id', $request->user()->id)
            ->with('sender')
            ->get();

        return response()->json([
            'sentMessages'          => $sentMessages,
            'receivedMessages'       => $receivedMessages
            ], 
        200);
    }
    
    //END
}
