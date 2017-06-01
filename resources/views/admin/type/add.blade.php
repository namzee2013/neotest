@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Type</a></li>
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
                    <h4>Add new Type</h4>                                  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Type</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="type" placeholder="Type name"/>
                            </div>
                        </div>       
                </div>
                <div class="panel-footer">
                    <div class="col-md-10">
                        <a href="{{ asset('admin/type/list') }}" class="btn btn-default">Return List</a>
                        <button class="btn btn-primary pull-right">Add new</button>
                    </div>
                </div>
                <!-- END DEFAULT FORM ELEMENTS -->            
            </div>
        </form>
    </div>
</div>
@endsection