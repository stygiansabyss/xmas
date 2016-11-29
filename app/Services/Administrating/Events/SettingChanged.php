<?php

namespace App\Services\Administrating\Events;

use App\Services\Administrating\Models\Setting;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SettingChanged implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var \App\Services\Administrating\Models\Setting
     */
    public $setting;

    /**
     * Create a new event instance.
     *
     * @param \App\Services\Administrating\Models\Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
    
    /**
     * Data to broadcast with.
     *
     * @return mixed
     */
    public function broadcastWith()
    {
        return ['setting' => $this->setting];
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
