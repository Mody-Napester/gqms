@extends('_layouts.dashboard')

@section('title') Users @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="#goToAll" class="btn btn-default waves-effect waves-light">Show All
                    <i class="fa fa-fw fa-arrow-down"></i></a>
            </div>

            <h4 class="page-title">Users</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>

        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="nav-item">
                    <a href="#searchResource" data-toggle="tab" aria-expanded="false" class="nav-link active">Search & filter</a>
                </li>
                <li class="nav-item">
                    <a href="#createResource" data-toggle="tab" aria-expanded="true" class="nav-link">Create new</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="searchResource">
                    <h4 class="header-title m-t-0">Search all users</h4>
                    <p class="text-muted font-14 m-b-20">
                        Search on resource from here.
                    </p>

                    @include('users.search')

                </div>
                <div class="tab-pane" id="createResource">
                    <h4 class="m-t-0 header-title">Create new user</h4>
                    <p class="text-muted font-14 m-b-30">
                        Create new resource from here.
                    </p>

                    @include('users.create')
                </div>
            </div>
        </div>
        <!-- end card-box -->
    </div>

    {{--<div class="row">--}}
        {{--<div class="col-lg-12">--}}
            {{--<div class="portlet">--}}
                {{--<div class="portlet-heading bg-primary">--}}
                    {{--<h3 class="portlet-title">--}}
                        {{--<i class="ti-user"></i> Create new User--}}
                    {{--</h3>--}}

                    {{--<div class="portlet-widgets">--}}
                        {{--<a data-toggle="collapse" data-parent="#accordion1" href="#bg-default" class=""--}}
                           {{--aria-expanded="true"><i class="ion-minus-round"></i></a>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div id="bg-default" class="panel-collapse collapse show" style="">--}}
                    {{--<div class="portlet-body">--}}
                        {{--@include('users.create')--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<!-- end card-box -->--}}
    {{--</div>--}}
    {{--<!-- end row -->--}}


    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title">All Users</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table style="max-height: 600px;" data-page-length='50' id="datatable-users-buttons" class="table table-responsive table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Speciality</th>
                        <th>Type</th>
                        <th>Roles</th>
                        <th>Created by</th>
                        <th>Updated by</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Reset</th>
                        <th>Control</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->status == 0)
                                    <span class="badge badge-danger"><i class="fa fa-fw fa-lock"></i></span>
                                @else
                                    <span class="badge badge-success"><i class="fa fa-fw fa-unlock"></i></span>
                                @endif
                            </td>
                            <td>
                                @if($user->type == 1)
                                    @if($user->doctor)
                                        {{ ($user->doctor->speciality)? $user->doctor->speciality->name_en : '-'}}
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ \App\Enums\UserTypes::$types[$user->type] }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="label {{ $role->class }}">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>{!! ($user->createdBy)? $user->createdBy->name : '<span class="badge badge-danger">SYSTEM</span>' !!}</td>
                            <td>{!! ($user->updatedBy)? $user->updatedBy->name : '<span class="badge badge-danger">SYSTEM</span>' !!}</td>
                            <td>{{ $user->created_at->addHour(2) }}</td>
                            <td>{{ $user->updated_at->addHour(2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('users.reset_password', [$user->uuid]) }}"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-recycle"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', [$user->uuid]) }}"
                                   class="update-modal btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                {{--<a href="{{ route('users.destroy', [$user->uuid]) }}"--}}
                                   {{--class="confirm-delete btn btn-sm btn-danger">--}}
                                    {{--<i class="fa fa-times"></i>--}}
                                {{--</a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <br>

                @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="clearfix">
                        <div class="float-left">Pages numbers</div>
                        <div class="float-right">{{ $users->appends($_GET)->links() }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

@section('scripts')
    <script>
        {{--const app = new Vue({--}}
            {{--el: '#app',--}}
            {{--data: {--}}
                {{--email: '',--}}
                {{--name: '',--}}
                {{--phone: '',--}}
                {{--password: '',--}}
                {{--status: '',--}}
                {{--type: '',--}}
                {{--roles: [],--}}
            {{--},--}}
            {{--methods: {--}}
                {{--// Submit--}}
                {{--createNew() {--}}
                    {{--addLoader('.current-queue-div');--}}
                    {{--var url = '{{ route('desks.queues.callNextQueueNumber', $desk->uuid) }}';--}}
                    {{--axios.post(url)--}}
                        {{--.then((response) => {--}}
                            {{--console.log(response.data);--}}

                            {{--removeLoarder();--}}

                            {{--if (response.data.message.msg_status == 1) {--}}
                                {{--addAlert('success', response.data.message.text);--}}
                            {{--} else {--}}
                                {{--addAlert('danger', response.data.message.text);--}}
                            {{--}--}}
                        {{--})--}}
                        {{--.catch((data) => {--}}
                            {{--console.log(data);--}}
                            {{--removeLoarder();--}}
                        {{--});--}}
                {{--},--}}
            {{--}--}}
        {{--});--}}

        var tableDTUsers = $('#datatable-users-buttons').DataTable({
            lengthChange: false,
            buttons: [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 5, 6, 7, 8, 9, 10]
                    }
                }
        ],
        });
        tableDTUsers.buttons().container().appendTo('#datatable-users-buttons_wrapper .col-md-6:eq(0)');

    </script>
@endsection
