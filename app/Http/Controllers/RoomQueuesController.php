<?php

namespace App\Http\Controllers;

use App\Enums\UserTypes;
use App\Events\NextRoomQueue;
use App\Floor;
use App\Room;
use App\RoomQueueStatus as RoomQueueStatusController;
use App\Events\RoomQueueStatus;
use App\Reservation;
use App\RoomQueue;
use App\User;
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

            // Add to room queue history
            $data['nextRoomQueueUpdated'] = RoomQueueStatusController::store([
                'user_id' => auth()->user()->id,
                'room_queue_id' => $data['nextQueue']->id,
                'queue_status_id' => config('vars.room_queue_status.called'),
            ]);

            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($data['room']->floor_id, $data['room']->id);

            $data['waitingTime'] = nice_time($data['nextQueue']->created_at);

            // Broadcast event to room
            event(new RoomQueueStatus($data['availableRoomQueue'], $data['room']->floor_id, $data['room']->id));

            // Broadcast event to screen
            event(new NextRoomQueue($data['room']->uuid, $data['nextQueue']->queue_number));

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

        $data['roomQueue'] = RoomQueue::getBy('id', $data['nextRoomQueueUpdated']->room_queue_id);

        // Return
        return response()->json($data);
    }

    /**
     * Call Next Queue Number.
     */
    public function callNextQueueNumberAgain($room_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data['room'] = Room::getBy('uuid', $room_uuid);

        $data['nextQueue'] = RoomQueue::where('floor_id', $data['room']->floor_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.room_queue_status.called'))
            ->orWhere('status', config('vars.room_queue_status.call_from_skip'))
            ->first();

        event(new NextRoomQueue($data['room']->uuid, $data['nextQueue']->queue_number));

        $data['message'] = [
            'msg_status' => 1,
            'text' => 'Queue number reminded',
        ];

        // Return
        return response()->json($data);
    }

    /**
     * Skip Queue Number.
     */
    public function skip($room_uuid, $room_queue_uuid)
    {
        $roomQueue = RoomQueue::getBy('uuid', $room_queue_uuid);

        $data['room'] = Room::getBy('uuid', $room_uuid);

        // Edit Status
        RoomQueue::edit([
            'status' => config('vars.room_queue_status.skipped'),
        ], $roomQueue->id);

        // Add to room queue history
        $roomQueueStatusSkip = RoomQueueStatusController::store([
            'user_id' => auth()->user()->id,
            'room_queue_id' => $roomQueue->id,
            'queue_status_id' => config('vars.room_queue_status.skipped'),
        ]);


        if($roomQueueStatusSkip){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Skipped',
            ];

            $data['roomQueuesSkip'] = RoomQueueStatusController::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.skipped'));
            $data['roomQueuesOut'] = RoomQueueStatusController::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.patient_out'));

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return $data;

    }

    /**
     * Skip Queue Number.
     */
    public function skipQueueNumber($room_uuid, $room_queue_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data = $this->skip($room_uuid, $room_queue_uuid);

        if($data['message']['msg_status'] == 1){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Queue number skipped successfully',
            ];

            $data['roomQueue'] = RoomQueue::getBy('uuid', $room_queue_uuid);

            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($data['room']->floor_id, $data['room']->id);

            // Broadcast event
            event(new RoomQueueStatus($data['availableRoomQueue'], $data['room']->floor_id, $data['room']->id));

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return response()->json($data);

    }

    /**
     * Skip And Next Queue Number.
     */
    public function skipAndNextQueueNumber($room_uuid, $room_queue_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $skippedData = $this->skip($room_uuid, $room_queue_uuid);

        if($skippedData['message']['msg_status'] == 1){

            $data = $this->callNext($room_uuid);

            $data['roomQueue'] = RoomQueue::getBy('uuid', $room_queue_uuid);

            if ($data['message']['msg_status'] == 1){
                $data['message'] = [
                    'msg_status' => 1,
                    'text' => 'Queue was skipped successfully with getting next number',
                ];
            }else{
                $data['message'] = [
                    'msg_status' => 1,
                    'text' => 'Queue was skipped successfully with no next number',
                ];
            }

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return response()->json($data);

    }

    /**
     * Patient in.
     */
    public function inQueueNumber($room_uuid, $room_queue_uuid)
    {
        $roomQueue = RoomQueue::getBy('uuid', $room_queue_uuid);

        $data['room'] = Room::getBy('uuid', $room_uuid);

        // Edit Status
        RoomQueue::edit([
            'status' => config('vars.room_queue_status.patient_in'),
        ], $roomQueue->id);

        // Add to room queue history
        $roomQueueStatusSkip = RoomQueueStatusController::store([
            'user_id' => auth()->user()->id,
            'room_queue_id' => $roomQueue->id,
            'queue_status_id' => config('vars.room_queue_status.patient_in'),
        ]);


        if($roomQueueStatusSkip){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Patient now in clinic',
            ];

            $data['roomQueue'] = RoomQueue::getBy('uuid', $room_queue_uuid);

            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($data['room']->floor_id, $data['room']->id);

            // Broadcast event
            event(new RoomQueueStatus($data['availableRoomQueue'], $data['room']->floor_id, $data['room']->id));

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return response()->json($data);

    }

    /**
     * Skip Queue Number.
     */
    public function out($room_uuid, $room_queue_uuid)
    {
        $roomQueue = RoomQueue::getBy('uuid', $room_queue_uuid);

        $data['room'] = Room::getBy('uuid', $room_uuid);

        // Edit Status
        RoomQueue::edit([
            'status' => config('vars.room_queue_status.patient_out'),
        ], $roomQueue->id);

        // Add to room queue history
        $roomQueueStatusSkip = RoomQueueStatusController::store([
            'user_id' => auth()->user()->id,
            'room_queue_id' => $roomQueue->id,
            'queue_status_id' => config('vars.room_queue_status.patient_out'),
        ]);


        if($roomQueueStatusSkip){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Patient out',
            ];

            $data['roomQueuesSkip'] = RoomQueueStatusController::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.skipped'));
            $data['roomQueuesOut'] = RoomQueueStatusController::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.patient_out'));

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return $data;

    }

    /**
     * Skip Queue Number.
     */
    public function outQueueNumber($room_uuid, $room_queue_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data = $this->out($room_uuid, $room_queue_uuid);

        if($data['message']['msg_status'] == 1){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Patient now out of the clinic',
            ];

            $data['roomQueue'] = RoomQueue::getBy('uuid', $room_queue_uuid);

            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($data['room']->floor_id, $data['room']->id);

            // Broadcast event
            event(new RoomQueueStatus($data['availableRoomQueue'], $data['room']->floor_id, $data['room']->id));

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return response()->json($data);

    }

    /**
     * Skip And Next Queue Number.
     */
    public function outAndNextQueueNumber($room_uuid, $room_queue_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $skippedData = $this->out($room_uuid, $room_queue_uuid);

        if($skippedData['message']['msg_status'] == 1){

            $data = $this->callNext($room_uuid);

            $data['roomQueue'] = RoomQueue::getBy('uuid', $room_queue_uuid);

            if ($data['message']['msg_status'] == 1){
                $data['message'] = [
                    'msg_status' => 1,
                    'text' => 'Patient is out successfully with getting next number',
                ];
            }else{
                $data['message'] = [
                    'msg_status' => 1,
                    'text' => 'Patient is out successfully with no next number',
                ];
            }

        }else{
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Some thing error, please try again after few minutes',
            ];
        }

        // Return
        return response()->json($data);

    }

    /**
     * All queue histories.
     */
    public function roomQueueHistory()
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data['rooms'] = Room::all();
        $data['floors'] = Floor::all();
        $data['users'] = User::where('type', UserTypes::$typesReverse['Doctor'])->get();
        $data['statuses'] = \App\QueueStatus::getQueueStatuses('room');
        $data['roomQueues'] = RoomQueue::all();
        return view('rooms.history', $data);

    }
    /**
     * Single queue histories.
     */
    public function roomQueueSingleHistory($queue_uuid) // Ajax
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data['roomQueue'] = RoomQueue::getBy('uuid', $queue_uuid);
        return response([
            'title'=> "All History for queue number " . "(" . $data['roomQueue']->queue_number . ")",
            'view'=> view('rooms._room_queue_history', $data)->render(),
        ]);

    }
}
