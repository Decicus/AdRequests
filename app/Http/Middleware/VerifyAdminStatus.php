<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Helpers\Http;

class VerifyAdminStatus
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
        if (Auth::check() && Auth::user()->admin) {
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

        return redirect()->route('home')->with('message', [
            'type' => 'danger',
            'body' => 'Unauthorized'
        ]);
    }
}
