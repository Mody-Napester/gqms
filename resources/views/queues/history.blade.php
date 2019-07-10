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
                {{--<h4 class="m-t-0 header-title">All Queues History</h4>--}}
                {{--<p class="text-muted font-14 m-b-30">--}}
                {{--Here you will find all the resources to make actions on them.--}}
                {{--</p>--}}

                <table data-page-length='50' id="datatable" class="text-center vertical-middle table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead style="background-color: #dddddd;">
                    <tr>
                        <th colspan="2">Queue Numbers</th>
                        <th colspan="3">Served With</th>
                        <th rowspan="2">Reservation</th>
                        <th colspan="2">Attend Date</th>
                        <th colspan="2">Take Time (HH:MM:SS)</th>
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
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($deskQueues as $deskQueue)
                        <tr>
                            <td>{{ $deskQueue->queue_number }}</td>
                            <td>{{ ($deskQueue->reservation) ? $deskQueue->reservation->source_queue_number : '-' }}</td>


                            <td>{{ ($deskQueue->desk)? $deskQueue->desk->name_en : '' }}</td>
                            <td>{{ ($deskQueue->reservation && $deskQueue->reservation->roomQueue) ? $deskQueue->reservation->roomQueue->room->name_en : '-' }}</td>
                            <td>
                                @if($deskQueue->reservation && $deskQueue->reservation->roomQueue)
                                    @if($deskQueue->reservation->roomQueue->room)
                                        @if($deskQueue->reservation->roomQueue->room->user)
                                            {{  $deskQueue->reservation->roomQueue->room->user->doctor->name_en }}
                                        @else
                                            {{ '-' }}
                                        @endif
                                    @else
                                        {{ '-' }}
                                    @endif
                                @else
                                    {{ '-' }}
                                @endif
                            </td>
                            <td>{{ ($deskQueue->reservation) ? $deskQueue->reservation->source_reservation_serial : '-' }}</td>

                            <td>{{ $deskQueue->created_at }}</td>
                            <td>{{ ($deskQueue->reservation && $deskQueue->reservation->roomQueue) ? $deskQueue->reservation->roomQueue->created_at : '-' }}</td>

                            <td>
                                @if($deskQueue->status == config('vars.desk_queue_status.done'))
                                    {{ getDeskQueuePatientServeTime($deskQueue) }}
                                @else
                                    00:00:00
                                @endif
                            </td>

                            <td>
                                @if(($deskQueue->reservation && $deskQueue->reservation->roomQueue))
                                    @if($deskQueue->reservation->roomQueue->status == config('vars.desk_queue_status.patient_out'))
                                        {{ getRoomQueuePatientServeTime($deskQueue->reservation->roomQueue) }}
                                    @endif
                                @else
                                    00:00:00
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
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection