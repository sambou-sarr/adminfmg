<?php

namespace App\Http\Middleware;

use Closure;

class FilamentRoleRedirect
{
    public function handle($request, Closure $next, $panel)
    {
       $user = $request->user(); 

        if (! $user) {
            return $next($request);
        }

        // ADMIN PANEL
        if ($panel === 'admin' && ! $user->hasRole('super_admin')) {
            return redirect('/manager'); // ou autre panel
        }

        // MANAGER PANEL
        if ($panel === 'manager' && ! $user->hasRole('manager')) {
            return redirect('/admin'); // ou autre
        }

        return $next($request);
    }
}
