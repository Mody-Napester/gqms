<div class="row">
    <div class="col-md-12">
        <h4 class="m-t-20 m-b-20">{{ trans('dashboard.Reservations') }}</h4>
    </div>

    <div class="col-md-4">
        <div class="card-box widget-box-1 bg-white">
            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ trans('dashboard.Total_reservations_default_today') }}"></i>
            <h4 class="text-dark font-18">{{ trans('dashboard.Total') }}</h4>
            <h2 class="text-primary text-center"><span data-plugin="counterup">{{ $reservations['total'] }}</span></h2>
            <p class="text-muted">{{ trans('dashboard.Total_Reservations') }}: {{ $reservations['total'] }}</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box widget-box-1 bg-white">
            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ trans('dashboard.Waiting_reservations_default_today') }}"></i>
            <h4 class="text-dark font-18">{{ trans('dashboard.Done') }}</h4>
            <h2 class="text-primary text-center"><span data-plugin="counterup">{{ $reservations['done'] }}</span></h2>
            <p class="text-muted">{{ trans('dashboard.Total_Reservations') }}: {{ $reservations['total'] }} <span class="pull-right"><i class="fa fa-caret-right text-primary m-r-5"></i>{{ ($reservations['done'] != 0)? round(($reservations['done']/$reservations['total']) * 100, 2) : 0 }} %</span></p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-box widget-box-1 bg-white">
            <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ trans('dashboard.Done_reservations_default_today') }}"></i>
            <h4 class="text-dark font-18">{{ trans('dashboard.Waiting') }}</h4>
            <h2 class="text-primary text-center"><span data-plugin="counterup">{{ $reservations['waiting'] }}</span></h2>
            <p class="text-muted">{{ trans('dashboard.Total_Reservations') }}: {{ $reservations['total'] }} <span class="pull-right"><i class="fa fa-caret-right text-primary m-r-5"></i>{{ ($reservations['waiting'] != 0)? round(($reservations['waiting']/$reservations['total']) * 100, 2) : 0 }} %</span></p>
        </div>
    </div>

</div>