@extends('layouts.auth')
@section('content')
<div class="login-body">
    <div class="login-title">Login</div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
      <div class="form-group">
          <div class="col-md-12">
              <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
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
          <div class="col-md-6">

              <a href="{{route('register')}}" class="btn btn-link btn-block">Register</a>
          </div>
          <div class="col-md-6">
              <button class="btn btn-info btn-block">Log In</button>
          </div>
      </div>
    </form>
</div>
@endsection
