<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class ActiveMiddleware
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
        if(Auth::user()->active != 1)
        {
            Auth::logout();
            alert()->warning('دسترسی شما به سامانه مسدود شده است');
            return redirect(route('login'));
        }
        return $next($request);
    }
}
