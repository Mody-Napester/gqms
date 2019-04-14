<?php

namespace App\Http\Controllers;

use App\DeskQueue;
use App\DeskQueueStatus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['today_total'] = DeskQueue::where('created_at', 'like', "%".date('Y-m-d')."%")->count();
        $data['today_waiting'] = DeskQueue::getCountDeskQueues(config('vars.queue_status.waiting'));
        $data['today_called'] = DeskQueueStatus::getCountDeskQueue(config('vars.queue_status.called'));
        $data['today_skipped'] = DeskQueueStatus::getCountDeskQueue(config('vars.queue_status.skipped'));
        $data['today_done'] = DeskQueueStatus::getCountDeskQueue(config('vars.queue_status.done'));

        $data['total_total'] = DeskQueue::count();
        $data['total_waiting'] = DeskQueue::getCountDeskQueues(config('vars.queue_status.waiting'), 1);
        $data['total_called'] = DeskQueueStatus::getCountDeskQueue(config('vars.queue_status.called'), 1);
        $data['total_skipped'] = DeskQueueStatus::getCountDeskQueue(config('vars.queue_status.skipped'), 1);
        $data['total_done'] = DeskQueueStatus::getCountDeskQueue(config('vars.queue_status.done'), 1);

        $data['today_total_is'] = ($data['today_total'] == 0)? 0 : 1;
        $data['total_total_is'] = ($data['total_total'] == 0)? 0 : 1;

        $data['today_total'] = ($data['today_total'] == 0)? 1 : $data['today_total'];
        $data['total_total'] = ($data['total_total'] == 0)? 1 : $data['total_total'];

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
