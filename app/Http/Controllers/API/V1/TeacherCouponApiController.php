<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Model\Category;

use Illuminate\Http\Request;
use Alert;
use Carbon\Carbon;
use App\Coupon;
use App\Model\Course;
use App\Model\Instructor;
use Auth;
use Session;
use App\TeacherCouponExport;
use DB;
use Excel;

class TeacherCouponApiController extends Controller
{
    /*
     * returns all published categories
     */

    public function getCoursesForTeacher(Request $request){
        // User Table ID because course was created with user_id, not instructor_id
        $user_id = $request->user_id;
        $courses = Course::select('title', 'id')->where('user_id', $user_id)->get();
        return response(['courses' => $courses], 200);
    }
}
