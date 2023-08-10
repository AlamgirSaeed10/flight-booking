<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'Super Admin') {
            return redirect()->route('super-admin.dashboard');
        }

        return $next($request);
    }
}
