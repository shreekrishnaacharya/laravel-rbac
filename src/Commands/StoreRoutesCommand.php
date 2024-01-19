<?php

namespace Skacharya\LaravelRbac\Commands;

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
