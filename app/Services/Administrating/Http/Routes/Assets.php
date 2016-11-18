<?php

namespace App\Services\Administrating\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Assets extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Administrating\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/asset';
    }

    public function middleware()
    {
        return [
            'web',
            //'auth',
            'active:asset'
        ];
    }

    public function patterns()
    {
        return [];
    }

    public function routes(Router $router)
    {
        $router->get('/')
               ->name('administrating.asset')
               ->uses('Assets@index');
    }
}
