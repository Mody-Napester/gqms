<?php

namespace App\Events;

use App\Room;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NextRoomQueue implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $room_uuid;
    public $queue_number;
    public $area_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($room_uuid, $queue_number)
    {
        $this->room_uuid = $room_uuid;
        $this->area_id = Room::getBy('uuid', $room_uuid)->area->area_id;
        $this->queue_number = $queue_number;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('room-queue-screen');
    }

    /**
     * Custom the payload
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'room' => $this->room_uuid,
            'queue' => $this->queue_number
        ];
    }
}
