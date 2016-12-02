<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ritero\SDK\TwitchTV\TwitchSDK;

class TwitchServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TwitchSDK::class, function ($app) {
            return new TwitchSDK(config('services.twitch'));
        });
    }
}
