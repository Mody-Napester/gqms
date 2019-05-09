<?php

namespace App\Http\Controllers;

use App\Room;
use App\Events\RoomQueueStatus;
use App\Reservation;
use App\RoomQueue;
use Illuminate\Http\Request;

class RoomQueuesController extends Controller
{
    /**
     * Store New Room Queue.
     */
    public function storeNewQueue($reservation_serial, $desk, $deskQueue)
    {
        // 1 - Get Reservation
        $reservation = Reservation::getBy('source_reservation_serial', $reservation_serial);

        $room = $reservation->doctor->user->room;

        $checkRoomQueue = RoomQueue::getBy('queue_number', $reservation->source_queue_number);

        if (!$checkRoomQueue){
            // 2 - Generate And Store Room Queue number
            $roomQueue = RoomQueue::store([
                'floor_id' => $desk->floor_id,
                'room_id' => $room->id,
                'queue_number' => $reservation->source_queue_number,
                'status' => config('vars.room_queue_status.waiting'),
            ]);

            // 3 - Update reservation
            $updatedReservation = $reservation->update([
                'desk_queue_id' => $deskQueue->id,
            ]);

            // 4 - Websockets notification for rooms
            if($updatedReservation) {
                $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($desk->floor_id, $room->id);
                event(new RoomQueueStatus($data['availableRoomQueue'], $desk->floor_id, $room->id));
            }
        }else{
            return false;
        }


    }

    /**
     * Call Next Queue Number.
     */
    public function callNext($room_uuid)
    {
        $data['room'] = Room::getBy('uuid', $room_uuid);

        if(!$data['room']){
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'No room nor doctor exists',
            ];
        }

        $data['nextQueue'] = RoomQueue::getNextRoomQueueTurn($data['room']);

        if($data['nextQueue']){
            // Edit Status
            $data['nextQueueUpdated'] = RoomQueue::edit([
                'status' => config('vars.room_queue_status.called'),
            ], $data['nextQueue']->id);

            $roomQueueStatusDone = RoomQueueStatus::store([
                'user_id' => auth()->user()->id,
                'room_queue_id' => $data['nextQueue']->id,
                'queue_status_id' => config('vars.room_queue_status.called'),
            ]);

            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($data['room']->floor_id);

            $data['waitingTime'] = nice_time($data['nextQueue']->created_at);

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Your next number has come',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Broadcast event
        if (isset($data['nextRoomQueueUpdated'])){
            event(new QueueStatus($data['availableRoomQueue'], $data['room']->floor_id));
            event(new NextRoomQueue($data['room']->uuid, $data['nextQueue']->queue_number));
        }

        // Return
        return $data;
    }

    /**
     * Call Next Queue Number.
     */
    public function callNextQueueNumber($room_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data = $this->callNext($room_uuid);

        // Return
        return response()->json($data);
    }
}
