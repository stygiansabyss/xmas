<?php

namespace App\Services\Voting\Models;

use App\Models\BaseModel;

class Option extends BaseModel
{
    protected $table = 'vote_options';

    protected $fillable = [
        'vote_id',
        'keyWord',
        'votes',
    ];

    protected $appends = [
        'percent',
        'percent_overlay',
    ];

    public function getPercentAttribute()
    {
        $total  = Option::where('vote_id', $this->vote_id)->sum('votes');
        $amount = $this->votes;

        return percent($amount, $total);
    }

    public function getPercentOverlayAttribute()
    {
        return $this->percent . '% ' . $this->keyWord;
    }

    public function vote()
    {
        return $this->belongsTo(Vote::class, 'vote_id');
    }
}
