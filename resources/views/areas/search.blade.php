<form method="get" action="{{ route('areas.index') }}" enctype="multipart/form-data">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_ar">Name ar</label>
                <input type="text" id="name_ar" autocomplete="off" class="form-control" name="name_ar" value="{{ \Illuminate\Support\Facades\Input::get('name_ar') }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_en">Name en</label>
                <input type="text" id="name_en" autocomplete="off" class="form-control" name="name_en" value="{{ \Illuminate\Support\Facades\Input::get('name_en') }}"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Floors</label>
                <select name="floor" id="floor" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach($floors as $key => $floor)
                        <option value="{{ $floor->uuid }}">{{ $floor->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Speciality</label>
                <select name="speciality" id="speciality" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach($specialities as $key => $speciality)
                        @foreach($specialities as $key => $speciality)
                            @if($speciality->area)
                                <option value="{{ $speciality->uuid }}">{{ $speciality->name_en }} - (Area : {{ $speciality->area->name_en }})</option>
                            @else
                                <option value="{{ $speciality->uuid }}">{{ $speciality->name_en }}</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose</option>
                    @foreach(App\Enums\FloorStatuses::$statuses as $key => $status)
                        <option value="{{ $key }}">{{ $status['en'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="form-group m-b-0">
        <button type="submit" class="btn btn-success waves-effect waves-light">
            <i class="fa fa-fw fa-search"></i> Search
        </button>
    </div>
</form>