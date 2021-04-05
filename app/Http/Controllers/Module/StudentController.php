<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Model\Course;
use App\Model\Enrollment;
use App\Model\Student;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /*All students with search option */
    public function index(Request $request)
    {
        if (Auth::user()->user_type == "Admin") {
            /*if Authenticated  user is admin , admin can show all students */
            if ($request->get('search')) {
                $students = Student::where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('search') . '%')
                    ->orderBydesc('id')->paginate(10);
            } else {
                $students = Student::orderBydesc('id')->paginate(10);
            }


        } else {
            /*There are the Instructor show only his/her register Students list*/
            $courses = Course::where('user_id', Auth::id())->get();
            $course_id_array = array();
            foreach ($courses as $i) {
                array_push($course_id_array, $i->id);
            }
            $enroll_student_id = array();
            $enroll = Enrollment::whereIn('course_id', $course_id_array)->get();
            foreach ($enroll as $i) {
                array_push($enroll_student_id, $i->user_id);
            }

            if ($request->get('search')) {
                $students = Student::where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('search') . '%')
                    ->whereIn('user_id', $enroll_student_id)->orderBydesc('id')->paginate(10);
            } else {
                $students = Student::whereIn('user_id', $enroll_student_id)->orderBydesc('id')->paginate(10);
            }
        }
        return view('module.students.index', compact('students'));
    }

    /*This function show all instructor related history
    like Package, Course , Enrolment Student list Get Payment History*/
    public function show($id)
    {
        $each_student = Student::where('user_id', $id)->first();

        return view('module.students.show', compact('each_student'));
    }

    //END
}
