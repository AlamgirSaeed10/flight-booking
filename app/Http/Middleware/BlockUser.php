<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BlockUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->is_blocked) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Your account has been blocked. Please contact the administrator.');
            }

            if ( !$user->is_blocked && $user->Role === "Super Admin") {
                return redirect()->route('super-admin.dashboard');
            }
        }

        return $next($request);
    }
}
