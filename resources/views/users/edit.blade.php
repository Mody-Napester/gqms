<form method="post" action="{{ route('users.update', $user->uuid) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="email">Email Or Username</label>
                <input type="text" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required autofocus/>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="name">Name</label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="" for="phone">Phone</label>
                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}">

                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Status</label>
                <select name="status" id="status" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach(App\Enums\UserStatuses::$statuses as $key => $status)
                        <option @if($key == $user->status) selected @endif value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Type</label>
                <select name="type" id="type" class="select2" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
                    @foreach(App\Enums\UserTypes::$types as $key => $type)
                        <option @if($key == $user->type) selected @endif value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Roles <span data-select2-target="roles_update" class="select-all text-success btn-link">(Select All)</span></label>
        <select name="roles[]" id="roles_update" class="select2 select2-multiple" multiple="" data-placeholder="Choose ..." tabindex="-1" aria-hidden="true" required>
            @foreach($roles as $role)
                <option @if(in_array($role->id, $user->roles->pluck('id')->toArray())) selected @endif value="{{ $role->uuid }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group m-b-0">
        <div>
            <button type="submit" class="btn btn-success waves-effect waves-light">
                Update User Data
            </button>
        </div>
    </div>
</form>

<hr>

<div class="border border-danger p-2">
    <form method="post" action="{{ route('users.update_password', $user->uuid) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <label class="text-danger" for="password">Update Password</label>

        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <input type="password" placeholder="Enter new password .." id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"/>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-block btn-danger waves-effect waves-light">
                    Update User Password
                </button>
            </div>
        </div>
    </form>
</div>

