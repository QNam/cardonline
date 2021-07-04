<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class apiAuth
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
        if(!$request->id) {
            return response()->json([], 400);
        }

        $valid = Hash::check($request->id.'namdzdzbodoiqua', $request->header('X-CSRF-TOKEN'));
        
        if (!$valid) {
            return response()->json([], 400);
        }

        return $next($request);
    }
}
