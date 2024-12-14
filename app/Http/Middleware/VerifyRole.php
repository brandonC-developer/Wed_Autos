<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        logger('Usuario autenticado:', [
            'usuario_id' => Auth::id(),
            'role' => Auth::user()->role ?? 'sin rol'
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['message' => 'Debes iniciar sesión.']);
        }

        $user = Auth::user();

        // Verificar si el usuario tiene un rol válido
        if (empty($user->role)) {
            return redirect()->route('home')->withErrors(['message' => 'No se encontró un rol válido para este usuario.']);
        }

        // Verificar si el rol del usuario coincide con los roles permitidos
        if (!in_array($user->role, $roles)) {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }

        return $next($request);
    }

}
