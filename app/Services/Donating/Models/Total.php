<?php

namespace App\Services\Donating\Models;

use App\Services\Donating\Events\TotalWasChanged;
use App\Models\BaseModel;

class Total extends BaseModel
{
    protected $table = 'donation_totals';

    protected $fillable = [
        'raised',
        'reason',
    ];
    
    protected $appends = [
        'raised_raw'
    ];

    public function donationReceived($donation)
    {
        $this->raised = $this->attributes['raised'] + $donation;
        $this->save();

        event(new TotalWasChanged($this));
    }

    public function setRaisedAttribute($value)
    {
        if (strpos($value, '.') !== false) {
            // check if one or 2 digits after period.
            $length = strlen(substr($value, strpos($value, '.') + 1));
            if ($length == 1) {
                $value = $value . '0';
            }

            $this->attributes['raised'] = str_replace(['.', ','], '', $value);
        } else {
            $this->attributes['raised'] = $value . '00';
        }
    }

    public function getRaisedAttribute()
    {
        return number_format($this->attributes['raised'] / 100, 2);
    }

    public function getRaisedRawAttribute()
    {
        return $this->attributes['raised'];
    }
}
