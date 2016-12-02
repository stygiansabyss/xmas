<?php

namespace App\Services\Authorizing\Listeners;

use App\Services\Authorizing\Models\Access;
use Illuminate\Support\Str;
use NukaCode\Users\Events\UserLoggedIn;
use Zarlach\TwitchApi\Services\TwitchApiService;

class DetermineAccess
{
    /**
     * @var \Zarlach\TwitchApi\Services\TwitchApiService
     */
    private $twitch;

    /**
     * @param \Zarlach\TwitchApi\Services\TwitchApiService $twitch
     */
    public function __construct(TwitchApiService $twitch)
    {
        $this->twitch = $twitch;
    }

    /**
     * Entry point to handle updating a user's subscription status.
     *
     * @param \NukaCode\Users\Events\UserLoggedIn $event
     *
     * @return array
     */
    public function handle(UserLoggedIn $event)
    {
        $accessLevel = Access::where('email', $event->user->email)->first();

        if ($accessLevel !== null) {
            return $event->user->roles()->sync([$accessLevel->role_id]);
        }

        if (Str::contains($event->user->email, ['yogscast.com', 'hat-films.com'])) {
            $event->user->roles()->sync([2]);
        }
    }
}
