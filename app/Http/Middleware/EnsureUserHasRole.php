<?php

namespace App\Http\Middleware;

use App\Models\Team;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if ($role === '*' || $request->user()->hasTeamRole(Team::first(), $role)) {

            return $next($request);
        }

        return redirect('/');
    }
}
