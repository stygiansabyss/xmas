<?php

namespace App\Services\Administrating\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Administrating\Models\Asset;
use App\Services\Administrating\Models\Setting;
use App\Services\Donating\Models\Total;
use App\Services\Goals\Models\Goal;
use App\Services\Incentivizing\Models\Incentive;
use App\Services\Raffling\Models\Raffle;
use App\Services\Voting\Models\Vote;

class Overlay extends BaseController
{
    public function __construct()
    {
        $this->setViewLayout('layouts.overlay');
    }

    public function index()
    {
        $settings = $this->getSettings();

        list($logos, $logoHeight) = $this->getLogos();

        $goal      = $this->getActiveGoal();
        $incentive = $this->getActiveIncentive();
        $raffle    = $this->getActiveRaffle();
        $vote      = $this->getActiveVote();
        $total     = $this->getCurrentTotal();

        $this->setJavascriptData(compact('settings', 'logos', 'logoHeight', 'goal', 'incentive', 'raffle', 'vote', 'total'));

        return $this->view();
    }

    public function right()
    {
        $settings = $this->getSettings();

        $goal  = $this->getActiveGoal();
        $vote  = $this->getActiveVote();
        $total = $this->getCurrentTotal();

        $this->setJavascriptData(compact('settings', 'goal', 'vote', 'total'));

        return $this->view();
    }

    public function vertical()
    {
        $settings = $this->getSettings();

        $goal = $this->getActiveGoal();
        $vote = $this->getActiveVote();

        $this->setJavascriptData(compact('settings', 'goal', 'vote'));

        return $this->view();
    }

    public function bottom()
    {
        $settings = $this->getSettings();

        $incentive = $this->getActiveIncentive();
        $raffle    = $this->getActiveRaffle();
        $vote      = $this->getActiveVote();
        $total     = $this->getCurrentTotal();

        $this->setJavascriptData(compact('settings', 'incentive', 'raffle', 'vote', 'total'));

        return $this->view();
    }

    public function horizontal()
    {
        $settings = $this->getSettings();

        $incentive = $this->getActiveIncentive();
        $raffle    = $this->getActiveRaffle();
        $vote      = $this->getActiveVote();

        $this->setJavascriptData(compact('settings', 'incentive', 'raffle', 'vote'));

        return $this->view();
    }

    public function total()
    {
        $settings = $this->getSettings();
        $total    = $this->getCurrentTotal();

        $this->setJavascriptData(compact('settings', 'total'));

        return $this->view();
    }

    /**
     * @return mixed
     */
    private function getSettings()
    {
        return Setting::pluck('value', 'name')->toArray();
    }

    /**
     * @return mixed|static
     */
    private function getActiveGoal()
    {
        return Goal::active()->first();
    }

    /**
     * @return mixed|static
     */
    private function getActiveIncentive()
    {
        return Incentive::active()->first();
    }

    /**
     * @return mixed|static
     */
    private function getActiveRaffle()
    {
        return Raffle::active()->first();
    }

    /**
     * @return mixed|static
     */
    private function getActiveVote()
    {
        return Vote::active()->first();
    }

    /**
     * @return mixed
     */
    private function getCurrentTotal()
    {
        return Total::orderBy('id', 'desc')->first();
    }

    /**
     * @return mixed
     */
    private function getLogos()
    {
        $assets = Asset::where('charity_flag', 1)->get();
        $count = count($assets);

        return [
            $assets,
            (980 - (20 * $count)) / $count,
        ];
    }
}
