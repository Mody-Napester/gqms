<div class="card-box">
    <h4 class="m-t-0 header-title">
        <label for="">{{ trans('rooms.Today_Queue') }} ({{ count($roomQueues) }})</label>
        <div class="row">
            <div class="col-md-6 pr-1">
                <input class="form-control" type="text" id="searchInput" placeholder="{{ trans('rooms.Search') }} ..">
            </div>
            <div class="col-md-6 pl-1">
                <select class="form-control" id="searchSelect" style="height: 35px;">
                    <option value='All'>{{ trans('rooms.All') }}</option>
                    @foreach($roomQueueStatues as $status)
                        <option value='{{ $status->name_en }}'>{{ $status->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </h4>


    <div class="mx-box" style="overflow: auto;">
        <table data-page-length='50' id="searchTable" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
            <tr>
                <th>{{ trans('rooms.Queue') }}</th>
                <th>{{ trans('rooms.Status') }}</th>
                <th>{{ trans('rooms.Action') }}</th>
            </tr>

            @foreach($roomQueues as $roomQueue)
{{--                @if($roomQueue->doctor_id == auth()->user()->doctor->source_doctor_id)--}}
                <tr>
                    <td>{{ $roomQueue->queue_number }}</td>
                    <td>
                        <span class="label {{ $roomQueue->queueStatus->class }}">{{ $roomQueue->queueStatus->name_en }}</span>
                    </td>
                    <td>
                        @if($roomQueue->queueStatus->id == config('vars.room_queue_status.skipped'))
                            <button onclick="callSkippedAgain('{{ $roomQueue->uuid }}')" class="btn btn-secondary waves-effect"
                                    style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">{{ trans('rooms.Call_again') }}</button>
                        @elseif($roomQueue->queueStatus->id != config('vars.room_queue_status.waiting'))
                            {{ trans('rooms.From') }} {{ $roomQueue->room->name_en }}
                        @endif
                    </td>
                </tr>
                {{--@endif--}}
            @endforeach

        </table>
    </div>
</div>