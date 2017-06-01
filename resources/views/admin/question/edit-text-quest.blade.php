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
        <form class="form-horizontal" action="{{ asset('admin/question/edit-text-quest') }}/{{ $question['id'] }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
            <div class="panel panel-default">
                <!-- START DEFAULT FORM ELEMENTS -->
                <div class="panel-body">
                    <h4>Add new Text Question</h4>     
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category</label>
                        <div class="col-md-7">
                            <select class="form-control select" name="category_id" >
                                @foreach ($categoryselect as $item)
                                    @if ($question['category_id'] == $item['is'])
                                        <option value="{{ $item['id'] }}" selected>{{ $item['name'] }}</option>
                                    @else
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endif
                                    
                                @endforeach
                            </select>
                        </div>
                    </div>                                
                    <div class="form-group">
                        <label class="col-md-3 control-label">Question</label>
                        <div class="col-md-7">
                            <textarea class="form-control" name="question" rows="5">{!! $question['title'] !!}</textarea>
                        </div>
                    </div>   
                    @foreach ($option as $item)
                        <div class="form-group">
                            <label class="col-md-3 control-label">Review Answer</label>
                            <div class="col-md-7">
                                <textarea class="form-control" name="answer" rows="5">{!! $item['content'] !!}</textarea>
                            </div>
                        </div>
                    @endforeach          
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