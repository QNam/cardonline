<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheckLogin
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
        
        if(!session()->has('adminInfo')) {
            return redirect()->route('AdminLogin');
        }   
        
        $user = session()->get('adminInfo');
        if( isset($user['userName']) && $user['userName'] == 'admin' ) {
            return $next($request);
        } else {
            return redirect()->route('AdminLogin');
        }
    }
}
