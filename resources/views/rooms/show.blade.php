@extends('_layouts.dashboard')

@section('title') {{ $room->name_en }} @endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <div class="row mb-3">
                <div class="col-lg-12 col-xl-4">
                    <div class="card-box mb-0">
                        <div class="bar-widget">
                            <div class="table-box">
                                <div class="table-detail">
                                    <div class="iconbox bg-info">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="table-detail text-right">
                                    <h4 class="m-t-0 m-b-5"><b>{{ $room->name_en }}</b></h4>
                                    <h5 class="text-muted m-b-0 m-t-0">{{ $room->floor->name_en }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4">
                    <div class="card-box mb-0">
                        <div class="bar-widget">
                            <div class="table-box">
                                <div class="table-detail">
                                    <div class="iconbox bg-danger">
                                        <i class="icon-close"></i>
                                    </div>
                                </div>
                                <div class="table-detail text-right">
                                    <h4 class="m-t-0 m-b-5"><b id="count-skip">{{ $roomQueuesSkip }}</b></h4>
                                    <h5 class="text-muted m-b-0 m-t-0">Skipped</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4">
                    <div class="card-box mb-0">
                        <div class="bar-widget">
                            <div class="table-box">
                                <div class="table-detail">
                                    <div class="iconbox bg-success">
                                        <i class="icon-check"></i>
                                    </div>
                                </div>
                                <div class="table-detail text-right">
                                    <h4 class="m-t-0 m-b-5"><b id="count-out">{{ $roomQueuesPatientOut }}</b></h4>
                                    <h5 class="text-muted m-b-0 m-t-0">Patient Out</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="current-queue-div card-box">
                <!-- Change btns -->
                {{--<div class="queue-settings-container">--}}
                    {{--<div class="queue-settings-btns">--}}
                        {{--<div class="queue-settings-close"><i class="fa fa-fw fa-close"></i></div>--}}
                        {{--<div style="overflow: auto;height: 100%">--}}
                            {{--<p>Done button</p>--}}
                            {{--<div class="radio radio-success" v-on:click="changeBtn('out')">--}}
                                {{--<input style="margin-top: 4px;" type="radio" name="queue_done" id="radio1">--}}
                                {{--<label for="radio1">--}}
                                    {{--Patient out--}}
                                {{--</label>--}}
                            {{--</div>--}}
                            {{--<div class="radio radio-success" v-on:click="changeBtn('outandnext')">--}}
                                {{--<input style="margin-top: 4px;" type="radio" checked name="queue_done" id="radio2">--}}
                                {{--<label for="radio2">--}}
                                    {{--Patient out and next--}}
                                {{--</label>--}}
                            {{--</div>--}}
                            {{--<hr>--}}
                            {{--<p>Skip button</p>--}}
                            {{--<div class="radio radio-danger" v-on:click="changeBtn('skip')">--}}
                                {{--<input style="margin-top: 4px;" type="radio" name="queue_skip" id="radio3">--}}
                                {{--<label for="radio3">--}}
                                    {{--Skip--}}
                                {{--</label>--}}
                            {{--</div>--}}
                            {{--<div class="radio radio-danger" v-on:click="changeBtn('skipandnext')">--}}
                                {{--<input style="margin-top: 4px;" type="radio" checked name="queue_skip" id="radio4">--}}
                                {{--<label for="radio4">--}}
                                    {{--Skip and next--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <!-- Waiting time -->
                <h4 class="m-t-0 m-b-20 header-title">
                    <b>Current Serving Queue</b>
                    <b class="pull-right">
                        Waiting : <span class="waitingTime">@{{ waiting_time }}</span>

                        {{--<span class="queue-settings"><i class="fa fa-cog fa-fw"></i></span>--}}

                    </b>
                </h4>

                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="current-queue" id="current-queue">{{ ($currentRoomQueueNumber)? $currentRoomQueueNumber->queue_number : '-' }}</div>

                            <div class="row">
                                <div class="col-md-4">
                                    <button v-on:click="skip()" v-if="skip_status" type="button" class="btn btn-block btn-danger waves-effect waves-light">
                                        Skip <i class="fa fa-fw fa-close"></i>
                                    </button>
                                    {{--<button v-on:click="skipAndNext()" v-if="skip_and_next_status && change_skip_and_next_status" type="button" class="btn btn-block btn-danger waves-effect waves-light">--}}
                                        {{--Skip and next <i class="fa fa-fw fa-close"></i>--}}
                                    {{--</button>--}}
                                </div>
                                <div class="col-md-4">
                                    <button v-on:click="callNext()" v-if="next_status" type="button" class="btn btn-block btn-primary waves-effect waves-light">
                                        Call Next <i class="fa fa-fw fa-refresh"></i>
                                    </button>
                                    <button v-on:click="callNextAgain()" v-if="call_status" type="button" class="btn btn-block btn-warning waves-effect waves-light">
                                        Call Next Again <i class="fa fa-fw fa-refresh"></i>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button v-on:click="patientIn()" v-if="in_status" type="button" class="btn btn-block btn-pink waves-effect waves-light">
                                        Patient in <i class="fa fa-fw fa-arrow-down"></i>
                                    </button>
                                    <button v-on:click="patientOut()" v-if="out_status" type="button" class="btn btn-block btn-success waves-effect waves-light">
                                        Patient out <i class="fa fa-fw fa-arrow-up"></i>
                                    </button>
                                    {{--<button v-on:click="patientOutAndNext()" v-if="out_and_next_status && change_out_and_next_status" type="button" class="btn btn-block btn-success waves-effect waves-light">--}}
                                        {{--Patient out and next <i class="fa fa-fw fa-arrow-up"></i>--}}
                                    {{--</button>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4" id="all-queues">
            @include('rooms._available_room_queue')
        </div>
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Search on table
            $('body').on("keyup", "#searchInput",function() {
                var value = $(this).val();

                $("#searchTable tr").each(function(index) {
                    if (index != 0) {

                        $row = $(this);

                        var id1 = $row.find("td:first").text();
                        var id2 = $row.find("td:nth-child(2) span").text();

                        if (id1.indexOf(value) != 0) {
                            if (id2.indexOf(value) != 0){
                                $(this).hide();
                            }else{
                                $(this).show();
                            }
                        }
                        else {
                            $(this).show();
                        }
                    }
                });
            })

            $('body').on("change", "#searchSelect",function() {
                var value = $(this).val();

                $("#searchTable tr").each(function(index) {
                    if (index != 0) {

                        $row = $(this);

                        var id = $row.find("td:nth-child(2) span").text();

                        if(value == 'All'){
                            $(this).show();
                        }else{
                            if (id.indexOf(value) != 0) {
                                $(this).hide();
                            }
                            else {
                                $(this).show();
                            }
                        }

                    }
                });
            })
        })
    </script>
    <script>
        const app = new Vue({
            el : '#app',
            data : {
                room_queue_uuid : '{{ ($currentRoomQueueNumber)? $currentRoomQueueNumber->uuid : '' }}',
                waiting_time : '{{ ($currentRoomQueueNumber)? nice_time($currentRoomQueueNumber->created_at) : '00:00' }}',
                room: '{{ $room->id }}',
                floor: '{{ $room->floor_id }}',

                current_room_queue_number: '{{ ($currentRoomQueueNumber)? $currentRoomQueueNumber->status : '0' }}',

                next_status: false,
                call_status: false,
                skip_status: false,
                skip_and_next_status: false,
                in_status: false,
                out_status: false,
                out_and_next_status: false,

                change_skip_status:false,
                change_skip_and_next_status:true,

                change_out_status:false,
                change_out_and_next_status:true,

            },
            methods : {
                // Configs
                changeBtn(type){
                    if(type == 'out'){
                        this.change_out_status = true;
                        this.change_out_and_next_status = false;

                        this.out_status = true;
                    }
                    else if(type == 'outandnext'){
                        this.change_out_status = false;
                        this.change_out_and_next_status = true;

                        this.out_and_next_status = true;
                    }
                    else if(type == 'skip'){
                        this.change_skip_status = true;
                        this.change_skip_and_next_status = false;

                        this.skip_status = true;
                    }
                    else if(type == 'skipandnext'){
                        this.change_skip_status = false;
                        this.change_skip_and_next_status = true;

                        this.skip_and_next_status = true;
                    }
                },
                changeBtnStatus(current_room_queue_number){
                    if(current_room_queue_number == '0'){
                        this.next_status = true;
                        this.call_status = false;
                        this.skip_status = false;
                        this.skip_and_next_status = false;
                        this.in_status = false;
                        this.out_status = false;
                        this.out_and_next_status = false;
                    }
                    else if(current_room_queue_number == '{{ config('vars.room_queue_status.called') }}'){
                        this.next_status = false;
                        this.call_status = true;
                        this.skip_status = true;
                        this.skip_and_next_status = false;
                        this.in_status = true;
                        this.out_status = false;
                        this.out_and_next_status = false;
                    }
                    else if(current_room_queue_number == '{{ config('vars.room_queue_status.skipped') }}'){
                        this.next_status = true;
                        this.call_status = false;
                        this.skip_status = false;
                        this.skip_and_next_status = false;
                        this.in_status = false;
                        this.out_status = false;
                        this.out_and_next_status = false;
                    }
                    else if(current_room_queue_number == '{{ config('vars.room_queue_status.patient_in') }}'){
                        this.next_status = false;
                        this.call_status = false;
                        this.skip_status = false;
                        this.skip_and_next_status = false;
                        this.in_status = false;
                        this.out_status = true;
                        this.out_and_next_status = false;
                    }
                    else if(current_room_queue_number == '{{ config('vars.room_queue_status.patient_out') }}'){
                        this.next_status = true;
                        this.call_status = false;
                        this.skip_status = false;
                        this.skip_and_next_status = false;
                        this.in_status = false;
                        this.out_status = false;
                        this.out_and_next_status = false;
                    }
                    else if(current_room_queue_number == '{{ config('vars.room_queue_status.call_from_skip') }}'){
                        this.next_status = false;
                        this.call_status = false;
                        this.skip_status = false;
                        this.skip_and_next_status = false;
                        this.in_status = true;
                        this.out_status = false;
                        this.out_and_next_status = false;
                    }
                },

                // Buttons
                callNext(){
                    addLoader('.current-queue-div');
                    var url = '{{ route('rooms.queues.callNextQueueNumber', $room->uuid) }}';
                    axios.get(url)
                        .then((response) => {
                            $('.current-queue').text(response.data.nextQueue.queue_number);

                            this.room_queue_uuid = response.data.nextQueue.uuid;
                            this.waiting_time = response.data.waitingTime;

                            this.changeBtnStatus(response.data.roomQueue.status);

                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },
                callNextAgain(){
                    addLoader('.current-queue-div');
                    var url = '{{ route('rooms.queues.callNextQueueNumberAgain', $room->uuid) }}';
                    axios.get(url)
                        .then((response) => {
                            removeLoarder();
                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },
                skip(){
                    addLoader('.current-queue-div');
                    var url = '{{ url('dashboard') }}/room/{{$room->uuid}}/' + this.room_queue_uuid + '/skip';
                    axios.get(url)
                        .then((response) => {

                            $('.current-queue').text('-');

                            $('#count-skip').text(response.data.roomQueuesSkip);
                            $('#count-out').text(response.data.roomQueuesOut);

                            this.changeBtnStatus(response.data.roomQueue.status);

                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },
                skipAndNext(){
                    addLoader('.current-queue-div');
                    var url = '{{ url('dashboard') }}/room/{{$room->uuid}}/' + this.room_queue_uuid + '/skip-and-next';
                    axios.get(url)
                        .then((response) => {
                            $('.current-queue').text(response.data.nextQueue.queue_number);
                            $('#count-skip').text(response.data.roomQueuesSkip);
                            $('#count-out').text(response.data.roomQueuesOut);

                            this.room_queue_uuid = response.data.nextQueue.uuid;
                            this.waiting_time = response.data.waitingTime;

                            this.changeBtnStatus(response.data.roomQueue.status);

                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },
                patientIn(){
                    addLoader('.current-queue-div');
                    var url = '{{ url('dashboard') }}/room/{{$room->uuid}}/' + this.room_queue_uuid + '/in';
                    axios.get(url)
                        .then((response) => {

                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                this.changeBtnStatus(response.data.roomQueue.status);
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },
                patientOut(){
                    addLoader('.current-queue-div');
                    var url = '{{ url('dashboard') }}/room/{{$room->uuid}}/' + this.room_queue_uuid + '/out';
                    axios.get(url)
                        .then((response) => {
                            $('.current-queue').text('-');

                            $('#count-skip').text(response.data.roomQueuesSkip);
                            $('#count-out').text(response.data.roomQueuesOut);

                            this.changeBtnStatus(response.data.roomQueue.status);

                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },
                patientOutAndNext(){
                    addLoader('.current-queue-div');
                    var url = '{{ url('dashboard') }}/room/{{$room->uuid}}/' + this.room_queue_uuid + '/out-and-next';
                    axios.get(url)
                        .then((response) => {
                            $('.current-queue').text(response.data.nextQueue.queue_number);
                            $('#count-skip').text(response.data.roomQueuesSkip);
                            $('#count-out').text(response.data.roomQueuesOut);
                            this.room_queue_uuid = response.data.nextQueue.uuid;
                            this.waiting_time = response.data.waitingTime;

                            this.changeBtnStatus(response.data.roomQueue.status);

                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },

                callSkippedAgain(skipped_queue_uuid){
                    addLoader();

                    var current_queue_uuid = this.room_queue_uuid;

                    var url = '{{ url('dashboard') }}/room/{{$room->uuid}}/' + skipped_queue_uuid + '/' + current_queue_uuid +'/call-skipped';

                    axios.get(url)
                        .then((response) => {
                            removeLoarder();
                            if(response.data.message.msg_status == 1){
                                $('.current-queue').text(response.data.skippedQueue.queue_number);

                                this.room_queue_uuid = response.data.skippedQueue.uuid;
                                this.waiting_time = response.data.waitingTime;
                                this.active_btn = true;

                                this.changeBtnStatus({{ config('vars.room_queue_status.call_from_skip') }});

                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },

                // Websockets
                listen(){
                    Echo.channel('available-room-queue-' + this.floor + '-' + this.room)
                        .listen('RoomQueueStatus', (response) => {
                            $('#all-queues').html('');
                            $('#all-queues').append(response.view);
                        });
                }
            },
            mounted() {
                this.listen();
                this.changeBtnStatus(this.current_room_queue_number);
            }
        });

        function callSkippedAgain(skipped_queue_uuid){
            app.callSkippedAgain(skipped_queue_uuid);
            {{--addLoader();--}}
            {{--var url = '{{ url('dashboard') }}/room/{{$room->uuid}}/' + skipped_queue_uuid + '/call-skipped';--}}

            {{--// Get contents--}}
            {{--$.ajax({--}}
                {{--method:'GET',--}}
                {{--url:url,--}}
                {{--beforeSend:function () {--}}
                    {{--addLoader();--}}
                {{--},--}}
                {{--success:function (response) {--}}

                    {{--$('.current-queue').text(response.skippedQueue.queue_number);--}}

                    {{--app.room_queue_uuid = response.skippedQueue.uuid;--}}
                    {{--app.waiting_time = response.waitingTime;--}}
                    {{--app.active_btn = true;--}}

                    {{--if(response.message.msg_status == 1){--}}
                        {{--addAlert('success', response.message.text);--}}
                    {{--}else{--}}
                        {{--addAlert('danger', response.message.text);--}}
                    {{--}--}}

                    {{--removeLoarder();--}}
                {{--},--}}
                {{--error:function () {--}}

                {{--}--}}
            {{--});--}}
        }
    </script>
@endsection
