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



}
