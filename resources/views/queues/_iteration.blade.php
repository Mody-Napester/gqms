<tr>
    <td>{{ $deskQueue->queue_number }}</td>

    <td>{{ (isset($roomQueue))? $roomQueue->queue_number : '-' }}</td>

    <td>{{ ($deskQueue->desk)? $deskQueue->desk->name_en : '' }}</td>

    <td>
        {{ (isset($roomQueue))? (\App\Room::getBy('id', $roomQueue->room_id))? \App\Room::getBy('id', $roomQueue->room_id)->name_en : '-' : '-' }}
    </td>

    <td>
        {{ (isset($roomQueue))? (\App\Doctor::getBy('source_doctor_id', $roomQueue->doctor_id))? \App\Doctor::getBy('source_doctor_id', $roomQueue->doctor_id)->name_en : '-' : '-' }}
    </td>

    <td>{{ ($deskQueue->reservation) ? $deskQueue->reservation->source_reservation_serial : '-' }}</td>

    {{--<td>--}}
    {{--@if($deskQueue->reservation)--}}
    {{--<span class="badge badge-success">No</span>--}}
    {{--@else--}}
    {{--<span class="badge badge-danger">Yes</span>--}}
    {{--@endif--}}
    {{--</td>--}}

<!-- Attend Time -->
    <td>{{ $deskQueue->created_at->addHour(2) }}</td>

    <td>
        {{ (isset($roomQueue))? $roomQueue->created_at->addHour(2) : '-' }}
    </td>

    <!-- Call Time -->
    <td>
        {{ getQueuePatientActionTime($deskQueue, 'desk', 'call') }}
    </td>

    <td>
        @if(isset($roomQueue))
            {{ getQueuePatientActionTime($roomQueue, 'room', 'call') }}
        @else
            -
        @endif
    </td>

    <!-- Waiting time -->
    <td>
        @if($deskQueue->status == config('vars.desk_queue_status.done'))
            {{ getQueuePatientTime($deskQueue, 'desk', 'waiting') }}
        @else
            -
        @endif
    </td>

    <td>
        @if(isset($roomQueue))
            @if($roomQueue->status == config('vars.room_queue_status.patient_out'))
                {{ getQueuePatientTime($roomQueue, 'room', 'waiting') }}
            @else
                -
            @endif
        @else
            -
        @endif
    </td>

    <!-- Patient in -->
    <td>
        @if(isset($roomQueue))
            {{ getQueuePatientActionTime($roomQueue, 'room', 'in') }}
        @else
            -
        @endif
    </td>

    <!-- Done Time -->
    <td>
        {{ getQueuePatientActionTime($deskQueue, 'desk', 'done') }}
    </td>

    <td>
        @if(isset($roomQueue))
            {{ getQueuePatientActionTime($roomQueue, 'room', 'done') }}
        @else
            -
        @endif
    </td>

    <!-- Serve time -->
    <td>
        @if($deskQueue->status == config('vars.desk_queue_status.done'))
            {{ getQueuePatientTime($deskQueue, 'desk', 'serve') }}
        @else
            -
        @endif
    </td>

    <td>
        @if(isset($roomQueue))
            @if($roomQueue->status == config('vars.room_queue_status.patient_out'))
                {{ getQueuePatientTime($roomQueue, 'room', 'serve') }}
            @else
                -
            @endif
        @else
            -
        @endif
    </td>

    <td class="text-center">
        @if($deskQueue->status != config('vars.desk_queue_status.waiting'))
            <a href="{{ route('queues.queuesSingleHistory', [$deskQueue->uuid]) }}"
               class="btn history-modal btn-warning waves-effect"
               style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">Show</a>
        @endif
    </td>
</tr>