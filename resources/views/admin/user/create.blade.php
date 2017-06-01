@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{route('admin.home')}}">Admin</a></li>
    <li><a href="{{route('admin.user')}}">User</a></li>
    <li class="active">Create</li>
</ul>
@endsection

@section('content')
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                      <strong>
                        <a href="{{route('admin.user')}}">Back</a>
                        | User
                      </strong> Create</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="form-group {{$errors->has('role_id') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Role</label>
                        <div class="col-md-6 col-xs-12">
                            <select class="form-control select" name="role_id">
                              <option value="">--Plsease select role--</option>
                              @foreach($roles as $key => $value)
                                <option value="{{$value->id}}">{{$value->role}}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('role_id'))
                              <span class="help-block">{{ $errors->first('role_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Name</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}"/>
                            </div>
                            @if ($errors->has('name'))
                              <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Email</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="email" value="{{old('email')}}"/>
                            </div>
                            @if ($errors->has('email'))
                              <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Password</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="password" class="form-control" name="password"/>
                            </div>
                            @if ($errors->has('password'))
                              <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group {{$errors->has('repassword') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Confirm Password</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="password" class="form-control" name="repassword"/>
                            </div>
                            @if ($errors->has('repassword'))
                              <span class="help-block">{{ $errors->first('repassword') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group {{$errors->has('avatar') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Avatar</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <input type="file" class="form-control" name="avatar"/>
                            </div>
                            @if ($errors->has('avatar'))
                              <span class="help-block">{{ $errors->first('avatar') }}</span>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="reset" class="btn btn-default">Clear Form</button>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
            </div>
            </form>

        </div>
    </div>

</div>
@endsection
