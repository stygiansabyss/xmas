<?php

namespace App\Services\Raffling\Events;

use App\Services\Raffling\Models\Raffle;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RaffleEntryAdded implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var \App\Services\Raffling\Models\Raffle
     */
    public $raffle;

    /**
     * Create a new event instance.
     *
     * @param \App\Services\Raffling\Models\Raffle $raffle
     */
    public function __construct(Raffle $raffle)
    {
        $this->raffle = $raffle;
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
