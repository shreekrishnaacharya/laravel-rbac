<?php

namespace Sk\LaravelRbac;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Sk\LaravelRbac\Commands\StoreRoutesCommand;

class SkRbacServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                StoreRoutesCommand::class,
            ]);
        }
        $this->loadViewsFrom(__DIR__ . '/views', 'laravel-rbac');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->publishes([
            __DIR__ . '/config/skrbac.php' => base_path('config/skrbac.php'),
        ], 'skrbac_config');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/laravel-rbac'),
        ], 'skrbac_public');

        $this->publishes([
            __DIR__ . '/views'  => base_path('resources/views/vendor/laravel-rbac'),
        ], 'skrbac_view');

        Route::group(['middleware' => ['web']], function () {
            \Sk\LaravelRbac\SkRbac::routes();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/skrbac.php', 'skrbac-config');

        $this->app->singleton('laravel-rbac', function () {
            return true;
        });
    }
}
