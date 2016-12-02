<?php

namespace App\Services\Authorizing\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Access extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Authorizing\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/access';
    }

    public function middleware()
    {
        return [
            'web',
            'auth',
            'acl:administrate',
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
               ->name('access.create')
               ->uses('Access@create');
        $router->post('create')
               ->name('access.create')
               ->uses('Access@store');

        $router->get('edit/{id}')
               ->name('access.edit')
               ->uses('Access@edit');
        $router->post('edit/{id}')
               ->name('access.edit')
               ->uses('Access@update');

        $router->get('delete/{id}')
               ->name('access.delete')
               ->uses('Access@delete');

        $router->get('/')
               ->name('access.index')
               ->uses('Access@index');
    }
}
