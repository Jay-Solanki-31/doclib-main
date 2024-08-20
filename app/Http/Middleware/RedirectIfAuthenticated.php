<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "other_user" && Auth::guard($guard)->check()) {
            if(Auth::guard($guard)->user()->UserRole === 1){
                return redirect('/starter');
            }else{
                return redirect('/student-homepage');
            }
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/dashoard');
        }

        return $next($request);
    }
}
