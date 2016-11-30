<?php

namespace App\Services\Raffling\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Raffling\Models\Raffle;
use App\Services\Raffling\Models\Tier;

class Winner extends BaseController
{
    /**
     * @var \App\Services\Raffling\Models\Raffle
     */
    private $raffles;

    /**
     * @var \App\Services\Raffling\Models\Tier
     */
    private $tiers;

    /**
     * Winners constructor.
     *
     * @param \App\Services\Raffling\Models\Raffle $raffles
     * @param \App\Services\Raffling\Models\Tier   $tiers
     */
    public function __construct(Raffle $raffles, Tier $tiers)
    {
        $this->raffles = $raffles;
        $this->tiers   = $tiers;
    }

    public function show($id)
    {
        $raffle  = $this->raffles->find($id);
        $winners = $raffle->tiers->id;

        $this->setJavascriptData(compact('raffle', 'winners'));

        return $this->view();
    }

    public function select($id)
    {
        $tier  = $this->tiers->find($id);
        $count = request('count');

        $tier->selectWinners($count);

        $tier = $this->tiers->find($id);

        return response()->json($tier->raffle);
    }

    public function status($statusId, $tierId, $donationId)
    {
        $tier = $this->tiers->find($tierId);
        $tier->setWinnerStatus($statusId, $donationId);

        return response()->json($tier->raffle);
    }

    public function deny($tierId, $donationId)
    {
        $tier = $this->tiers->find($tierId);
        $tier->denyWinner($donationId);

        return response()->json($tier->raffle);
    }
}
