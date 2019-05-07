<?php

namespace App\Http\Middleware;

use Closure;

class AutorizeCheck {

    public function handle($request, Closure $next)
    {

        $sessionShopId = $request->session()->get('shopId');
        $cookieShopId = $request->cookie('shopId');

        if( empty($sessionShopId) || empty($cookieShopId) )
        {
            return redirect()->route('error',['code' => '401']);
        }

        if ( $sessionShopId != $cookieShopId )
        {
            return redirect()->route('error',['code' => '401']);
        }

        return $next($request);

    }

}