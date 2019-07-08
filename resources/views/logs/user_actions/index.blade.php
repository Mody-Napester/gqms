@extends('_layouts.dashboard')

@section('title') User Actions Log @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">User Actions Log</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">User Actions Log</li>
            </ol>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All User Actions Logs</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the user actions done on the system.
                </p>

                <table data-page-length='50' id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Method</th>
                        <th>URL</th>
                        <th>Created at</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->method }}</td>
                            <td>{{ $log->url }}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection