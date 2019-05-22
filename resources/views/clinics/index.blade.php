@extends('_layouts.dashboard')

@section('title') Clinics @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="" class="btn btn-danger waves-effect waves-light">Sync <i class="fa fa-fw fa-refresh"></i></a>
            </div>

            <h4 class="page-title">Clinics</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="#">Clinics</a></li>
                <li class="breadcrumb-item active">Index</li>
            </ol>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title">All Clinics</h4>
                <p class="text-muted font-14 m-b-30">
                    Here you will find all the resources to make actions on them.
                </p>

                <table id="datatable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Source clinic id</th>
                            <th>Name ar</th>
                            <th>Name en</th>
                            <th>Created at</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($clinics as $clinic)
                            <tr>
                                <td>{{ $clinic->id }}</td>
                                <td>{{ $clinic->source_clinic_id }}</td>
                                <td>{{ $clinic->name_ar }}</td>
                                <td>{{ $clinic->name_en }}</td>
                                <td>{{ $clinic->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection