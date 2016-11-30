<?php

namespace App\Services\Raffling\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Raffling\Models\Tier as TierModel;

class Tier extends BaseController
{
    /**
     * @var \App\Services\Raffling\Models\Tier
     */
    private $tiers;

    /**
     * Tiers constructor.
     *
     * @param \App\Services\Raffling\Models\Tier $tiers
     */
    public function __construct(TierModel $tiers)
    {
        $this->tiers = $tiers;
    }

    public function status($tierId, $statusId)
    {
        $tier = $this->tiers->find($tierId);
        $tier->update(['status' => $statusId]);

        return response()->json($tier->raffle, 200);
    }
}
