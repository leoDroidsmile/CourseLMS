<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Validator, Redirect, Response, File;
use Socialite;
use App\User;
use App\Model\Student;

class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /*Socialite callback*/
    public function callback($provider)
    {

          $getInfo = Socialite::driver($provider)->user();

          $user_update = User::where('email', $getInfo->getEmail())->update([
              'user_type' => 'Student',
              'provider_id' => $getInfo->id,
          ]);

          $user = User::where('provider_id', $getInfo->id)->first();
          if ($user === null) {

              $slug_name = Str::slug($getInfo->name);
              /*check the slug */
              $users = User::where('slug', $slug_name)->get();
              if ($users->count() > 0) {
                  $slug_name = $slug_name.($users->count() + 1);
              }

              $user = User::create([
                    'name' => $getInfo->name,
                    'slug' => $slug_name,
                    'email' => $getInfo->email,
                    'user_type' => 'Student',
                    'provider_id' => $getInfo->id,
                ]);

                    Student::create([
                    'name' => $getInfo->name,
                    'email' => $getInfo->email,
                    'user_id' => $user->id,

                ]);
            }
           Auth::login($user);


        return redirect()->to('/');

    }

    //END
}
