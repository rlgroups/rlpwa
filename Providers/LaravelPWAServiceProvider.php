<?php

namespace RlPWA\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RlPWAServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerIcons();
        $this->registerViews();
        $this->registerServiceworker();
        $this->registerDirective();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('pwa.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'pwa'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/vendor/RlPWA');

        $sourcePath = __DIR__.'/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/vendor/RlPWA';
        }, \Config::get('view.paths')), [$sourcePath]), 'RlPWA');
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerIcons()
    {
        $iconsPath = public_path('images/icons');

        $sourcePath = __DIR__.'/../assets/images/icons';

        $this->publishes([
            $sourcePath => $iconsPath
        ], 'icons');
    }

    /**
     * Register serviceworker.js.
     *
     * @return void
     */
    protected function registerServiceworker()
    {
        $publicPath = public_path();

        $sourcePath = __DIR__.'/../assets/js';

        $this->publishes([
            $sourcePath => $publicPath
        ], 'sw');
    }

    /**
     * Register directive.
     *
     * @return void
     */
    public function registerDirective()
    {
        Blade::directive('pwa', function ($app) {
            return (new \RlPWA\Services\MetaService)->render($app);
        });
    }



    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
