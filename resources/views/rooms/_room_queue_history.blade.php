<table class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
    <tr>
        <th>Action</th>
        <th>By</th>
        <th>Date</th>
    </tr>

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

</table>