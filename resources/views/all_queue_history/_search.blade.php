<form method="get" action="" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="date_from">Date from</label>
                <input type="date" id="date_from" autocomplete="off" class="form-control" name="date_from" @if(request()->has('date_from')) value="{{ request()->get('date_from') }}" @endif />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="date_to">Date to</label>
                <input type="date" id="date_to" autocomplete="off" class="form-control" name="date_to" @if(request()->has('date_to')) value="{{ request()->get('date_to') }}" @endif />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="reservation">Reservation</label>
                <input type="text" id="reservation" autocomplete="off" class="form-control" name="reservation" @if(request()->has('reservation')) value="{{ request()->get('reservation') }}" @endif />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Doctor</label>
                <select name="doctor" id="doctor" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected value="Choose">Choose</option>
                    @foreach($doctors as $key => $doctor)
                        <option @if(request()->get('doctor') == $doctor->source_doctor_id) selected @endif value="{{ $doctor->source_doctor_id }}">{{ $doctor->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Desks</label>
                <select name="desk" id="desk" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected value="Choose">Choose</option>
                    @foreach($desks as $key => $desk)
                        <option @if(request()->get('desk') == $desk->id) selected @endif value="{{ $desk->id }}">{{ $desk->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Rooms</label>
                <select name="room" id="room" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected value="Choose">Choose</option>
                    @foreach($rooms as $key => $room)
                        <option @if(request()->get('room') == $room->id) selected @endif value="{{ $room->id }}">{{ $room->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group m-b-0">
        <button type="submit" class="btn btn-success waves-effect waves-light">
            <i class="fa fa-fw fa-search"></i> Search
        </button>
        <a href="{{ route('queues.allQueuesHistory') }}" type="reset" class="btn btn-warning waves-effect waves-light">
            <i class="fa fa-fw fa-refresh"></i> Reset
        </a>
    </div>
</form>
