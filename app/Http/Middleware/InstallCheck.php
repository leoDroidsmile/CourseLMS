<?php

namespace App\Http\Middleware;

use Closure;

class InstallCheck
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
        if(env('MIX_PUSHER_APP_CLUSTER_SECURE') == 'c2f3f489a00553e7a01d369c103c7251'){
            return $next($request);
        }else{
            return redirect()->to('/');
        }
    }
}
