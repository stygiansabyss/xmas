<?php

namespace App\Services\Tweeting\Http\Routes;

use NukaCode\Core\Contracts\Routes;
use NukaCode\Core\Providers\Routes as BaseRoutes;
use Illuminate\Routing\Router;

class Tweets extends BaseRoutes implements Routes
{
    public function namespacing()
    {
        return 'App\Services\Tweeting\Http\Controllers';
    }

    public function prefix()
    {
        return $this->getContext('default') . '/tweet';
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
        $router->get('overlay')
               ->name('tweet.overlay')
               ->uses('Tweet@overlay');
    }
}
