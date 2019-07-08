@extends('_layouts.dashboard')

@section('title') User Login Log @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">User Login Log</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">User Login Log</li>
            </ol>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Login Users Logs</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the logs for user login.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Login ip</th>
                        <th>Browser</th>
                        <th>Platform</th>
                        <th>Login date</th>
                        {{--<th>logout_date_time</th>--}}
                        {{--<th>Created at</th>--}}
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->login_ip }}</td>
                            <td>{{ json_decode($log->login_data, true)['browser'] }}</td>
                            <td>{{ json_decode($log->login_data, true)['platform'] }}</td>
                            <td>{{ $log->login_date_time }}</td>
                            {{--<td>{{ $log->logout_date_time }}</td>--}}
{{--                            <td>{{ $log->created_at }}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection