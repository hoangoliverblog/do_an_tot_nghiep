<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;
use Mockery\CountValidator\AtMost;

class adminMiddleware
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

        if(Auth::check() & isset(Auth::user()->role_id) == 1)
        {
            if(Auth::user()->role_id != 1)
            {
                return redirect()->route('Admin.login');
            }
            return $next($request);
        }
        else
        {
            return redirect()->back();
        }
    }
}
