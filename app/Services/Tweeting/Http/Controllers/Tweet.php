<?php

namespace App\Services\Tweeting\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Tweeting\Models\Tweet as TweetModel;

class Tweet extends BaseController
{
    /**
     * @var \App\Services\Tweeting\Models\Tweet
     */
    private $tweets;

    /**
     * Tweet constructor.
     *
     * @param \App\Services\Tweeting\Models\Tweet $tweets
     */
    public function __construct(TweetModel $tweets)
    {
        $this->tweets = $tweets;
    }

    public function overlay()
    {
        if (cache()->has('tweet:show:call')) {
            $tweets = cache('tweet:show:call');
        } else {
            $tweets = $this->tweets->getTweetsForScroll();

            cache('tweet:show:call', $tweets, .5);
        }

        return response()->json($tweets);
    }
}
