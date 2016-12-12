<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyAuthentication
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
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }

        $path = $request->path();
        session(['redirect_to' => $path]);
        return redirect()->route('auth.reddit.redirect');
    }
}
