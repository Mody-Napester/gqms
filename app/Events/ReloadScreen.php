<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReloadScreen implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $screen_uuid;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($screen_uuid)
    {
        $this->screen_uuid = $screen_uuid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('reload-screen-'.$this->screen_uuid);
    }

}
