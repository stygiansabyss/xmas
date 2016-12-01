<?php

namespace App\Services\Donating\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Api extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Donating\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/api';
    }

    public function middleware()
    {
        return [
            'api',
        ];
    }

    public function patterns()
    {
        return [];
    }

    public function routes(Router $router)
    {
        $router->get('total')
               ->name('api.total')
               ->uses('Api@total');

        $router->get('day-start')
               ->name('api.day-start')
               ->uses('Api@start');

        $router->post('milestone')
               ->name('api.milestone')
               ->uses('Api@milestone');

        $router->post('tweets')
               ->name('api.tweets')
               ->uses('Api@tweets');

        $router->post('donations')
               ->name('api.donations')
               ->uses('Api@donations');
    }
}
