<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentsResource;
use App\Http\Resources\EnrollmentResource;

use App\Http\Resources\MessageResource;
use App\Jobs\EnrollmentJob;
use App\Jobs\InstructorRegisterJob;
use App\Jobs\NewRegisterJob;
use App\Model\AdminEarning;
use App\Model\Cart;
use App\Model\Course;
use App\Model\CourseComment;
use App\Model\CoursePurchaseHistory;
use App\Model\Enrollment;
use App\Model\Instructor;
use App\Model\InstructorEarning;
use App\Model\Massage;
use App\Model\Package;
use App\Notifications\EnrolmentCourse;
use App\Notifications\InstructorRegister;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnrollmentApiController extends Controller
{
    /*this is   Enrollment, and paid the course fee*/
    public function enrollment(Request $request)
    {
        $rules = [
            'id' => 'required',
            'payment_method' => 'required'
        ];
        $customMessages = [
            'id.required' => 'The Cart   is required.',
            'payment_method.required' => 'The Payment  is required.',

        ];
        /*Check validator */
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }

        /*get data from cart and delete from cart Add in,
        Enrollment and save purchase history*/
        foreach (json_decode($request->id) as $id) {

            $cart = Cart::findOrFail($id);

            //todo::there are calculate the Instructor balance Calculate the admin or Instructor commission
            $course = Course::findOrFail($cart->course_id); //get course
            $instructor = Instructor::where('user_id', $course->user_id)->first(); //get instructor
            $package = Package::findOrFail($instructor->package_id); //get instructor package commission
            $admin_get = ($cart->course_price * $package->commission) / 100; //$admin commission
            $instructor_get = ($cart->course_price - $admin_get); //instructor amount

            //admin earning
            //Todo::Admin Earning calculation
            $admin = new AdminEarning();
            $admin->amount = $admin_get;
            $admin->purposes = "Commission Form Enrolment";
            $admin->save();

            //save in enrolments table
            $enrollment = new Enrollment();
            $enrollment->user_id = $cart->user_id; //this is student id
            $enrollment->course_id = $cart->course_id;
            $enrollment->save();

            //todo::Instructor Earning history
            //instructor Earning
            $instructorEarning = new InstructorEarning();
            $instructorEarning->enrollment_id = $enrollment->id;
            $instructorEarning->package_id = $package->id;
            $instructorEarning->user_id = $instructor->user_id; //instructor user_id
            $instructorEarning->course_price = $cart->course_price;
            $instructorEarning->will_get = $instructor_get;
            $instructorEarning->save();

            //todo::update the instructor balance
            $instructor->balance += $instructor_get;
            $instructor->save();

            //save in purchase history
            $history = new CoursePurchaseHistory();
            $history->enrollment_id = $enrollment->id;
            $history->amount = $cart->course_price;
            $history->payment_method = $request->payment_method;
            $history->save();


            //todo::mail Admin, Instructor, Student
            //todo::there are problem
            try {
                //teacher
                $user = User::findOrFail($instructorEarning->user_id);
                $user->notify(new EnrolmentCourse());
                //student
                $user = User::findOrFail($enrollment->user_id);
                $user->notify(new EnrolmentCourse());
            }catch (\Exception $exception){}

            //delete from cart
            $cart->delete(); //Todo::uncomment it rumon

        }
        return response(['message' => 'Enrollment Successfully'], 200);
    }


    /*There are show enrollment course
    register use can show this */
    public function enrollmentCourses($id)
    {
        $enrollments = Enrollment::where('user_id', $id)
            ->with('messages')
            ->with('history')
            ->with('enrollCourse')
            ->latest()->get();

        //this resource pass the user id
        return EnrollmentResource::collection($enrollments)->additional(['success' => true, 'status' => 200]);
    }


    /*Send message to instructor inbox*/
    public function sendMessage(Request $request)
    {
        $rules = [
            'enroll_id' => 'required',
            'user_id' => 'required',
            'message' => 'required',
        ];
        $customMessages = [
            'enroll_id.required' => 'The Enroll field is required.',
            'user_id.required' => 'The User field is required.',
            'message.required' => 'The Message field is required.',
        ];
        /*Check validator */
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }

        //check the enroll by this user_id
        $e = Enrollment::where('id', $request->enroll_id)->first();
        if ($e->user_id != $request->user_id) {
            return response(['message' => 'you are doing some thing wrong, try later'], 404);
        }
        $message = new Massage();
        $message->enroll_id = $request->enroll_id;
        $message->user_id = $request->user_id;
        $message->content = $request->message;
        $message->save();
        return response(['message' => 'Message send'], 200);
    }

    /*Enroll Course ways messages List*/
    public function inboxMessage($id)
    {
        $inbox = Massage::where('enroll_id', $id)->get();
        return MessageResource::collection($inbox);
    }


    /*Course Commenting authenticated */
    public function comments(Request $request)
    {
        $rules = [
            'course_id' => 'required',
            'user_id' => 'required',
            'comment' => 'required'
        ];
        $customMessages = [
            'course_id.required' => 'The Course  is required.',
            'user_id.required' => 'The User  is required.',
            'comment.required' => 'The Comment  is required.',
        ];

        /*Check validator */
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }

        if ($request->comment_id != null) {
            $comment = new CourseComment();
            $comment->course_id = $request->course_id;
            $comment->user_id = $request->user_id;
            $comment->comment = $request->comment;
            $comment->replay = $request->comment_id;
            $comment->save();
            return response(['comment' => $comment, 'message' => 'Replay Commenting done'], 200);
        } else {
            $comment = new CourseComment();
            $comment->course_id = $request->course_id;
            $comment->user_id = $request->user_id;
            $comment->comment = $request->comment;
            $comment->save();
            return response(['comment' => $comment, 'message' => 'Commenting done'], 200);
        }
    }

    /*Single Course all commenting*/
    public function allComments($id)
    {
        $comments = CourseComment::where('course_id', $id)->where('replay', 0)->with('replay')->with('user')->get();
        return CommentsResource::collection($comments)->additional(['success' => true, 'status' => 200]);
    }


    //END
}
