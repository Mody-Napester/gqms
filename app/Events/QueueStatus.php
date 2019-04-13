<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QueueStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $availableDeskQueue;
    public $floor_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($availableDeskQueue, $floor_id)
    {
        $this->availableDeskQueue = $availableDeskQueue;
        $this->floor_id = $floor_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('available-desk-queue-' . $this->floor_id);
    }

    /**
     * Custom the payload
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'view' => $this->availableDeskQueue
        ];
    }
}
