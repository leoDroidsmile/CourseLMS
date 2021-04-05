<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Model\ClassContent;
use App\Model\Course;
use App\Model\Demo;
use App\Question;
use App\Quiz;
use Alert;
use App\QuizScore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;


class QuizController extends Controller
{
    //
    public function create()
    {
        $quiz = Quiz::where('user_id', Auth::id())->paginate(10);
        $courses = Course::where('user_id', Auth::id())->get();
        return view('addon.view.quiz.index', compact('quiz', 'courses'));
    }

    /*store */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'pass_mark' => 'required',
        ]);
        $quiz = new Quiz();
        $quiz->name = $request->name;
        $quiz->quiz_time = $request->quiz_time;
        $quiz->pass_mark = $request->pass_mark;
        $quiz->status = $request->status;
        $quiz->user_id = Auth::id();
        $quiz->course_id = $request->course_id;
        $quiz->save();
        notify()->success(translate('Quiz Create Successful Done'));
        return back();
    }

    /*edit quiz*/
    public function edit($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $courses = Course::where('user_id', Auth::id())->Published()->get();
        return view('addon.view.quiz.edit', compact('quiz', 'courses'));
    }

    /*quiz update*/
    public function update(Request $request)
    {
        $quiz = Quiz::where('id', $request->id)->first();
        $quiz->name = $request->name;
        $quiz->quiz_time = $request->quiz_time;
        $quiz->pass_mark = $request->pass_mark;
        $quiz->status = $request->status;
        $quiz->user_id = Auth::id();
        $quiz->course_id = $request->course_id;
        $quiz->save();
        notify()->success(translate('Quiz Update Successful Done'));
        return back();
    }


    /*quiz delete*/
    public function delete($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $quiz->delete();
        notify()->success(translate('Quiz Delete Successful Done'));
        return back();
    }

    //published
    public function published(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $quiz = Quiz::where('id', $request->id)->first();
        if ($quiz->status == 1) {
            $quiz->status = 0;
            $quiz->save();
        } else {
            $quiz->status = 1;
            $quiz->save();
        }
        return response(['message' => translate('Quiz  status is changed ')], 200);
    }


    /*questions*/
    public function questionsIndex($id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $questions = Question::where('quiz_id', $quiz->id)->get();
        return view('addon.view.quiz.questionsIndex', compact('quiz', 'questions'));
    }

    /*questions store*/
    public function questionsStore(Request $request)
    {
        $i = 0;
        $answer_collection = collect();
        foreach ($request->answer as $answer) {
            $data = rand(1000, 1000000);
            $demo = new Demo();
            $demo->image = $request->image[$i] ?? null;
            $demo->index = $data;
            $demo->correct = $request->correct[$i];
            $demo->answer = $answer;
            if ($demo->image != null) {
                //upload the image
                $demo->image = fileUpload($request->image[$i], 'quiz');
            }
            $i++;
            $answer_collection->push($demo);

        }

        $question = new Question();
        $question->question = $request->title;
        $question->quiz_id = $request->quiz_id;
        $question->user_id = Auth::id();
        $question->grade = $request->grade;
        $question->options = json_encode($answer_collection);
        $question->save();
        notify()->success(translate('Questions Create Successful'));
        return back();
    }


    //published
    public function questionsPublished(Request $request)
    {
        // don't use this type of variable naming, use $category instead of $cat1
        $quiz = Question::where('id', $request->id)->first();
        if ($quiz->status == 1) {
            $quiz->status = 0;
            $quiz->save();
        } else {
            $quiz->status = 1;
            $quiz->save();
        }
        return response(['message' => translate('Question  status is changed ')], 200);
    }

    /*questions delete*/
    public function questionsDelete($id)
    {
        $quiz = Question::where('id', $id)->first();
        $quiz->delete();
        notify()->success(translate('Question Delete Successful Done'));
        return back();
    }

    /*questions edit*/

    public function questionsEdit($id)
    {
        $question = Question::where('id', $id)->first();
        return view('addon.view.quiz.questionsEdit', compact('question'));
    }


    public function questionsUpdate(Request $request)
    {

        $i = 0;
        $answer_collection = collect();
        foreach ($request->answer as $answer) {
            $data = $request->index[$i];
            $demo = new Demo();
            $demo->image = $request->image[$i] ?? null;
            $demo->index = $data;
            $demo->correct = $request->correct[$i];
            $demo->answer = $answer;
            if ($demo->image != null) {
                //upload the image
                $demo->image = fileUpload($request->image[$i], 'quiz');
            }
            $i++;
            $answer_collection->push($demo);

        }

        $question = Question::where('id', $request->id)->first();
        $question->question = $request->title;
        $question->grade = $request->grade;
        $question->status = $request->status;
        $question->options = json_encode($answer_collection);
        $question->save();
        notify()->success(translate('Questions Update Successful'));
        return back();

    }
    /*for frontend*/


    public function start($id, $content_id){
        $quiz = Quiz::where('id',$id)->first();
        $url = route('start.quiz',[$id,$content_id]);
        return \view('addon.view.quiz.question',compact('url','quiz'));
    }

    /*quiz start*/
    public function quizStart(Request $request, $id, $content_id)
    {
        $time = Carbon::now();
        $request->session()->put('start_quiz', $time->toTimeString());
        $content = ClassContent::findOrFail($content_id);

        if ($content != null) {
            $quiz = Quiz::where('id', $id)->with('questions')->firstOrFail();
        }
        return view('addon.view.quiz.questionsStart', compact('quiz', 'content'));
    }

    /*quiz done*/
    public function quizDone(Request $request)
    {

        /*here the most complicated is identify $minutes*/
        $time = Carbon::now();
        $start_time = $request->session()->get('start_quiz');
        $end_time = $time->diffInMinutes($start_time);
        $request->session()->forget('start_quiz');

        $minutes = $end_time == 0 ? 1 : $end_time;
        $quiz = Quiz::where('id', $request->quiz_id)->first();;
        $content_id = $request->content_id;
        $wrong = 0;
        $point = 0;
        $right = 0;
        $status = '';
        foreach ($request->question as $id) {
            $qu = Question::where('id', $id)->first();

            foreach (json_decode($qu->options, true) as $ns) {
                $radio = 'answer_' . $id;
                if ($ns['index'] == $request->$radio) {
                    if ($ns['correct'] == "true") {
                        $point += $qu->grade;
                        $right = $right + 1;
                    } else {
                        $wrong = $wrong + 1;
                    }
                }
            }
        }
        if ($quiz->pass_mark > $point) {
            //fail
            $status = 'fail';
        } else {
            //pass
            $status = 'pass';
        }
        if ($end_time > $quiz->minutes) {
            //fail
            $status = 'fail';
        }
        /*student course score*/
        $scores = QuizScore::where('quiz_id', $quiz->id)
            ->where('course_id', $quiz->course_id)
            ->where('content_id', $content_id)
            ->where('user_id', Auth::id())->first();
        if ($scores == null) {
            $scores = new QuizScore();
            $scores->quiz_id = $quiz->id;
            $scores->course_id = $quiz->course_id;
            $scores->content_id = $content_id;
            $scores->user_id = Auth::id();
        }
        $scores->minutes = $minutes;
        $scores->score = $point;
        $scores->wrong = $wrong;
        $scores->right = $right;
        $scores->status = $status;
        $scores->save();
        $againQuizStart = route('start.quiz', [$scores->quiz_id, $scores->content_id]);
        return \view('addon.view.quiz.questionsDone', compact('scores', 'againQuizStart'));
    }

    /*show done score */

    public function questionScoreShow($id)
    {
        $scores = QuizScore::where('id', $id)->first();
        $againQuizStart = route('start.quiz', [$scores->quiz_id, $scores->content_id]);
        return \view('addon.view.quiz.questionsDone', compact('scores', 'againQuizStart'));
    }
}
