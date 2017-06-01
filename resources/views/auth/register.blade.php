@extends('layouts.auth')
@section('content')
<div class="login-body">
    <div class="login-title">Register</div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}
      <div class="form-group">
          <div class="col-md-12">
            <input placeholder="Name" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

            @if ($errors->has('name'))
                <span class="help-block error">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
          </div>
      </div>
      <div class="form-group">
          <div class="col-md-12">
            <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
                <span class="help-block error">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
      </div>
      <div class="form-group">
          <div class="col-md-12">
            <input placeholder="Password" id="password" type="password" class="form-control" name="password">

            @if ($errors->has('password'))
                <span class="help-block error">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
      </div>
      <div class="form-group">
          <div class="col-md-12">
            <input placeholder="Password confirm" id="password-confirm" type="password" class="form-control" name="password_confirmation">
          </div>
      </div>
      <div class="form-group">
          <div class="col-md-6">
              <a href="{{route('login')}}" class="btn btn-link btn-block">Login</a>
          </div>
          <div class="col-md-6">
              <button class="btn btn-info btn-block">Register</button>
          </div>
      </div>
    </form>
</div>
@endsection
