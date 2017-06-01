
@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{route('admin.home')}}">Admin</a></li>
    <li><a href="{{route('admin.role')}}">Role</a></li>
    <li class="active">Edit</li>
</ul>
@endsection

@section('content')
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{route('admin.role.update', $id)}}" method="post">
              {{ csrf_field() }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                      <strong>
                        <a href="{{route('admin.role')}}">Back</a>
                        | Role
                      </strong> Edit</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                    <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Role</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="role" value="{{$role->role}}"/>
                            </div>
                            @if ($errors->has('role'))
                              <span class="help-block">{{ $errors->first('role') }}</span>
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
