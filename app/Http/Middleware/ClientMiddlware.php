<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->roles()->first()->name == 'client') {
            $user = auth()->user();
            if ($user->status == 1) {
                auth()->logout();
                return redirect()->route('login')->with('message', 'Wait for the admin approval.');
            }
            if ($user->status == 3) {
                auth()->logout();
                return redirect()->route('login')->with('message', 'You are bnned becausse :' . $user->ban_reason);
            }
            return $next($request);
        }

        return redirect()->route('login')->with('message', 'Unauthorized');
    }
}
