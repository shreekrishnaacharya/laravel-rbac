<?php

namespace Skacharya\LaravelRbac;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Skacharya\LaravelRbac\Controllers\AccessController;
use Skacharya\LaravelRbac\Controllers\RoleController;
use Skacharya\LaravelRbac\Middlewares\RbacFilter;

class SkRbac
{
    const PACKAGE_NAME = 'laravel-rbac';
    const DS = '/';

    protected $config;
    protected $request;

    public function __construct(Config $config = null, Request $request = null)
    {
        $this->config = $config;
        $this->request = $request;
    }


    public function config($key)
    {
        return $this->config->get('skrbac.' . $key);
    }

    /**
     * Generates routes of this package.
     *
     * @return void
     */
    public static function routes()
    {
        Route::group(['prefix' => 'skrbac', 'as' => 'skrbac.'], function () {
            Route::get('home', [RoleController::class, 'home'])->name("home");
            Route::get('users', [RoleController::class, 'users'])->name("users");
            Route::get('roles', [RoleController::class, 'index'])->name("roles.index");
            Route::post('roles', [RoleController::class, 'store'])->name("roles.store");
            Route::get('roles/{role}', [RoleController::class, 'show'])->name("roles.show");
            Route::put('roles/{role}', [RoleController::class, 'update'])->name("roles.update");
            // Route::patch('roles/{role}', [RoleController::class, 'update'])->name("roles.update");
            Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name("roles.delete");
            Route::get('access', [AccessController::class, 'index'])->name("access.index");
            Route::post('access', [AccessController::class, 'store'])->name("access.store");
            Route::get('access/{role}', [AccessController::class, 'withRole'])->name("access.show");
            Route::delete('access/{role_access}', [AccessController::class, 'destroy'])->name("access.delete");
        });
    }
}
