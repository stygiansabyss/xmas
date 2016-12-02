<?php

namespace App\Services\Donating\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Search extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Donating\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/donation';
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
        $router->get('search')
               ->name('donation.search')
               ->uses('Search@search');

        $router->any('find')
               ->name('donation.find')
               ->uses('Search@find');

        $router->post('edit/{id}')
               ->name('donation.edit')
               ->uses('Search@update');

        $router->post('edit')
               ->name('donation.edit.all')
               ->uses('Search@updateAll');
    }
}
