<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('custom')->check()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}