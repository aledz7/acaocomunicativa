<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Registered
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

        if( \Auth::guest() ) return redirect()->route('register');

        return $next($request);
    }
}
