<?php

namespace Heymom\Weidian;

use Heymom\Weidian\Facades\Weidian;
use Illuminate\Support\ServiceProvider;

class WeidianServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('weidian', function ($app) {
            return new Client($app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__ . "/config/weidian.php" => config_path("weidian.php"),
        ]);
    }

    public function provides()
    {
        return ['weidian'];
    }
}
