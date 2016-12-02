<?php

namespace App\Services\Administrating\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Setting extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Administrating\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/setting';
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
        return [];
    }

    public function routes(Router $router)
    {
        $router->any('edit')
               ->name('setting.edit')
               ->uses('Setting@update');
    }
}
