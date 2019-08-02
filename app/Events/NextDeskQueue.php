<?php

namespace App\Events;

use App\Desk;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NextDeskQueue implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $desk_uuid;
    public $queue_number;
    public $area_uuid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($desk_uuid, $queue_number)
    {
        $this->desk_uuid = $desk_uuid;
        $this->queue_number = $queue_number;
        $this->area_uuid = Desk::getBy('uuid', $desk_uuid)->area->uuid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('desk-queue-screen-'. $this->area_uuid);
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
            'queue' => $this->queue_number,
            'area' => $this->area_uuid
        ];
    }
}
