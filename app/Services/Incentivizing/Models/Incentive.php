<?php

namespace App\Services\Incentivizing\Models;

use App\Models\BaseModel;

class Incentive extends BaseModel
{
    protected $table = 'donation_incentives';

    protected $fillable = [
        'target',
        'count',
        'reward',
        'reached_at',
    ];

    protected $appends = [
        'percent',
        'duration',
        'reached_at_short',
    ];

    protected $dates = [
        'reached_at',
    ];

    public function getReachedAtAttribute()
    {
        return $this->getDate('reached_at');
    }

    public function setReachedAtAttribute($value)
    {
        $this->setDate('reached_at', $value);
    }

    public function getReachedAtShortAttribute()
    {
        return $this->reached_at == null ? null : $this->reached_at->format('d-m-y');
    }

    public function getTargetAttribute()
    {
        return number_format($this->attributes['target']);
    }

    public function setTargetAttribute($value)
    {
        $this->attributes['target'] = str_replace(',', '', $value);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('reached_at')->orderBy('target', 'asc');
    }

    public function getPercentAttribute()
    {
        return percent($this->count, $this->target);
    }

    public function getDurationAttribute()
    {
        return carbonParse($this->reached_at)->diffForHumans(carbonParse($this->created_at), true);
    }

    public function reached()
    {
        $this->reached_at = carbonParse('now');
        return $this->save();
    }

    public function donationReceived()
    {
        $this->increment('count');
        $this->save();

        if ($this->count == $this->target) {
            $this->reached();
        }
    }
}
