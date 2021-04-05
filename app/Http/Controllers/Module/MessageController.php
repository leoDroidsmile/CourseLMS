<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Model\Course;
use App\Model\CourseComment;
use App\Model\Enrollment;
use App\Model\Massage;
use App\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\NotificationUser;


class MessageController extends Controller
{


    function userNotify($user_id,$details)
    {
        $notify = new NotificationUser();
        $notify->user_id = $user_id;
        $notify->data = $details;
        $notify->save();
    }

    /*Show all message list send add by register student*/
    public function index()
    {
        $course_id = array();
        $course = Course::where('user_id', Auth::user()->id)->get();
        foreach ($course as $id) {
            $course_id = array_merge($course_id, [$id->id]);
        }
        $enrolls = Enrollment::whereIn('course_id', $course_id)->with('messages')->get();

        $ids = array();
        foreach ($enrolls as $item){
            if($item->messages->count() > 0){
                $ids = array_merge($ids,[$item->course_id]);

            }
        }
        $enroll = Enrollment::whereIn('course_id', $ids)->with('enrollCourse')
            ->with('messagesForInbox')->paginate(10);

        return view('module.message.inbox', compact('enroll'));
    }

    /*Show single enrolled student messages chat */
    public function show($id)
    {
        $messages = Massage::where('enroll_id', $id)->get();

        $enroll_id = $id;
        $student = User::where('id', $messages->first()->user_id)->first();

        return view('module.message.show', compact('messages', 'enroll_id', 'student'));
    }

    /*Send the message*/
    public function send(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'enroll_id' => 'required',
            'message'   => 'required',
        ]);

        //check the enroll course instructor in login
        $e = Enrollment::where('id', $request->enroll_id)->with('enrollCourse')->first();
        if ($e->enrollCourse->user_id != Auth::user()->id) {
            notify()->warning(translate('you are doing some thing wrong, try later'));
            return back();
        }
        $message = new Massage();
        $message->enroll_id = $request->enroll_id;
        $message->user_id = Auth::user()->id;
        $message->content = $request->message;
        $message->save();


        notify()->success(translate('Message sent successfully'));
        return back();
    }

    /*all course commenting method function here*/

    /*show all latest comment*/
    public function allCommenting()
    {

        $course = Course::where('user_id', Auth::user()->id)->get();
        $id = array();
        foreach ($course as $item) {
            $id = array_merge($id, [$item->id]);
        }
        $comments = CourseComment::whereIn('course_id', $id)
            ->where('replay', 0)->latest()
            ->with('user')->with('replay')
            ->with('course')
            ->with('replayLast')
            ->paginate(10);
        return view('module.comment.index', compact('comments'));

    }

    /*show single comment replay*/
    public function commentShow($id)
    {
        $comment = CourseComment::where('id', $id)
            ->where('replay', 0)
            ->with('user')->with('replay')
            ->with('course')
            ->first();

        return view('module.comment.show', compact('comment'));
    }
    /*destroy comment*/
    public function commentDestroy($id){
        CourseComment::where('id', $id)->delete();
        CourseComment::where('replay', $id)->delete();
        notify()->success(translate('Comment delete successfully'));
        return back();
    }

    /*save the comment replay*/
    public function commentReplay(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        $request->validate([
            'course_id' => 'required',
            'comment_id' => 'required',
            'comment' => 'required'
        ]);

        if ($request->comment_id != null) {
            $comment = new CourseComment();
            $comment->course_id = $request->course_id;
            $comment->user_id = Auth::id();
            $comment->comment = $request->comment;
            $comment->replay = $request->comment_id;
            $comment->save();
            notify()->success(translate('Reply sent successfully'));
            return back();
        }

    }
}
