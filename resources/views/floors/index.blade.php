@extends('_layouts.dashboard')

@section('title') {{ trans('floors.Floors') }} @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="#goToAll" class="btn btn-default waves-effect waves-light">{{ trans('floors.Show_All') }} <i class="fa fa-fw fa-arrow-down"></i></a>
            </div>

            <h4 class="page-title">{{ trans('floors.Floors') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">{{ trans('floors.Floors') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('floors.Index') }}</li>
            </ol>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="nav-item">
                    <a href="#searchResource" data-toggle="tab" aria-expanded="false" class="nav-link active">{{ trans('floors.Search_filter') }}</a>
                </li>
                <li class="nav-item">
                    <a href="#createResource" data-toggle="tab" aria-expanded="true" class="nav-link">{{ trans('floors.Create_new') }}</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="searchResource">
                    <h4 class="header-title m-t-0">{{ trans('floors.Search') }}</h4>
                    <p class="text-muted font-14 m-b-20">
                        Search on resource from here.
                    </p>

                    @include('floors.search')

                </div>
                <div class="tab-pane" id="createResource">
                    <h4 class="m-t-0 header-title">{{ trans('floors.Create_new_Floor') }}</h4>
                    <p class="text-muted font-14 m-b-30">
                        Create new resource from here.
                    </p>

                    @include('floors.create')
                </div>
            </div>
        </div>
        <!-- end card-box -->
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">{{ trans('floors.All_Floors') }}</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table data-page-length='50' id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name ar</th>
                            <th>Name en</th>
                            <th>Status</th>
                            <th>Created by</th>
                            <th>Updated by</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Control</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($floors as $floor)
                            <tr>
                                <td>{{ $floor->id }}</td>
                                <td>{{ $floor->name_ar }}</td>
                                <td>{{ $floor->name_en }}</td>
                                <td>{{ App\Enums\FloorStatuses::$statuses[$floor->status]['en'] }}</td>
                                <td>{{ $floor->createdBy->name }}</td>
                                <td>{{ $floor->updatedBy->name }}</td>
                                <td>{{ $floor->created_at }}</td>
                                <td>{{ $floor->updated_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('floors.edit', [$floor->uuid]) }}" class="update-modal btn btn-sm btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    {{--<a href="{{ route('floors.destroy', [$floor->uuid]) }}" class="confirm-delete btn btn-sm btn-danger">--}}
                                        {{--<i class="fa fa-times"></i>--}}
                                    {{--</a>--}}
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