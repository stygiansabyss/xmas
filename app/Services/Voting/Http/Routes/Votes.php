<?php

namespace App\Services\Voting\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Votes extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Voting\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/vote';
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
               ->name('vote.create')
               ->uses('Votes@create');
        $router->post('create')
               ->name('vote.create')
               ->uses('Votes@store');

        $router->get('edit/{id}')
               ->name('vote.edit')
               ->uses('Votes@edit');
        $router->post('edit/{id}')
               ->name('vote.edit')
               ->uses('Votes@update');

        $router->get('{voteId}/status/{statusId}')
               ->name('vote.status')
               ->uses('Votes@status');

        $router->get('{voteId}/acceptance/{statusId}')
               ->name('vote.acceptance')
               ->uses('Votes@acceptance');

        $router->get('/')
               ->name('vote.index')
               ->uses('Votes@index');
    }
}
