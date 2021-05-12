<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\User;
use App\NotificationUser;
use App\TeacherCoupon;

use App\Model\Instructor;
use App\Model\Course;
use App\Model\AdminPaid;
use App\Model\AdminPaidTeacherCoupon;
use App\Model\InstructorEarning;
use App\Model\CoursePurchaseHistory;

use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use phpseclib\Crypt\Hash;

class InstructorController extends Controller
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

    /*all instructor list*/
    public function index(Request $request)
    {
        //there are the check the admin or
        if (Auth::user()->user_type == "Admin") {
            if ($request->has('search')) {
                $instructors = Instructor::where("name", 'LIKE', '%'. $request->search.'%')
                    ->paginate(10);
            } else {
                $instructors = Instructor::latest()->paginate(10);
            }
        } else {
            $instructors = Instructor::where('user_id', Auth::id())->paginate(10);
        }
        return view('instructor.index', compact('instructors'));
    }


    /*This function show all instructor related history
    like Package, Course , Enrolment Student list Get Payment History*/
    public function show($id)
    {
        if(Auth::user()->user_type == "Instructor"){
            $instructor = Instructor::where('user_id', Auth::id())
                ->with('purchaseHistory')
                ->with('courses')
                ->first();

            return view('instructor.show', compact('instructor'));
        }else{
            $teacher_coupons = TeacherCoupon::where('user_id', $id)->get();
            $all_teacher_coupons = sizeof($teacher_coupons);

            $used_teacher_coupons = TeacherCoupon::where('user_id', $id)
                ->where('is_used', true)
                ->get();

            $used_teacher_coupons = sizeof($used_teacher_coupons);
        
            $instructor = Instructor::where('user_id', $id)
                ->with('purchaseHistory')
                ->with('courses')
                ->with('user')
                ->first();

            $admin_paid = AdminPaid::where('user_id', $id)
                ->get();

            $paid_amount = 0;
            foreach($admin_paid as $item){
                $paid_amount += $item->amount;
            }

            $admin_paid_teacher_coupons = AdminPaidTeacherCoupon::where('user_id', $id)->get();
            $paid_teacher_coupons = 0;
            foreach($admin_paid_teacher_coupons as $item){
                $paid_teacher_coupons += $item->count;
            }

            return view('instructor.show', compact('instructor', 'all_teacher_coupons', 'used_teacher_coupons', 'paid_amount', 'paid_teacher_coupons'));
        }
    }

    /*  All Courss that the instructor created */
    public function courses($id){
        $courses = Course::where('user_id', $id)->latest()->paginate(10);
        return view('instructor.courses', compact('courses'));
    }


    /*  Courses that students bought   */
    public function coursesInWallet($id){
        $histories = InstructorEarning::where('user_id', $id)
            ->with('enrollment')
            ->latest()->paginate(1);
        return view('instructor.courses-wallet', compact('histories'));
    }

    public function teacherCoupons($id){
        $teacher_coupons = TeacherCoupon::where('user_id', $id)
            ->where('is_used', true)
            ->with('course')
            ->paginate(10);
            
        return view('instructor.teacher-coupons', compact('teacher_coupons'));
    }

    /*Update profile */
    public function edit($id)
    {
        $each_user = Instructor::where('user_id', Auth::id())->firstOrFail();
        return view('instructor.profile', compact('each_user'));
    }

    /*Update the Profile*/
    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }

        $instructor = Instructor::where('user_id', Auth::id())->firstOrFail();
        $instructor->phone = $request->phone;
        if ($request->hasFile('newImage')) {
            fileDelete($request->image);
            $instructor->image = fileUpload($request->newImage, 'instructor');
        } else {
            $instructor->image = $request->image;
        }
        $instructor->address = $request->address;
        $instructor->linked = $request->linked;
        $instructor->tw = $request->tw;
        $instructor->fb = $request->fb;
        $instructor->skype = $request->skype;
        $instructor->about = $request->about;

        if ($request->hasFile('signature')){
            $instructor->signature = fileUpload($request->signature,'instructor') ;
        }
        $instructor->save();

        /*User*/
        $user = User::findOrFail($request->user_id);
        $user->image = $instructor->image;
        if ($request->password != null){
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->save();

        $details = [
            'body' => $instructor->name . translate(' profile updated '),
        ];

        /* sending instructor notification */
        $notify = $this->userNotify(Auth::user()->id,$details);

        notify()->success(translate('Profile updated successfully'));
        return back();
    }

    /*banned the instructor*/
    public function banned(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $user = User::findOrFail($request->id);
        if ($user->user_type == "Instructor" && $user->banned == true) {
            $user->banned = false;
            notify()->success(translate('This user is Active'));

        } elseif ($user->user_type == "Instructor" && $user->banned == false) {
            $user->banned = true;
            notify()->success(translate('This user is Banned'));
        } else {
            notify()->warning(translate('Please there are problem try again'));
        }
        $user->save();
        return back();
    }

    /* Show Modal to pay to instructor */
    public function showPayModal($instructor_id){
        return view('instructor.create', compact('instructor_id'));
    }


    public function showPayTeacherCouponModal($instructor_id){
        return view('instructor.pay-teacher-coupon', compact('instructor_id'));
    }


    public function payToInstructor(Request $request){
        $paid_amount = new AdminPaid();
        $paid_amount->amount = $request->amount;
        $paid_amount->user_id = $request->instructor_id;
        $paid_amount->save();
        return back();
    }


    public function payTeacherCoupons(Request  $request){
        $paid_amount = new AdminPaidTeacherCoupon();
        $paid_amount->count = $request->count;
        $paid_amount->user_id = $request->instructor_id;
        $paid_amount->save();
        return back();
    }

    /*Destroy the instructor*/
    public function destroy($id){
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();
        
        /* sending instructor notification */
        notify()->success(translate('Deleted successfully'));
        return back();
    }
    //END
}
