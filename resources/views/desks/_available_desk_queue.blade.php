<div class="card-box">
    <h4 class="m-t-0 m-b-20 header-title"><b>Today Desk Queue ({{ count($deskQueues) }})</b></h4>

    <div class="mx-box" style="overflow: auto;">
        <table class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Queue</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($deskQueues as $deskQueue)
                <tr>
                    <th>{{ $deskQueue->queue_number }}</th>
                    <th>
                        <span class="label {{ $deskQueue->queueStatus->class }}">{{ $deskQueue->queueStatus->name_en }}</span>
                    </th>
                    <th>
                        @if($deskQueue->queueStatus->id == 3)
                            <button class="btn btn-secondary waves-effect" style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">Call again</button>
                        @endif
                    </th>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</div>