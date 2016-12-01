<?php

namespace App\Console\Commands;

use App\Services\Administrating\Models\Setting;
use App\Services\Tweeting\Models\Tweet;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Snipe\BanBuilder\CensorWords;
use Thujohn\Twitter\Facades\Twitter;

class GetTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jj:tweets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get tweets matching the search.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $search = Setting::getSetting('twitter_search');
        $since  = cache()->has('jj:tweets') ? cache('jj:tweets') : null;

        $searchResults = Twitter::getSearch([
            'q'        => $search,
            'since_id' => $since,
            'count'    => 100,
        ]);

        $tweets     = $searchResults->statuses;
        $tweetCount = count($tweets);

        if ($tweetCount > 0) {
            $censor = new CensorWords;
            $censor->setDictionary('en-uk');
            $censor->badwords = config('censor.badwords');

            foreach ($tweets as $tweet) {
                if (Tweet::where('twitter_id', $tweet->id)->count() == 0) {
                    $text = $censor->censorString($tweet->text);

                    $patterns = [
                        'url'      => '(?xi)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))',
                        'long_url' => '>(([[:alnum:]]+:\/\/)|www\.)?([^[:space:]]{12,22})([^[:space:]]*)([^[:space:]]{12,22})([[:alnum:]#?\/&=])<',
                    ];

                    $data = [
                        'twitter_id'         => $tweet->id,
                        'text'               => preg_replace('#' . $patterns['url'] . '#', '', $text['clean']),
                        'name'               => $tweet->user->screen_name,
                        'twitter_created_at' => (string)Carbon::parse($tweet->created_at),
                    ];

                    Tweet::create($data);
                }
            }
        }

        $lastId = Tweet::orderBy('twitter_created_at', 'desc')->first()->twitter_id;

        cache()->forever('jj:tweets', $lastId);
    }

    private function emptyTweets()
    {
        $skip   = Setting::getSetting('max_tweets');
        $tweets = Tweet::where('shown_flag', 1)->orderBy('twitter_created_at', 'desc')->skip((int)$skip)->get();

        $tweets->delete();
    }
}
