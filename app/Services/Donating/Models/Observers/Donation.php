<?php

namespace App\Services\Donating\Models\Observers;

use App\Services\Donating\Models\Incentive;
use App\Services\Raffling\Models\Tier;
use App\Services\Voting\Models\Vote;

class Donation
{
    public function created($model)
    {
        $activeIncentive = Incentive::active()->first();

        if ($activeIncentive != null) {
            $activeIncentive->donationReceived();
        }

        $activeTiers = Tier::active()->get();

        if ($activeTiers != null) {
            foreach ($activeTiers as $activeTiers) {
                $activeTiers->donationReceived($model);
            }
        }

        $activeVotes = Vote::accepting()->get();

        if ($activeVotes != null) {
            foreach ($activeVotes as $activeVote) {
                $activeVote->donationReceived($model);
            }
        }
    }
}