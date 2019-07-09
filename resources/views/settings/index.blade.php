@extends('_layouts.dashboard')

@section('title') Settings @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Settings</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">Settings</li>
            </ol>
        </div>
    </div>

    <div class="row" id="goToAll">
        <div class="col-lg-12">
            <div class="card-box table-responsive">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="m-t-0 header-title">Reset reservations</h4>
                        <p class="text-muted font-14 m-b-30">
                            Clear all queues and link with reservations.
                        </p>
                        <a href="{{ route('resetQueues') }}" data-general-confirm-header="Reset reservations"
                           data-general-confirm-message="Are you sure you want to clear all reservations?"
                           class="general-confirm btn btn-danger waves-effect">
                            <i class="fa fa-fw fa-refresh"></i> <span> Reset Queues </span>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <h4 class="m-t-0 header-title">Logout users</h4>
                        <p class="text-muted font-14 m-b-30">
                            Logout desks and doctors from the system.
                        </p>
                        <a href="{{ route('auth.logoutUsers') }}" data-general-confirm-header="Logout users"
                           data-general-confirm-message="Are you sure you want to logout all desks and doctors from the system?"
                           class="general-confirm btn btn-danger waves-effect">
                            <i class="fa fa-fw fa-sign-out"></i> <span> Logout users </span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection