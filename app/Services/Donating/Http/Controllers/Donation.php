<?php

namespace App\Services\Donating\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Services\Donating\Events\DonationWasRead;
use App\Services\Donating\Models\Donation as DonationModel;

class Donation extends BaseController
{
    /**
     * @var \App\Services\Donating\Models\Donation
     */
    private $donations;

    /**
     * Donation constructor.
     *
     * @param \App\Services\Donating\Models\Donation $donations
     */
    public function __construct(DonationModel $donations)
    {
        $this->donations = $donations;

        $this->setViewLayout('layouts.donation');
    }

    public function index()
    {
        $donations = $this->donations->where('read_flag', 0)
                                     ->withComment()
                                     ->where('amount', '>=', '500')
                                     ->orderBy('hb_created_at', 'asc')
                                     ->take(10)
                                     ->get();

        $this->setJavascriptData(compact('donations'));

        return $this->view();
    }

    public function read($id)
    {
        $donation = $this->donations->find($id);
        $donation->markRead();

        event(new DonationWasRead($donation));
    }
}
