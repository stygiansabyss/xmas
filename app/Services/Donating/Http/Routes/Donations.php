<?php

namespace App\Services\Donating\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Donations extends BaseRoutes implements Routes
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
        $router->get('read/{id}')
               ->name('donation.read')
               ->uses('Donations@read');

        $router->post('search')
               ->name('donation.search')
               ->uses('Donations@search');

        $router->get('edit')
               ->name('donation.edit')
               ->uses('Donations@edit');
        $router->post('edit')
               ->name('donation.edit')
               ->uses('Donations@update');

        $router->get('/')
               ->name('donation.index')
               ->uses('Donations@index');
    }
}
