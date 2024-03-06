<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->is_email_verified) {
            auth()->logout();
            return redirect()->route('user.login')
            ->with('error', 'Vous devez confirmer votre inscription. Nous vous avons envoyé un email de confirmation, veuillez vérifier votre email..');
        }
        return $next($request);
    }
}
