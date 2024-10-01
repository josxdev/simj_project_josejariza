<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Guest
{
    /**
     * Controlar accesibilidad a recursos. Solo permite si NO tiene sesión iniciada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Si la tiene, lo redirige
        if (session()->has('user')) return redirect(route('projects.index'));

        return $next($request);
    }
}
