<?php

namespace App\Services\Donating\Events;

use App\Services\Donating\Models\Incentive;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class IncentiveWasUpdated implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var \App\Services\Donating\Models\Incentive
     */
    public $incentive;

    /**
     * Create a new event instance.
     *
     * @param \App\Services\Donating\Models\Incentive $incentive
     */
    public function __construct(Incentive $incentive)
    {
        $this->incentive = $incentive;
    }
    
    /**
     * Data to broadcast with.
     *
     * @return mixed
     */
    public function broadcastWith()
    {
        return ['incentive' => $this->incentive];
    }
    
    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['christmas'];
    }
}
