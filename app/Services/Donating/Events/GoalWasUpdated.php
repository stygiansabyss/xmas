<?php

namespace App\Services\Donating\Events;

use App\Services\Donating\Models\Goal;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GoalWasUpdated implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var \App\Services\Donating\Models\Goal
     */
    public $goal;

    /**
     * Create a new event instance.
     *
     * @param \App\Services\Donating\Models\Goal $goal
     */
    public function __construct(Goal $goal)
    {
        $this->goal = $goal;
    }
    
    /**
     * Data to broadcast with.
     *
     * @return mixed
     */
    public function broadcastWith()
    {
        return ['goal' => $this->goal];
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
