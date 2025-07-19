<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login'); // ⬅️ Penting!
        }
    
        if (auth()->user()->role !== $role) {
            abort(403, 'Akses ditolak.');
        }
    
        return $next($request);
    }
    
}
