<div class="col-md-6 pl-0">
    <div class="bg-green-2 section mb-2">
        <div class="text-white txt-1 text-center">
            إنتظار العيادات
        </div>
    </div>


    @foreach($screen->rooms()->orderBy('room_id', 'ASC')->get() as $room)
        <!-- Start Reservation Row -->
        <div class="res-row row m-0">
            <div class="col-md-5 p-0">
                <div id="{{ $room->uuid }}" class="bg-gray-2 section mb-2 @if(!in_array($room->id , $logegdInRoomUsers)) canceled-res @endif">
                    <div class="txt-3 text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="number-app">{{ ($queue = \App\RoomQueue::getCurrentRoomQueues($room->id))? $queue->queue_number : '-'  }}</span>
                            </div>
                            {{--<div class="col-md-6">--}}
                                {{--<span class="text-app">حجز</span>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 p-0">
                <div class="bg-green-3 section-1 mb-2">
                    <div class="txt-3">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <span class="number-app">{{ $room->name_en }}</span>
                            </div>
                            <div class="col-md-8 text-right">
                                <span id="doctor-{{ $room->uuid }}" class="text-app-1">{{ ($room->user)? $room->user->doctor->name_ar : '-' }}</span>
                                <span id="clinic-{{ $room->uuid }}" class="text-app-2">{{ ($room->user)? $room->user->doctor->speciality->name_ar : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Reservation Row -->
    @endforeach

</div>