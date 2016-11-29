<?php

namespace App\Services\Administrating\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Administrating\Models\Setting;
use App\Services\Administrating\Transformers\Setting as SettingTransformer;
use App\Services\Donating\Models\Donation;
use App\Services\Goals\Models\Goal;
use App\Services\Donating\Models\Incentive;
use App\Services\Donating\Models\Total;
use App\Services\Raffling\Models\Raffle;
use App\Services\Voting\Models\Vote;

class Dashboard extends BaseController
{
    public function __invoke()
    {
        $activeGoal      = Goal::active()->first();
        $activeIncentive = Incentive::active()->first();
        $activeRaffle    = Raffle::active()->first();
        $activeVote      = Vote::active()->first();

        $total        = Total::orderBy('id', 'desc')->first();
        $commentCount = Donation::withComment()->count();
        $shownCount   = Donation::shown()->count();
        $readCount    = Donation::read()->count();

        $settings = SettingTransformer::transform(Setting::all());

        $this->setJavascriptData(compact(
            'activeGoal',
            'activeIncentive',
            'activeRaffle',
            'activeVote',
            'total',
            'commentCount',
            'shownCount',
            'readCount',
            'settings'
        ));

        return $this->view();
    }
}
