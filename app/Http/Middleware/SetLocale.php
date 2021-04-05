<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Artisan;

class SetLocale
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
        if (empty(session('locale'))){
            app()->setLocale(env('DEFAULT_LANGUAGE'));
        }else{
            app()->setLocale(session('locale'));
        }
        Artisan::call('optimize:clear');
        return $next($request);
    }
}
