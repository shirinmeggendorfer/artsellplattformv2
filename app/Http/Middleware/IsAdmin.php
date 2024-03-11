<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->is_admin) {
            return $next($request);
        }

        // Redirect oder Fehlermeldung, wenn kein Admin
        return redirect('/')->with('error', 'Zugriff verweigert');
    }
}