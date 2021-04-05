<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class Installed
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
        try {
            if (!DB::connection()->getPdo() || env('MIX_PUSHER_APP_CLUSTER_SECURE') == 'c2f3f489a00553e7a01d369c103c7251' ){
                return redirect()->route('install');
            }
            return $next($request);
        }catch (\Exception $exception){
            return redirect()->route('install');
        }
    }
}
