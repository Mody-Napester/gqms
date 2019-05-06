<?php

namespace App\Http\Controllers;

use App\Desk;
use App\Events\RoomQueueStatus;
use App\Reservation;
use App\Room;
use App\RoomQueue;
use Illuminate\Http\Request;

class RoomQueuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store New Room Queue.
     */
    public function storeNewQueue($reservation_serial, $room, $desk, $deskQueue)
    {
        // 1 - Get Reservation
        $reservation = Reservation::getBy('source_reservation_serial', $reservation_serial);

        // 2 - Generate And Store Room Queue number
        $roomQueue = RoomQueue::store([
            'floor_id' => $desk->floor_id,
            'room_id' => $room->id,
            'queue_number' => roomQueueNumberFormat($desk->floor_id, $room->id,100),
            'status' => config('vars.room_queue_status.waiting'),
        ]);

        // 3 - Update reservation
        $updatedReservation = $reservation->update([
            'room_id' => $room->id,
            'desk_queue_id' => $deskQueue->id,
            'room_queue_id' => $roomQueue->id,
        ]);

        // 4 - Websockets notification for rooms
        if($updatedReservation) {
            $data['availableRoomQueue'] = RoomQueue::getAvailableRoomQueueView($desk->floor_id, $room->id);
            event(new RoomQueueStatus($data['availableRoomQueue'], $desk->floor_id, $room->id));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
