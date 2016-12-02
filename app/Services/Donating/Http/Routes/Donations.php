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
        $router->group(['middleware' => ['auth', 'acl:access']], function () use ($router) {
            $router->get('read/{id}')
                   ->name('donation.read')
                   ->uses('Donation@read');
            
            $router->get('read/all')
                   ->name('donation.read.all')
                   ->uses('Donation@readAll');
            
            $router->get('/')
                   ->name('donation.index')
                   ->uses('Donation@index');
        });
        
        $router->get('overlay')
               ->name('donation.overlay')
               ->uses('Donation@overlay');
    }
}
