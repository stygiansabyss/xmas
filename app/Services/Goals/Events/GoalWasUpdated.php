<?php

namespace App\Services\Goals\Events;

use App\Services\Goals\Models\Goal;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GoalWasUpdated implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var \App\Services\Goals\Models\Goal
     */
    public $goal;

    /**
     * Create a new event instance.
     *
     * @param \App\Services\Goals\Models\Goal $goal
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
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('christmas');
    }
}
