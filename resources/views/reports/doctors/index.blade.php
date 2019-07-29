@extends('_layouts.dashboard')

@section('title') Doctors Reports @endsection

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

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Doctors Reports</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the login users and rooms.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
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
                            <td>{{ $user->room->name_en }}</td>
                            <td>{{ getDoctorReport($user, config('vars.room_queue_status.called')) }}</td>
                            <td>{{ getDoctorReport($user, config('vars.room_queue_status.skipped')) }}</td>
                            <td>{{ getDoctorReport($user, config('vars.room_queue_status.patient_in')) }}</td>
                            <td>{{ getDoctorReport($user, config('vars.room_queue_status.patient_out')) }}</td>
                            <td>{{ (getCurrentDoctorReport($user))? 'Serving queue ' . getCurrentDoctorReport($user)->queue_number : '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection