<?php

namespace App\Services\Administrating\Models\Observers;

use App\Services\Administrating\Events\SettingChanged;

class Setting
{
    public function saved($model)
    {
        event(new SettingChanged($model));
    }
}
