<form method="post" action="{{ route('printers.update', $printer->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name_ar">Name ar</label>
                <input type="text" id="name_ar" autocomplete="off" class="form-control{{ $errors->has('name_ar') ? ' is-invalid' : '' }}" name="name_ar" value="{{ $printer->name_ar }}" required/>

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
                <input type="text" id="name_en" autocomplete="off" class="form-control{{ $errors->has('name_en') ? ' is-invalid' : '' }}" name="name_en" value="{{ $printer->name_en }}" required/>

                @if ($errors->has('name_en'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name_en') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="" for="ip">Printer IP</label>
                <input type="text" id="ip" autocomplete="off" class="form-control{{ $errors->has('ip') ? ' is-invalid' : '' }}" name="ip" value="{{ $printer->ip }}" required/>

                @if ($errors->has('ip'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ip') }}</strong>
                    </span>
                @endif
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