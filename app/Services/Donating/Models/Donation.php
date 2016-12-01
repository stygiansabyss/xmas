<?php

namespace App\Services\Donating\Models;

use App\Models\BaseModel;

class Donation extends BaseModel
{
    protected $table = 'donations';

    protected static $observer = \App\Services\Donating\Models\Observers\Donation::class;

    protected $fillable = [
        'hb_id',
        'amount',
        'name',
        'comment',
        'email',
        'read_flag',
        'shown_flag',
        'hb_created_at',
    ];

    protected $dates = [
        'hb_created_at',
    ];

    protected $appends = [
        'sanitized_comment',
        'created_at_readable',
        'created_at_short',
    ];

    public function markRead()
    {
        $this->read_flag = 1;
        $this->save();
    }

    public function markShown()
    {
        $this->shown_flag = 1;
        $this->save();
    }

    public function markNotRead()
    {
        $this->read_flag = 0;
        $this->save();
    }

    public function markNotShown()
    {
        $this->shown_flag = 0;
        $this->save();
    }

    public function getCreatedAtReadableAttribute()
    {
        return $this->hb_created_at->format('F jS, Y \a\t H:ia');
    }

    public function getCreatedAtShortAttribute()
    {
        return $this->hb_created_at->format('Y-m-d h:ia');
    }

    public function getSanitizedCommentAttribute()
    {
        return str_replace([')'], '\)', $this->comment);
    }

    public function getHbCreatedAtAttribute()
    {
        return $this->getDate('hb_created_at');
    }

    public function setHbCreatedAtAttribute($value)
    {
        $this->setDate('hb_created_at', $value);
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'] == null ? 'No name provided' : $this->attributes['name'];
    }

    public function setAmountAttribute($value)
    {
        if (strpos($value, '.') !== false) {
            $this->attributes['amount'] = str_replace('.', '', $value);
        } else {
            $this->attributes['amount'] = $value . '00';
        }
    }

    public function getAmountAttribute()
    {
        return number_format($this->attributes['amount'] / 100, 2);
    }

    public function getAmountRawAttribute()
    {
        return $this->attributes['amount'];
    }

    public function scopeWithComment($query)
    {
        return $query->whereNotNull('comment')->where('comment', '!=', '');
    }

    public function scopeShown($query)
    {
        return $query->where('shown_flag', 1);
    }

    public function scopeRead($query)
    {
        return $query->where('read_flag', 1);
    }

    public static function getDonationsForScroll()
    {
        $donations = static::where('shown_flag', 0)->withComment()->orderBy('hb_created_at', 'asc')->take(2)->get();

        if ($donations->count() == 0) {
            $donations = static::orderBy('hb_created_at', 'desc')->withComment()->take(10)->get();
        }

        $donations->markShown();

        return $donations;
    }
}
