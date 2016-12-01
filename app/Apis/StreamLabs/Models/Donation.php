<?php

namespace App\Apis\StreamLabs\Models;

use Carbon\Carbon;
use Jenssegers\Model\Model;

/**
 * Class Token
 *
 * @property integer        $donation_id
 * @property string         $currency
 * @property string         $amount
 * @property string         $name
 * @property string         $email
 * @property string         $message
 *
 * @property \Carbon\Carbon $created_at
 */
class Donation extends Model
{
    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::createFromTimestamp($value);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = intval(floatval($value) * 100);
    }
}
