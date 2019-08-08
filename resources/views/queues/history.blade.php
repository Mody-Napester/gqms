@extends('_layouts.dashboard')

@section('title') Queues History @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Queues History</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Queues History</a></li>
                <li class="breadcrumb-item active">History</li>
            </ol>

        </div>
    </div>

    {{--<div class="row">--}}
    {{--<div class="col-lg-12">--}}
    {{--<div class="card-box">--}}
    {{--<h4 class="m-t-0 header-title">Search and filter</h4>--}}
    {{--<p class="text-muted font-14 m-b-30">--}}
    {{--Here you can filter and search on desk queues.--}}
    {{--</p>--}}

    {{--@include('desks._desk_queue_history_filter')--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<!-- end card-box -->--}}
    {{--</div>--}}

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Queues History</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the Queues History.
                </p>

                <table data-page-length='50' id="datatable-history-buttons" class="text-center vertical-middle table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead style="background-color: #dddddd;">
                    <tr>
                        <th colspan="2">Queue Numbers</th>
                        <th colspan="3">Served With</th>
                        <th rowspan="2">Reservation</th>
                        <th rowspan="2">Desk Abuse</th>
                        <th colspan="2">Attend Time</th>
                        <th colspan="2">Waiting Time</th>
                        <th colspan="2">Serve Time</th>
                        <th rowspan="2" class="text-center">History</th>
                    </tr>
                    <tr>
                        <th>Desk</th>
                        <th>Doctor</th>

                        <th>Desk</th>
                        <th>Room</th>
                        <th>Doctor</th>

                        <th>Desk</th>
                        <th>Doctor</th>

                        <th>Desk</th>
                        <th>Doctor</th>

                        <th>Desk</th>
                        <th>Doctor</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($deskQueues as $deskQueue)
                        <?php
                        if($deskQueue->reservation){
                            $roomQueue =\App\RoomQueue::where('reservation_source_serial', $deskQueue->reservation->source_reservation_serial)->first();
                        }
                        ?>
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

                            <td>
                                @if($deskQueue->reservation)
                                    <span class="badge badge-success">No</span>
                                @else
                                    <span class="badge badge-danger">Yes</span>
                                @endif
                            </td>

                            <td>{{ $deskQueue->created_at->addHour(2) }}</td>

                            <td>
                                {{ (isset($roomQueue))? $roomQueue->created_at->addHour(2) : '-' }}
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
                                    <a href="{{ route('queues.queuesSingleHistory', [$deskQueue->uuid]) }}" class="btn history-modal btn-warning waves-effect" style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">Show</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $deskQueues->links() }}
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <script>
        var tableDTUsers = $('#datatable-history-buttons').DataTable({
            lengthChange: false,
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10]
                    }
                }
            ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-history-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection