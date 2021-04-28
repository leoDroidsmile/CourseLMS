<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Model\ClassContent;
use App\Model\Classes;
use App\Model\Course;
use App\Model\Enrollment;
use App\Quiz;
use App\User;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\NotificationUser;


class ContentController extends Controller
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

    /*content create*/
  public function create($id)
    {
        // /Check the id is valid/

        $course_id = $id;
        Course::findOrFail($id);
        $classes = Classes::where('course_id', $id)->get();
        $quizes = collect();
        if (quizActive()){
            $q =Quiz::where('status',1)->where('user_id',Auth::id())->where('course_id',$id)->get();
            foreach ($q as $i){
                if($i->questions->count() > 0){
                    $quizes->push($i);
                }
            }
        }

        return view('course.contents.create', compact('classes','course_id','quizes'));
    }

    //this function is store the content
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'title' => 'required',
            'content_type' => 'required',
        ],
            [
                'title.required' => translate('Title is required'),
                'content_type.required' => translate('Content type is required'),
            ]);

        /*
        |--------------------------------------------------------------------------
        | storing value
        |--------------------------------------------------------------------------
        */

        $content = new ClassContent();
        $content->title = $request->title;
        $content->content_type = $request->content_type;
        $content->provider = $request->provider;

        if(quizActive() && $request->quiz_id != null){
            $content->quiz_id = $request->quiz_id;
            $content->provider = $request->content_type;
        }

        if ($request->hasFile('video_url')) {
            $content->video_url = fileUpload($request->video_url, 'class_contents_files');
        }else{
            $content->video_url = $request->video_url ?? $request->video_raw_url;
        }

        if (zoomActive() && $request->meeting_id != null) {
            $content->meeting_id = $request->meeting_id;
        }

        $content->description = $request->description;
        $content->is_preview =  false;
        $content->class_id = $request->class_id;
        if ($request->hasFile('file')) {
            $content->file = fileUpload($request->file, 'class_contents');
        }

        if ($request->hasFile('source_code')) {
            $content->source_code = fileUpload($request->source_code, 'class_source_codes');
        }else{
            $content->source_code = $request->source_code_url;
        }

        $content->duration = $request->duration;
        /*save priority*/
        $contentSort = ClassContent::where('class_id',$request->class_id)->count();
        $content->priority = $contentSort+1;
        $content->save();

        $details = [
            'body' => translate($content->title . ' - new content uploaded to the courses that you have purchased, by ' . Auth::user()->name),
        ];
        //get course id
        $class = Classes::where('id', $content->class_id)->firstOrFail();
        //get all enroll student
        $enroll = Enrollment::where('course_id', $class->course_id)->with('user')->get();
        foreach($enroll as $item){
            /* sending instructor notification */
            $this->userNotify($item->user_id,$details);
        }


        /* sending instructor notification */
        // $notify = $this->userNotify(Auth::user()->id,$details);

        notify()->success(translate('Class content saved successfully '));
        return back();

    }

    /*
    |--------------------------------------------------------------------------
    | this function is destroy or trash the content
    |--------------------------------------------------------------------------
    */

    /*Delete the content*/
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $ClassContent = ClassContent::find($id);
        $ClassContent->delete();

        notify()->success(translate('Class content deleted successfully '));
        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | this function is showing content
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        /*Check the id is valid*/
        $each_contents = ClassContent::findOrFail($id);
        return view('course.contents.show', compact('id', 'each_contents'));
    }

    /*
    |--------------------------------------------------------------------------
    | this function is updating content
    |--------------------------------------------------------------------------
    */

    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $i = 1;
        $s = json_encode($request->order);
        foreach (json_decode($s) as $content) {
            $c = ClassContent::findOrFail((int)$content->id);
            $c->priority = (int)$content->position;
            $c->save();
            $i++;
        }
        return response(translate('Updated successfully'), 200);
    }

    /*
    |--------------------------------------------------------------------------
    | this function that download content source code
    |--------------------------------------------------------------------------
    */

    public function code($id)
    {
        try {
            $source_code = ClassContent::findOrFail($id)->source_code;
            $path = public_path($source_code);
            return response()->download($path);
        } catch (\Throwable $th) {
            notify()->warning(translate('No Source Code Found'));
            return back();
        }

    }

    //published
    public function published(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        // don't use this type of variable naming, use $category instead of $cat1
        $content = ClassContent::where('id', $request->id)->first();
        if ($content->is_published == 1) {
            $content->is_published = 0;
            $content->save();
        } else {
            $content->is_published = 1;
            $content->save();
        }

        return response(['message' => translate('Class content active status is changed')], 200);
    }

    //preview
    public function preview(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $content = ClassContent::where('id', $request->id)->first();
        if ($content->is_preview == 1) {
            $content->is_preview = 0;
            $content->save();
        } else {
            $content->is_preview = 1;
            $content->save();
        }
        return response(['message' => translate('Class content preview status is changed')], 200);
    }

    //END
}
