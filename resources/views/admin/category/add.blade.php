@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Category</a></li>
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
                    <h4>Add new Category</h4>                                  
                        <div class="form-group">
                            <label class="col-md-3 control-label">Category</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="name" placeholder="Category name"/>
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