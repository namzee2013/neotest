@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Question</a></li>
    <li class="active">Add</li>
</ul>
@endsection
@section('content')
<div class="page-content-wrap">
    <div class="col-md-12">
        <form class="form-horizontal" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            <div class="panel panel-default">
                <!-- START DEFAULT FORM ELEMENTS -->
                <div class="panel-body">
                    <h4>Add new Text Question</h4>     
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category</label>
                        <div class="col-md-7">
                            <select class="form-control select" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categoryselect as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                
                    <div class="form-group">
                        <label class="col-md-3 control-label">Question</label>
                        <div class="col-md-7">
                            <textarea class="form-control" name="question" rows="5">{!! old('question') !!}</textarea>
                        </div>
                    </div>                                  
                          
                </div>
                <div class="panel-footer">
                    <div class="col-md-10">
                        <a href="{{ asset('admin/category/list') }}" class="btn btn-default">Return List</a>
                        <button class="btn btn-primary pull-right">Save</button>
                    </div>
                </div>
                <!-- END DEFAULT FORM ELEMENTS -->            
            </div>
        </form>
    </div>
</div>
@endsection