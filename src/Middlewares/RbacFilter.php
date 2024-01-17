<?php

namespace Sk\LaravelRbac\Middlewares;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Sk\LaravelRbac\Models\RoleAccess;
use Sk\LaravelRbac\Models\RoleUser;
use Illuminate\Http\Request;
use Sk\LaravelRbac\SkAccess;
use Sk\LaravelRbac\SkRouteHolder;

class RbacFilter
{
    public function handle(Request $request, Closure $next, string ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        $routeName = $request->route()->getName();
        if (Auth::check()) {
            $user_id = Auth::id();
            $user_roles = RoleUser::where(["user_id" => $user_id])->pluck("role_id")->toArray();
            SkRouteHolder::$allowedRoutes = RoleAccess::whereIn("role_id", $user_roles)->pluck("access_id")->toArray();
            if (!SkAccess::hasAccess($routeName)) {
                throw new AuthorizationException('You are not authorized to view this resource.');
            }
        }
        return $next($request);
    }
}
