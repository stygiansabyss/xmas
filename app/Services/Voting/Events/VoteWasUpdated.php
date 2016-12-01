<?php

namespace App\Services\Voting\Events;

use App\Services\Voting\Models\Vote;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VoteWasUpdated implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var \App\Services\Voting\Models\Vote
     */
    public $vote;

    /**
     * Create a new event instance.
     *
     * @param \App\Services\Voting\Models\Vote $vote
     */
    public function __construct(Vote $vote)
    {
        $this->vote = $vote;
    }

    /**
     * Data to broadcast with.
     *
     * @return mixed
     */
    public function broadcastWith()
    {
        return ['vote' => $this->vote];
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new Channel('christmas');
    }
}
