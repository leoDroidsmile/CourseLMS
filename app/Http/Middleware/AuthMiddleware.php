<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Auth::user()){
            if (Auth::user()->user_type == "Student") {
                return $next($request)
                        ->header('Access-Control-Allow-Origin', '*')
                        ->header('Access-Control-Allow-Methods', '*')
                        ->header('Access-Control-Allow-Credentials', true)
                        ->header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization')
                        ->header('Accept', 'application/json');
            }
        }
        return $next($request);
    }
}
