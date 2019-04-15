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

            <div class="card-box">
                <h4 class="m-t-0 m-b-20 header-title"><b>Current Serving Queue</b></h4>

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
                <h4 class="m-t-0 m-b-20 header-title"><b>Today Desk Queue ({{ count($deskQueues) }})</b></h4>

                <input type="text" id="myInput" v-on:keyup="myFunction()" placeholder="Search for names..">

                <div class="mx-box" style="overflow: auto;">
                    <table id="myTable" class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Queue</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($deskQueues as $deskQueue)
                                <tr>
                                    <th>{{ $deskQueue->queue_number }}</th>
                                    <th>
                                        <span class="label {{ $deskQueue->queueStatus->class }}">{{ $deskQueue->queueStatus->name_en }}</span>
                                    </th>
                                    <th>
                                        @if($deskQueue->queueStatus->id == 3)
                                            <button class="btn btn-secondary waves-effect" style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">Call again</button>
                                        @endif
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <script>
        const app = new Vue({
            el : '#app',
            data : {
                desk_queue_uuid : '{{ ($currentDeskQueueNumber)? $currentDeskQueueNumber->uuid : '' }}',
                active_btn : {{ ($currentDeskQueueNumber)? 'true' : 'false' }},
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
                // Search on table
                myFunction() {
                    // Declare variables
                    var input, filter, table, tr, td, i, txtValue;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");

                    // Loop through all table rows, and hide those who don't match the search query
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[0];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
            },
            mounted() {
                this.listen();
            }
        });
    </script>
@endsection
