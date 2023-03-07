<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // $user = Admin::first();
        // if (Auth::user()) {
        //     $user_type = Auth::user()->type;
        //     if ($user_type == 1) {
        //         return $next($request);
        //     } else {
        //          Session::flush();
        //          Auth::logout();
        //          return redirect('/');
        //     }
        // }
        //  return redirect('/');
        if(Auth::guard('web')->check()){
            return $next($request);
        }
        return redirect('/');
    }
}
