<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user() || !$request->user()->role) {
            abort(403, 'Acesso não autorizado.');
        }

        $userRoleValue = $request->user()->role instanceof UserRole
            ? $request->user()->role->value
            : $request->user()->role;

        if (!in_array($userRoleValue, $roles)) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
