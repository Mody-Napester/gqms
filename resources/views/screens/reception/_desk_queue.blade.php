<div class="col-md-6 pr-0">
    <div class="bg-blue-2 section mb-2">
        <div class="text-white txt-1 text-center">
            إنتظار الإستقبال
        </div>
    </div>

@foreach($screen->desks as $desk)
    <!-- Start Reservation Row -->
        <div class="res-row row m-0">
            <div class="col-md-6 p-0">
                <div id="{{ $desk->uuid }}" class="bg-gray-1 section mb-2 @if(!in_array($desk->id , $logegdInDeskUsers)) canceled-res @endif">
                    <div class="txt-3 text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="number-app">{{ ($queue = \App\DeskQueue::getCurrentDeskQueues($desk->id))? $queue->queue_number : '-'  }}</span>
                            </div>
                            <!-- <div class="col-md-6">
                                <span class="text-app">حجز</span>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-0">
                <div class="bg-blue-3 section mb-2">
                    <div class="txt-3 text-center">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="number-app">{{ $desk->name_en }}</span>
                            </div>
                            <div class="col-md-6">
                                <span class="text-app">كاشير</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Reservation Row -->
    @endforeach
</div>