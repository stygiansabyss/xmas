<?php

namespace App\Services\Raffling\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Winners extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Raffling\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/raffle/winner';
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
        $router->post('select/{id}')
               ->name('raffle.winners.select')
               ->uses('Winner@select');

        $router->post('status/{statusId}/{tierId}/{donationId}')
               ->name('raffle.winners.status')
               ->uses('Winner@status');

        $router->post('deny/{tierId}/{donationId}')
               ->name('raffle.winners.deny')
               ->uses('Winner@deny');

        $router->get('{id}')
               ->name('raffle.winners.show')
               ->uses('Winner@show');
    }
}
