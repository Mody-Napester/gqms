<form method="post" action="{{ route('areas.update', $area->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_ar">Name ar</label>
                <input type="text" id="name_ar" autocomplete="off" class="form-control{{ $errors->has('name_ar') ? ' is-invalid' : '' }}" name="name_ar" value="{{ $area->name_ar }}" required/>

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
                <input type="text" id="name_en" autocomplete="off" class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en" value="{{ $area->name_en }}" required/>

                @if ($errors->has('name_en'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name_en') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Floors</label>
                <select name="floor" id="floor" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach($floors as $key => $floor)
                        <option @if($floor->id == $area->floor_id) selected @endif value="{{ $floor->uuid }}">{{ $floor->name_en }}</option>
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
                                <option disabled  value="{{ $speciality->uuid }}">{{ $speciality->name_en }} - (Area : {{ $speciality->area->name_en }})</option>
                            @else
                                <option @if($speciality->id == $area->speciality_id) selected @endif value="{{ $speciality->uuid }}">{{ $speciality->name_en }}</option>
                            @endif
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach(App\Enums\AreaStatuses::$statuses as $key => $status)
                        <option @if($key == $area->status) selected @endif value="{{ $key }}">{{ $status['en'] }}</option>
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