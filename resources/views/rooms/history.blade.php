@extends('_layouts.dashboard')

@section('title') Desk Queue History @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Desk Queue History</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Desks</a></li>
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

                @include('desks._desk_queue_history_filter')
            </div>
        </div>
        <!-- end card-box -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Desks</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Queue</th>
                            <th>Floor</th>
                            <th>Current Desk</th>
                            <th>Current Status</th>
                            <th>Created at</th>
                            <th class="text-center">History</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($deskQueues as $deskQueue)
                            <tr>
                                <td>{{ $deskQueue->queue_number }}</td>
                                <td>{{ $deskQueue->floor->name_en }}</td>
                                <td>{{ ($deskQueue->desk)? $deskQueue->desk->name_en : '' }}</td>
                                <td>
                                    <span class="label {{ $deskQueue->queueStatus->class }}">
                                        {{ $deskQueue->queueStatus->name_en }}
                                    </span>
                                </td>
                                <td>{{ $deskQueue->created_at }}</td>
                                <td class="text-center">
                                    @if($deskQueue->status != config('vars.desk_queue_status.waiting'))
                                        <a href="{{ route('desks.queues.deskQueueSingleHistory', [$deskQueue->uuid]) }}" class="btn history-modal btn-warning waves-effect" style="padding: 0.3em .6em;font-size: 75%;font-weight: 700;line-height: 1;">Show</a>
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