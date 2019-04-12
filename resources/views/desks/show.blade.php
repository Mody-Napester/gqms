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
                                    <h4 class="m-t-0 m-b-5"><b>-</b></h4>
                                    <h5 class="text-muted m-b-0 m-t-0">Skip</h5>
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
                                    <h4 class="m-t-0 m-b-5"><b>-</b></h4>
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
                            <div class="current-queue">-</div>

                            <div class="row">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-block btn-danger waves-effect waves-light">
                                        Skip <i class="fa fa-fw fa-close"></i>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-block btn-primary waves-effect waves-light">
                                        Next <i class="fa fa-fw fa-arrow-right"></i>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-block btn-success waves-effect waves-light">
                                        Done <i class="fa fa-fw fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="m-t-0 m-b-20 header-title"><b>Today Desk Queue ({{ count($deskQueues) }})</b></h4>

                <div class="nicescroll mx-box">
                    <table class="table table-striped table-bordered table-sm text-center" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Queue</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($deskQueues as $deskQueue)
                                <tr>
                                    <th>{{ $deskQueue->queue_number }}</th>
                                    <th>
                                        <span class="label {{ $deskQueue->queueStatus->class }}">{{ $deskQueue->queueStatus->name_en }}</span>
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