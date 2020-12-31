<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserIsAdmin
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
        $token = $request->token;
        if(Auth::check()){
            if (!$request->user()->hasAnyRole('admin', 'super-admin')) {
                return abort(401);
            }
        }else{
            return redirect()->route('login');
        }
    
        return $next($request);
    }
}
