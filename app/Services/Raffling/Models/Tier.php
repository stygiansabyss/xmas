<?php

namespace App\Services\Raffling\Models;

use App\Models\BaseModel;
use App\Services\Donating\Models\Donation;

class Tier extends BaseModel
{
    const INACTIVE = 0;

    const ACTIVE = 1;

    const FINISHED = 2;

    protected $table = 'raffle_tiers';

    protected $fillable = [
        'raffle_id',
        'status',
        'minimum',
        'reward',
        'level',
    ];

    protected $appends = [
        'entries',
        'simple_amount',
        'winner_count',
        'unshown_winners',
        'email',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE);
    }

    public function scopeFinished($query)
    {
        return $query->where('status', self::FINISHED);
    }

    public function getSimpleAmountAttribute()
    {
        return substr($this->attributes['minimum'], 0, -2);
    }

    public function setMinimumAttribute($value)
    {
        if (strpos($value, '.') !== false) {
            $this->attributes['minimum'] = str_replace('.', '', $value);
        } else {
            $this->attributes['minimum'] = $value . '00';
        }
    }

    public function getMinimumAttribute()
    {
        return number_format($this->attributes['minimum'] / 100, 2);
    }

    public function getUnshownWinnersAttribute()
    {
        return $this->winners()->wherePivot('status', '!=', 2)->get();
    }

    public function getEntriesAttribute()
    {
        return $this->donations->count();
    }

    public function getWinnerCountAttribute()
    {
        return $this->winners->count();
    }

    public function getEmailAttribute()
    {
        return $this->raffleWinner == null ? 'No winner' : $this->raffleWinner->email;
    }

    public function donationReceived($donation)
    {
        if ($donation->amountRaw > $this->attributes['minimum']) {
            $this->donations()->attach($donation->id);
        }
    }

    public function selectWinners($count)
    {
        // Get an array of possible winners and previous winners.
        $possibilities = $this->donations->id->toArray();
        $raffleWinners = $this->raffle->tiers->winners->id->toArray();

        // Previous winners in this raffle are not eligible to win again.
        $possibilities = array_where($possibilities, function ($key, $value) use ($raffleWinners) {
            return ! in_array($value, $raffleWinners);
        });

        // Get the required number of winners.
        $selected = [];

        while (count($selected) < $count) {
            $selected[] = $possibilities[array_rand($possibilities)];
        }

        $donations = $this->donations()->whereIn('id', $selected)->get();
        $this->winners()->attach($donations->id->toArray());
    }

    public function setWinnerStatus($status, $donationId)
    {
        $this->winners()->updateExistingPivot($donationId, ['status' => $status]);
    }

    public function denyWinner($donationId)
    {
        $this->winners()->detach($donationId);
    }

    public function setFinished()
    {
        $this->status = self::FINISHED;
        $this->save();
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function raffle()
    {
        return $this->belongsTo(Raffle::class, 'raffle_id');
    }

    public function donations()
    {
        return $this->belongsToMany(Donation::class, 'raffle_donations', 'raffle_tier_id', 'donation_id');
    }

    public function winners()
    {
        return $this->belongsToMany(Donation::class, 'raffle_winners', 'raffle_tier_id', 'donation_id')->withPivot('status');
    }
}
