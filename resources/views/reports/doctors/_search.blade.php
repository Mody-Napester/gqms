<form method="get" action="{{ route('reports.doctors.index') }}" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-3">
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
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="date_from">Date from</label>
                <input type="date" id="date_from" autocomplete="off" class="form-control" name="date_from" @if(request()->has('date_from')) value="{{ request()->get('date_from') }}" @endif />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="date_to">Date to</label>
                <input type="date" id="date_to" autocomplete="off" class="form-control" name="date_to" @if(request()->has('date_to')) value="{{ request()->get('date_to') }}" @endif />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Show in results</label>
                <select name="show" id="show" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true">
                    <option selected disabled>Choose</option>
                    <option @if(request()->has('show') &&  request()->show == 1) selected @endif value="1">All Users</option>
                    <option @if(request()->has('show') &&  request()->show == 0) selected @endif value="0">Only Performed</option>
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
