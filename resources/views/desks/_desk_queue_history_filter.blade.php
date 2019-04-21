<form method="get" action="" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="queue_number">Queue number</label>
                <input type="text" id="queue_number" autocomplete="off" class="form-control" name="queue_number"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Users</label>
                <select name="users" id="users" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    @foreach($users as $user)
                        <option value="{{ $user->uuid }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Floor</label>
                <select name="floor" id="floor" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    @foreach($floors as $key => $floor)
                        <option value="{{ $floor->uuid }}">{{ $floor->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Queue Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    @foreach($statuses as $status)
                        <option value="{{ $status->uuid }}">{{ $status->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="date">Date</label>
                <input type="date" id="date" autocomplete="off" class="form-control" name="date"/>
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