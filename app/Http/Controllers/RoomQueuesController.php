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
use DB;
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

        $doctor = $reservation->doctor;

        if($doctor){
            $room = ($reservation->doctor->user)? $reservation->doctor->user->room : 0;
        }else{
            $room = 0;
        }

//        $checkRoomQueue = RoomQueue::getBy('queue_number', $reservation->source_queue_number);

        $doctor_id = ($doctor)? $doctor->source_doctor_id : '0';

        // 2 - Generate And Store Room Queue number
        $roomQueue = RoomQueue::store([
            'floor_id' => ($room)? $room->floor_id : '0',
            'room_id' => ($room)? $room->id : '0',
            'doctor_id' => $doctor_id,
            'queue_number' => $reservation->source_queue_number,
            'status' => config('vars.room_queue_status.waiting'),
        ]);

        // 3 - Update reservation
        $updatedReservation = $reservation->update([
            'desk_queue_id' => $deskQueue->id,
        ]);

        // 4 - Websockets notification for rooms
        if($updatedReservation && !empty($room)) {
            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($room->floor_id, $room->id);
            event(new RoomQueueStatus($data['availableRoomQueue'], $room->floor_id, $room->id));
        }

        return true;
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

        // Get Current queue number
        $data['currentQueue'] = RoomQueue::getCurrentRoomQueues($data['room']->id);

        // Get Next queue number
        $data['nextQueue'] = RoomQueue::getNextRoomQueueTurn($data['room'], $data['currentQueue']);

        if($data['nextQueue']){
            // Next Queue Edited Status
            if($data['nextQueue']->status == config('vars.room_queue_status.waiting')){
                $status = config('vars.room_queue_status.called');
            }elseif ($data['nextQueue']->status == config('vars.room_queue_status.skipped')){
                $status = config('vars.room_queue_status.call_from_skip');
            }

            // Edit Status
            $data['nextQueueUpdated'] = RoomQueue::edit([
                'status' => $status,
                'call_count' => ($data['nextQueue']->status == config('vars.room_queue_status.skipped'))? DB::raw('call_count + 1') : DB::raw('call_count'),
            ], $data['nextQueue']->id);

            // Add to room queue history
            $data['nextRoomQueueUpdated'] = RoomQueueStatusController::store([
                'user_id' => auth()->user()->id,
                'room_queue_id' => $data['nextQueue']->id,
                'queue_status_id' => $status,
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
            ->where('room_id', $data['room']->id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.room_queue_status.called'))
            ->orWhere('status', config('vars.room_queue_status.call_from_skip'))
            ->first();

        if($data['nextQueue']){
            // Do Code
            $data['nextRoomQueueUpdated'] = RoomQueue::edit([
                'reminder' => 1,
            ], $data['nextQueue']->id);
        }

        event(new NextRoomQueue($data['room']->uuid, $data['nextQueue']->queue_number));

        $data['message'] = [
            'msg_status' => 1,
            'text' => 'Queue number reminded',
        ];

        // Return
        return response()->json($data);
    }


    /**
     * Call Skipped Queue Number.
     */
    public function callSkippedAgain($room_uuid, $queue_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data['skippedQueue'] = RoomQueue::getBy('uuid', $queue_uuid);
        $data['room'] = Room::getBy('uuid', $room_uuid);

        // Get Current queue number
        $data['currentQueue'] = RoomQueue::getCurrentRoomQueues($data['room']->id);

        // Get Next queue number
        $data['nextQueue'] = RoomQueue::getNextRoomQueueTurn($data['room'], $data['currentQueue']);

        // Do Code
        if($data['currentQueue']){
            // Edit current
            RoomQueueStatusController::where('room_queue_id', $data['currentQueue']->id)->delete();

            RoomQueue::edit([
                'room_id' => $data['room']->id,
                'status' => config('vars.room_queue_status.waiting'),
            ], $data['currentQueue']->id);
        }

        // Edit skipped
        RoomQueue::edit([
            'room_id' => $data['room']->id,
            'status' => config('vars.room_queue_status.call_from_skip'),
        ], $data['skippedQueue']->id);

        // Do Code
        $roomQueueStatusSkip = RoomQueueStatusController::store([
            'user_id' => auth()->user()->id,
            'room_queue_id' => $data['skippedQueue']->id,
            'queue_status_id' => config('vars.room_queue_status.call_from_skip'),
        ]);

        if($roomQueueStatusSkip){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Called skipped number',
            ];

            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($data['room']->floor_id, $data['room']->id);
            $data['waitingTime'] = nice_time($data['skippedQueue']->created_at);
            $data['roomQueuesSkip'] = RoomQueueStatusController::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.skipped'));
            $data['roomQueuesOut'] = RoomQueueStatusController::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.patient_out'));

            // Broadcast event to room
            event(new RoomQueueStatus($data['availableRoomQueue'], $data['room']->floor_id, $data['room']->id));

            // Broadcast event to screen
            if($data['nextQueue']){
                event(new NextRoomQueue($data['room']->uuid, $data['nextQueue']->queue_number));
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
    public function skipQueueNumber($room_uuid, $room_queue_uuid, $fromCode = false)
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
        if($fromCode){
            return $data;
        }else{
            return response()->json($data);
        }

    }

    /**
     * Skip And Next Queue Number.
     */
    public function goSkipAndNextQueueNumber($room_uuid, $room_queue_uuid)
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
        return $data;

    }

    /**
     * Skip And Next Queue Number.
     */
    public function skipAndNextQueueNumber($room_uuid, $room_queue_uuid)
    {
        // Check if there is a waiting patient
        $data['desk'] = Room::getBy('uuid', $room_uuid);
        $data['nextQueue'] = DeskQueue::where('floor_id', $data['desk']->floor_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.desk_queue_status.waiting'))
            ->first();

        if($data['nextQueue']){
            $data = $this->goSkipAndNextQueueNumber($room_uuid, $room_queue_uuid);
        }else{
            $data = $this->skipQueueNumber($room_uuid, $room_queue_uuid, true);
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
