<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkReferer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
        // $referer = $request->headers->get('referer');
        // if($referer && strpos($referer, env('APP_URL')) !== false) {
        //     return $next($request);
        // }

        // return response()->json(['code' => 401, 'message' => 'Unauthorized'],401);
    }
}
