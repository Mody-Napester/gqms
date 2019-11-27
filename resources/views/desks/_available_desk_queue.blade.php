<div class="card-box">
    <h4 class="m-t-0 header-title">
        <label for="">{{ trans('desks.Today_Queue') }} ({{ count($deskQueues) }})</label>
        <div class="row">
            <div class="col-md-6 pr-1">
                <input class="form-control" type="text" id="searchInput" placeholder="{{ trans('desks.Search') }} ..">
            </div>
            <div class="col-md-6 pl-1">
                <select class="form-control" id="searchSelect" style="height: 35px;">
                    <option value='All'>All</option>
                    @foreach($deskQueueStatues as $status)
                    <option value='{{ $status->name_en }}'>{{ $status->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </h4>


    <div class="mx-box" style="overflow: auto;">
        <table id="searchTable" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
            <tr>
                <th>{{ trans('desks.Queue') }}</th>
                <th>{{ trans('desks.Status') }}</th>
                <th>{{ trans('desks.Action') }}</th>
                <th>{{ trans('desks.Attend_at') }}</th>
            </tr>

            @foreach($deskQueues as $deskQueue)
                <tr>
                    <td>{{ $deskQueue->queue_number }}</td>
                    <td>
                        <span class="label {{ $deskQueue->queueStatus->class }}">{{ $deskQueue->queueStatus->name_en }}</span>
                    </td>
                    <td>
                        @if($deskQueue->queueStatus->id == config('vars.desk_queue_status.skipped'))
                            <button onclick="callSkippedAgain('{{ $deskQueue->uuid }}')" class="btn btn-secondary waves-effect"
                                    style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">{{ trans('desks.Call_again') }}</button>
                        @elseif($deskQueue->queueStatus->id != config('vars.desk_queue_status.waiting'))
                            {{ trans('desks.By') }} {{ translate($deskQueue->desk, 'name') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $deskQueue->created_at->addHour(2) }}</td>
                </tr>
            @endforeach

        </table>
    </div>
</div>