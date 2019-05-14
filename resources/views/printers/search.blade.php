<form method="get" action="{{ route('printers.index') }}" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_ar">Name ar</label>
                <input type="text" id="name_ar" autocomplete="off" class="form-control" name="name_ar" @if(request()->has('name_ar')) value="{{ request()->get('name_ar') }}" @endif />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_en">Name en</label>
                <input type="text" id="name_en" autocomplete="off" class="form-control" name="name_en" @if(request()->has('name_en')) value="{{ request()->get('name_en') }}" @endif />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="" for="ip">Printer IP</label>
                <input type="text" id="ip" autocomplete="off" class="form-control" name="ip" @if(request()->has('ip')) value="{{ request()->get('ip') }}" @endif />
            </div>
        </div>
    </div>


    <div class="form-group m-b-0">
        <button type="submit" class="btn btn-success waves-effect waves-light">
            <i class="fa fa-fw fa-search"></i> Search
        </button>
    </div>
</form>