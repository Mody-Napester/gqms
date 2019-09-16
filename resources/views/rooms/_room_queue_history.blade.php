<table class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
    <tr>
        <th>Action</th>
        <th>By</th>
        <th>Date</th>
    </tr>

    @foreach($roomQueue->roomQueueStatusHistories as $history)
        <tr>
            <td>
                <span class="label {{ \App\QueueStatus::where('id', $history->queue_status_id)->first()->class }}">
                    {{ \App\QueueStatus::where('id', $history->queue_status_id)->first()->name_en }}
                </span>
            </td>
            <td>{{ \App\User::getBy('id', $history->user_id)->name }}</td>
            <td>{{ $history->created_at->addHour(2) }}</td>
        </tr>
    @endforeach

</table>