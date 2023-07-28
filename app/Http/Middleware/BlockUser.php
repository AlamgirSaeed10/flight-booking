<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BlockUser
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_blocked) {

            $is_banned = Auth::user()->is_blocked;
            Auth::logout(); // Log out the blocked user
            if ($is_banned == 0) {
                return redirect()->route('login')->with('error', 'Your account has been blocked. Please contact the administrator.');
            }
            return redirect()->route('login')->with('error', 'Your account has been blocked. Please contact the administrator.');

        }
        return $next($request);
    }
}
