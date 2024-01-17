<?php

namespace Sk\LaravelRbac;

class SkAccess
{
    public static function hasAccess(string $routeName): bool
    {
        if (count(SkRouteHolder::$allowedRoutes) == 0) {
            return true;
        }
        return !in_array($routeName, SkRouteHolder::$allowedRoutes);
    }
}
