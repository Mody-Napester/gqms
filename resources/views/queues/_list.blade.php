@foreach($deskQueues as $deskQueue)
    <?php
    if ($deskQueue->reservation) {
        $roomQueue = \App\RoomQueue::where('reservation_source_serial', $deskQueue->reservation->source_reservation_serial)->first();
    }
    ?>


    @if($search == true)
        @if((isset($deskQueue->reservation) && $deskQueue->reservation->source_reservation_serial == $reservation) ||
             (isset($roomQueue) && $room == $roomQueue->room_id) ||
             (isset($roomQueue) && $doctor == $roomQueue->doctor_id)
             )
            @include('queues._iteration')
        @endif
    @elseif(isset($doctor) && $doctor == null && isset($room) && $room == null && isset($reservation) && $reservation == null)
        @include('queues._iteration')
    @else
        @include('queues._iteration')
    @endif

@endforeach

