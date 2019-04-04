@extends('auth._layout')

@section('content')
    <div class="wrapper-page">
        <div class="card-box">
            <div class="panel-heading">
                <h4 class="text-center"> Sign In to <strong>{{ config('app.name') }}</strong></h4>
            </div>

            <div class="p-20">
                <form class="form-horizontal m-t-20" method="post" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group-custom">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="{{ $errors->has('email') ? ' is-invalid' : '' }}"/>
                        <label class="control-label" for="email">Username</label><i class="bar"></i>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group-custom">
                        <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required/>
                        <label class="control-label" for="user-password">Password</label><i class="bar"></i>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group ">
                        <div class="col-12">
                            <div class="checkbox checkbox-primary">
                                <input name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox">
                                <label for="checkbox-signup"> Remember me </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-12">
                            <button class="btn btn-purple btn-block text-uppercase waves-effect waves-light" type="submit">
                                Log In
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
