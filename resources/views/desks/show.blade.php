@extends('_layouts.dashboard')

@section('title') {{ translate($desk, 'name') }} @endsection

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
                                    <h4 class="m-t-0 m-b-5"><b>{{ translate($desk, 'name') }}</b></h4>
                                    <h5 class="text-muted m-b-0 m-t-0">{{ translate($desk->area, 'name') }}</h5>
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
                                    <h4 class="m-t-0 m-b-5"><b id="count-skip">{{ $deskQueuesSkip }}</b></h4>
                                    <h5 class="text-muted m-b-0 m-t-0">{{ trans('desks.Skipped') }}</h5>
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
                                    <h4 class="m-t-0 m-b-5"><b id="count-done">{{ $deskQueuesDone }}</b></h4>
                                    <h5 class="text-muted m-b-0 m-t-0">{{ trans('desks.Done') }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="current-queue-div card-box">
                <div class="queue-settings-container">
                    <div class="queue-settings-btns">
                        <div class="queue-settings-close"><i class="fa fa-fw fa-close"></i></div>
                        <div style="overflow: auto;height: 100%">
                            <p>{{ trans('desks.Done_button') }}</p>
                            <div class="radio radio-success" v-on:click="changeBtn('done')">
                                <input style="margin-top: 4px;" type="radio" name="queue_done" id="radio1" value="option4">
                                <label for="radio1">
                                    {{ trans('desks.Done') }}
                                </label>
                            </div>
                            <div class="radio radio-success" v-on:click="changeBtn('doneandnext')">
                                <input style="margin-top: 4px;" type="radio" checked name="queue_done" id="radio2" value="option4">
                                <label for="radio2">
                                    {{ trans('desks.Done_and_next') }}
                                </label>
                            </div>
                            <hr>
                            <p>{{ trans('desks.Skip_button') }}</p>
                            <div class="radio radio-danger" v-on:click="changeBtn('skip')">
                                <input style="margin-top: 4px;" type="radio" name="queue_skip" id="radio3" value="option4">
                                <label for="radio3">
                                    {{ trans('desks.Skip') }}
                                </label>
                            </div>
                            <div class="radio radio-danger" v-on:click="changeBtn('skipandnext')">
                                <input style="margin-top: 4px;" type="radio" checked name="queue_skip" id="radio4" value="option4">
                                <label for="radio4">
                                    {{ trans('desks.Skip_and_next') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="confirm-done-container">
                    <div class="confirm-done-close"><i class="fa fa-fw fa-close"></i></div>
                    <div class="confirm-done">
                        <div class="">
                            <div class="input-group">
                                <input v-model="reservation_resource" placeholder="Enter reservation serial or patient id number.."
                                       name="reservation_resource" id="reservation_resource" type="text"
                                       class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button v-on:click="checkReservationExists()" class="btn btn-secondary waves-effect waves-light" type="button"><i class="fa fa-fw fa-search"></i> {{ trans('desks.Search') }}</button>
                                </div>
                            </div>
                            <div class="invalid-feedback reservation_resource_feedback"></div>
                            {{--<div>--}}
                                {{--<select v-model="selected_room" name="room_uuid" class="selected_room form-control">--}}
                                    {{--<option value="choose" disabled>Choose Room..</option>--}}
                                    {{--<option v-for="room in rooms" v-bind:value="room.uuid" >@{{ room.name_en }}</option>--}}
                                {{--</select>--}}
                                {{--<div class="invalid-feedback selected_room_feedback"></div>--}}
                            {{--</div>--}}
                        </div>

                        <div style="max-height: 200px;overflow: auto;display: none;" class="card-box get-patient-data mt-3 mb-0">

                        </div>
                    </div>
                </div>

                <h4 class="m-t-0 m-b-20 header-title">
                    <b>{{ trans('desks.Current_Serving_Queue') }}</b> <b class="pull-right">{{ trans('desks.Waiting') }} : <span class="waitingTime">@{{ waiting_time }}</span>
                        <span class="queue-settings"><i class="fa fa-cog fa-fw"></i></span></b>
                </h4>

                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="current-queue" id="current-queue">{{ ($currentDeskQueueNumber)? $currentDeskQueueNumber->queue_number : '-' }}</div>

                            <div class="row">
                                <div class="col-md-4">
                                    <button v-if="active_btn && skip_status" @click.prevent="skip()" type="button" class="btn btn-block btn-danger waves-effect waves-light">
                                        {{ trans('desks.Skip') }} <i class="fa fa-fw fa-close"></i>
                                    </button>
                                    <button v-if="active_btn && !skip_status" @click.prevent="skipAndNext()" type="button" class="btn btn-block btn-danger waves-effect waves-light">
                                        {{ trans('desks.Skip_And_Next') }} <i class="fa fa-fw fa-close"></i>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button v-if="!active_btn" @click.prevent="next()" type="button" class="btn btn-block btn-primary waves-effect waves-light">
                                        {{ trans('desks.Next') }} <i class="fa fa-fw fa-arrow-right"></i>
                                    </button>
                                    <button v-if="active_btn" @click.prevent="call()" type="button" class="btn btn-block btn-warning waves-effect waves-light">
                                        {{ trans('desks.Call_Again') }} <i class="fa fa-fw fa-refresh"></i>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button v-if="active_btn && done_status" type="button" class="confirm btn btn-block btn-success waves-effect waves-light">
                                        {{ trans('desks.Done') }} <i class="fa fa-fw fa-check"></i>
                                    </button>
                                    <button v-if="active_btn && !done_status" type="button" class="confirm btn btn-block btn-success waves-effect waves-light">
                                        {{ trans('desks.Done_And_Next') }} <i class="fa fa-fw fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4" id="all-queues">
            @include('desks._available_desk_queue')
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

                // Declare variables
                var input, filter, table, tr, td, td1, td2, td3, i, txtValue, txtValue1, txtValue2, txtValue3;
                input = value;
                filter = input.toUpperCase();
                table = document.getElementById("searchTable");
                tr = table.getElementsByTagName("tr");

                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    td1 = tr[i].getElementsByTagName("td")[1];
                    td2 = tr[i].getElementsByTagName("td")[2];
                    td3 = tr[i].getElementsByTagName("td")[3];

                    if (td) {
                        txtValue = td.textContent || td.innerHtml;
                        txtValue1 = td1.textContent || td1.innerHtml;
                        txtValue2 = td2.textContent || td2.innerHtml;
                        txtValue3 = td3.textContent || td3.innerHtml;

                        console.log(txtValue1);

                        if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }

//                $("#searchTable tr").each(function(index) {
//                    if (index != 0) {
//
//                        $row = $(this);
//
//                        var id1 = $row.find("td:first").text();
//                        var id2 = $row.find("td:nth-child(2) span").text();
//
//                        if (id1.indexOf(value) != 0) {
//                            if (id2.indexOf(value) != 0){
//                                $(this).hide();
//                            }else{
//                                $(this).show();
//                            }
//                        }
//                        else {
//                            $(this).show();
//                        }
//                    }
//                });
            });


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

            // Confirm Open
            $('body').on('click', '.confirm', function () {
                $('.confirm-done-container').show(0);
                $('.confirm-done-container').animate({
                    opacity:1
                }, 100);
            });

            // Confirm Close
            $('body').on('click', '.confirm-done-close', function() {
                $('.confirm-done-container').animate({
                    opacity:0
                }, 100);

                $('.confirm-done-container').hide(0);

                $('#reservation_resource').removeClass('is-invalid');
                $('.reservation_resource_feedback').text('').hide(0);
            });
        })
    </script>
    <script>
        const app = new Vue({
            el : '#app',
            data : {
                desk_queue_uuid : '{{ ($currentDeskQueueNumber)? $currentDeskQueueNumber->uuid : '' }}',
                active_btn : {{ ($currentDeskQueueNumber)? 'true' : 'false' }},
                waiting_time : '{{ ($currentDeskQueueNumber)? nice_time($currentDeskQueueNumber->created_at) : '00:00' }}',
                done_status: false,
                skip_status: false,
                reservation_resource: '',
                serial: '-',
                patient: '-',
                doctor: '-',
                clinic: '-',
            },
            methods : {
                // Buttons
                checkReservationExists(){
                    addLoader('.current-queue-div');
                    if (this.reservation_resource.length > 0){
                        var url = '{{ url('dashboard') }}/desk/reservation/' + this.reservation_resource + '/check';

                        axios.get(url)
                            .then((response) => {
                                if(response.data.message.msg_status != 0){
                                    $('.get-patient-data').show(0);
                                    $('.get-patient-data').html(response.data.view);

                                    if(Object.keys(response.data.messages).length > 0){
                                        // Loop
                                        for (var message in response.data.messages) {
                                            if(response.data.messages[message].msg_status == 0){
                                                addAlert('danger', response.data.messages[message].text, 1);
                                            }else if (response.data.messages[message].msg_status == 2){
                                                addAlert('warning', response.data.messages[message].text, 1);
                                            }
                                        }
                                    }else{
                                        $('#reservation_resource').removeClass('is-invalid');
                                        $('.reservation_resource_feedback').text('').hide(0);
                                    }

                                    removeLoarder();
                                }else{
                                    $('.get-patient-data').hide(0);
                                    $('#reservation_resource').addClass('is-invalid');
                                    $('.reservation_resource_feedback').text(response.data.message.text).show(0);

                                    removeLoarder();
                                }

                            })
                            .catch((data) => {
                                removeLoarder();
                                // addAlert('danger', 'Server Error!');
                                console.log(data);
                                $('#reservation_resource').removeClass('is-invalid');
                                $('.reservation_resource_feedback').text('').hide(0);
                            });

                    }else {
                        removeLoarder();
                        $('#reservation_resource').addClass('is-invalid');
                        $('.reservation_resource_feedback').text('Enter reservation serial').show(0);
                    }
                },
                confirmDoneOrDoneAndNext(reservation_resource){
                    this.reservation_resource = reservation_resource;

                    if(this.done_status == true){
                        this.done();
                    }
                    else if(this.done_status == false){
                        this.doneAndNext();
                    }

                    this.reservation_resource = '';
                    $('.get-patient-data').html('');
                    $('.get-patient-data').hide(0);

                    $('.confirm-done-close').trigger('click');
                },

                next(){
                    addLoader('.current-queue-div');
                    var url = '{{ route('desks.queues.callNextQueueNumber', $desk->uuid) }}';
                    axios.get(url)
                        .then((response) => {

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);

                                $('.current-queue').text(response.data.nextQueue.queue_number);
                                this.desk_queue_uuid = response.data.nextQueue.uuid;
                                this.waiting_time = response.data.waitingTime;
                                this.active_btn = true;

                            }else{
                                if(response.data.haveWaiting === 0){
                                    console.log(response);
                                    addAlert('danger', 'No Queue Found');
                                }else{
                                    addAlert('danger', response.data.message.text);
                                }
                            }

                            removeLoarder();

                        })
                        .catch((data) => {
                            removeLoarder();
                            addAlert('danger', data, 1);
                        });
                },
                call(){
                    addLoader('.current-queue-div');
                    var url = '{{ route('desks.queues.callNextQueueNumberAgain', $desk->uuid) }}';
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
                    var url = '{{ url('dashboard') }}/desk/{{$desk->uuid}}/' + this.desk_queue_uuid + '/skip';
                    axios.get(url)
                        .then((response) => {

                            $('#count-skip').text(response.data.deskQueuesSkip);
                            $('#count-done').text(response.data.deskQueuesDone);

                            $('.current-queue').text('-');
                            this.active_btn = false;

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
                    var url = '{{ url('dashboard') }}/desk/{{$desk->uuid}}/' + this.desk_queue_uuid + '/skip-and-next';
                    axios.get(url)
                        .then((response) => {
                            $('.current-queue').text(response.data.nextQueue.queue_number);
                            $('#count-skip').text(response.data.deskQueuesSkip);
                            $('#count-done').text(response.data.deskQueuesDone);
                            this.desk_queue_uuid = response.data.nextQueue.uuid;
                            this.waiting_time = response.data.waitingTime;
                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }

                            if(response.data.haveWaiting == 0){
                                $('.current-queue').text('-');
                                this.active_btn = false;
                            }

                            $('.confirm-done-close').trigger('click');
                        })
                        .catch((data) => {
                            removeLoarder();
                        });
                },

                done(){
                    addLoader('.current-queue-div');
                    var url = '{{ url('dashboard') }}/desk/{{$desk->uuid}}/' + this.desk_queue_uuid + '/' + this.reservation_resource + '/done';
                    axios.get(url)
                        .then((response) => {
                            $('.current-queue').text('-');

                            $('#count-skip').text(response.data.deskQueuesSkip);
                            $('#count-done').text(response.data.deskQueuesDone);

                            this.active_btn = false;

                            removeLoarder();

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }

                            $('.confirm-done-close').trigger('click');
                        })
                        .catch((data) => {
                            removeLoarder();
                            // addAlert('danger', 'Server Error!');
                        });

                    console.log('done');
                },
                doneAndNext(){
                    addLoader('.current-queue-div');
                    var url = '{{ url('dashboard') }}/desk/{{$desk->uuid}}/' + this.desk_queue_uuid + '/' + this.reservation_resource + '/done-and-next';
                    axios.get(url)
                        .then((response) => {

                            if(response.data.message.msg_status == 1){
                                addAlert('success', response.data.message.text);
                            }else{
                                addAlert('danger', response.data.message.text);
                            }

                            if(response.data.haveWaiting == 0){
                                $('.current-queue').text('-');
                                this.waiting_time = '-';
                                this.active_btn = false;
                            }else {
                                $('.current-queue').text(response.data.nextQueue.queue_number);
                                $('#count-skip').text(response.data.deskQueuesSkip);
                                $('#count-done').text(response.data.deskQueuesDone);
                                this.desk_queue_uuid = response.data.nextQueue.uuid;
                                this.waiting_time = response.data.waitingTime;
                            }

                            removeLoarder();
                            $('.confirm-done-close').trigger('click');
                        })
                        .catch((data) => {
                            removeLoarder();
                            addAlert('danger', data);
                        });

                    console.log('done and next');
                },

                callSkippedAgain(skipped_queue_uuid){
                    addLoader();
                    var url = '{{ url('dashboard') }}/desk/{{$desk->uuid}}/' + skipped_queue_uuid + '/call-skipped';
                    axios.get(url)
                        .then((response) => {
                            removeLoarder();

                            $('.current-queue').text(response.data.skippedQueue.queue_number);

                            this.desk_queue_uuid = response.data.skippedQueue.uuid;
                            this.waiting_time = response.data.waitingTime;
                            this.active_btn = true;

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

                // Websockets
                listen(){
                    Echo.channel('available-desk-queue-{{ $desk->area_id }}')
                        .listen('QueueStatus', (response) => {
                            $('#all-queues').html('');
                            $('#all-queues').append(response.view);
                        });
                },

                // Configs
                changeBtn(type){
                    if(type == 'done'){
                        this.done_status = true;
                    }
                    else if(type == 'doneandnext'){
                        this.done_status = false;
                    }
                    else if(type == 'skip'){
                        this.skip_status = true;
                    }
                    else if(type == 'skipandnext'){
                        this.skip_status = false;
                    }
                },
                searchFunction(){
                    var value = $(this).val();

                    $("#searchTable tbody tr").each(function(index) {
                        if (index != 0) {

                            $row = $(this);

                            var id = $row.find("td:first").text();

                            if (id.indexOf(value) != 0) {
                                $(this).hide();
                            }
                            else {
                                $(this).show();
                            }
                        }
                    });
                }
            },
            mounted() {
                this.listen();
            }
        });

        $('body').on('click','.data-reservation' ,function () {
            var data_reservation = $(this).attr('id');

            app.confirmDoneOrDoneAndNext(data_reservation);
        });

        function callSkippedAgain(skipped_queue_uuid){
            addLoader();
            var url = '{{ url('dashboard') }}/desk/{{$desk->uuid}}/' + skipped_queue_uuid + '/call-skipped';

            // Get contents
            $.ajax({
                method:'GET',
                url:url,
                beforeSend:function () {
                    addLoader();
                },
                success:function (response) {

                    $('.current-queue').text(response.skippedQueue.queue_number);

                    app.desk_queue_uuid = response.skippedQueue.uuid;
                    app.waiting_time = response.waitingTime;
                    app.active_btn = true;

                    if(response.message.msg_status == 1){
                        addAlert('success', response.message.text);
                    }else{
                        addAlert('danger', response.message.text);
                    }

                    removeLoarder();
                },
                error:function () {

                }
            });
        }
    </script>
@endsection
