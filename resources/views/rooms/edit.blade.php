<form method="post" action="{{ route('rooms.update', $room->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_ar">Name ar</label>
                <input type="text" id="name_ar" autocomplete="off" class="form-control{{ $errors->has('name_ar') ? ' is-invalid' : '' }}" name="name_ar" value="{{ $room->name_ar }}" required/>

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
                <input type="text" id="name_en" autocomplete="off" class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en" value="{{ $room->name_en }}" required/>

                @if ($errors->has('name_en'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name_en') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="" for="ip">Room IP</label>
                <input type="text" id="ip" autocomplete="off" class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" value="{{ $room->ip }}" required/>

                @if ($errors->has('ip'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ip') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Floor</label>
                <select name="floor" id="floor" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach($floors as $key => $floor)
                        <option @if($room->floor_id == $floor->id) selected @endif value="{{ $floor->uuid }}">{{ $floor->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach(App\Enums\RoomStatuses::$statuses as $key => $status)
                        <option @if($key == $room->status) selected @endif value="{{ $key }}">{{ $status['en'] }}</option>
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