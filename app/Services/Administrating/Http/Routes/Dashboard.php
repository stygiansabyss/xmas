<?php

namespace App\Services\Administrating\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Dashboard extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Administrating\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/manage';
    }

    public function middleware()
    {
        return [
            'web',
            //'auth',
            'active:manage'
        ];
    }

    public function patterns()
    {
        return [];
    }

    public function routes(Router $router)
    {
        $router->get('/')
               ->name('administrating.dashboard')
               ->uses('Dashboard');
    }
}
