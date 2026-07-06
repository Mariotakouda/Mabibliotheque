<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Restricts access to routes based on the authenticated user's role.
 *
 * Usage in routes: ->middleware('role:admin') or ->middleware('role:admin,librarian')
 */
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, $roles, true)) {
            abort(403, "Vous n'avez pas la permission d'accéder à cette page.");
        }

        return $next($request);
    }
}
