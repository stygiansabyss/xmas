<?php

return [
    'apiLink' => env('HUMBLE_BUNDLE_API'),
    'pubNubLink' => env('HUMBLE_BUNDLE_PUB_NUB'),
    'settings'   => [
        'scroll_mode'    => [
            'twitter'   => 'Twitter Feed',
            'donations' => 'Donations Feed',
            'incentive' => 'Donation Incentive',
            'raffle'    => 'Donation Raffle',
            'vote'      => 'Vote Options',
            'text'      => 'Text',
        ],
        'scroll_speed'   => [
            0   => 'No Scroll',
            25  => 'Slowest',
            50  => 'Slow',
            100 => 'Medium',
            150 => 'Fast',
            200 => 'Fastest',
        ],
        'goal_mode'      => [
            'goal'  => 'Show goal',
            'vote'  => 'Show vote',
            'logos' => 'Show logos',
        ],
        'max_tweets'     => [
            //
        ],
        'twitter_search' => [
            //
        ],
        'total_display'  => [
            'Hide',
            'Show',
        ],
    ],
];
