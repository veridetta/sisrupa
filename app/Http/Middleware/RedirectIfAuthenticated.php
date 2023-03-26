<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch (Auth::user()->role) {
                    case 'admin':
                        return redirect(RouteServiceProvider::HOME);
                    case 'pedagang':
                        return redirect(RouteServiceProvider::HOME);
                    case 'petugas':
                        return redirect(RouteServiceProvider::HOME);
                    default:
                        auth()->logout();
                        return redirect(RouteServiceProvider::HOME);
                }
                
            }
        }

        return $next($request);
    }
}
