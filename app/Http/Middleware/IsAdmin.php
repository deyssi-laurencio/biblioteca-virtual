<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si está autenticado y es administrador activo
        if (!Auth::check() || Auth::user()->rol !== 'admin' || Auth::user()->estado !== 'activo') {
            abort(403, 'No autorizado.');
        }

        return $next($request);
    }
}
