@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Test</a></li>
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
                    <h4>Add new Test</h4>                                  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Category</label>
                            <div class="col-md-7">
                                <select class="form-control select" name="category_id">
                                    <option>Select Category</option>
                                    @foreach ($categoryselect as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                                         
                        <div class="form-group">
                            <label class="col-md-3 control-label">Quantity One-choice Quest</label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" name="qOneQuest" placeholder="Quantity of One-choice Question"/>
                            </div>
                        </div>                             
                        <div class="form-group">
                            <label class="col-md-3 control-label">Quantity Multi-choice Quest</label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" name="qMultiQuest" placeholder="Quantity of Multi-choice Question"/>
                            </div>
                        </div>                             
                        <div class="form-group">
                            <label class="col-md-3 control-label">Quantity Text Quest</label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" name="qTextQuest" placeholder="Quantity of Text Question"/>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label class="col-md-3 control-label">Time Total (min)</label>
                            <div class="col-md-7">
                                <input type="number" class="form-control" name="timetotal" placeholder="Time"/>
                            </div>
                        </div>                    
                        <div class="form-group">
                            <label class="col-md-3 control-label">Expired</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control datepicker" name="expired">
                            </div>
                        </div>  
                </div>
                <div class="panel-footer">
                    <div class="col-md-10">
                        <a href="{{ asset('admin/category/list') }}" class="btn btn-default">Return List</a>
                        <button class="btn btn-primary pull-right">Add new</button>
                    </div>
                </div>
                <!-- END DEFAULT FORM ELEMENTS -->            
            </div>
        </form>
    </div>
</div>
@endsection