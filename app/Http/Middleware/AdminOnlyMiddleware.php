<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnlyMiddleware
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
        if (Auth::user()) {
            if (Auth::user()->quyen == 0) {
                return $next($request);
            } else {
                return redirect(route('home'));
            } 
        }else{
            return redirect(route('login_admin'))->with('message','Bạn không có quyền truy cập trang này');
        }
    }
}
