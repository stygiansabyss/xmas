<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        Broadcast::channel('App.Models.User.*', function ($user, $userId) {
            return (int)$user->id === (int)$userId;
        });

        Broadcast::channel('manage', function (User $user) {
            $administrator = $user->can('administrate');

            return [
                'id'    => $user->id,
                'name'  => $user->display_name,
                'title' => $administrator ? 'JingleJam Administrator' : 'Twitch Streamer',
                'icon'  => $administrator ? 'fa-lock' : 'fa-twitch',
                'color' => $administrator ? 'text-danger' : 'text-twitch',
                'level' => $administrator ? 'admin' : 'streamer',
            ];
        });
    }
}
