<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Controlar accesibilidad a recursos. Solo permite si tiene sesión iniciada y además es administrador
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('user') && !session()->get('user')['is_admin'])
            return redirect(route('projects.index'));

        return $next($request);
    }
}
