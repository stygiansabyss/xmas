<?php

namespace App\Services\Voting\Models;

use App\Models\BaseModel;

class Vote extends BaseModel
{
    const INACTIVE = 0;

    const ACTIVE = 1;

    const FINISHED = 2;

    protected $table = 'votes';

    protected $fillable = [
        'name',
        'accepting_flag',
        'status',
    ];

    protected $with = [
        'options',
    ];

    protected $appends = [
        'options_readable',
    ];

    public static function generate($request)
    {
        $name    = $request->get('name');
        $options = $request->get('options');

        $vote = static::create(['name' => $name]);

        foreach ($options as $option) {
            $data = [
                'vote_id' => $vote->id,
                'keyWord' => $option['keyWord'],
            ];

            Option::create($data);
        }

        return $vote;
    }

    public function updateOptions($options)
    {
        foreach ($options as $optionId => $option) {
            $optionData = [
                'vote_id' => $this->id,
                'keyWord' => $option['keyWord'],
            ];

            $option = Option::find($optionId);
            $option->update($optionData);
        }
    }

    public function createOptions($options)
    {
        foreach ($options as $option) {
            $optionData = [
                'vote_id' => $this->id,
                'keyWord' => $option['keyWord'],
            ];

            Option::create($optionData);
        }
    }

    public function donationReceived($donation)
    {
        $expression = str_replace('#', '\#', implode('|', $this->options->keyWord->toArray()));
        preg_match("/($expression)/i", $donation->comment, $matches);

        if (count($matches) > 0) {
            $option = $this->options()->where('keyWord', $matches[0])->first();
            $option->increment('votes');
        }
    }

    public function setFinished()
    {
        $this->status = self::FINISHED;
        $this->save();
    }

    public function setAccepting($status)
    {
        $this->accepting_flag = $status;
        $this->save();
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function scopeAccepting($query)
    {
        return $query->where('accepting_flag', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }

    public function scopeFinished($query)
    {
        return $query->where('status', self::FINISHED);
    }

    public function getOptionsReadableAttribute()
    {
        return humanReadableImplode($this->options->keyWord->toArray(), 'or');
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'vote_id');
    }
}
