<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfNotClient
{
    CONST TYPE = 'client';
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'client')
    {
        if (!Auth::guard(Self::TYPE)->check()) {
            return redirect()->route('user.login');
        }

        if (Auth::guard(Self::TYPE)->user()->status != 1) {
            Auth::logout();
            return redirect()->route('user.account-restricted');
        }

        return $next($request);
    }
}
