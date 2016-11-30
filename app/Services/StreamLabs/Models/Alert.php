<?php

namespace App\Services\StreamLabs\Models;


use App\Models\BaseModel;
use App\Services\Donating\Models\Donation;

class Alert extends BaseModel
{
    public $table = 'stream_labs_alerts';
    
    protected $fillable = [
        'name',
        'sound_href',
        'image_href',
        'minimum_amount',
        'exact_flag',
        'template',
    ];
    
    public function setMinimumAmountAttribute($value)
    {
        if (strpos($value, '.') !== false) {
            $this->attributes['minimum_amount'] = str_replace('.', '', $value);
        } else {
            $this->attributes['minimum_amount'] = $value . '00';
        }
    }
    
    public function getMinimumAmountAttribute()
    {
        return number_format($this->attributes['minimum_amount'] / 100, 2);
    }
    
    public function getMinimumAmountRawAttribute()
    {
        return $this->attributes['minimum_amount'];
    }
    
    public static function getByAmount($amount)
    {
        $alert = self::where('exact_flag', true)->where('minimum_amount', $amount)->first();
        
        if (is_null($alert)) {
            $alert = self::where('minimum_amount', '<=', $amount)->where('exact_flag', false)->orderBy('minimum_amount', 'desc')->get();
        }
        
        return $alert->count() ? $alert->first() : new self;
    }
    
    public static function getByDonation(Donation $donation)
    {
        return self::getByAmount($donation->amount_raw);
    }
}
