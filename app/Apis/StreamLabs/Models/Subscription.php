<?php

namespace App\Apis\StreamLabs\Models;

use Carbon\Carbon;
use Jenssegers\Model\Model;

/**
 * Class Token
 *
 * @property string         $name
 * @property string         $months
 * @property string         $message
 * @property string         $emotes
 *
 * @property \Carbon\Carbon $created_at
 */
class Subscription extends Model
{
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value . ' UTC');
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = intval(floatval($value) * 100);
    }
}
