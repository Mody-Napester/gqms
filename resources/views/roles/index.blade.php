@extends('_layouts.dashboard')

@section('title') Roles @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">Roles</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Roles</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <!-- Create new -->
                <h4 class="m-t-0 header-title">Create new Role</h4>
                <p class="text-muted font-14 m-b-30">
                    Create new resource from here.
                </p>

                @include('roles.create')
            </div>
        </div>
        <!-- end card-box -->
        </div>
    <!-- end row -->


    <div class="row">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Roles</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table data-page-length='50' id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Permissions</th>
                            <th>Created by</th>
                            <th>Updated by</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Control</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($resources as $resource)
                            <tr>
                                <td>{{ $resource->id }}</td>
                                <td>
                                    <span class="label {{ $resource->class }}">{{ $resource->name }}</span>
                                </td>
                                <td>
                                    @foreach($resource->permissions as $permission)
                                        <span class="label label-default">{{ \App\PermissionGroup::getBy('id', $permission->pivot->permission_group_id)->name }}.{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $resource->createdBy->name }}</td>
                                <td>{{ $resource->updatedBy->name }}</td>
                                <td>{{ $resource->created_at }}</td>
                                <td>{{ $resource->updated_at }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', [$resource->uuid]) }}" class="update-modal btn btn-sm btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('roles.destroy', [$resource->uuid]) }}" class="confirm-delete btn btn-sm btn-danger">
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