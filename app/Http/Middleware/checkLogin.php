<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        if ($user->level == $role) {
            return $next($request);
        }

        if (Auth::check()) {
            return redirect()->route('home');
        }

        return redirect('login')->with('error', 'Anda tidak memiliki akses');
        // return $next($request);
    }
}
