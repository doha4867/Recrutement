<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect('login');
        }
    
        // Débogage
        
        
        // Empêcher la boucle de redirection
        if (auth()->user()->role !== $role) {
            // Rediriger vers une page générale plutôt que dashboard spécifique
            return redirect()->route('home')
                ->with('error', 'Accès non autorisé. Votre rôle est ' . auth()->user()->role . 
                      ' mais cette page requiert le rôle ' . $role);
        }
    
        return $next($request);
    }
}