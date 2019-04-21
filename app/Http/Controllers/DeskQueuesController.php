<?php

namespace App\Http\Controllers;

use App\Desk;
use App\DeskQueue;
use App\DeskQueueStatus;
use App\Events\NextDeskQueue;
use App\Events\QueueStatus;
use App\Floor;
use App\Screen;
use App\User;
use Validator;
use Illuminate\Http\Request;

class DeskQueuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!User::hasAuthority('index.desks')){
            return redirect('/');
        }
        $data['desks'] = Desk::all();
        $data['floors'] = Floor::all();
        return view('desks.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string $screen_uuid
     * @return \Illuminate\Http\Response
     */
    public function storeNewQueue($screen_uuid, $floor_uuid)
    {
        $screen = Screen::getBy('uuid', $screen_uuid);

        $floor_id = Floor::getBy('uuid', $floor_uuid)->id;

        if($screen->screen_type_id == config('vars.screen_types.kiosk')){ // Kiosk
            // Do Code
            $resource = DeskQueue::store([
                'floor_id' => $floor_id,
                'queue_number' => deskQueueNumberFormat($floor_id, 100),
                'status' => config('vars.default_kiosk_status'),
            ]);
        }

        // Return
        if ($resource){
//            try{
//                \EPSON::deskPrint([
//                    'queue_number' => $resource->queue_number,
//                    'screen_ip' => $screen->ip
//                ]);
//            }catch (\Exception $e){
//                $data['res'] = [
//                    $e->getFile(), $e->getMessage(), $e->getLine()
//                ];
//            }

            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($floor_id);
            $data['queue_number'] = $resource->queue_number;

            event(new QueueStatus($data['availableDeskQueue'], $floor_id));

            return response($data);
        }
    }
    
    /**
     * Call Next Queue Number.
     */
    public function callNext($desk_uuid)
    {
        $data['desk'] = Desk::getBy('uuid', $desk_uuid);
        $data['nextQueue'] = DeskQueue::where('floor_id', $data['desk']->floor_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.queue_status.waiting'))
            ->first();

        if($data['nextQueue']){
            // Do Code
            $data['nextDeskQueueUpdated'] = DeskQueue::edit([
                'desk_id' => $data['desk']->id,
                'status' => config('vars.queue_status.called'),
            ], $data['nextQueue']->id);

            $deskQueueStatusDone = DeskQueueStatus::store([
                'user_id' => auth()->user()->id,
                'desk_queue_id' => $data['nextQueue']->id,
                'queue_status_id' => config('vars.queue_status.called'),
            ]);

            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($data['desk']->floor_id);

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
        if (isset($data['nextDeskQueueUpdated'])){
            event(new QueueStatus($data['availableDeskQueue'], $data['desk']->floor_id));
            event(new NextDeskQueue($data['desk']->uuid, $data['nextQueue']->queue_number));
        }

        // Return
        return $data;
    }

    /**
     * Call Next Queue Number.
     */
    public function callNextQueueNumber($desk_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data = $this->callNext($desk_uuid);

        // Return
        return response()->json($data);
    }

    /**
     * Call Next Queue Number.
     */
    public function callNextQueueNumberAgain($desk_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data['desk'] = Desk::getBy('uuid', $desk_uuid);
        $data['nextQueue'] = DeskQueue::where('floor_id', $data['desk']->floor_id)
            ->where('created_at', 'like', "%".date('Y-m-d')."%")
            ->where('status', config('vars.queue_status.called'))
            ->first();

        event(new NextDeskQueue($data['desk']->uuid, $data['nextQueue']->queue_number));

        $data['message'] = [
            'msg_status' => 1,
            'text' => 'Next number called again',
        ];

        // Return
        return response()->json($data);
    }

    /**
     * Call Skipped Queue Number.
     */
    public function callSkippedAgain($desk_uuid, $queue_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data['skippedQueue'] = DeskQueue::getBy('uuid', $queue_uuid);
        $data['desk'] = Desk::getBy('uuid', $desk_uuid);

        $data['currentQueue'] = DeskQueue::getCurrentDeskQueues($data['desk']->id);

        // Do Code
        // Edit current
        DeskQueue::edit([
            'desk_id' => $data['desk']->id,
            'status' => config('vars.queue_status.done'),
        ], $data['currentQueue']->id);

        // Edit skipped
        DeskQueue::edit([
            'desk_id' => $data['desk']->id,
            'status' => config('vars.queue_status.cell_from_skip'),
        ], $data['skippedQueue']->id);

        // Do Code
        $deskQueueStatusSkip = DeskQueueStatus::store([
            'user_id' => auth()->user()->id,
            'desk_queue_id' => $data['skippedQueue']->id,
            'queue_status_id' => config('vars.queue_status.cell_from_skip'),
        ]);

        if($deskQueueStatusSkip){

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Called skipped number',
            ];

            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($data['desk']->floor_id);
            $data['waitingTime'] = nice_time($data['skippedQueue']->created_at);
            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.queue_status.done'));

            // Broadcast event
            event(new QueueStatus($data['availableDeskQueue'], $data['desk']->floor_id));
            event(new NextDeskQueue($data['desk']->uuid, $data['skippedQueue']->queue_number));

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
    public function skipQueueNumber($desk_uuid, $desk_queue_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $deskQueue = DeskQueue::getBy('uuid', $desk_queue_uuid);

        // Do Code
        DeskQueue::edit([
            'desk_id' => Desk::getBy('uuid', $desk_uuid)->id,
            'status' => config('vars.queue_status.skipped'),
        ], $deskQueue->id);

        // Do Code
        $deskQueueStatusSkip = DeskQueueStatus::store([
            'user_id' => auth()->user()->id,
            'desk_queue_id' => $deskQueue->id,
            'queue_status_id' => config('vars.queue_status.skipped'),
        ]);

        if($deskQueueStatusSkip){
            $data = $this->callNext($desk_uuid);

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

            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.queue_status.done'));

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
     * Done Queue Number.
     */
    public function doneQueueNumber($desk_uuid, $desk_queue_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $deskQueue = DeskQueue::getBy('uuid', $desk_queue_uuid);

        // Do Code
        DeskQueue::edit([
            'desk_id' => Desk::getBy('uuid', $desk_uuid)->id,
            'status' => config('vars.queue_status.done'),
        ], $deskQueue->id);

        // Do Code
        $deskQueueStatusDone = DeskQueueStatus::store([
            'user_id' => auth()->user()->id,
            'desk_queue_id' => $deskQueue->id,
            'queue_status_id' => config('vars.queue_status.done'),
        ]);

        if($deskQueueStatusDone){
            $data = $this->callNext($desk_uuid);

            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.queue_status.done'));

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Queue was done successfully with getting next number',
            ];
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
    public function deskQueueHistory()
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data['desks'] = Desk::all();
        $data['deskQueues'] = DeskQueue::all();
        return view('desks.history', $data);

    }
    /**
     * Single queue histories.
     */
    public function deskQueueSingleHistory($queue_uuid)
    {
        if (!User::hasAuthority('use.desk_queue')){
            return redirect('/');
        }

        $data['deskQueue'] = DeskQueue::getBy('uuid', $queue_uuid);
        return response([
            'title'=> "All History for queue number " . "(" . $data['deskQueue']->queue_number . ")",
            'view'=> view('desks._desk_queue_history', $data)->render(),
        ]);

    }
}
