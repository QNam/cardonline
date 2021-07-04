<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class apiAdminAuth
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
        if( $request->header('X-CSRF-TOKEN') != '9144961542asdvnamdzbodoiqua' ) {
            return response()->json([], 400);
        }
        return $next($request);
    }
}
