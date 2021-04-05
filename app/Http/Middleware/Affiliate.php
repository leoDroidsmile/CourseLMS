<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Affiliate
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
        /*todo::here the manage refer id*/
        if($request->has('ref')){
            $response = $next($request);
            /*here check the refer id and auth user is same or not*/
            $affiliate =  \App\Model\Affiliate::where('refer_id',$request->ref)->where('user_id',Auth::id())->first();
            if ($affiliate){
                return $next($request);
            }else{
                return $response->withCookie(cookie('ref', $request->ref, cookiesLimit()));
            }

        }else{
            return $next($request);
        }
    }
}
