<div class="col-md-6 pl-0">
    <table class="cm-table">
        <tr>
            <td colspan="3" class="cm-header cm-bg-green">إنتظار العيادات</td>
        </tr>
        <tr class="cm-space"></tr>
        @foreach($screen->rooms()->orderBy('room_id', 'ASC')->get() as $room)
            <tr class="cm-tr cm-bg-green">
                <td id="{{ $room->uuid }}" class="cm-queue-number @if(!in_array($room->id , $logegdInRoomUsers)) cm-canceled-res @endif">
                    <span class="cm-number cm-txt-green">{{ ($queue = \App\RoomQueue::getCurrentRoomQueues($room->id))? $queue->queue_number : '-'  }}</span>
                </td>
                <td class="cm-place">
                    <span class="cm-number cm-txt-green">{{ $room->name_en }}</span>
                </td>
                <td class="cm-user">
                    <span id="doctor-{{ $room->uuid }}" class="cm-text-1">{{ ($room->user)? ('د ' . (!empty($room->user->doctor->nickname))? $room->user->doctor->nickname : $room->user->doctor->name_ar) : '-' }}</span>
                    <span id="clinic-{{ $room->uuid }}" class="cm-text-2">{{ ($room->user)? $room->user->doctor->speciality->name_ar : '-' }}</span>
                </td>
            </tr>
            <tr class="cm-space"></tr>
        @endforeach
    </table>
</div>