@extends('_layouts.dashboard')

@section('title') Queues History @endsection

@section('post_css')
    <style>
        #datatable-history-buttons_wrapper{
            padding: 0;
        }
    </style>
@endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a class="btn btn-danger waves-effect waves-light"
                   href="{{ route('queues.allQueuesHistory') }}">Remove search <i class="fa fa-fw fa-close"></i></a>
            </div>

            <h4 class="page-title">Queues History</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Queues History</a></li>
                <li class="breadcrumb-item active">History</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">Search and filter</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you can filter and search on desk queues.
                </p>

                @include('all_queue_history._search')
            </div>
        </div>
        <!-- end card-box -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box ">
                <h4 class="m-t-0 header-title">All Queues History</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the Queues History.
                </p>

                <table data-page-length='50' id="datatable-history-buttons"
                       class="text-center vertical-middle table-responsive table table-striped table-bordered table-sm" cellspacing="0"
                       width="100%">
                    <thead style="background-color: #dddddd;">
                    <tr>
                        <th colspan="7">Desk</th>
                        <th colspan="4">Reservation</th>
                        <th colspan="6">Room</th>
                        <th rowspan="2" class="text-center">History</th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <th>Abuse</th>
                        <th>Queue</th>
                        <th>Attend</th>
                        <th>Call</th>
                        <th>Done</th>
                        <th>Serve</th>

                        <th>ID</th>
                        <th>Patient ID</th>
                        <th>Time</th>
                        <th>Doctor</th>

                        <th>Name</th>
                        <th>Queue</th>
                        <th>Attend</th>
                        <th>Call</th>
                        <th>Done</th>
                        <th>Serve</th>
                    </tr>
                    </thead>

                    <tbody>

                        @foreach($histories as $history)
                            <tr>
                                <td>{{ ($d = \App\Desk::getBy('id', $history->desk_id))? $d->name_en : '-' }}</td>
                                <td>
                                    @if(isset($history->desk_id))
                                        <span class="badge badge-success">No</span>
                                    @else
                                        <span class="badge badge-danger">Yes</span>
                                    @endif
                                </td>
                                <td>{{ $history->desk_qn }}</td>
                                <td>
                                    @if(isset($history->desk_id))
                                        {{ \Carbon\Carbon::parse($history->d_created_at)->addHour(2) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(isset($history->desk_id))
                                        {{ getQueueActionTime($history->dq_id, 'desk', 'call') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(isset($history->desk_id))
                                        {{ getQueueActionTime($history->dq_id, 'desk', 'done') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(isset($history->desk_id))
                                        {{ getQueueServeTime($history->dq_id, 'desk') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ $history->source_reservation_serial }}</td>
                                <td>{{ $history->patientid }}</td>
                                <td>{{ $history->reservation_date_time }}</td>
                                <td>{{ ($doc = \App\Doctor::getBy('source_doctor_id', $history->res_doctor_id))? $doc->name_en : '-' }}</td>

                                <td>{{ ($r = \App\Room::getBy('id', $history->room_id))? $r->name_en : '-' }}</td>
                                <td>{{ $history->room_qn }}</td>
                                <td>
                                    @if(isset($history->room_id))
                                        {{ \Carbon\Carbon::parse($history->r_created_at)->addHour(2) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(isset($history->room_id))
                                        {{ getQueueActionTime($history->rq_id, 'room', 'call') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(isset($history->room_id))
                                        {{ getQueueActionTime($history->rq_id, 'room', 'done') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(isset($history->room_id))
                                        {{ getQueueServeTime($history->rq_id, 'room') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>
                                    @if(isset($history->d_uuid) && $history->d_status != config('vars.desk_queue_status.waiting'))
                                        <a href="{{ route('queues.queuesSingleHistory', [$history->d_uuid]) }}"
                                           class="btn history-modal btn-warning waves-effect"
                                           style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">Show</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <br>

                @if ($histories instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="clearfix">
                        <div class="float-left">Pages numbers</div>
                        <div class="float-right">{{ $histories->appends($_GET)->links() }}</div>
                    </div>
                @endif
            </div>

        </div>
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <script>
        var tableDTUsers = $('#datatable-history-buttons').DataTable({
            lengthChange: false,
            ordering: false,
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16]
                    }
                }
            ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-history-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection
