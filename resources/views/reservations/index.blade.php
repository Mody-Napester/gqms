@extends('_layouts.dashboard')

@section('title') Reservations @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="" class="btn btn-danger waves-effect waves-light">Sync <i class="fa fa-fw fa-refresh"></i></a>
            </div>

            <h4 class="page-title">Reservations</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Reservations</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Reservations</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Clinic</th>
                            <th>Doctor</th>
                            <th>Desk queue</th>
                            <th>Serial</th>
                            <th>Patient</th>
                            <th>Queue number</th>
                            <th>Created at</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->clinic_id }}</td>
                                <td>{{ $reservation->doctor_id }}</td>
                                <td>{{ $reservation->desk_queue_id }}</td>
                                <td>{{ $reservation->source_reservation_serial }}</td>
                                <td>{{ ($reservation->patient)? $reservation->patient->name_en : '' }}</td>
                                <td>{{ $reservation->source_queue_number }}</td>
                                <td>{{ $reservation->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection