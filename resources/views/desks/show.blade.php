@extends('_layouts.dashboard')

@section('title') {{ $desk->name_en }} @endsection

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
                                    <h4 class="m-t-0 m-b-5"><b>{{ $desk->name_en }}</b></h4>
                                    <h5 class="text-muted m-b-0 m-t-0">{{ $desk->floor->name_en }}</h5>
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
                                    <h4 class="m-t-0 m-b-5"><b id="count-done">{{ $deskQueuesDone }}</b></h4>
                                    <h5 class="text-muted m-b-0 m-t-0">Done</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="current-queue-div card-box">
                <h4 class="m-t-0 m-b-20 header-title">
                    <b>Current Serving Queue</b>
                    <b class="pull-right">Waiting : <span class="waitingTime">@{{ waiting_time }}</span></b>
                </h4>

                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="current-queue" id="current-queue">{{ ($currentDeskQueueNumber)? $currentDeskQueueNumber->queue_number : '-' }}</div>

                            <div class="row">
                                <div class="col-md-4">
                                    <button v-if="active_btn" @click.prevent="skip()" type="button" class="btn btn-block btn-danger waves-effect waves-light">
                                        Skip And Next <i class="fa fa-fw fa-close"></i>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button v-if="!active_btn" @click.prevent="next()" type="button" class="btn btn-block btn-primary waves-effect waves-light">
                                        Next <i class="fa fa-fw fa-arrow-right"></i>
                                    </button>
                                    <button v-if="active_btn" @click.prevent="call()" type="button" class="btn btn-block btn-warning waves-effect waves-light">
                                        Call Again <i class="fa fa-fw fa-refresh"></i>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button v-if="active_btn" @click.prevent="done()" type="button" class="btn btn-block btn-success waves-effect waves-light">
                                        Done And Next <i class="fa fa-fw fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4" id="all-queues">
            <div class="card-box">
                <h4 class="m-t-0 header-title">
                    <label for="">Today Queue ({{ count($deskQueues) }})</label>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <input class="form-control" type="text" id="searchInput" placeholder="Search ..">
                        </div>
                        <div class="col-md-6 pl-1">
                            <select class="form-control" id="searchSelect" style="height: 35px;">
                                <option value='All'>All</option>
                                <option value='Waiting'>Waiting</option>
                                <option value='Called'>Called</option>
                                <option value='Skipped'>Skipped</option>
                                <option value='Done'>Done</option>
                                <option value='Cell from skip'>Cell from skip</option>
                            </select>
                        </div>
                    </div>
                </h4>


                <div class="mx-box" style="overflow: auto;">
                    <table id="searchTable" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                        <tr>
                            <th>Queue</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                        @foreach($deskQueues as $deskQueue)
                            <tr>
                                <td>{{ $deskQueue->queue_number }}</td>
                                <td>
                                    <span class="label {{ $deskQueue->queueStatus->class }}">{{ $deskQueue->queueStatus->name_en }}</span>
                                </td>
                                <td>
                                    @if($deskQueue->queueStatus->id == 3)
                                        <button @click.prevent="callSkippedAgain()" class="btn btn-secondary waves-effect" style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">Call again</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
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
                desk_queue_uuid : '{{ ($currentDeskQueueNumber)? $currentDeskQueueNumber->uuid : '' }}',
                active_btn : {{ ($currentDeskQueueNumber)? 'true' : 'false' }},
                waiting_time : '{{ ($currentDeskQueueNumber)? nice_time($currentDeskQueueNumber->created_at) : '00:00' }}',
            },
            methods : {
                skip(){
                    addLoader();
                    var url = '{{ url('dashboard') }}/desk/{{$desk->uuid}}/' + this.desk_queue_uuid + '/skip';
                    axios.get(url)
                        .then((response) => {
                            console.log(response.data);
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
                        })
                        .catch((data) => {
                            console.log(0, data);
                            removeLoarder();
                        });
                },
                next(){
                    addLoader();
                    var url = '{{ route('desks.queues.callNextQueueNumber', $desk->uuid) }}';
                    axios.get(url)
                            .then((response) => {
                                console.log(response.data);
                                $('.current-queue').text(response.data.nextQueue.queue_number);

                                this.desk_queue_uuid = response.data.nextQueue.uuid;
                                this.waiting_time = response.data.waitingTime;
                                this.active_btn = true;

                                removeLoarder();

                                if(response.data.message.msg_status == 1){
                                    addAlert('success', response.data.message.text);
                                }else{
                                    addAlert('danger', response.data.message.text);
                                }
                            })
                            .catch((data) => {
                                console.log(0, data);
                                removeLoarder();
                            });
                },
                call(){
                    addLoader();
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
                                console.log(data);
                                removeLoarder();
                            });
                },
                callSkippedAgain(){
                    addLoader();
                    var url = '{{ url('dashboard') }}/desk/{{$desk->uuid}}/' + this.desk_queue_uuid + '/skip-again';
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
                                console.log(data);
                                removeLoarder();
                            });
                },
                done(){
                    addLoader();
                    var url = '{{ url('dashboard') }}/desk/{{$desk->uuid}}/' + this.desk_queue_uuid + '/done';
                    axios.get(url)
                        .then((response) => {
                            console.log(response.data);
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
                        })
                        .catch((data) => {
                            console.log(0, data);
                            removeLoarder();
                        });
                },
                listen(){
                    Echo.channel('available-desk-queue-{{ $desk->floor_id }}')
                        .listen('QueueStatus', (response) => {
                            console.log(response.view);
                            $('#all-queues').html(response.view);
                        });
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


    </script>
@endsection
