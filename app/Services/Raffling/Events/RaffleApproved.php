<?php

namespace App\Services\Raffling\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RaffleApproved implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var
     */
    public $tiers;

    /**
     * Create a new event instance.
     *
     * @param $tiers
     */
    public function __construct($tiers)
    {
        $this->tiers = $tiers;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('christmas');
    }
}