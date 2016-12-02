<?php

namespace App\Services\Incentivizing\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Incentives extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Incentivizing\Http\Controllers';
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
        $router->get('create')
               ->name('incentive.create')
               ->uses('Incentive@create');
        $router->post('create')
               ->name('incentive.create')
               ->uses('Incentive@store');

        $router->get('edit/{id}')
               ->name('incentive.edit')
               ->uses('Incentive@edit');
        $router->post('edit/{id}')
               ->name('incentive.edit')
               ->uses('Incentive@update');

        $router->get('reached/{id?}')
               ->name('incentive.reached')
               ->uses('Incentive@reached');

        $router->get('overlay')
               ->name('incentive.overlay')
               ->uses('Incentive@overlay');

        $router->get('/')
               ->name('incentive.index')
               ->uses('Incentive@index');
    }
}
