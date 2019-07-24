<?php

namespace App\Http\Controllers;

use App\DeskQueue;
use App\DeskQueueStatus;
use App\Reservation;
use App\RoomQueue;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];

        if (empty($request->all())){
            $data['reservations']['total'] = Reservation::where('created_at', 'like', "%".date('Y-m-d')."%")->count();
            $data['reservations']['done'] = Reservation::where('created_at', 'like', "%".date('Y-m-d')."%")->where('desk_queue_id', '<>', '')->count();
            $data['reservations']['waiting'] = $data['reservations']['total'] - $data['reservations']['done'];

            $data['desk']['total']      = DeskQueue::where('created_at', 'like', "%".date('Y-m-d')."%")->count();
            $data['desk']['waiting']    = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.waiting'));
            $data['desk']['called']     = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.called'));
            $data['desk']['skipped']    = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.skipped'));
            $data['desk']['done']       = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.done'));

            $data['room']['total']      = RoomQueue::where('created_at', 'like', "%".date('Y-m-d')."%")->count();
            $data['room']['waiting']    = RoomQueue::getCountRoomQueues(config('vars.room_queue_status.waiting'));
            $data['room']['called']     = RoomQueue::getCountRoomQueues(config('vars.room_queue_status.called'));
            $data['room']['skipped']    = RoomQueue::getCountRoomQueues(config('vars.room_queue_status.skipped'));
            $data['room']['done']       = RoomQueue::getCountRoomQueues(config('vars.room_queue_status.done'));
        }else{

            $data['reservations']['total'] = Reservation::whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $data['reservations']['done'] = Reservation::whereBetween('created_at', [$request->date_from, $request->date_to])->where('desk_queue_id', '<>', '')->count();
            $data['reservations']['waiting'] = $data['reservations']['total'] - $data['reservations']['done'];

            $data['desk']['total']      = DeskQueue::whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $data['desk']['waiting']    = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.waiting'), null, $request->date_from, $request->date_to);
            $data['desk']['called']     = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.called'), null, $request->date_from, $request->date_to);
            $data['desk']['skipped']    = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.skipped'), null, $request->date_from, $request->date_to);
            $data['desk']['done']       = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.done'), null, $request->date_from, $request->date_to);

            $data['room']['total']      = RoomQueue::whereBetween('created_at', [$request->date_from, $request->date_to])->count();
            $data['room']['waiting']    = RoomQueue::getCountRoomQueues(config('vars.room_queue_status.waiting'), null, $request->date_from, $request->date_to);
            $data['room']['called']     = RoomQueue::getCountRoomQueues(config('vars.room_queue_status.called'), null, $request->date_from, $request->date_to);
            $data['room']['skipped']    = RoomQueue::getCountRoomQueues(config('vars.room_queue_status.skipped'), null, $request->date_from, $request->date_to);
            $data['room']['done']       = RoomQueue::getCountRoomQueues(config('vars.room_queue_status.done'), null, $request->date_from, $request->date_to);
        }

        $data['loggedInUsers'] = User::where('login_ip', '<>', '')->get();

        return view('dashboard.index', $data);
    }
}
