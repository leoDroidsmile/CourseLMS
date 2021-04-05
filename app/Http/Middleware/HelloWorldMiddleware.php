<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;
use Auth;
use Alert;

class HelloWorldMiddleware
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

        //form data
        $addon_name = $request->addon_name;
        $token = '0eZScyN9HOoPHzKSJMtWI8U1d7VwkApX';
        $purchase_code = $request->purchase_code;
        $url = 'https://api.envato.com/v3/market/buyer/purchase?code='.$purchase_code;
        $response = Http::withToken($token)->get($url);

        
        try {

            /**
             * PAYTM
             */
                if ($addon_name == "paytm") {
                    if ($purchase_code == $response['code']) {
                        notify()->success(translate('Purchase code applied successfully.'));
                        return $next($request);
                    }
                }

        //END

        } catch (\Throwable $th) {
            notify()->error(translate('Invalid purchase code.'));
            return back();
        }


    }
}
