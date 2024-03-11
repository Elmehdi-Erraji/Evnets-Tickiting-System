<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->status == 1) {
                Auth::logout(); 
                return redirect()->route('login')->with('message', 'Your account is pending approval.');
            }

            if ($user->status == 3) {
                Auth::logout(); 
                return redirect()->route('login')->with('message', 'Your account has been banned: ' . $user->ban_reason);
            }
        }

        return $next($request);
    }
}
