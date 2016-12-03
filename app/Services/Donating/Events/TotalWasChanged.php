<?php

namespace App\Services\Donating\Events;

use App\Services\Donating\Models\Donation;
use App\Services\Donating\Models\Total;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TotalWasChanged implements ShouldBroadcast
{
    use SerializesModels;
    
    /**
     * @var \App\Services\Donating\Models\Total
     */
    public $total;
    
    public $commentCount;
    
    public $shownCount;
    
    public $readCount;
    
    /**
     * Create a new event instance.
     *
     * @param \App\Services\Donating\Models\Total $total
     */
    public function __construct(Total $total)
    {
        $this->total        = $total->append('raised_raw');
        $this->commentCount = Donation::withComment()->count();
        $this->shownCount   = Donation::shown()->count();
        $this->readCount    = Donation::read()->count();
    }
    
    /**
     * Data to broadcast with.
     *
     * @return mixed
     */
    public function broadcastWith()
    {
        return [
            'total'        => $this->total,
            'commentCount' => $this->commentCount,
            'shownCount'   => $this->shownCount,
            'readCount'    => $this->readCount,
        ];
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
