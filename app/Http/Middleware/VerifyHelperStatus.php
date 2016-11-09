<?php

namespace App\Http\Middleware;

use Closure;

class VerifyHelperStatus
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
        if (Auth::check() && Auth::user()->helper || Auth::user()->admin) {
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            $data = [
                'success' => false,
                'code' => 401,
                'error' => 'Unauthorized'
            ];

            return $data;
        }

        return redirect()->route('home')->with('message', [
            'type' => 'danger',
            'body' => 'Unauthorized'
        ]);
    }
}
