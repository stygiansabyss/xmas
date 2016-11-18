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
        return $this->getContext('default') . '/raffle/winners';
    }

    public function middleware()
    {
        return [
            'web',
            'auth',
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
               ->uses('Winners@select');

        $router->post('status/{statusId}/{tierId}/{donationId}')
               ->name('raffle.winners.status')
               ->uses('Winners@status');

        $router->post('deny/{tierId}/{donationId}')
               ->name('raffle.winners.deny')
               ->uses('Winners@deny');

        $router->get('{id}')
               ->name('raffle.winners.show')
               ->uses('Winners@show');
    }
}
