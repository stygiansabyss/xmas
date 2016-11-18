<?php

namespace App\Services\Donating\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Goals extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Donating\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/goal';
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
               ->name('goal.create')
               ->uses('Goals@create');
        $router->post('create')
               ->name('goal.create')
               ->uses('Goals@store');

        $router->get('edit/{id}')
               ->name('goal.edit')
               ->uses('Goals@edit');
        $router->post('edit/{id}')
               ->name('goal.edit')
               ->uses('Goals@update');

        $router->get('reached/{id?}')
               ->name('goal.reached')
               ->uses('Goals@reached');

        $router->get('/')
               ->name('goal.index')
               ->uses('Goals@index');
    }
}
