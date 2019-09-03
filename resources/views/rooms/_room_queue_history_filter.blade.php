<form method="get" action="{{ route('rooms.queues.roomQueueHistory') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="queue_number">Queue number</label>
                <input type="text" id="queue_number" autocomplete="off" class="form-control" name="queue_number" value="{{ request()->get('queue_number') }}"/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="reservation">Reservation</label>
                <input type="text" id="reservation" autocomplete="off" class="form-control" name="reservation" value="{{ request()->get('reservation') }}"/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Floor</label>
                <select name="floor" id="floor" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose</option>
                    @foreach($floors as $key => $floor)
                        <option @if(request()->get('floor') == $floor->uuid) selected @endif value="{{ $floor->uuid }}">{{ $floor->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Doctor</label>
                <select name="doctor" id="doctor" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose</option>
                    @foreach($doctors as $doctor)
                        <option @if(request()->get('doctor') == $doctor->uuid) selected @endif value="{{ $doctor->uuid }}">{{ translate($doctor, 'name') }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Queue Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1"
                        aria-hidden="true">
                    <option selected disabled>Choose</option>
                    @foreach($statuses as $status)
                        <option @if(request()->get('status') == $status->uuid) selected @endif value="{{ $status->uuid }}">{{ $status->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="date">Date</label>
                <input type="date" id="date" autocomplete="off" class="form-control" name="date" value="{{ request()->get('date') }}"/>
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