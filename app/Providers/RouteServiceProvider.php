<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Route providers that contain the configuration of a route group.
     *
     * @var array
     */
    protected $providers = [
        \App\Http\Routes\Home::class,
        //\App\Http\Routes\Admin::class,

        \App\Services\Administrating\Http\Routes\Setting::class,
        \App\Services\Administrating\Http\Routes\Assets::class,
        \App\Services\Administrating\Http\Routes\Dashboard::class,
        \App\Services\Administrating\Http\Routes\Overlay::class,

        \App\Services\Donating\Http\Routes\Api::class,
        \App\Services\Donating\Http\Routes\Donations::class,
        \App\Services\Donating\Http\Routes\Goals::class,
        \App\Services\Donating\Http\Routes\Incentives::class,

        \App\Services\Raffling\Http\Routes\Raffles::class,
        \App\Services\Raffling\Http\Routes\Tiers::class,
        \App\Services\Raffling\Http\Routes\Winners::class,

        \App\Services\Voting\Http\Routes\Votes::class,
    ];

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app['router'];

        foreach ($this->providers as $provider) {
            $provider = new $provider;

            $router->patterns($provider->patterns());
        }

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $router = $this->app['router'];

        foreach ($this->providers as $provider) {
            $provider = new $provider;

            $router->group([
                'prefix'     => $provider->prefix(),
                'namespace'  => $provider->namespacing(),
                'middleware' => $provider->middleware(),
            ], function ($router) use ($provider) {
                $provider->routes($router);
            });
        }

        require base_path('vendor/nukacode/users/src/routes/routes.php');
    }
}
