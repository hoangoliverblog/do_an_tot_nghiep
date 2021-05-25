<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class languageMiddleware
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
        if(Session::has('language'))
        {
            app()->setLocale(Session::get('language'));
        }
        return $next($request);
    }
}
