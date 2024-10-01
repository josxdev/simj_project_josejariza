<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Controlar accesibilidad a recursos. Solo permite si tiene sesión iniciada.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Si no tiene sesión, te redirige
        if (!session()->has('user'))
            return redirect(route('signin'));


        return $next($request);
    }
}
