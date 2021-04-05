<?php

namespace App\Http\Middleware;

use Closure;

class PostRequestBlockForDemo
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if ($request->isMethod('post')) {
//            notify()->info(translate('this is for demo purpose only'));
//            return back();
//        } else {
//            return $next($request);
//        }


       return $next($request);
    }
}
