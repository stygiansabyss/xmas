<?php

namespace App\Services\Raffling\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Raffling\Events\RaffleApproved;
use App\Services\Raffling\Events\RaffleEntryAdded;
use App\Services\Raffling\Models\Raffle as RaffleModel;
use App\Services\Raffling\Models\Tier;

class Raffle extends BaseController
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
     * Raffle constructor.
     *
     * @param \App\Services\Raffling\Models\Raffle $raffles
     * @param \App\Services\Raffling\Models\Tier   $tiers
     */
    public function __construct(RaffleModel $raffles, Tier $tiers)
    {
        $this->raffles = $raffles;
        $this->tiers   = $tiers;
    }

    public function index()
    {
        $raffles = $this->raffles->orderBy('created_at', 'desc')->paginate(25);

        $this->setViewData(compact('raffles'));

        return $this->view();
    }

    public function create()
    {
        $this->setJavascriptData('csrfToken', csrf_token());

        return $this->view();
    }

    public function store()
    {
        ppd(request()->all());
        $raffle = $this->raffles->generate(request());

        event(new RaffleEntryAdded($raffle));

        return redirect(route('administrating.dashboard'))
            ->with('message', 'New raffle created');
    }

    public function edit($id)
    {
        $raffle = $this->raffles->find($id);

        $this->setViewData(compact('raffle'));

        return $this->view();
    }

    public function update($id)
    {
        $raffle = $this->raffles->find($id);

        $raffle->update(['name' => request('name')]);
        $raffle->updateTiers(request('tiers'));
        $raffle->createTiers(request('new_tiers'));

        return redirect(route('administrating.dashboard'))
            ->with('message', 'Raffle updated');
    }

    public function preview($id)
    {
        $tiers = $this->raffles->find($id)->tiers()->whereHas('winners', function ($query) {
            $query->where('status', 1);
        })->get();

        $this->setViewData(compact('tiers'));

        $this->setViewLayout('layouts.dark');
    }

    public function approve($id)
    {
        $tiers = $this->raffles->find($id)->tiers()->whereHas('winners', function ($query) {
            $query->where('status', 1);
        })->get();

        event(new RaffleApproved($tiers));

        return redirect(route('raffle.winners', [$id]))->with('message', 'Raffle approved for view.');
    }
}
