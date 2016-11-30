<?php

namespace App\Services\StreamLabs\Http\Routes;

use Illuminate\Routing\Router;
use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;

class Alerts extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\StreamLabs\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/stream-labs/alerts';
    }

    public function middleware()
    {
        return [
            'web',
            //'auth',
            'active:stream-labs_alerts',
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
               ->name('stream-labs.alerts.create')
               ->uses('AlertsController@create');
        $router->post('create')
               ->name('stream-labs.alerts.store')
               ->uses('AlertsController@store');

        $router->get('{id}/edit')
               ->name('stream-labs.alerts.edit')
               ->uses('AlertsController@edit');
        $router->post('{id}/edit')
               ->name('stream-labs.alerts.edit')
               ->uses('AlertsController@update');

        $router->delete('{id}/delete')
               ->name('stream-labs.alerts.delete')
               ->uses('AlertsController@delete');

        $router->get('/')
               ->name('stream-labs.alerts.index')
               ->uses('AlertsController@index');
        $router->get('test')
               ->name('stream-labs.alerts.test')
               ->uses('AlertsController@test');
    }
}
