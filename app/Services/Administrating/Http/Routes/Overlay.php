<?php

namespace App\Services\Administrating\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Overlay extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Administrating\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/overlay';
    }

    public function middleware()
    {
        return [
            'web',
        ];
    }

    public function patterns()
    {
        return [];
    }

    public function routes(Router $router)
    {
        $router->get('total')
               ->name('administrating.overlay.total')
               ->uses('Overlay@total');

        $router->get('vertical')
               ->name('administrating.overlay.vertical')
               ->uses('Overlay@vertical');

        $router->get('horizontal')
               ->name('administrating.overlay.horizontal')
               ->uses('Overlay@horizontal');

        $router->get('bottom')
               ->name('administrating.overlay.bottom')
               ->uses('Overlay@bottom');

        $router->get('right')
               ->name('administrating.overlay.right')
               ->uses('Overlay@right');

        $router->get('/')
               ->name('administrating.overlay')
               ->uses('Overlay@index');
    }
}
