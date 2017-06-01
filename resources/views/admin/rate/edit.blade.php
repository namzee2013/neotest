@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{route('admin.home')}}">Admin</a></li>
    <li><a href="{{route('admin.rate')}}">Rate</a></li>
    <li class="active">Create</li>
</ul>
@endsection

@section('content')
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{route('admin.rate.update',$id)}}" method="post">
              {{ csrf_field() }}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                      <strong>
                        <a href="{{route('admin.rate')}}">Back</a>
                        | Rates
                      </strong> Create</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="form-group {{$errors->has('category_id') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Category</label>
                        <div class="col-md-6 col-xs-12">
                            <select class="form-control select" name="category_id">
                                <option value="">--Plsease select category--</option>
                              @foreach($cates as $key => $value)
                                @if($value->id === $rate->category_id)
                                  <option value="{{$value->id}}" selected="">{{$value->name}}</option>
                                @else
                                  <option value="{{$value->id}}">{{$value->name}}</option>
                                @endif
                              @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                              <span class="help-block">{{ $errors->first('category_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has('label') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Label</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="label" value="{{$rate['label']}}"/>
                            </div>
                            @if ($errors->has('label'))
                              <span class="help-block">{{ $errors->first('label') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group {{$errors->has('index1') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Limit bottom</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="index1" value="{{$rate['index1']}}"/>
                            </div>
                            @if ($errors->has('index1'))
                              <span class="help-block">{{ $errors->first('index1') }}</span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group {{$errors->has('index2') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Limit top</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" name="index2" value="{{$rate['index2']}}"/>
                            </div>
                            @if ($errors->has('index2'))
                              <span class="help-block">{{ $errors->first('index2') }}</span>
                            @endif

                        </div>
                    </div>
                    <div class="form-group {{$errors->has('color') ? 'has-error' : ''}}">
                        <label class="col-md-3 col-xs-12 control-label">Color</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="color" class="form-control" name="color" value="{{$rate['color']}}"/>
                            </div>
                            @if ($errors->has('color'))
                              <span class="help-block">{{ $errors->first('color') }}</span>
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
