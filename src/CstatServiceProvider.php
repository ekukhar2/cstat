<?php

namespace Eugen\Cstat;

use Illuminate\Support\ServiceProvider;

class CstatServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Language
        $this->loadTranslationsFrom( __DIR__.'/Lang', 'cstat');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->publishes([__DIR__.'/Config/cstat.php' => config_path('cstat.php'),], 'config');
        $this->publishes([__DIR__.'/migrations/' =>database_path('migrations')], 'migrations');
        $this->publishes([__DIR__.'/seeds/' =>database_path('seeds')], 'seeds');
        $this->publishes([__DIR__.'/Middleware/' =>base_path('App/Http/Middleware')]);
        $this->publishes([__DIR__.'/assets/' =>public_path('vendor/cstat')]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/Config/cstat.php', 'cstat');
        // View
        $this->loadViewsFrom(__DIR__ . '/Views', 'cstat');
        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');
        $this->app['cstat'] = $this->app->share(function($app) {
            return new Cstat;
        });
    }
}
