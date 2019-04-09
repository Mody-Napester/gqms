<form method="post" action="{{ route('floors.store') }}" enctype="multipart/form-data">
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
                <label>Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach(App\Enums\UserStatuses::$statuses as $key => $status)
                        <option value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-primary waves-effect waves-light">
                Submit
            </button>
        </div>
    </div>
</form>