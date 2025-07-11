<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect()->guest(route('login')); // Utilisez redirect()->guest()
        }

        if (Auth::user()->role !== $role) {
            abort(403); // Utilisez abort() au lieu de redirect()
        }

        return $next($request); // ← Ceci permet à la requête de continuer
    }
}
