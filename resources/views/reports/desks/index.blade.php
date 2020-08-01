@extends('_layouts.dashboard')

@section('title') Desks Reports @endsection

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
                   href="{{ route('reports.desks.index') }}">Remove search <i class="fa fa-fw fa-close"></i></a>
            </div>

            <h4 class="page-title">Desks Reports</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">Desks Reports</li>
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

                @include('reports.desks._search')
            </div>
        </div>
        <!-- end card-box -->
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Desks Reports</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the login users and desks.
                </p>

                <table data-page-length='50' id="datatable-history-buttons" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Current Desk</th>
                        <th>Called</th>
                        <th>Skipped</th>
                        <th>Done</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        @if(request()->has('show') && request()->show == 0)
                            @if(\App\DeskQueueStatus::where('user_id', $user->id)->where('created_at', 'like', "%".request()->date."%")->first())
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ ($user->desk)? $user->desk->name_en : '-' }}</td>
                                <td>{{ getDeskReport($user, config('vars.desk_queue_status.called'), $all, $date) }}</td>
                                <td>{{ getDeskReport($user, config('vars.desk_queue_status.skipped'), $all, $date) }}</td>
                                <td>{{ getDeskReport($user, config('vars.desk_queue_status.done'), $all, $date) }}</td>
                                <td>{{ (getCurrentDeskReport($user))? 'Serving queue ' . getCurrentDeskReport($user)->queue_number : '-' }}</td>
                            </tr>
                            @endif
                        @else
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ ($user->desk)? $user->desk->name_en : '-' }}</td>
                                <td>{{ getDeskReport($user, config('vars.desk_queue_status.called'), $all, $date) }}</td>
                                <td>{{ getDeskReport($user, config('vars.desk_queue_status.skipped'), $all, $date) }}</td>
                                <td>{{ getDeskReport($user, config('vars.desk_queue_status.done'), $all, $date) }}</td>
                                <td>{{ (getCurrentDeskReport($user))? 'Serving queue ' . getCurrentDeskReport($user)->queue_number : '-' }}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="clearfix">
                    <div class="float-left">Pages numbers</div>
                    <div class="float-right">{{ $users->links() }}</div>
                </div>
            @endif
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
                }
            ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-history-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection
