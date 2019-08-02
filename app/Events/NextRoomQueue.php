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
    public $area_uuid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($room_uuid, $queue_number)
    {
        $this->room_uuid = $room_uuid;
        $this->queue_number = $queue_number;

        // Get Area by screen
        $screen = Room::getBy('uuid', $room_uuid)->screens()->where('area_id', '<>', '')->first();

        $this->area_uuid = ($screen->area)? $screen->area->uuid : 0;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('room-queue-screen-'. $this->area_uuid);
//        return new Channel('room-queue-screen');
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
            'queue' => $this->queue_number,
            'area' => $this->area_uuid
        ];
    }
}
