<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DirectorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->activo) {
            abort(403);
        }

        if (!$user->tieneRol('Director')) {
            abort(403);
        }

        return $next($request);
    }
}