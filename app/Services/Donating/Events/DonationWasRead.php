<?php

namespace App\Services\Donating\Events;

use App\Services\Donating\Models\Donation;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DonationWasRead implements ShouldBroadcast
{
    use SerializesModels;

    /* @var \App\Services\Donating\Models\Donation */
    public $donation;

    /**
     * Create a new event instance.
     *
     * @param \App\Services\Donating\Models\Donation $donation
     */
    public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('donation_read');
    }
}
