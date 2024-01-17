<?php

namespace Sk\LaravelRbac\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

class StoreRoutesCommand extends Command
{
    protected $signature = 'route:store';
    protected $description = 'Store all Laravel routes in the database';

    public function handle()
    {
        DB::table("skrbac_routes")->delete();
        // $providerModelClass = config("skrbac.user_model");
        // $guards = config("skrbac.guards");
        // $auth = config("auth");
        // $routes = collect(Route::getRoutes())->filter(function ($route) use ($providerModelClass, $auth, $guards) {
        //     $middleware = $route->middleware()[0];
        //     if (!in_array($middleware, $guards)) {
        //         return false;
        //     }
        //     if (isset($auth["guards"][$middleware])) {
        //         if (isset($auth["providers"][$auth["guards"][$middleware]["provider"]])) {
        //             return $auth["providers"][$auth["guards"][$middleware]["provider"]]["model"] === $providerModelClass;
        //         }
        //     }
        //     return false;
        // });
        $prefixs = config("skrbac.groups");
        $allowRouteList = config("skrbac.routes");
        $blockRouteList = config("skrbac.except_routes");
        $routes = collect(Route::getRoutes())->filter(function ($route) use ($prefixs, $allowRouteList, $blockRouteList) {
            $flag = false;
            foreach ($prefixs as $px) {
                if (strpos($route->getName(), $px) === 0) {
                    $flag = true;
                    break;
                }
            }
            if (in_array($route->getName(), $allowRouteList)) {
                $flag = true;
            }
            if (in_array($route->getName(), $blockRouteList)) {
                $flag = false;
            }
            return $flag;
        });

        $routeList = $routes->map(function ($route) {
            return [
                'uri' => $route->uri(),
                'method' => $route->methods()[0] ?? null,
                'name' => $route->getName(),
            ];
        });
        DB::table("skrbac_routes")->insert($routeList->toArray());
        $this->info('Routes stored successfully!');
    }
}
