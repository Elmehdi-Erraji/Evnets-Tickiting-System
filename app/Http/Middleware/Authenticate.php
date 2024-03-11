<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if (auth()->check()) {
            $user = auth()->user();
            if ($user->status == 1) {
                auth()->logout();
                return redirect()->route('login')->with('message', 'Wait for the admin approval.');
            }
            if ($user->status == 3) {
                auth()->logout();
                return redirect()->route('login')->with('message', 'You are banned because: ' . $user->ban_reason);
            }
        }

        return $next($request);
    }
}

