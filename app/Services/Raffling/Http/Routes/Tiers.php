<?php

namespace App\Services\Raffling\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Tiers extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Raffling\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/raffle/tier';
    }

    public function middleware()
    {
        return [
            'web',
            'auth',
            'acl:access',
        ];
    }

    public function patterns()
    {
        return [
            'id' => '[0-9]+',
        ];
    }

    public function routes(Router $router)
    {
        $router->get('{tierId}/status/{statusId}')
               ->name('raffle.tier.status')
               ->uses('Tier@status');
    }
}
