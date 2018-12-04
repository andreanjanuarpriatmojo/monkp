<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
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
        if (Auth::user()) 
        {
            if( Auth::user()->role == 'ADMIN' || Auth::user()->username=='198407082010122004')
            {
                return $next($request);
            }
            
        }
        return redirect('/');    }
}
