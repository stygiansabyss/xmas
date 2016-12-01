<?php

namespace App\Services\Administrating\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Administrating\Events\SettingChanged;
use App\Services\Administrating\Models\Setting as SettingModel;

class Setting extends BaseController
{
    /**
     * @var \App\Services\Administrating\Models\Setting
     */
    private $settings;

    /**
     * Setting constructor.
     *
     * @param \App\Services\Administrating\Models\Setting $settings
     */
    public function __construct(SettingModel $settings)
    {
        $this->settings = $settings;
    }

    public function update()
    {
        foreach (request('settings') as $id => $value) {
            if ($id === 0) {
                continue;
            }

            try {
                $setting = $this->settings->find($id);
                $setting->update(['value' => $value]);

                event(new SettingChanged($setting));
            } catch (\Exception $exception) {
                return response()->json($exception->getMessage(), 500);
            }
        }

        return response()->json('Settings updated.', 200);
    }
}
