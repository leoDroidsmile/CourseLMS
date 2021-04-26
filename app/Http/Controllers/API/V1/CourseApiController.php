<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\ClassContentResource;
use App\Http\Resources\ClassResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\EnrollmentResource;
use App\Http\Resources\SeenContentResource;
use App\Model\Category;
use App\Model\ClassContent;
use App\Model\Classes;
use App\Model\Course;
use App\Model\Enrollment;
use App\Http\Controllers\Controller;
use App\Model\SeenContent;
use Illuminate\Support\Str;
use App\Model\Demo;
use App\Coupon;
use App\TeacherCoupon;
use Carbon\Carbon;
use App\User;
use App\Model\Instructor;
use App\Model\InstructorEarning;
use App\Model\CoursePurchaseHistory;
use App\Model\Package;
use App\Model\AdminEarning;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseApiController extends Controller
{
    /*Show All Course An browse it*/
    public function allCourses(){
        $courses = Course::Published()
        ->with('category')
        ->with('classes')
        ->latest()
        ->paginate(10);
        return CourseResource::collection($courses)->additional(['success'=>true,'status'=>200]);
    }

    /*Show single course with details*/
    public function singleCourse($id){
        $course = Course::with('category')
        ->with('classes')
        ->findOrFail($id);
        return new CourseResource($course);
    }

    /*Show single class with relation data*/
    public function singleClass($id){
        $class = Classes::with('contents')->findOrFail($id);
        return new ClassResource($class);
    }

    /*Single contents*/
    public function singleContent($id){
        $content = ClassContent::findOrFail($id);
        return new ClassContentResource($content);
    }

    /*Category ways course*/
    public function catCourses($id){
        $ids = array();
        $category = Category::findOrFail($id);
        $cid = Category::where('parent_category_id',$category->id)->get();
        array_push($ids,$category->id);
        foreach ($cid as $i){
            array_push($ids,$i->id);
        }
        $course = Course::with('classes')->latest()->Published()->whereIn('category_id',$ids)->paginate(10);
        return CourseResource::collection($course)->additional(['success'=>true,'status'=>200]);
    }

    /*Enroll Top Courses*/
    public function topCourses(){
        $enroll_courser_count = DB::table('enrollments')->select('enrollments.course_id',
            DB::raw('count(enrollments.course_id) as total_course'))
            ->orderByDesc('total_course')
            ->groupBy('course_id')->get();

        $i_id = array();
        $courses = collect();
        foreach ($enroll_courser_count as $e) {
            $co = Course::Published()->find($e->course_id);
          $courses->push($co);
        }
        return CourseResource::collection($courses->take(10));
    }

    /*Free Courses*/
    public function freeCourses()
    {
      $free_courses = Course::Published()
                      ->latest()
                       ->with('category')
                      ->with('classes')
                      ->where('is_free',true)
                      ->paginate(10);
      return CourseResource::collection($free_courses)->additional(['success'=>true,'status'=>200]);

    }

    /*Search courses*/
    public function searchCourses(Request $request){
        $search_courses = Course::Published()
            ->latest()
            ->with('category')
            ->with('classes')
            ->where('title','like','%'.$request->search.'%')
            ->paginate(10);
        return CourseResource::collection($search_courses)->additional(['success'=>true,'status'=>200]);
    }

    /*Seen Courses Listed*/
    public function seenCourseListed(Request $request){
        $rules = [
            'class_id' => 'required',
            'content_id' => 'required',
            'course_id' => 'required',
            'enroll_id' => 'required',
            'user_id' => 'required',
        ];
        $customMessages = [
            'class_id.required' => 'The Class is required.',
            'content_id.required' => 'The Content  is required.',
            'course_id.required' => 'The Course  is required.',
            'enroll_id.required' => 'The Enroll  is required.',
            'user_id.required' => 'The User  is required.',
        ];
        $validator = Validator::make($request->all(), $rules,$customMessages);
        /*IF the validators fail*/
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }
        $seens = SeenContent::where('class_id',$request->class_id)
            ->where('content_id',$request->content_id)->where('course_id',$request->course_id)
            ->where('enroll_id',$request->enroll_id)->where('user_id',$request->user_id)->first();
        if($seens){
            return response(['message' => 'Successfully Seen History Stored in Server'], 200);
        }
        $seen  = new SeenContent();
        $seen->class_id = $request->class_id;
        $seen->content_id = $request->content_id;
        $seen->course_id = $request->course_id;
        $seen->enroll_id = $request->enroll_id;
        $seen->user_id = $request->user_id;
        $seen->saveOrFail();

        return response(['message' => 'Successfully Seen History Created'], 200);

    }

    /*Course,Class,content Seen history*/
    public function seenHistory(Request $request){

        $rules = [
            'enroll_id' => 'required',
            'user_id' => 'required',
        ];
        $customMessages = [
            'enroll_id.required' => 'The Enroll  is required.',
            'user_id.required' => 'The User  is required.',
        ];
        $validator = Validator::make($request->all(), $rules,$customMessages);
        /*IF the validators fail*/
        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }

        $conditions=[];
        $conditions = array_merge($conditions,['enroll_id'=>$request->enroll_id]);
        $conditions = array_merge($conditions,['user_id'=>$request->user_id]);
        if ($request->class_id){
            $conditions =  array_merge($conditions,['class_id'=>$request->class_id]);
        }
        if($request->content_id){
            $conditions =  array_merge($conditions,['content_id'=>$request->content_id]);
        }
        if($request->course_id){
            $conditions =  array_merge($conditions,['course_id'=>$request->course_id]);
        }

        $seens = SeenContent::where($conditions)->get();
        return SeenContentResource::collection($seens);
    }


    /*single content*/
    public function singleContentWithVideo(Request $request)
    {
        $contentId = $request->contentId;
        $userId = $request->userId;

        $content = ClassContent::find($contentId);
        $demo = new Demo();
        if($content->content_type == 'Video'){
            $demo->provider = $content->provider;
            $demo->description = $content->description;
            if ($content->provider == "Youtube") {
                $demo->url = Str::after($content->video_url, 'https://youtu.be/');
            } elseif ($content->provider == "Vimeo") {
                $demo->url = Str::after($content->video_url, 'https://vimeo.com/');
            } elseif ($content->provider == "File") {
                $demo->url = asset($content->video_url);
            } elseif ($content->provider == "Live") {
                $demo->url = $content->video_url;
            } else{
                $demo->provider = "HTML5";
                $demo->url = $content->video_url;
            }
        }elseif ($content->content_type == 'Quiz'){
            /*if quiz is done then show the score*/
            $scores = QuizScore::where('quiz_id',$content->quiz_id)
                ->where('content_id',$content->id)
                ->where('user_id', $userId)->first();

            if ($scores != null){
                $demo->provider = $content->content_type;
                $demo->url = route('quiz.score.show',$scores->id);
            }else{
                $demo->provider = $content->content_type;
                $demo->url = route('start',[$content->quiz_id,$content->id]);
            }
        }
        else{
            $demo->provider = $content->content_type;
            $demo->description = $content->description;
            $demo->item1 = translate('Content document');
            $demo->item2 = translate('Download');
            $demo->url = filePath($content->file);
        }


        $course_id = Classes::where('id', $content->class_id)->first()->course_id;


        if(!request()->is('subscription/*')){
            $enroll_id = Enrollment::where('course_id', $course_id)->where('user_id', $userId)->first()->id;
        }else{
            $enroll_id = SubscriptionEnrollment::where('user_id', $userId)->first()->id;
        }

        $seens = SeenContent::where('class_id', $content->class_id)
            ->where('content_id', $content->id)
            ->where('course_id', $course_id)->where('enroll_id', $enroll_id)->where('user_id', $userId)->get();
        if ($seens->count() == 0) {
            $seen = new SeenContent();
            $seen->class_id = $content->class_id;
            $seen->content_id = $content->id;
            $seen->course_id = $course_id;
            $seen->enroll_id = $enroll_id;
            $seen->user_id = $userId;
            $seen->saveOrFail();
        }
        return response()->json($demo);
    }

    public function couponApply(Request $request)
    {
      $coupon = Coupon::where('code',$request->code)->Published()->first();
      $course = Course::where('id', $request->course_id)->first();

      if ($coupon != null) {

        if($coupon->is_used)
            return response(['error' => 'The coupon was already used.'], 200);


        $start_day  = Carbon::create(Coupon::where('code',$request->code)->Published()->first()->start_day);
        $end_day    = Carbon::create(Coupon::where('code',$request->code)->Published()->first()->end_day);
        $min_value  = Coupon::where('code',$request->code)->Published()->first()->min_value;
        
        //   return response(['error' => $coupon], 200);

        if (Carbon::now() > $start_day && Carbon::now() < $end_day) {
            if ($course->is_discount == 1 && $course->discount_price < $coupon->rate 
                || $course->is_discount == 0 && $course->price < $coupon->rate) {
            
                //save in enrolments table
                $enrollment = new Enrollment();
                $enrollment->user_id = $request->user_id; //this is student id
                $enrollment->course_id = $request->course_id;
                $enrollment->save();

                if($course->is_discount == 1)
                    $course_price = $course->discount_price;
                else
                    $course_price = $course->price;

                $history = new CoursePurchaseHistory();
                $history->enrollment_id = $enrollment->id;
                $history->amount = $course_price;
                $history->payment_method = "Copupon";
                $history->save();


                // Add remained amount to user's wallet
                $remaining = $coupon->rate - $course_price;
                $user = User::where('id', $request->user_id)->first();
                $amount = $remaining; // (Double) Can be a negative value
                $message = "Courses have been purchased with Coupon"; //The reason for this transaction

                //Optional (if you modify the point_transaction table)
                $data = [
                    'ref_id' => 'someReferId',
                ];

                // Save remaining amount to student's wallet
                if($remaining > 0)
                    $transaction = $user->addPoints($remaining,$message,$data);

                
                // Save course price amount to teacher's wallet
                $instructor = Instructor::where('user_id', $course->user_id)->first();
                $instructor_package = Package::findOrFail($instructor->package_id);
                
                // Save Admin Earning
                $admin_earning_price = $course_price * $instructor_package->commission / 100;
                $admin_earning = new AdminEarning();
                $admin_earning->amount = $admin_earning_price;
                $admin_earning->purposes = "Commission from enrolment";
                $admin_earning->save();
                
                $instructor_earning_price = $course_price - $admin_earning_price;
                $instructor->balance += $instructor_earning_price;
                $instructor->save();


                // Save instructor earning
                $instructor_earning = new InstructorEarning();
                $instructor_earning->enrollment_id = $enrollment->id;
                $instructor_earning->course_price = $course_price;
                $instructor_earning->package_id = $instructor->package_id;
                $instructor_earning->will_get = $instructor_earning_price;
                $instructor_earning->user_id = $course->user_id;
                $instructor_earning->save();

                
                // Set the Coupon used
                $coupon->is_used = true;
                $coupon->save();

                return response(['success' => 'Courses have been purchased successfully.'], 200);
            }else {
                return response(['error' => 'Not enough money for the coupon '], 200);
            }
        }
        else {
            return response(['error' => translate('Coupon expired.')], 200);
        }
      }else {
        // Check Teacher Coupon
        $coupon = TeacherCoupon::where('code', $request->code)->first();
        if ($coupon != null){
            if($coupon->course_id == $request->course_id) {
                $enrollment = new Enrollment();
                $enrollment->user_id = $request->user_id; //this is student id
                $enrollment->course_id = $request->course_id;
                $enrollment->save();

                if($course->is_discount == 1)
                $course_price = $course->discount_price;
                else
                    $course_price = $course->price;

                $history = new CoursePurchaseHistory();
                $history->enrollment_id = $enrollment->id;
                $history->amount = $course_price;
                $history->payment_method = "Teacher Copupon";
                $history->save();

                // Set the Coupon used
                $coupon->is_used = true;
                $coupon->student_id = $request->user_id;
                $coupon->save();

                return response(['success' => 'The Course have been purchased successfully.'], 200);
            }else
                return response(['error' => 'This coupon is for another course.'], 200);
        }
  
        return response(['error' => translate('Invalid Coupon Code.')], 200);
      }
    }


    public function buyCourseWithWallet(Request $request)
    {
        $course = Course::where('id', $request->course_id)->first();
        $user   = User::where('id', $request->user_id)->first();
      
        if($course->is_discount == 1)
            $course_price = $course->discount_price;
        else
            $course_price = $course->price;

        if ($course_price < $user->currentPoints()) {
        
            //save in enrolments table
            $enrollment = new Enrollment();
            $enrollment->user_id = $request->user_id; //this is student id
            $enrollment->course_id = $request->course_id;
            $enrollment->save();
            

            $history = new CoursePurchaseHistory();
            $history->enrollment_id = $enrollment->id;
            $history->amount = $course_price;
            $history->payment_method = "Wallet";
            $history->save();

                
            // Sub course price to user's wallet
            $message = "Courses have been purchased with Wallet"; //The reason for this transaction

            //Optional (if you modify the point_transaction table)
            $data = [
                'ref_id' => 'someReferId',
            ];


            // Sub student's wallet
            $transaction = $user->subPoints($course_price,$message,$data);

            // Save course price amount to teacher's wallet
            $instructor = Instructor::where('user_id', $course->user_id)->first();
            $instructor_package = Package::findOrFail($instructor->package_id);
            
            // Save Admin Earning
            $admin_earning_price = $course_price * $instructor_package->commission / 100;
            $admin_earning = new AdminEarning();
            $admin_earning->amount = $admin_earning_price;
            $admin_earning->purposes = "Commission from enrolment";
            $admin_earning->save();
            
            $instructor_earning_price = $course_price - $admin_earning_price;
            $instructor->balance += $instructor_earning_price;
            $instructor->save();


            // Save instructor earning
            $instructor_earning = new InstructorEarning();
            $instructor_earning->enrollment_id = $enrollment->id;
            $instructor_earning->course_price = $course_price;
            $instructor_earning->package_id = $instructor->package_id;
            $instructor_earning->will_get = $instructor_earning_price;
            $instructor_earning->user_id = $course->user_id;
            $instructor_earning->save();


            return response(['success' => 'Courses have been purchased successfully.'], 200);
        }else {
            return response(['error' => 'Not enough money in Your wallet'], 200);
        }
    }

    function enrollFreeCourse(Request $request){
        $course = Course::where('id', $request->course_id)->first();
        $user = User::where('id', $request->user_id)->first();
      
        $enrollment = new Enrollment();
        $enrollment->user_id = $request->user_id; //this is student id
        $enrollment->course_id = $request->course_id;
        $enrollment->save();
        
        $history = new CoursePurchaseHistory();
        $history->enrollment_id = $enrollment->id;
        $history->amount = 0;
        $history->payment_method = "Free Course";
        $history->save();

        return response(['success' => 'Course has been set enrolled.'], 200);
    }
}
