<?php

namespace App\Http\Controllers;

use App\Doctor;
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
            if($doctor_id == 0){
                $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($room->floor_id, $room->id);
            }else{
                $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($room->floor_id, $room->id, $doctor_id);
            }
//            event(new RoomQueueStatus($data['availableRoomQueue'], $room->floor_id, $room->id));
            event(new RoomQueueStatus($data['availableRoomQueue'], auth()->user()->doctor->source_doctor_id));
        }

        return true;
    }

    /**
     * Call Next Queue Number.
     */
    public function callNext()
    {
        $data['doctor'] = auth()->user()->doctor;
        $data['room'] = auth()->user()->room;

        if(!$data['room']){
            $data['message'] = [
                'msg_status' => 0,
                'text' => 'Doctor not exists',
            ];
        }

        // Get Next queue number
        $data['nextQueue'] = RoomQueue::getNextRoomQueueTurn($data['doctor']->source_doctor_id);

        if($data['nextQueue']){
            // Edit Status
            RoomQueue::edit([
                'floor_id' => $data['room']->floor->id,
                'room_id' => $data['room']->id,
                'status' => config('vars.room_queue_status.called'),
            ], $data['nextQueue']->id);

            // Add to room queue history
            $data['nextQueueHistory'] = RoomQueueStatusController::store([
                'user_id' => auth()->user()->id,
                'room_queue_id' => $data['nextQueue']->id,
                'queue_status_id' => config('vars.room_queue_status.called'),
            ]);

            // Queue waiting time
            $data['waitingTime'] = nice_time($data['nextQueue']->created_at);

            // Broadcast event to room
            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueViewByDoctor($data['doctor']->source_doctor_id);
            event(new RoomQueueStatus($data['availableRoomQueue'], auth()->user()->doctor->source_doctor_id));

            // Broadcast event to screen
            event(new NextRoomQueue($data['room']->uuid, $data['nextQueue']->queue_number));

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Your next number has come',
            ];
        }else{
            $data['message'] = [
                'msg_status' => 2,
                'text' => 'No patient waiting in queue!',
            ];
        }

        // Return
        return $data;
    }

    /**
     * Call Next Queue Number.
     */
    public function callNextQueueNumber()
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data = $this->callNext();

        if($data['message']['msg_status'] == 2){
            $data['roomQueue'] = null;
        }else{
            $data['roomQueue'] = RoomQueue::getBy('id', $data['nextQueueHistory']->room_queue_id);
        }

        // Return
        return response()->json($data);
    }

    /**
     * Call Next Queue Number.
     */
    public function callNextQueueNumberAgain($room_queue_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data['doctor'] = auth()->user()->doctor;
        $data['room'] = auth()->user()->room;

        $data['currentQueue'] = RoomQueue::getBy('uuid', $room_queue_uuid);

        if($data['currentQueue']){
            // Increment reminder
            RoomQueue::edit([
                'reminder' => $data['currentQueue']->reminder + 1,
            ], $data['currentQueue']->id);
        }

        event(new NextRoomQueue($data['room']->uuid, $data['currentQueue']->queue_number));

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
    public function skip($room_queue_uuid)
    {
        $data['currentQueue'] = RoomQueue::getBy('uuid', $room_queue_uuid);

        // Edit Status
        RoomQueue::edit([
            'status' => config('vars.room_queue_status.skipped'),
        ], $data['currentQueue'] ->id);

        // Add to room queue history
        $data['currentQueueHistory'] = RoomQueueStatusController::store([
            'user_id' => auth()->user()->id,
            'room_queue_id' => $data['currentQueue']->id,
            'queue_status_id' => config('vars.room_queue_status.skipped'),
        ]);

        if($data['currentQueueHistory']){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Queue Skipped Successfully',
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
    public function skipQueueNumber($room_queue_uuid, $fromCode = false)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data = $this->skip($room_queue_uuid);

        if($data['message']['msg_status'] == 1){

            $data['doctor'] = auth()->user()->doctor;
            $data['room'] = auth()->user()->room;

            $data['roomQueue'] = RoomQueue::getBy('uuid', $room_queue_uuid);

            // Broadcast event
            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueViewByDoctor($data['doctor']->source_doctor_id);
            event(new RoomQueueStatus($data['availableRoomQueue'], $data['doctor']->source_doctor_id));

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Queue number skipped successfully',
            ];
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
     * Call Skipped Queue Number.
     */
    public function callSkippedAgain($skipped_queue_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data['doctor'] = auth()->user()->doctor;
        $data['room'] = auth()->user()->room;

        // Get Next queue number
        $data['skippedQueue'] = RoomQueue::getBy('uuid', $skipped_queue_uuid);

        // Edit skipped
        RoomQueue::edit([
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

            // Queue waiting time
            $data['waitingTime'] = nice_time($data['skippedQueue']->created_at);

            $data['roomQueuesSkip'] = RoomQueueStatusController::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.skipped'));
            $data['roomQueuesOut'] = RoomQueueStatusController::getRoomQueues(auth()->user()->id, config('vars.room_queue_status.patient_out'));

            // Broadcast event to room
            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueViewByDoctor($data['doctor']->source_doctor_id);
            event(new RoomQueueStatus($data['availableRoomQueue'], $data['doctor']->source_doctor_id));

            // Broadcast event to screen
            event(new NextRoomQueue($data['room']->uuid, $data['skippedQueue']->queue_number));

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
    public function inQueueNumber($room_queue_uuid)
    {
        $data['doctor'] = auth()->user()->doctor;
        $data['room'] = auth()->user()->room;

        $roomQueue = RoomQueue::getBy('uuid', $room_queue_uuid);

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

            // Broadcast event
            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueViewByDoctor($data['doctor']->source_doctor_id);
            event(new RoomQueueStatus($data['availableRoomQueue'], $data['doctor']->source_doctor_id));

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
    public function out($room_queue_uuid)
    {
        $data['doctor'] = auth()->user()->doctor;
        $data['room'] = auth()->user()->room;

        $roomQueue = RoomQueue::getBy('uuid', $room_queue_uuid);

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
    public function outQueueNumber($room_queue_uuid)
    {
        if (!User::hasAuthority('use.room_queue')){
            return redirect('/');
        }

        $data = $this->out($room_queue_uuid);

        if($data['message']['msg_status'] == 1){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Patient now out of the clinic',
            ];

            $data['roomQueue'] = RoomQueue::getBy('uuid', $room_queue_uuid);


            // Broadcast event
            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueViewByDoctor($data['doctor']->source_doctor_id);
            event(new RoomQueueStatus($data['availableRoomQueue'], $data['doctor']->source_doctor_id));

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
    public function roomQueueHistory(Request $request)
    {
        if (!User::hasAuthority('use.doctor_queue_history')){
            return redirect('/');
        }

        $data['rooms'] = Room::all();
        $data['floors'] = Floor::all();
        $data['doctors'] = Doctor::all();
        $data['users'] = User::where('type', UserTypes::$typesReverse['Doctor'])->get();
        $data['statuses'] = \App\QueueStatus::getQueueStatuses('room');
        $data['roomQueues'] = RoomQueue::orderBy('created_at', 'DESC')->get();

        if (empty($request->all())){
            $data['roomQueues'] = RoomQueue::paginate(20);
        }else{
            $data['roomQueues'] = new RoomQueue();

            $data['roomQueues'] = ($request->has('queue_number') && $request->queue_number != null)? $data['roomQueues']->where('queue_number',$request->queue_number) : $data['roomQueues'];
            $data['roomQueues'] = ($request->has('reservation') && $request->reservation != null)? $data['roomQueues']->where('reservation_source_serial',$request->reservation) : $data['roomQueues'];
            $data['roomQueues'] = ($request->has('floor'))? $data['roomQueues']->where('floor_id',Floor::getBy('uuid', $request->floor)->id ) : $data['roomQueues'];
            $data['roomQueues'] = ($request->has('doctor'))? $data['roomQueues']->where('doctor_id',Doctor::getBy('uuid', $request->doctor)->source_doctor_id ) : $data['roomQueues'];
            $data['roomQueues'] = ($request->has('status'))? $data['roomQueues']->where('status', \App\QueueStatus::where('uuid', $request->status)->first()->id) : $data['roomQueues'];
//            $data['roomQueues'] = ($request->has('date') && $request->date != null)? $data['roomQueues']->where('created_at', 'like', $request->date . '%') : $data['roomQueues'];

            if($request->has('date_from') && $request->date_from != null || $request->has('date_from') && $request->date_from != null){
                $data['roomQueues'] = $data['roomQueues']->whereBetween('created_at', [$request->date_from, $request->date_to]);
            }

            $data['roomQueues'] = $data['roomQueues']->get();
        }

        return view('rooms.history', $data);

    }
    /**
     * Single queue histories.
     */
    public function roomQueueSingleHistory($queue_uuid) // Ajax
    {
        if (!User::hasAuthority('use.doctor_queue_history')){
            return redirect('/');
        }

        $data['roomQueue'] = RoomQueue::getBy('uuid', $queue_uuid);
        return response([
            'title'=> "All History for queue number " . "(" . $data['roomQueue']->queue_number . ")",
            'view'=> view('rooms._room_queue_history', $data)->render(),
        ]);

    }
}
