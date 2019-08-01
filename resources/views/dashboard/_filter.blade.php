<form method="get" action="{{ route('dashboard.index') }}" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="date_from">Date from</label>
                <input type="date" id="date_from" autocomplete="off" class="form-control" name="date_from"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="date_to">Date to</label>
                <input type="date" id="date_to" autocomplete="off" class="form-control" name="date_to"/>
            </div>
        </div>
    </div>

    <div class="form-group m-b-0">
        <button type="submit" class="btn btn-info waves-effect waves-light">
            <i class="fa fa-fw fa-search"></i> Search
        </button>
    </div>
</form>