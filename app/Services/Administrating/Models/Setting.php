<?php

namespace App\Services\Administrating\Models;

use App\Models\BaseModel;

class Setting extends BaseModel
{
    protected $table = 'settings';

    protected static $observer = \App\Services\Administrating\Models\Observers\Setting::class;

    protected $fillable = [
        'name',
        'label',
        'value',
        'type',
    ];

    public static function getSetting($keyName)
    {
        $setting = static::where('name', $keyName)->first();

        if (is_null($setting)) {
            return null;
        }

        return $setting->value;
    }
}
