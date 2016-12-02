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
            'auth',
            'acl:access',
            'active:asset'
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
        $router->get('{id}/edit')
               ->name('administrating.asset.edit')
               ->uses('Assets@edit');
        $router->post('{id}/edit')
               ->name('administrating.asset.edit')
               ->uses('Assets@update');

        $router->get('/')
               ->name('administrating.asset')
               ->uses('Assets@index');
    }
}
