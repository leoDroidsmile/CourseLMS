<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Model\Classes;
use App\Model\Course;
use App\Model\Enrollment;
use App\NotificationUser;

use App\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
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

    //this function is insert course
    public function create($id)
    {
        /*Check the id is valid*/
        Course::findOrFail($id);
        return view('course.classes.create', compact('id'));
    }

    //this function is redirect to edit course
    public function edit($id)
    {
        /*Check the id is valid*/
        $each_class = Classes::findOrFail($id);
        return view('course.classes.edit', compact('id', 'each_class'));
    }

    //this function is store the class title or name
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => translate('Title is required'),
        ]);

        $class = new Classes();
        $class->title = $request->title;
        $class->course_id = $request->course_id;
        $class->priority = 0;
        $class->save();

        //todo:class create notify
        $details = [
            'body' => translate($class->title . ' new class uploaded by ' . Auth::user()->name),
        ];

        //get all enroll student
        $enroll = Enrollment::where('course_id', $request->course_id)->with('user')->get();

        /* sending instructor notification */
        $this->userNotify(Auth::user()->id,$details);

        notify()->success(translate('Class created successfully'));
        return back();
    }

    //this function is update the class title or name
    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => 'Title is required',
        ]);

        Classes::findOrFail($request->course_id)->update([
            'title' => $request->title,
        ]);

        notify()->success(translate('Class created successfully'));
        return back();
    }

    // this function is delete or trash the class
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        Classes::findOrFail($id)->delete();

        notify()->success(translate('Class deleted successfully'));
        return back();
    }

    //END
}
