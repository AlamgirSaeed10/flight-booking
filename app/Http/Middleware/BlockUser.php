<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BlockUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_blocked) {
                Auth::logout(); // Log out the blocked user
                return redirect()->route('login')->with('error', 'Your account has been blocked. Please contact the administrator.');
            }
        }

        return $next($request);
    }
}
