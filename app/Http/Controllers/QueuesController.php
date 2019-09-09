<?php

namespace App\Http\Controllers;

use App\Desk;
use App\DeskQueue;
use App\Doctor;
use App\Floor;
use App\Room;
use App\User;
use Illuminate\Http\Request;

class QueuesController extends Controller
{
    /**
     * All queue histories.
     */
    public function queuesHistory(Request $request)
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

        if (empty($request->all()) || (count($request->all()) == 1 && $request->has('page'))){
            $data['search'] = false;
            $data['deskQueues'] = DeskQueue::paginate(20);
        }else{

            $data['search'] = true;

            $data['deskQueues'] = new DeskQueue();

//            dd($request->all());

            $data['doctor']      = ($request->has('doctor')) ? Doctor::getBy('uuid', $request->doctor)->id : null;
            $data['room']        = ($request->has('room')) ? Room::getBy('uuid', $request->room)->id : null;
            $data['reservation'] = ($request->has('reservation')) ? $request->reservation : null;

            if($request->has('date') && $request->date != ''){
//                $data['deskQueues'] = $data['deskQueues']->where('created_at', 'like', $request->date . '%');
                $data['deskQueues'] = $data['deskQueues']->whereBetween('created_at', [$request->date_from, $request->date_to]);

            }

            if($request->has('desk')){
                $data['desk'] = Desk::getBy('uuid', $request->desk);
                $data['deskQueues'] = $data['deskQueues']->where('desk_id',$data['desk']->id);
            }

            $data['deskQueues'] = $data['deskQueues']->get();
        }

        // Store User Action Log
        storeLogUserAction(\App\Enums\LogUserActions::$name['IndexQueueHistory'], 'Get',route('queues.queuesHistory'));

        $data['queuesListsView'] = view('queues._list', $data);

        return view('queues.history', $data);

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
