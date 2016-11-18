<?php

namespace App\Services\Administrating\Transformers;

use App\Services\Administrating\Models\Setting as SettingModel;

class Setting
{
    public static function transform($settings)
    {
        return $settings->map(function (SettingModel $setting) {
            return (object)[
                'id'      => $setting->id,
                'type'    => $setting->type,
                'label'   => $setting->label,
                'name'    => $setting->name,
                'value'   => $setting->value,
                'options' => config('jinglejam.settings.' . $setting->name),
            ];
        });
    }
}
