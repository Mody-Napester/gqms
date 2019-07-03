@extends('_layouts.dashboard')

@section('title') Dashboard @endsection

@section('content')
    
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Dashboard</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

        </div>
    </div>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-4">
            <h4 class="m-t-20 m-b-20">Today ({{ ($today_total_is == 0)? 0 : $today_total }})</h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="mini-stat clearfix card-box">
                        <span class="mini-stat-icon bg-warning"><i class="ion-load-d text-white"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark" data-plugin="counterup">{{ $today_waiting }}</span>
                            Waiting
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($today_waiting/$today_total)*100) }}%</span></h5>
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ floor(($today_waiting/$today_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($today_waiting/$today_total)*100) }}%">
                                        <span class="sr-only">{{ floor(($today_waiting/$today_total)*100) }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mini-stat clearfix card-box">
                        <span class="mini-stat-icon bg-primary"><i class="ion-location text-white"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark" data-plugin="counterup">{{ $today_called }}</span>
                            Called
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($today_called/$today_total)*100) }}%</span></h5>
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ floor(($today_called/$today_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_called/$today_total)*100) }}%">
                                        <span class="sr-only">{{ floor(($today_called/$today_total)*100) }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mini-stat clearfix card-box">
                        <span class="mini-stat-icon bg-danger"><i class="ion-arrow-return-right text-white"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark" data-plugin="counterup">{{ $today_skipped }}</span>
                            Skipped
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($today_skipped/$today_total)*100) }}%</span></h5>
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ floor(($today_skipped/$today_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_skipped/$today_total)*100) }}%">
                                        <span class="sr-only">{{ floor(($today_skipped/$today_total)*100) }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mini-stat clearfix card-box">
                        <span class="mini-stat-icon bg-success"><i class="ion-checkmark text-white"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark" data-plugin="counterup">{{ $today_done }}</span>
                            Done
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($today_done/$today_total)*100) }}%</span></h5>
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ floor(($today_done/$today_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($today_done/$today_total)*100) }}%">
                                        <span class="sr-only">{{ floor(($today_done/$today_total)*100) }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <h4 class="m-t-20 m-b-20">Total ({{ ($total_total_is == 0)? 0 : $total_total }})</h4>

            <div class="row">
                <div class="col-md-12">
                    <div class="mini-stat clearfix card-box">
                        <span class="mini-stat-icon bg-warning"><i class="ion-load-d text-white"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark" data-plugin="counterup">{{ $total_waiting }}</span>
                            Waiting
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($total_waiting/$total_total)*100) }}%</span></h5>
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="{{ floor(($total_waiting/$total_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_waiting/$total_total)*100) }}%">
                                        <span class="sr-only">{{ floor(($total_waiting/$total_total)*100) }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mini-stat clearfix card-box">
                        <span class="mini-stat-icon bg-primary"><i class="ion-location text-white"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark" data-plugin="counterup">{{ $total_called }}</span>
                            Called
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($total_called/$total_total)*100) }}%</span></h5>
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ floor(($total_called/$total_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_called/$total_total)*100) }}%">
                                        <span class="sr-only">{{ floor(($total_called/$total_total)*100) }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mini-stat clearfix card-box">
                        <span class="mini-stat-icon bg-danger"><i class="ion-arrow-return-right text-white"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark" data-plugin="counterup">{{ $total_skipped }}</span>
                            Skipped
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($total_skipped/$total_total)*100) }}%</span></h5>
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ floor(($total_skipped/$total_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_skipped/$total_total)*100) }}%">
                                        <span class="sr-only">{{ floor(($total_skipped/$total_total)*100) }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mini-stat clearfix card-box">
                        <span class="mini-stat-icon bg-success"><i class="ion-checkmark text-white"></i></span>
                        <div class="mini-stat-info text-right text-dark">
                            <span class="counter text-dark" data-plugin="counterup">{{ $total_done }}</span>
                            Done
                        </div>
                        <div class="tiles-progress">
                            <div class="m-t-20">
                                <h5 class="text-uppercase font-16">Percentage <span class="pull-right">{{ floor(($total_done/$total_total)*100) }}%</span></h5>
                                <div class="progress progress-sm m-0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ floor(($total_done/$total_total)*100) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ floor(($total_done/$total_total)*100) }}%">
                                        <span class="sr-only">{{ floor(($total_done/$total_total)*100) }}% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">

            <h4 class="m-t-20 m-b-20">Logged in Users ({{ count($loggedInUsers) }})</h4>

            <div class="card-box p-2">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <td>User</td>
                        <td>Type</td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($loggedInUsers as $loggedInUser)
                        <tr>
                            <td>{{ $loggedInUser->name }}</td>
                            <td>{{ \App\Enums\UserTypes::$types[$loggedInUser->type] }}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>



@endsection