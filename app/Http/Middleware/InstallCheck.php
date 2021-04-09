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
        if(env('MIX_PUSHER_APP_CLUSTER_SECURE') == '7469a286259799e5b37e5db9296f00b3'){
            return $next($request);
        }else{
            return redirect()->to('/');
        }
    }
}
