<?php

namespace App\Http\Controllers;

use App\Desk;
use App\DeskQueue;
use App\Doctor;
use App\Floor;
use App\Reservation;
use App\Room;
use App\RoomQueue;
use App\User;
use DB;
use Illuminate\Http\Request;

class QueuesController extends Controller
{
    /**
     * All queue histories.
     */
    public function queuesHistory(Request $request)
    {
//        dd($request->all());
        if (!User::hasAuthority('use.all_queue_history')){
            return redirect('/');
        }

        $data['desks'] = Desk::all();
        $data['doctors'] = Doctor::getAll();
        $data['floors'] = Floor::all();
        $data['rooms'] = Room::all();
        $data['users'] = User::all();
        $data['statuses'] = \App\QueueStatus::getQueueStatuses('desk');

        if (empty($request->all()) || (count($request->all()) == 1 && $request->has('page'))){
            $data['search'] = 0;
//            $data['deskQueues'] = DeskQueue::paginate(20);
             $data['deskQueues'] = [];
        }else{

            $data['search'] = 1;
            $data['deskQueues'] = new DeskQueue();
//            $data['deskQueues'] = DB::table('desk_queues');

            if($request->has('doctor')){
                $data['doctor_id'] = ($request->has('doctor')) ? Doctor::getBy('uuid', $request->doctor)->source_doctor_id : null;

                $data['deskQueues'] = $data['deskQueues']
                    ->join('reservations', 'desk_queues.id', '=', 'reservations.desk_queue_id')
                    ->join('room_queues', 'room_queues.id', '=', 'reservations.desk_queue_id')
                    ->where('room_queues.doctor_id', $data['doctor_id']);
            }

            if($request->has('room')){
                $data['room_id'] = ($request->has('room')) ? Room::getBy('uuid', $request->room)->id : null;

                $data['deskQueues'] = $data['deskQueues']
                    ->join('reservations', 'desk_queues.id', '=', 'reservations.desk_queue_id')
                    ->join('room_queues', 'room_queues.id', '=', 'reservations.desk_queue_id')
                    ->where('room_queues.room_id', $data['room_id']);
            }

            if($request->has('reservation') && !is_null($request->reservation)){
                $searchReservation = Reservation::getBy('source_reservation_serial', $request->reservation);
                $data['deskQueues'] = $data['deskQueues']->where('id', $searchReservation->desk_queue_id);
            }

            if($request->has('desk')){
                $data['deskQueues'] = $data['deskQueues']->where('desk_id', Desk::getBy('uuid', $request->desk)->id);
            }

            if($request->has('date_from') && $request->has('date_to') && !is_null($request->date_from) && !is_null($request->date_to)){
                $data['deskQueues'] = $data['deskQueues']->whereBetween('created_at', [$request->date_from, $request->date_to]);
            }

//            if($request->has('doctor') || $request->has('room') || $request->has('reservation')){
//                $data['doctor_id']      = ($request->has('doctor')) ? Doctor::getBy('uuid', $request->doctor)->id : null;
//                $data['room_id']        = ($request->has('room')) ? Room::getBy('uuid', $request->room)->id : null;
//                $data['reservation_serial'] = ($request->has('reservation')) ? $request->reservation : null;
//
//                $searchReservation = Reservation::getBy('source_reservation_serial', $data['reservation_serial']);
//
//                $data['deskQueues'] = $data['deskQueues']->where('desk_id', Desk::getBy('uuid', $request->desk)->id);
//            }

//            if($data['doctor'] == null && $data['room'] == null && $data['reservation'] == null){
//                $data['search'] = 1;
//            }

            $data['deskQueues'] = $data['deskQueues']->paginate(10);
        }

        // Store User Action Log
//        storeLogUserAction(\App\Enums\LogUserActions::$name['IndexQueueHistory'], 'Get',route('queues.queuesHistory'));
//        dd($data);
//        $data['queuesListsView'] = view('queues._list', $data);
//        dd($request->all());

//        return $data['deskQueues'];
        return view('queues.history', $data);

    }

    /**
     * All queue histories.
     */
    public function allQueuesHistory(Request $request)
    {
        if (!User::hasAuthority('use.all_queue_history')){
            return redirect('/');
        }

        $data['desks'] = Desk::all();
        $data['doctors'] = Doctor::getAll();
        $data['floors'] = Floor::all();
        $data['rooms'] = Room::all();
        $data['users'] = User::all();
        $data['statuses'] = \App\QueueStatus::getQueueStatuses('desk');

        $data['histories'] = DeskQueue::rightJoin('reservations', 'desk_queues.id', '=', 'reservations.desk_queue_id')
            ->join('room_queues', 'room_queues.reservation_source_serial', '=', 'reservations.source_reservation_serial')
            ->select('desk_queues.id as dq_id','desk_queues.desk_id','desk_queues.created_at as d_created_at','desk_queues.queue_number as desk_qn','desk_queues.status as d_status','desk_queues.uuid as d_uuid',
                'reservations.source_reservation_serial','reservations.source_queue_number','reservations.patientid','reservations.reservation_date_time','reservations.doctor_id as res_doctor_id',
                'room_queues.id as rq_id', 'room_queues.room_id','room_queues.created_at as r_created_at','room_queues.queue_number as room_qn','room_queues.doctor_id as r_doctor_id');

        if($request->has('date_from') && $request->has('date_to') && $request->date_from != '' && $request->date_to != ''){
            $data['histories'] = $data['histories']->whereBetween('desk_queues.created_at', [$request->date_from, $request->date_to]);
        }
        if($request->has('reservation') && $request->reservation != ''){
            $data['histories'] = $data['histories']->where('reservations.source_reservation_serial', $request->reservation);
        }
        if($request->has('doctor') && $request->doctor != '' && $request->doctor != 'Choose'){
            $data['histories'] = $data['histories']->where('reservations.doctor_id', $request->doctor);
        }
        if($request->has('desk') && $request->desk != '' && $request->desk != 'Choose'){
            $data['histories'] = $data['histories']->where('desk_queues.desk_id', $request->desk);
        }
        if($request->has('room') && $request->room != '' && $request->room != 'Choose'){
            $data['histories'] = $data['histories']->where('room_queues.room_id', $request->room);
        }

        $data['histories'] = $data['histories']->orderBy('reservations.id', 'DESC')->paginate(30);

        return view('all_queue_history.history', $data);

    }

    /**
     * Single queue histories.
     */
    public function queuesSingleHistory($queue_uuid) // Ajax
    {
        if (!User::hasAuthority('use.all_queue_history')){
            return redirect('/');
        }

        $data['deskQueue'] = DeskQueue::getBy('uuid', $queue_uuid);

        return response([
            'title'=> "All History for queue number " . "(" . $data['deskQueue']->queue_number . ' / ' .(($data['deskQueue']->reservation) ? $data['deskQueue']->reservation->source_queue_number : '-') . ")",
            'view'=> view('queues._queues_history', $data)->render(),
        ]);

    }
}
