<div class="col-md-6 pr-0">
    <table class="cm-table">
        <tr>
            <td colspan="3" class="cm-header cm-bg-blue">إنتظار الإستقبال</td>
        </tr>
        <tr class="cm-space"></tr>
        @foreach($screen->desks()->orderBy('desk_id', 'ASC')->get() as $desk)
            <tr class="cm-tr cm-bg-blue">
                <td id="{{ $desk->uuid }}" class="cm-queue-number @if(!in_array($desk->id , $logegdInDeskUsers)) cm-canceled-res @endif">
                    <span class="cm-number cm-txt-blue">{{ ($queue = \App\DeskQueue::getCurrentDeskQueues($desk->id))? $queue->queue_number : '-'  }}</span>
                </td>
                <td class="cm-place">
                    <span class="cm-number cm-txt-blue">{{ $desk->name_en }}</span>
                </td>
                <td class="cm-user">
                    <span class="cm-text-3">كاشير</span>
                </td>
            </tr>
            <tr class="cm-space"></tr>
        @endforeach
    </table>

{{--@foreach($screen->desks()->orderBy('desk_id', 'ASC')->get() as $desk)--}}
    {{--<!-- Start Reservation Row -->--}}
        {{--<div class="res-row row m-0">--}}
            {{--<div class="col-md-6 p-0">--}}
                {{--<div id="{{ $desk->uuid }}" class="bg-gray-1 section mb-2 @if(!in_array($desk->id , $logegdInDeskUsers)) canceled-res @endif">--}}
                    {{--<div class="txt-3 text-center">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-12">--}}
                                {{--<span class="number-app">{{ ($queue = \App\DeskQueue::getCurrentDeskQueues($desk->id))? $queue->queue_number : '-'  }}</span>--}}
                            {{--</div>--}}
                            {{--<!-- <div class="col-md-6">--}}
                                {{--<span class="text-app">حجز</span>--}}
                            {{--</div> -->--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-6 p-0">--}}
                {{--<div class="bg-blue-3 section mb-2">--}}
                    {{--<div class="txt-3 text-center">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<span class="number-app">{{ $desk->name_en }}</span>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<span class="text-app">كاشير</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!-- End Reservation Row -->--}}
    {{--@endforeach--}}
</div>