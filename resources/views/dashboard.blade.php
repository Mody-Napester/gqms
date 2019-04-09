@extends('_layouts.dashboard')

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

    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-attach-money text-primary"></i>
                <h2 class="m-0 text-dark counter font-600">50568</h2>
                <div class="text-muted m-t-5">Total Revenue</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-add-shopping-cart text-pink"></i>
                <h2 class="m-0 text-dark counter font-600">1256</h2>
                <div class="text-muted m-t-5">Sales</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-store-mall-directory text-info"></i>
                <h2 class="m-0 text-dark counter font-600">18</h2>
                <div class="text-muted m-t-5">Stores</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="widget-panel widget-style-2 bg-white">
                <i class="md md-account-child text-custom"></i>
                <h2 class="m-0 text-dark counter font-600">8564</h2>
                <div class="text-muted m-t-5">Users</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-4">
            <div class="card-box">
                <div class="bar-widget">
                    <div class="table-box">
                        <div class="table-detail">
                            <div class="iconbox bg-info">
                                <i class="icon-layers"></i>
                            </div>
                        </div>

                        <div class="table-detail">
                            <h4 class="m-t-0 m-b-5"><b>1256</b></h4>
                            <h5 class="text-muted m-b-0 m-t-0">Visiters</h5>
                        </div>
                        <div class="table-detail text-right">
                            <span data-plugin="peity-bar" data-colors="#34d3eb,#ebeff2" data-width="120" data-height="45">5,3,9,6,5,9,7,3,5,2,9,7,2,1</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-4">
            <div class="card-box">
                <div class="bar-widget">
                    <div class="table-box">
                        <div class="table-detail">
                            <div class="iconbox bg-custom">
                                <i class="icon-layers"></i>
                            </div>
                        </div>

                        <div class="table-detail">
                            <h4 class="m-t-0 m-b-5"><b>1256</b></h4>
                            <h5 class="text-muted m-b-0 m-t-0">Visiters</h5>
                        </div>
                        <div class="table-detail text-right">
                            <span data-plugin="peity-pie" data-colors="#5fbeaa,#ebeff2" data-width="50" data-height="45">1/5</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-xl-4">
            <div class="card-box">
                <div class="bar-widget">
                    <div class="table-box">
                        <div class="table-detail">
                            <div class="iconbox bg-danger">
                                <i class="icon-layers"></i>
                            </div>
                        </div>

                        <div class="table-detail">
                            <h4 class="m-t-0 m-b-5"><b>1256</b></h4>
                            <h5 class="text-muted m-b-0 m-t-0">Visiters</h5>
                        </div>
                        <div class="table-detail text-right">
                            <span data-plugin="peity-donut" data-colors="#f05050,#ebeff2" data-width="50" data-height="45">1/5</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Transactions -->
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="m-t-0 m-b-20 header-title"><b>Last Transactions</b></h4>

                <div class="nicescroll mx-box">
                    <ul class="list-unstyled transaction-list m-r-5">
                        <li>
                            <i class="ti-download text-success"></i>
                            <span class="tran-text">Advertising</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">07/09/2015</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="ti-upload text-danger"></i>
                            <span class="tran-text">Support licence</span>
                            <span class="pull-right text-danger tran-price">-$965</span>
                            <span class="pull-right text-muted">07/09/2015</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="ti-download text-success"></i>
                            <span class="tran-text">Extended licence</span>
                            <span class="pull-right text-success tran-price">+$830</span>
                            <span class="pull-right text-muted">07/09/2015</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="ti-download text-success"></i>
                            <span class="tran-text">Advertising</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">05/09/2015</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="ti-upload text-danger"></i>
                            <span class="tran-text">New plugins added</span>
                            <span class="pull-right text-danger tran-price">-$452</span>
                            <span class="pull-right text-muted">05/09/2015</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="ti-download text-success"></i>
                            <span class="tran-text">Google Inc.</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">04/09/2015</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="ti-upload text-danger"></i>
                            <span class="tran-text">Facebook Ad</span>
                            <span class="pull-right text-danger tran-price">-$364</span>
                            <span class="pull-right text-muted">03/09/2015</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="ti-download text-success"></i>
                            <span class="tran-text">New sale</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">03/09/2015</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="ti-download text-success"></i>
                            <span class="tran-text">Advertising</span>
                            <span class="pull-right text-success tran-price">+$230</span>
                            <span class="pull-right text-muted">29/08/2015</span>
                            <span class="clearfix"></span>
                        </li>

                        <li>
                            <i class="ti-upload text-danger"></i>
                            <span class="tran-text">Support licence</span>
                            <span class="pull-right text-danger tran-price">-$854</span>
                            <span class="pull-right text-muted">27/08/2015</span>
                            <span class="clearfix"></span>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
        <!-- end col -->
    </div> <!-- end row -->

@endsection