<table class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
    <tr>
        <th>Action</th>
        <th>By</th>
        <th>Date</th>
    </tr>

    <tr><td colspan="3">Desk Queue</td></tr>
    @foreach($deskQueue->deskQueueStatusHistories as $history)
        <tr>
            <td>
                <span class="label {{ \App\QueueStatus::where('id', $history->queue_status_id)->first()->class }}">
                    {{ \App\QueueStatus::where('id', $history->queue_status_id)->first()->name_en }}
                </span>
            </td>
            <td>{{ \App\User::getBy('id', $history->user_id)->first()->name }}</td>
            <td>{{ $history->created_at }}</td>
        </tr>
    @endforeach

    @if($deskQueue->reservation && $deskQueue->reservation->roomQueue)
        <tr><td colspan="3">Doctor Queue</td></tr>
        @foreach($deskQueue->reservation->roomQueue->roomQueueStatusHistories as $history)
            <tr>
                <td>
                    <span class="label {{ \App\QueueStatus::where('id', $history->queue_status_id)->first()->class }}">
                        {{ \App\QueueStatus::where('id', $history->queue_status_id)->first()->name_en }}
                    </span>
                </td>
                <td>{{ \App\User::getBy('id', $history->user_id)->first()->name }}</td>
                <td>{{ $history->created_at }}</td>
            </tr>
        @endforeach
    @endif

</table>