@extends('_layouts.dashboard')

@section('title') {{ trans('dashboard.Dashboard') }} @endsection

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a class="btn btn-danger waves-effect waves-light" href="{{ route('dashboard.index') }}">{{ trans('dashboard.Get_Today') }}
                    Statistics <i class="fa fa-fw fa-bar-chart"></i></a>
            </div>

            <h4 class="page-title">{{ trans('dashboard.Dashboard') }}</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('dashboard.Dashboard') }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="portlet">
                <div class="portlet-heading bg-info">
                    <h3 class="portlet-title">
                        <i class="ti-search"></i> {{ trans('dashboard.Search_and_filter') }}
                    </h3>

                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default" class=""
                           aria-expanded="true"><i class="ion-minus-round"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="bg-default" class="panel-collapse collapse show" style="">
                    <div class="portlet-body">
                        @include('dashboard._filter')
                    </div>
                </div>
            </div>
        </div>
        <!-- end card-box -->
    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-md-12">
            <!-- Reservations -->
            @include('dashboard._reservations_stat')
        </div>

        <div class="col-md-7">
            <!-- Desk Queue Stata -->
        @include('dashboard._desk_queue_stat')

        <!-- Room Queue Stata -->
            @include('dashboard._room_queue_stat')
        </div>

        <div class="col-md-5">
            @include('dashboard._logged_in_users')
        </div>
    </div>


    <!-- Page-Title -->
    {{--<div class="row">--}}
    {{--<div class="col-sm-4">--}}
    {{--<h4 class="m-t-20 m-b-20">Today ({{ ($today_total_is == 0)? 0 : $today_total }})</h4>--}}

    {{--<div class="row">--}}
    {{--<div class="col-md-12">--}}
    {{--<div class="mini-stat clearfix card-box">--}}
    {{--<span class="mini-stat-icon bg-warning"><i class="ion-load-d text-white"></i></span>--}}
    {{--<div class="mini-stat-info text-right text-dark">--}}
    {{--<span class="counter text-dark" data-plugin="counterup">{{ $today_waiting }}</span>--}}
    {{--Waiting--}}
    {{--</div>--}}
    {{--<div class="tiles-progress">--}}
    {{--<div class="m-t-20">--}}
    {{--<h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($today_waiting/$today_total)*100) }}%</span></h5>--}}
    {{--<div class="progress progress-sm m-0">--}}
    {{--<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ floor(($today_waiting/$today_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($today_waiting/$today_total)*100) }}%">--}}
    {{--<span class="sr-only">{{ floor(($today_waiting/$today_total)*100) }}% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-12">--}}
    {{--<div class="mini-stat clearfix card-box">--}}
    {{--<span class="mini-stat-icon bg-primary"><i class="ion-location text-white"></i></span>--}}
    {{--<div class="mini-stat-info text-right text-dark">--}}
    {{--<span class="counter text-dark" data-plugin="counterup">{{ $today_called }}</span>--}}
    {{--Called--}}
    {{--</div>--}}
    {{--<div class="tiles-progress">--}}
    {{--<div class="m-t-20">--}}
    {{--<h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($today_called/$today_total)*100) }}%</span></h5>--}}
    {{--<div class="progress progress-sm m-0">--}}
    {{--<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ floor(($today_called/$today_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_called/$today_total)*100) }}%">--}}
    {{--<span class="sr-only">{{ floor(($today_called/$today_total)*100) }}% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-12">--}}
    {{--<div class="mini-stat clearfix card-box">--}}
    {{--<span class="mini-stat-icon bg-danger"><i class="ion-arrow-return-right text-white"></i></span>--}}
    {{--<div class="mini-stat-info text-right text-dark">--}}
    {{--<span class="counter text-dark" data-plugin="counterup">{{ $today_skipped }}</span>--}}
    {{--Skipped--}}
    {{--</div>--}}
    {{--<div class="tiles-progress">--}}
    {{--<div class="m-t-20">--}}
    {{--<h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($today_skipped/$today_total)*100) }}%</span></h5>--}}
    {{--<div class="progress progress-sm m-0">--}}
    {{--<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ floor(($today_skipped/$today_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_skipped/$today_total)*100) }}%">--}}
    {{--<span class="sr-only">{{ floor(($today_skipped/$today_total)*100) }}% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-12">--}}
    {{--<div class="mini-stat clearfix card-box">--}}
    {{--<span class="mini-stat-icon bg-success"><i class="ion-checkmark text-white"></i></span>--}}
    {{--<div class="mini-stat-info text-right text-dark">--}}
    {{--<span class="counter text-dark" data-plugin="counterup">{{ $today_done }}</span>--}}
    {{--Done--}}
    {{--</div>--}}
    {{--<div class="tiles-progress">--}}
    {{--<div class="m-t-20">--}}
    {{--<h5 class="text-uppercase font-16">Percentage <span class="">{{ floor(($today_done/$today_total)*100) }}%</span></h5>--}}
    {{--<div class="progress progress-sm m-0">--}}
    {{--<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ floor(($today_done/$today_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($today_done/$today_total)*100) }}%">--}}
    {{--<span class="sr-only">{{ floor(($today_done/$today_total)*100) }}% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-sm-4">--}}
    {{--<h4 class="m-t-20 m-b-20">Total ({{ ($total_total_is == 0)? 0 : $total_total }})</h4>--}}

    {{--<div class="row">--}}
    {{--<div class="col-md-6">--}}
    {{--<div class="mini-stat clearfix card-box">--}}
    {{--<span class="mini-stat-icon bg-warning"><i class="ion-load-d text-white"></i></span>--}}
    {{--<div class="mini-stat-info text-right text-dark">--}}
    {{--<span class="counter text-dark" data-plugin="counterup">{{ $total_waiting }}</span>--}}
    {{--Waiting--}}
    {{--</div>--}}
    {{--<div class="tiles-progress">--}}
    {{--<div class="m-t-20">--}}
    {{--<h5 class="text-uppercase font-16"> <span class="">{{ floor(($total_waiting/$total_total)*100) }}%</span></h5>--}}
    {{--<div class="progress progress-sm m-0">--}}
    {{--<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ floor(($total_waiting/$total_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_waiting/$total_total)*100) }}%">--}}
    {{--<span class="sr-only">{{ floor(($total_waiting/$total_total)*100) }}% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-6">--}}
    {{--<div class="mini-stat clearfix card-box">--}}
    {{--<span class="mini-stat-icon bg-primary"><i class="ion-location text-white"></i></span>--}}
    {{--<div class="mini-stat-info text-right text-dark">--}}
    {{--<span class="counter text-dark" data-plugin="counterup">{{ $total_called }}</span>--}}
    {{--Called--}}
    {{--</div>--}}
    {{--<div class="tiles-progress">--}}
    {{--<div class="m-t-20">--}}
    {{--<h5 class="text-uppercase font-16"> <span class="pull-right">{{ floor(($total_called/$total_total)*100) }}%</span></h5>--}}
    {{--<div class="progress progress-sm m-0">--}}
    {{--<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ floor(($total_called/$total_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_called/$total_total)*100) }}%">--}}
    {{--<span class="sr-only">{{ floor(($total_called/$total_total)*100) }}% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-12">--}}
    {{--<div class="mini-stat clearfix card-box">--}}
    {{--<span class="mini-stat-icon bg-danger"><i class="ion-arrow-return-right text-white"></i></span>--}}
    {{--<div class="mini-stat-info text-right text-dark">--}}
    {{--<span class="counter text-dark" data-plugin="counterup">{{ $total_skipped }}</span>--}}
    {{--Skipped--}}
    {{--</div>--}}
    {{--<div class="tiles-progress">--}}
    {{--<div class="m-t-20">--}}
    {{--<h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($total_skipped/$total_total)*100) }}%</span></h5>--}}
    {{--<div class="progress progress-sm m-0">--}}
    {{--<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ floor(($total_skipped/$total_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_skipped/$total_total)*100) }}%">--}}
    {{--<span class="sr-only">{{ floor(($total_skipped/$total_total)*100) }}% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-md-12">--}}
    {{--<div class="mini-stat clearfix card-box">--}}
    {{--<span class="mini-stat-icon bg-success"><i class="ion-checkmark text-white"></i></span>--}}
    {{--<div class="mini-stat-info text-right text-dark">--}}
    {{--<span class="counter text-dark" data-plugin="counterup">{{ $total_done }}</span>--}}
    {{--Done--}}
    {{--</div>--}}
    {{--<div class="tiles-progress">--}}
    {{--<div class="m-t-20">--}}
    {{--<h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($total_done/$total_total)*100) }}%</span></h5>--}}
    {{--<div class="progress progress-sm m-0">--}}
    {{--<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ floor(($total_done/$total_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_done/$total_total)*100) }}%">--}}
    {{--<span class="sr-only">{{ floor(($total_done/$total_total)*100) }}% Complete</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

@endsection