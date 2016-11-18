<?php

namespace App\Services\Tweeting\Models;

use App\Models\BaseModel;

class Tweet extends BaseModel
{
    protected $table = 'tweets';

    protected $fillable = [
        'twitter_id',
        'text',
        'name',
        'twitter_created_at'
    ];

    protected $dates = [
        'twitter_created_at'
    ];

    public function getTwitterCreatedAtAttribute()
    {
        return $this->getDate('twitter_created_at');
    }

    public function setTwitterCreatedAtAttribute($value)
    {
        $this->setDate('twitter_created_at', $value);
    }

    public static function getTweetsForScroll()
    {
        $tweets = static::where('shown_flag', 0)->orderBy('twitter_created_at', 'asc')->take(5)->get();

        if ($tweets->count() == 0) {
            $tweets = static::orderBy('twitter_created_at', 'desc')->take(10)->get();
        }

        $tweets->markShown();

        return $tweets;
    }

    public function markShown()
    {
        $this->shown_flag = 1;
        $this->save();
    }
}
