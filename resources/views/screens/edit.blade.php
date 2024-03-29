<form method="post" action="{{ route('screens.update', $screen->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_ar">Name ar</label>
                <input type="text" id="name_ar" autocomplete="off" class="form-control{{ $errors->has('name_ar') ? ' is-invalid' : '' }}" name="name_ar" value="{{ $screen->name_ar }}" required/>

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
                <input type="text" id="name_en" autocomplete="off" class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en" value="{{ $screen->name_en }}" required/>

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
                <input type="text" id="ip" autocomplete="off" class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" value="{{ $screen->ip }}" required/>

                @if ($errors->has('ip'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ip') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Screen place</label>
                <select name="area" id="area" class="select2 filter-area" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    <option disabled selected>Choose</option>
                    @foreach($areas as $key => $area)
                        <option @if($screen->area_id == $area->id) selected @endif value="{{ $area->uuid }}">{{ $area->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach(App\Enums\screenstatuses::$statuses as $key => $status)
                        <option @if($key == $screen->status) selected @endif value="{{ $key }}">{{ $status['en'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Type</label>
                <select name="type" id="type" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach($screenTypes as $key => $screenType)
                        <option @if($screen->screen_type_id == $screenType->id) selected @endif value="{{ $screenType->id }}">{{ $screenType->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div @if(count($screen->rooms) == 0 && $screen->screen_type_id != config('vars.screen_types.reception')) style="display: none;" @endif id="rooms-div" class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group filter-desks">
                        <label>Show Desks</label>
                        <select name="desks[]" id="desks" class="select2" multiple data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                            @foreach($desks as $key => $desk)
                                <option @if(in_array($desk->id, $screen->desks()->pluck('desk_id')->toArray())) selected @endif value="{{ $desk->uuid }}">
                                    {{ (($desk->area)? $desk->area->name_en : '') . ' - ' . $desk->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Show Rooms</label>
                        <select name="rooms[]" id="rooms" class="select2" multiple data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                            @foreach($rooms as $key => $room)
                                <option @if(in_array($room->id, $screen->rooms()->pluck('room_id')->toArray())) selected @endif value="{{ $room->uuid }}">
                                    {{ (($room->floor)? $room->floor->name_en : '-') . ' - ' . $room->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" @if(count($screen->floors) == 0 && $screen->screen_type_id != config('vars.screen_types.kiosk')) style="display: none;" @endif id="floor-div">
        <div class="col-md-6">
            <div class="form-group">
                <label>Enable print</label>
                <select name="enable_print" id="enable_print" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option @if($screen->enable_print == 0) selected @endif value="0">No</option>
                    <option @if($screen->enable_print == 1) selected @endif value="1">Yes</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="printer">Printer IP</label>
                <select name="printer" id="printer" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    @foreach($printers as $key => $printer)
                        <option @if($printer->id == $screen->printer_id) selected @endif value="{{ $printer->uuid }}">{{ $printer->name_en }} - {{ $printer->ip }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Print For Floors</label>
                <select name="floors[]" id="floors" class="select2" multiple data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    @foreach($floors as $key => $floor)
                        <option @if(in_array($floor->id, $screen->floors()->pluck('floor_id')->toArray())) selected @endif value="{{ $floor->uuid }}">{{ $floor->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-success waves-effect waves-light">
                Update
            </button>
        </div>
    </div>
</form>