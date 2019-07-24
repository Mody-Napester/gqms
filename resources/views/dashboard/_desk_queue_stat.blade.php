<div class="row">
    <div class="col-md-12">
        <h4 class="m-t-20 m-b-20">Desk Queue <span class="text-danger">({{ $desk['total'] }})</span></h4>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-6">
        <div class="widget-bg-color-icon card-box fadeInDown animated">
            <div class="bg-icon bg-icon-warning pull-left">
                <i class="ion-load-d text-warning"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{ $desk['waiting'] }}</b></h3>
                <p class="text-muted mb-0">Waiting</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-6">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-primary pull-left">
                <i class="ion-location text-primary"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{ $desk['called'] }}</b></h3>
                <p class="text-muted mb-0">Called</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-6">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-danger pull-left">
                <i class="ion-arrow-return-right text-danger"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{ $desk['skipped'] }}</b></h3>
                <p class="text-muted mb-0">Skipped</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 col-xl-6">
        <div class="widget-bg-color-icon card-box">
            <div class="bg-icon bg-icon-success pull-left">
                <i class="ion-checkmark text-success"></i>
            </div>
            <div class="text-right">
                <h3 class="text-dark"><b class="counter">{{ $desk['done'] }}</b></h3>
                <p class="text-muted mb-0">Done</p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>