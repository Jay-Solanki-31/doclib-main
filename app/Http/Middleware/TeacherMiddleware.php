<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class TeacherMiddleware
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
        if(true == Auth::guard('other_user')->check() && Auth::guard('other_user')->user()->UserRole === 1){
            return $next($request);
        }
        return redirect()->back();
    }
}
