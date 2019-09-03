<form method="get" action="{{ route('desks.queues.deskQueueHistory') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="queue_number">Queue number</label>
                <input type="text" id="queue_number" autocomplete="off" class="form-control" name="queue_number" value="{{ request()->get('queue_number') }}"/>
            </div>
        </div>
        {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
                {{--<label>Users</label>--}}
                {{--<select name="user" id="user" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">--}}
                    {{--@foreach($users as $user)--}}
                        {{--<option value="{{ $user->uuid }}">{{ $user->name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="col-md-6">
            <div class="form-group">
                <label>Areas</label>
                <select name="area" id="area" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose</option>
                    @foreach($areas as $area)
                        <option @if(request()->get('area') == $area->uuid) selected @endif value="{{ $area->uuid }}">{{ translate($area, 'name') }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Desk</label>
                <select name="desk" id="desk" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose</option>
                    @foreach($desk_names as $key => $desk_name)
                        <option @if(request()->get('desk') == $desk_name->uuid) selected @endif value="{{ $desk_name->uuid }}">{{ $desk_name->name_en }}</option>
                    @endforeach
                </select>
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
                <label>Queue Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
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