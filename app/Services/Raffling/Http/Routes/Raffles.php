<?php

namespace App\Services\Raffling\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Raffles extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Raffling\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/raffle';
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
        $router->get('create')
               ->name('raffle.create')
               ->uses('Raffles@create');
        $router->post('create')
               ->name('raffle.create')
               ->uses('Raffles@store');

        $router->get('edit/{id}')
               ->name('raffle.edit')
               ->uses('Raffles@edit');
        $router->post('edit/{id}')
               ->name('raffle.edit')
               ->uses('Raffles@update');

        $router->get('winner/{id}')
               ->name('raffle.winner')
               ->uses('Raffles@winner');

        $router->get('preview/{id}')
               ->name('raffle.preview')
               ->uses('Raffles@preview');

        $router->get('approve/{id}')
               ->name('raffle.approve')
               ->uses('Raffles@approve');

        $router->get('watch/{id}')
               ->name('raffle.watch')
               ->uses('Raffles@watch');

        $router->get('finished/{id}')
               ->name('raffle.finished')
               ->uses('Raffles@finished');

        $router->get('{raffleId}/status/{statusId}')
               ->name('raffle.status')
               ->uses('Raffles@status');

        $router->get('/')
               ->name('raffle.index')
               ->uses('Raffles@index');
    }
}
