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
        $lang = 'en';
        $desk = Desk::getBy('uuid', $this->desk_uuid);
//        $text = "عميل رقم {$this->queue_number}{$desk->name_en} - شباك رقم ";
        $text = "agent number {$this->queue_number} - desk number {$desk->name_en}";
        $textEncoded = htmlspecialchars(rawurlencode($text));
        return [
            'desk' => $this->desk_uuid,
            'queue' => $this->queue_number,
            'area' => $this->area_uuid,
            'desk_name' => $desk->name_en,
//            'ttsULR' => "https://translate.google.com/translate_tts?tl={$lang}&q={$textEncoded}&client=tw-ob"
//            'ttsULR' => "https://translate.google.com/translate_tts?tl={$lang}&q=ahmed&client=tw-ob"
        ];
    }
}
