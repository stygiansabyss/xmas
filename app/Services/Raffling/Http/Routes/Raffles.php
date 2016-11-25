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
            //'auth',
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
               ->uses('Raffle@create');
        $router->post('create')
               ->name('raffle.create')
               ->uses('Raffle@store');

        $router->get('edit/{id}')
               ->name('raffle.edit')
               ->uses('Raffle@edit');
        $router->post('edit/{id}')
               ->name('raffle.edit')
               ->uses('Raffle@update');

        $router->get('winner/{id}')
               ->name('raffle.winner')
               ->uses('Raffle@winner');

        $router->get('preview/{id}')
               ->name('raffle.preview')
               ->uses('Raffle@preview');

        $router->post('approve/{id}')
               ->name('raffle.approve')
               ->uses('Raffle@approve');

        $router->get('watch/{id}')
               ->name('raffle.watch')
               ->uses('Raffle@watch');

        $router->get('finished/{id}')
               ->name('raffle.finished')
               ->uses('Raffle@finished');

        $router->get('{raffleId}/status/{statusId}')
               ->name('raffle.status')
               ->uses('Raffle@status');

        $router->get('/')
               ->name('raffle.index')
               ->uses('Raffle@index');
    }
}
