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
                   href="{{ route('queues.queuesHistory') }}">Remove search <i class="fa fa-fw fa-close"></i></a>
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

                @include('queues._search')
            </div>
        </div>
        <!-- end card-box -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Queues History</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the Queues History.
                </p>

                <table data-page-length='50' id="datatable-history-buttons"
                       class="text-center vertical-middle table table-striped table-bordered table-sm" cellspacing="0"
                       width="100%">
                    <thead style="background-color: #dddddd;">
                    <tr>
                        <th colspan="2">Queue Numbers</th>
                        <th colspan="3">Served With</th>
                        <th rowspan="2">Reservation</th>
                        {{--<th rowspan="2">Desk Abuse</th>--}}
                        <th colspan="2">Attend Time</th>
                        <th colspan="2">Call Time</th>
                        <th colspan="2">Waiting Time</th>
                        <th rowspan="2">Patient in</th>
                        <th colspan="2">Done Time</th>
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

                        <th>Desk</th>
                        <th>Doctor</th>

                        <th>Desk</th>
                        <th>Doctor</th>
                    </tr>
                    </thead>

                    <tbody>
                        {!! $queuesListsView !!}
                    </tbody>
                </table>
            </div>

            <div class="clearfix">
                <div class="float-left">Pages numbers</div>
                <div class="float-right">{{ $deskQueues->links() }}</div>
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