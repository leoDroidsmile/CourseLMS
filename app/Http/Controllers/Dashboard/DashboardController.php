<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Model\AdminEarning;
use App\Model\Course;
use App\Model\Enrollment;
use App\Model\Instructor;
use App\Model\InstructorEarning;
use App\Model\Student;
use App\User;
use Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        Artisan::call('view:clear');
    }

    // dashboard
    public function index()
    {

        //this month
        $this_start = Carbon::parse(date('d-M-y'))->startOfMonth()->toDateTimeString();
        $this_end = Carbon::parse(date('d-M-y'))->endOfMonth()->toDateTimeString();

        //prev month
        $prev_start = Carbon::parse(date('d-M-y'))->startOfMonth()->subMonth()->toDateTimeString();
        $prev_end = Carbon::parse(date('d-M-y'))->endOfMonth()->subMonth()->toDateTimeString();

        if (Auth::user()->user_type == "Admin") {

            //all instructor
            /*Top instructor get bay most enroll courses*/
            $enroll_courser_count = DB::table('enrollments')->select('enrollments.course_id',
                DB::raw('count(enrollments.course_id) as total_course'))
                ->orderByDesc('total_course')
                ->groupBy('course_id')->get();

            $i_id = array();

            foreach ($enroll_courser_count as $e) {
                $c = Course::find($e->course_id);
                if ($c != null && $c->user_id != null){
                    array_push($i_id, $c->user_id);
                }
            }
            /*Top Selling courses Instructor*/
            $top_instructor = Instructor::whereIn('user_id', array_unique($i_id))->take(10)->get()->shuffle();

            //
            $total_instructor = User::where('user_type', 'Instructor')->count();
            $total_students = User::where('user_type', 'Student')->count();
            $total_course = Course::all()->count();
            $total_enrollments = Enrollment::all()->count();

            //Admin Earning
            //this mount earning
            $this_earning = AdminEarning::whereBetween('created_at', [$this_start, $this_end])->sum('amount');
            //previous mount earning
            $prev_earning = AdminEarning::whereBetween('created_at', [$prev_start, $prev_end])->sum('amount');
            //total earning
            $total_earning = AdminEarning::all()->sum('amount');

            //month or labels
            $months = array();
            $admin_earning = array();
            $instructor_earning = array();
            $t_earning = array();
            for ($i = 1; $i <= 12; $i++) {
                $m = date("M", mktime(0, 0, 0, $i, 1, date("Y")));
                array_push($months, $m);
                //this month
                $start = Carbon::parse($m)->startOfMonth()->toDateTimeString();
                $end = Carbon::parse($m)->endOfMonth()->toDateTimeString();
                $per_earning = InstructorEarning::whereBetween('created_at', [$start, $end])->sum('will_get');
                array_push($instructor_earning, $per_earning);
                $a_earning = AdminEarning::whereBetween('created_at',[$start,$end])->sum('amount');
                array_push($admin_earning, $a_earning);
                array_push($t_earning,$a_earning+$per_earning);
                if (date('M') == $m) {
                    break;
                }
            }

            return view('dashboard.index',
                compact('top_instructor',
                    'total_instructor',
                    'total_students',
                    'months',
                    't_earning',
                    'admin_earning',
                    'instructor_earning',
                    'total_earning',
                    'prev_earning',
                    'this_earning',
                    'total_course',
                    'total_enrollments'));
        } else {
            $course = Course::where('user_id', Auth::id())->get();
            $c_id = array();
            foreach ($course as $c) {
                array_push($c_id, $c->id);
            }
            $enroll = Enrollment::whereIn('course_id', array_unique($c_id))->get();

            //get student id
            $s_id = array();
            foreach ($enroll as $e) {
                array_push($s_id, $e->user_id);
            }
            $total_students = Student::whereIn('user_id', array_unique($s_id))->take(10)->get()->shuffle();

            //Instructor Earning
            //this mount earning
            $this_earning = InstructorEarning::whereBetween('created_at', [$this_start, $this_end])->sum('will_get');
            //previous mount earning
            $prev_earning = InstructorEarning::whereBetween('created_at', [$prev_start, $prev_end])->sum('will_get');
            //total earning
            $total_earning = InstructorEarning::all()->sum('will_get');


            //month or labels
            $months = array();
            $data = array();
            for ($i = 1; $i <= 12; $i++) {
                $m = date("M", mktime(0, 0, 0, $i, 1, date("Y")));
                array_push($months, $m);
                //this month
                $start = Carbon::parse($m)->startOfMonth()->toDateTimeString();
                $end = Carbon::parse($m)->endOfMonth()->toDateTimeString();
                $per_earning = InstructorEarning::whereBetween('created_at', [$start, $end])->sum('will_get');
                array_push($data, $per_earning);
                if (date('M') == $m) {
                    break;
                }
            }

            return view('dashboard.instructor',
                compact('enroll', 'months','data','course', 'total_students', 'this_earning', 'prev_earning', 'total_earning'));
        }
    }


}
