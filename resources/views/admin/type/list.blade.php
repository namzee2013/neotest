@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Type</a></li>
    <li class="active">List</li>
</ul>
@endsection
@section('content')
<div class="page-content-wrap">
    <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">                     
                <a href="{{ asset('admin/type/add') }}" class="btn btn-info">Add Type</a>
            </div>
            <div class="panel-heading">                                
                <h3 class="panel-title">List Type</h3>
            </div>
            <div class="panel-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Time Updated</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($type as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td>{{ $item['updated_at'] }}</td>
                            <td>
                                <a href="{{ asset('admin/type/edit') }}/{{ $item['id'] }}" title="Edit"><i class="fa fa-cog"></i></a>    
                                <a  data-toggle="modal" data-target="#del{{ $item['id'] }}" title="Delete"><i class="fa fa-trash-o"></i></a> 

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($type as $item)

                <!-- Modal -->
                <div class="modal fade" id="del{{ $item['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete Item</h4>
                        </div>
                        <div class="modal-body">
                            Delete this data. Are you sure?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <a href="{{ asset('admin/type/delete') }}/{{ $item['id'] }}" class="btn btn-primary">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- END DEFAULT DATATABLE -->
</div>
</div>  
@endsection