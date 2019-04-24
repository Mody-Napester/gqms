<div class="card-box">
    <h4 class="m-t-0 header-title">
        <label for="">Today Queue ({{ count($roomQueues) }})</label>
        <div class="row">
            <div class="col-md-6 pr-1">
                <input class="form-control" type="text" id="searchInput" placeholder="Search ..">
            </div>
            <div class="col-md-6 pl-1">
                <select class="form-control" id="searchSelect" style="height: 35px;">
                    <option value='All'>All</option>
                    <option value='Waiting'>Waiting</option>
                    <option value='Called'>Called</option>
                    <option value='Skipped'>Skipped</option>
                    <option value='Done'>Done</option>
                    <option value='Cell from skip'>Cell from skip</option>
                </select>
            </div>
        </div>
    </h4>


    <div class="mx-box" style="overflow: auto;">
        <table id="searchTable" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
            <tr>
                <th>Queue</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @foreach($roomQueues as $roomQueue)
                <tr>
                    <td>{{ $roomQueue->queue_number }}</td>
                    <td>
                        <span class="label {{ $roomQueue->queueStatus->class }}">{{ $roomQueue->queueStatus->name_en }}</span>
                    </td>
                    <td>
                        @if($roomQueue->queueStatus->id == config('vars.queue_status.skipped'))
                            <button onclick="callSkippedAgain('{{ $roomQueue->uuid }}')" class="btn btn-secondary waves-effect"
                                    style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">Call again</button>
                        @elseif($roomQueue->queueStatus->id != config('vars.queue_status.waiting'))
                            By {{ $roomQueue->room->name_en }}
                        @endif
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
</div>