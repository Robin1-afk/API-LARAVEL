<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Manejar la solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $user = auth()->user();

        // Dividir los roles permitidos y verificar si el usuario tiene uno de ellos
        $allowedRoles = explode(',', $roles);
        if (!in_array($user->rol, $allowedRoles)) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        return $next($request);
    }
}
