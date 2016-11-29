<?php

namespace App\Services\Goals\Models;

use App\Models\BaseModel;

class Goal extends BaseModel
{
    protected $table = 'donation_goals';

    protected static $observer = \App\Services\Goals\Models\Observers\Goal::class;
    
    protected $fillable = [
        'start_value',
        'goal',
        'reached_at',
    ];

    protected $dates = [
        'reached_at',
    ];

    protected $appends = [
        'percent',
        'duration',
        'reached_at_short',
    ];

    public function getReachedAtAttribute()
    {
        return $this->getDate('reached_at');
    }

    public function setReachedAtAttribute($value)
    {
        $this->setDate('reached_at', $value);
    }

    public function getStartValueAttribute()
    {
        return number_format($this->attributes['start_value'] / 100);
    }

    public function setStartValueAttribute($value)
    {
        if (strpos($value, '.') !== false) {
            $this->attributes['start_value'] = str_replace([',', '.'], '', $value);
        } else {
            $this->attributes['start_value'] = str_replace([',', '.'], '', $value) . '00';
        }
    }

    public function getReachedAtShortAttribute()
    {
        return $this->reached_at == null ? null : $this->reached_at->format('d-m-y');
    }

    public function getGoalAttribute()
    {
        return number_format($this->attributes['goal'] / 100);
    }

    public function setGoalAttribute($value)
    {
        if (strpos($value, '.') !== false) {
            $this->attributes['goal'] = str_replace([',', '.'], '', $value);
        } else {
            $this->attributes['goal'] = str_replace([',', '.'], '', $value) . '00';
        }
    }

    public function scopeActive($query)
    {
        return $query->whereNull('reached_at')->orderBy('goal', 'asc');
    }

    public function getPercentAttribute()
    {
        $total       = $this->attributes['goal'] - $this->attributes['start_value'];
        $totalRaised = Total::orderBy('id', 'desc')->first();

        if ($totalRaised == null) {
            return 0;
        }

        $raised = $totalRaised->raisedRaw - $this->attributes['start_value'];

        $percent = percent($raised, $total);

        if ($percent > 100) {
            $percent = 100;
        } elseif ($percent < 0) {
            $percent = 0;
        }

        return $percent;
    }

    public function getDurationAttribute()
    {
        if ($this->reached_at == null) {
            $previousGoal = self::where('goal', $this->start_value)->first();

            if ($previousGoal == null) {
                return carbonParse('now')->diffForHumans(carbonParse($this->created_at), true);
            }

            if ($previousGoal->reached_at == null) {
                return '&nbsp;';
            }

            return carbonParse('now')->diffForHumans(carbonParse($previousGoal->reached_at), true);
        }

        return carbonParse($this->reached_at)->diffForHumans(carbonParse($this->created_at), true);
    }

    public function reached()
    {
        $this->reached_at = carbonParse('now');
        $this->save();
    }
}
