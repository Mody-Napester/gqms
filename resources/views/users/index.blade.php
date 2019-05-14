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
            <div class="portlet">
                <div class="portlet-heading bg-primary">
                    <h3 class="portlet-title">
                        <i class="ti-user"></i> Create new User
                    </h3>

                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default" class=""
                           aria-expanded="true"><i class="ion-minus-round"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-default" class="panel-collapse collapse show" style="">
                    <div class="portlet-body">
                        @include('users.create')
                    </div>
                </div>
            </div>
        </div>
        <!-- end card-box -->
    </div>
    <!-- end row -->


    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Users</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Created by</th>
                        <th>Updated by</th>
                        <th>Created at</th>
                        <th>Updated at</th>
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
                                @foreach($user->roles as $role)
                                    <span class="label {{ $role->class }}">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $user->createdBy->name }}</td>
                            <td>{{ $user->updatedBy->name }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <a href="{{ route('users.edit', [$user->uuid]) }}"
                                   class="update-modal btn btn-sm btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('users.destroy', [$user->uuid]) }}"
                                   class="confirm-delete btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

{{--@section('scripts')--}}
{{--<script>--}}
{{--const app = new Vue({--}}
{{--el : '#app',--}}
{{--data : {--}}
{{--email: '',--}}
{{--name: '',--}}
{{--phone: '',--}}
{{--password: '',--}}
{{--status: '',--}}
{{--type: '',--}}
{{--roles: [],--}}
{{--},--}}
{{--methods : {--}}
{{--// Submit--}}
{{--createNew(){--}}
{{--addLoader('.current-queue-div');--}}
{{--var url = '{{ route('desks.queues.callNextQueueNumber', $desk->uuid) }}';--}}
{{--axios.post(url)--}}
{{--.then((response) => {--}}
{{--console.log(response.data);--}}

{{--removeLoarder();--}}

{{--if(response.data.message.msg_status == 1){--}}
{{--addAlert('success', response.data.message.text);--}}
{{--}else{--}}
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
{{--</script>--}}
{{--@endsection--}}
