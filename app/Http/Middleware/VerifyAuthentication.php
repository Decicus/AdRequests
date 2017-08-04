<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Helpers\Http;

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

        if ($request->ajax() || $request->wantsJson()) {
            $data = [
                'success' => false,
                'code' => 401,
                'error' => 'Unauthorized'
            ];

            return Http::json($data, 401);
        }

        $path = $request->path();
        session(['redirect_to' => $path]);
        return redirect()->route('auth.reddit.redirect');
    }
}
