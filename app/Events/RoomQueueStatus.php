<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RoomQueueStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $availableRoomQueue;
    public $doctor_source_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($availableRoomQueue, $doctor_source_id)
    {
        $this->availableRoomQueue = $availableRoomQueue;
        $this->doctor_source_id = $doctor_source_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('available-room-queue-' . $this->doctor_source_id);
    }

    /**
     * Custom the payload
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'view' => $this->availableRoomQueue
        ];
    }
}
