<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login');
        }

        // Check if session is expired (1 hour)
        $loginTime = $request->session()->get('login_time');
        if (now()->diffInHours($loginTime) >= 1) {
            $request->session()->forget(['user_id', 'login_time']);
            return redirect()->route('login');
        }

        return $next($request);
    }
}
