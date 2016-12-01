<?php

namespace App\Services\Donating\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DonationsWereReset implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Data to broadcast with.
     *
     * @return mixed
     */
    public function broadcastWith()
    {
        return [];
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new Channel('donation_read');
    }
}
