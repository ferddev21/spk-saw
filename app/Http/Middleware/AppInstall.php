<?php

namespace App\Http\Middleware;

use App\Models\App;
use Closure;
use Illuminate\Http\Request;

class AppInstall
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $route)
    {
        $App = new App();

        if ($route == 'login') {
            if (empty($App->first()->name)) {
                return redirect()->route('install');
            }
        }

        if ($route == 'install') {
            if (!empty($App->first()->name)) {
                return redirect()->route('login');
            }
        }


        return $next($request);
    }
}
