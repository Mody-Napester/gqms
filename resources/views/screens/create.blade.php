<form method="post" action="{{ route('screens.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_ar">Name ar</label>
                <input type="text" id="name_ar" autocomplete="off" class="form-control{{ $errors->has('name_ar') ? ' is-invalid' : '' }}" name="name_ar" value="{{ old('name_ar') }}" required/>

                @if ($errors->has('name_ar'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name_ar') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_en">Name en</label>
                <input type="text" id="name_en" autocomplete="off" class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en" value="{{ old('name_en') }}" required/>

                @if ($errors->has('name_en'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name_en') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="ip">Screen IP</label>
                <input type="text" id="ip" autocomplete="off" class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" value="{{ old('ip') }}" required/>

                @if ($errors->has('ip'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ip') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Screen Place</label>
                <select name="floor" id="floor" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach($floors as $key => $floor)
                        <option value="{{ $floor->uuid }}">{{ $floor->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Enable print</label>
                <select name="enable_print" id="enable_print" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Type</label>
                <select name="type" id="type" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    <option disabled selected>Choose</option>
                    @foreach($screenTypes as $key => $screenType)
                        <option value="{{ $screenType->id }}">{{ $screenType->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach(App\Enums\screenstatuses::$statuses as $key => $status)
                        <option value="{{ $key }}">{{ $status['en'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div style="display: none;" id="rooms-div" class="col-md-6">
            <div class="form-group">
                <label>Show Rooms</label>
                <select name="rooms[]" id="rooms" class="select2" multiple data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    @foreach($rooms as $key => $room)
                        <option value="{{ $room->uuid }}">{{ $room->floor->name_en . ' - ' . $room->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row" style="display: none;" id="floor-div">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="printer">Printer IP</label>
                <select name="printer" id="printer" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    @foreach($printers as $key => $printer)
                        <option value="{{ $printer->uuid }}">{{ $printer->name_en }} - {{ $printer->ip }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Print For Floors</label>
                <select name="floors[]" id="floors" class="select2" multiple data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    @foreach($floors as $key => $floor)
                        <option value="{{ $floor->uuid }}">{{ $floor->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                <i class="fa fa-fw fa-save"></i> Save
            </button>
        </div>
    </div>
</form>