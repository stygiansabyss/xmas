<?php

return [
    'twitch'      => [
        'client_id'     => env('TWITCH_KEY'),
        'client_secret' => env('TWITCH_SECRET'),
        'redirect'      => env('TWITCH_REDIRECT_URI'),
        'scope'         => config('users.providers.0.scopes'),
    ],
    'stream-labs' => [
        'access_token'  => env('STREAM_LABS_TOKEN'),
        'client_id'     => env('STREAM_LABS_KEY'),
        'client_secret' => env('STREAM_LABS_SECRET'),
        'redirect'      => env('STREAM_LABS_REDIRECT_URI'),
        'alert_channel' => env('STREAM_LABS_ALERT_CHANNEL'),
    ],
];
