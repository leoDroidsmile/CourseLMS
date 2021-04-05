<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Model\AdminEarning;
use App\Model\InstructorEarning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;

class EarningController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

// admin earning
    public function adminEarning(Request $request)
    {
        if ($request->get('search')) {
            $earning = AdminEarning::where('purposes', 'like', '%' . $request->get('search') . '%')
                ->latest()->paginate();
        } else {
            $earning = AdminEarning::latest()->paginate();
        }
        return view('module.earning.index', compact('earning'));
    }


    //instructor earning
    public function instructorEarning()
    {
        if (Auth::user()->user_type == "Instructor") {
            $earning = InstructorEarning::where('user_id', Auth::id())
                ->with('enrollment')
                ->paginate(10);
            return view('instructor.earning', compact('earning'));
        }
        return back();
    }
    //END
}
