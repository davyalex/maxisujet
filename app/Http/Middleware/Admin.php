<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $user = Auth::user();
        if (Auth::check() && $user->hasAnyRole(['administrateur', 'gestionnaire' ,'developpeur'])) {
            return $next($request);
        } else {
            return redirect()->route('auth.login')->withError('Access non autorisé');
        }
    }
}
