<?php

namespace Skacharya\LaravelRbac;

class SkAccess
{
    public static function hasAccess(string $routeName = null): bool
    {
        if (!is_string($routeName) || count(SkRouteHolder::$allowedRoutes) == 0) {
            return true;
        }
        return !in_array($routeName, SkRouteHolder::$allowedRoutes);
    }
}
