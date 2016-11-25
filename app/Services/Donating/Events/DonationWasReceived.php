<?php

namespace App\Services\Donating\Events;

use App\Services\Donating\Models\Donation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DonationWasReceived implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var  \App\Services\Donating\Models\Donation
     */
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
     * Data to broadcast with.
     *
     * @return mixed
     */
    public function broadcastWith()
    {
        return ['donation' => $this->donation];
    }
    
    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new Channel('channel');
    }
}
