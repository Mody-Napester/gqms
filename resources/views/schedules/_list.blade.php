<table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Serial</th>
        <th>Doctor (EN)</th>
        <th>Doctor (AR)</th>
        <th>Day</th>
        <th>Start time</th>
        <th>End time</th>
        <th>Duration hours</th>
        <th>Slot minutes</th>
        <th>Start date</th>
        <th>End date</th>
        <th>Created at</th>
    </tr>
    </thead>

    <tbody>
        @foreach($schedules as $schedule)
            <tr>
                <td>{{ $schedule->serial }}</td>
                <td>{{ ($schedule->doctor)? $schedule->doctor->name_en : '-' }}</td>
                <td>{{ ($schedule->doctor)? $schedule->doctor->name_ar : '-' }}</td>
                <td>{{ $schedule->dayname_ar }}</td>
                <td>{{ $schedule->starttime }}</td>
                <td>{{ $schedule->endtime }}</td>
                <td>{{ $schedule->duration_by_hour }}</td>
                <td>{{ $schedule->time_slot_by_minute }}</td>
                <td>{{ $schedule->startdate }}</td>
                <td>{{ $schedule->enddate }}</td>
                {{--<td>{{ ($schedule->doctor)? $schedule->doctor->name_en : '-' }}</td>--}}
                {{--<td>{{ ($schedule->desk_queue_id)? 'Served' : '' }}</td>--}}
                <td>{{ $schedule->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>