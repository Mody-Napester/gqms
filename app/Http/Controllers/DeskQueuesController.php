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
    public function storeNewQueue($screen_uuid)
    {
        $screen = Screen::getBy('uuid', $screen_uuid);

        if($screen->screen_type_id == 1){ // Kiosk
            // Do Code
            $resource = DeskQueue::store([
                'floor_id' => $screen->floor_id,
                'queue_number' => (DeskQueue::getDeskQueues($screen->floor_id)->count() + 1) + 100,
                'status' => config('vars.default_kiosk_status'),
            ]);
        }

        // Return
        if ($resource){
            $data['availableDeskQueue'] = DeskQueue::getAvailableDeskQueueView($screen->floor_id);
            event(new QueueStatus($data['availableDeskQueue'], $screen->floor_id));
            return back();
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
        if ($data['nextDeskQueueUpdated']){
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

            $data['deskQueuesSkip'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.queue_status.skipped'));
            $data['deskQueuesDone'] = DeskQueueStatus::getDeskQueues(auth()->user()->id, config('vars.queue_status.done'));

            $data['message'] = [
                'msg_status' => 1,
                'text' => 'Queue was skipped successfully with getting next number',
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
}