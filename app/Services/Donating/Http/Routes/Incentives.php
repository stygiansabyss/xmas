<?php

namespace App\Services\Donating\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Incentives extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Donating\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/incentive';
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
               ->name('incentive.create')
               ->uses('Incentives@create');
        $router->post('create')
               ->name('incentive.create')
               ->uses('Incentives@store');

        $router->get('edit/{id}')
               ->name('incentive.edit')
               ->uses('Incentives@edit');
        $router->post('edit/{id}')
               ->name('incentive.edit')
               ->uses('Incentives@update');

        $router->get('reached/{id?}')
               ->name('incentive.reached')
               ->uses('Incentives@reached');

        $router->get('/')
               ->name('incentive.index')
               ->uses('Incentives@index');
    }
}
