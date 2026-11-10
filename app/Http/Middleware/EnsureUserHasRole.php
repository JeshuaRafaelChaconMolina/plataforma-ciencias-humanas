<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Protege rutas por rol. Uso en routes: ->middleware('role:administrador')
 * o con varios roles separados por coma: ->middleware('role:docente,alumno')
 */
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        $allowed = explode(',', $roles);

        if (! $request->user() || ! $request->user()->hasAnyRole($allowed)) {
            abort(403, 'No tienes permiso para acceder a esta seccion.');
        }

        return $next($request);
    }
}
