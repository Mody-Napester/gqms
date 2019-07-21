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
            
        }else{

        }

        $data['reservations']['total'] = Reservation::where('created_at', 'like', "%".date('Y-m-d')."%")->count();
        $data['reservations']['done'] = Reservation::where('created_at', 'like', "%".date('Y-m-d')."%")->where('desk_queue_id', '<>', '')->count();
        $data['reservations']['waiting'] = $data['reservations']['total'] - $data['reservations']['done'];

        $data['desk']['total']      = DeskQueue::where('created_at', 'like', "%".date('Y-m-d')."%")->count();
        $data['desk']['waiting']    = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.waiting'));
        $data['desk']['called']     = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.called'));
        $data['desk']['skipped']    = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.skipped'));
        $data['desk']['done']       = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.done'));

        $data['room']['total']      = RoomQueue::where('created_at', 'like', "%".date('Y-m-d')."%")->count();
        $data['room']['waiting']    = RoomQueue::getCountDeskQueues(config('vars.room_queue_status.waiting'));
        $data['room']['called']     = RoomQueue::getCountDeskQueues(config('vars.room_queue_status.called'));
        $data['room']['skipped']    = RoomQueue::getCountDeskQueues(config('vars.room_queue_status.skipped'));
        $data['room']['done']       = RoomQueue::getCountDeskQueues(config('vars.room_queue_status.done'));

//        $data['today_total'] = DeskQueue::where('created_at', 'like', "%".date('Y-m-d')."%")->count();
//        $data['today_waiting'] = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.waiting'));
//        $data['today_called'] = DeskQueueStatus::getCountDeskQueue(config('vars.desk_queue_status.called'));
//        $data['today_skipped'] = DeskQueueStatus::getCountDeskQueue(config('vars.desk_queue_status.skipped'));
//        $data['today_done'] = DeskQueueStatus::getCountDeskQueue(config('vars.desk_queue_status.done'));
//
//        $data['total_total'] = DeskQueue::count();
//        $data['total_waiting'] = DeskQueue::getCountDeskQueues(config('vars.desk_queue_status.waiting'), 1);
//        $data['total_called'] = DeskQueueStatus::getCountDeskQueue(config('vars.desk_queue_status.called'), 1);
//        $data['total_skipped'] = DeskQueueStatus::getCountDeskQueue(config('vars.desk_queue_status.skipped'), 1);
//        $data['total_done'] = DeskQueueStatus::getCountDeskQueue(config('vars.desk_queue_status.done'), 1);
//
//        $data['today_total_is'] = ($data['today_total'] == 0)? 0 : 1;
//        $data['total_total_is'] = ($data['total_total'] == 0)? 0 : 1;
//
//        $data['today_total'] = ($data['today_total'] == 0)? 1 : $data['today_total'];
//        $data['total_total'] = ($data['total_total'] == 0)? 1 : $data['total_total'];

        $data['loggedInUsers'] = User::where('login_ip', '<>', '')->get();

        return view('dashboard.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
