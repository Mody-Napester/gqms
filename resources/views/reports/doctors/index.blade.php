@extends('_layouts.dashboard')

@section('title') Doctors Reports @endsection

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
            <h4 class="page-title">Doctors Reports</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">Doctors Reports</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">Search and filter</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you can filter and search.
                </p>

                @include('reports.doctors._search')
            </div>
        </div>
        <!-- end card-box -->
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Doctors Reports</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the login users and rooms.
                </p>

                <table data-page-length='50' id="datatable-history-buttons" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Room</th>
                        <th>Called</th>
                        <th>Skipped</th>
                        <th>Patient in</th>
                        <th>Patient out</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ ($user->room)? $user->room->name_en : '-' }}</td>
                            <td>{{ getDoctorReport($user, config('vars.room_queue_status.called'), 1) }}</td>
                            <td>{{ getDoctorReport($user, config('vars.room_queue_status.skipped'), 1) }}</td>
                            <td>{{ getDoctorReport($user, config('vars.room_queue_status.patient_in'), 1) }}</td>
                            <td>{{ getDoctorReport($user, config('vars.room_queue_status.patient_out'), 1) }}</td>
                            <td>{{ (getCurrentDoctorReport($user))? 'Serving queue ' . getCurrentDoctorReport($user)->queue_number : '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="clearfix">
                <div class="float-left">Pages numbers</div>
                <div class="float-right">{{ $users->links() }}</div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        var tableDTUsers = $('#datatable-history-buttons').DataTable({
            lengthChange: false,
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                }
            ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-history-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection