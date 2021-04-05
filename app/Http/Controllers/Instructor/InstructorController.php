<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Model\Instructor;
use App\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\NotificationUser;

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
        }else{
            $instructor = Instructor::where('user_id', $id)
                ->with('purchaseHistory')
                ->with('courses')
                ->first();
        }


        return view('instructor.show', compact('instructor'));
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
    //END
}
