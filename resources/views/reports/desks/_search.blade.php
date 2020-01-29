<form method="get" action="{{ route('reports.desks.index') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>User</label>
                <select name="user" id="user" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose</option>
                    @foreach($allUsers as $user)
                        <option @if(request()->get('user') == $user->uuid) selected @endif value="{{ $user->uuid }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="" for="date">Date</label>
                <input type="date" id="date" autocomplete="off" class="form-control" name="date" @if(request()->has('date')) value="{{ request()->get('date') }}" @endif />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Show in results</label>
                <select name="show" id="show" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option value="1">All Users</option>
                    <option value="0">Only Performed</option>
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