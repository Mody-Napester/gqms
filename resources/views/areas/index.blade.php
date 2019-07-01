@extends('_layouts.dashboard')

@section('title') Reception Areas @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="#goToAll" class="btn btn-default waves-effect waves-light">Show All <i class="fa fa-fw fa-arrow-down"></i></a>
            </div>

            <h4 class="page-title">Reception Areas</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Areas</a></li>
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
                    <h4 class="header-title m-t-0">Search</h4>
                    <p class="text-muted font-14 m-b-20">
                        Search on resource from here.
                    </p>

                    @include('areas.search')

                </div>
                <div class="tab-pane" id="createResource">
                    <h4 class="m-t-0 header-title">Create new Reception Area</h4>
                    <p class="text-muted font-14 m-b-30">
                        Create new resource from here.
                    </p>

                    @include('areas.create')
                </div>
            </div>
        </div>
        <!-- end card-box -->
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Areas</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name ar</th>
                            <th>Name en</th>
                            <th>Floor</th>
                            <th>Speciality</th>
                            <th>Status</th>
                            <th>Created by</th>
                            <th>Updated by</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Control</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <td>{{ $area->id }}</td>
                                <td>{{ $area->name_ar }}</td>
                                <td>{{ $area->name_en }}</td>
                                <td>{{ $area->floor->name_en }}</td>
                                <td>
                                    @foreach($area->specialities as $speciality)
                                        <span class="badge badge-warning">{{ $speciality->name_en }}</span>
                                    @endforeach
                                </td>
                                <td>{{ App\Enums\AreaStatuses::$statuses[$area->status]['en'] }}</td>
                                <td>{{ $area->createdBy->name }}</td>
                                <td>{{ $area->updatedBy->name }}</td>
                                <td>{{ $area->created_at }}</td>
                                <td>{{ $area->updated_at }}</td>
                                <td>
                                    <a href="{{ route('areas.edit', [$area->uuid]) }}" class="update-modal btn btn-sm btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('areas.destroy', [$area->uuid]) }}" class="confirm-delete btn btn-sm btn-danger">
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