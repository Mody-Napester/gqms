<?php

namespace App\Http\Controllers;

use App\Desk;
use App\DeskQueue;
use App\Floor;
use App\User;
use Illuminate\Http\Request;

class QueuesController extends Controller
{
    /**
     * All queue histories.
     */
    public function queuesHistory()
    {
        if (!User::hasAuthority('use.all_queue_history')){
            return redirect('/');
        }

        $data['desks'] = Desk::all();
        $data['floors'] = Floor::all();
        $data['users'] = User::all();
        $data['statuses'] = \App\QueueStatus::getQueueStatuses('desk');
        $data['deskQueues'] = DeskQueue::paginate(20);

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
