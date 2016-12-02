<?php

namespace App\Services\StreamLabs\Http\Routes;

use Illuminate\Routing\Router;
use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;

class Admin extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\StreamLabs\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/stream-labs/token';
    }

    public function middleware()
    {
        return [
            'web',
            'auth',
            'acl:administrate',
            'active:stream-labs_token',
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
               ->name('stream-labs.token.create')
               ->uses('TokenController@create');
        $router->get('callback')
               ->name('stream-labs.token.callback')
               ->uses('TokenController@store');

        $router->get('{id}/edit')
               ->name('stream-labs.token.edit')
               ->uses('TokenController@edit');
        $router->post('{id}/edit')
               ->name('stream-labs.token.edit')
               ->uses('TokenController@update');

        $router->get('{id}/refresh')
               ->name('stream-labs.token.refresh')
               ->uses('TokenController@refresh');

        $router->delete('{id}/delete')
               ->name('stream-labs.token.delete')
               ->uses('TokenController@delete');

        $router->get('/')
               ->name('stream-labs.token.index')
               ->uses('TokenController@index');
    }
}
