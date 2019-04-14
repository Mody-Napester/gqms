<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DeskStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $desk_uuid;
    public $available;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($desk_uuid, $available)
    {
        $this->desk_uuid = $desk_uuid;
        $this->available = $available;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('desk-queue-screen');
    }

    /**
     * Custom the payload
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'desk' => $this->desk_uuid,
            'available' => $this->available
        ];
    }
}
