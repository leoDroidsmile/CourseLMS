<?php

namespace App\Http\Controllers\UserManager;


use App\Http\Controllers\Controller;
use App\Model\VerifyUser;
use App\Notifications\VerifyNotifications;
use Illuminate\Support\Str;

use App\User;
use Auth;
use Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*user list*/
    public function index(Request $request)
    {
        $users = User::where('user_type', 'Admin')->get();
        return view('userManager.user.index')->with('users', $users);
    }

    /*user create form*/
    public function create()
    {

        return view('userManager.user.create');
    }

    /*new user store done*/
    public function store(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
            [
                'name.required' => translate('Name is required'),
                'email.required' => translate('Email is required'),
                'email.email' => translate('This is not an email format'),
                'email.unique' => translate('Email must be unique'),
                'password.required' => translate('Password is required'),
                'password.confirmed' => translate('Password must be matched'),
            ]);

        $user = new User();
        $user->name = $request->name;
        $slug = Str::slug($request->name);
        $user_s = User::where('slug',$slug)->get();
        if ($user_s->count() > 0){
            $slug =$slug.($user_s->count()+1);
        }
        $user->slug = $slug;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = "Admin";
        if ($user->save()) {
            //verify email

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time())
            ]);

            $details = [
                'name' => $request->name,
                'user_id' => $user->id,
                'body' => 'New user registered named ',
            ];
            try {
                $user->notify(new VerifyNotifications($user));
            }catch (\Exception $exception){}
            notify()->success($request->name . ' ' . translate('User Create Successfully'));
            return back();
        } else {
            notify()->error(translate('There are Some Problem Try again'));
            return back();
        }
    }

    /*User show */
    public function show($id)
    {
        $user = User::where('id', $id)->where('user_type', 'Admin')->firstOrFail();
        return view('userManager.user.show')->with('user', $user);
    }

    /*user edit form*/
    public function edit($id)
    {
        $user = User::where('id', Auth::id())->first();
        return view('userManager.user.edit')->with('user', $user);
    }

    /*user update*/
    public function update(Request $request)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'id' => 'required',
        ]);
        if ($request->hasFile('newImage')) {
            fileDelete($request->image);
            $image = fileUpload($request->newImage, 'user');
        } else {
            $image = $request->image;
        }
        $slug = Str::slug($request->name);
        $user_s = User::where('slug',$slug)->get();
        if ($user_s->count() > 0){
            $slug =$slug.($user_s->count()+1);
        }
        $user =User::where('id', Auth::id())->first();
        $user->name = $request->name;
        $user->image = $image;
        $user->slug = $slug;
        $user->user_type = 'Admin';
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if ($user) {
            notify()->success($request->name . ' ' . translate('User Update Successfully'));
            return back();
        } else {
            notify()->error($request->name . ' ' . translate('There are Some Problem Try again'));
            return back();
        }

    }


    /*Delete the user*/
    public function destroy($id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }
      
        if (Auth::id() == $id) {
            notify()->error(translate('You are login,'));
        } else {
            if (User::where('id', $id)->where('user_type', 'Admin')->delete()) {
                notify()->success(translate('User Delete Successfully'));
                return back();
            } else {
                notify()->error(translate('There are Some Problem Try again'));
                return back();
            }
        }

    }
}
