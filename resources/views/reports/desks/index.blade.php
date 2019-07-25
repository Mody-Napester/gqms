@extends('_layouts.dashboard')

@section('title') Desks Reports @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Desks Reports</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">Desks Reports</li>
            </ol>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Desks Reports</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the login users and desks.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Desk</th>
                        <th>Called</th>
                        <th>Skipped</th>
                        <th>Done</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->desk->name_en }}</td>
                            <td>{{ getDeskReport($user, config('vars.desk_queue_status.called')) }}</td>
                            <td>{{ getDeskReport($user, config('vars.desk_queue_status.skipped')) }}</td>
                            <td>{{ getDeskReport($user, config('vars.desk_queue_status.done')) }}</td>
                            <td>{{ (getCurrentDeskReport($user))? 'Serving queue ' . getCurrentDeskReport($user)->queue_number : '-' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection