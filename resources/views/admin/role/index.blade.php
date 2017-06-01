@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{route('admin.home')}}">Admin</a></li>
    <li class="active">Role</li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
              <h3 class="panel-title">
                <a href="{{route('admin.role.create')}}" class="btn btn-info">Add Role</a>
                Roles tables</h3>


            </div>

            <div class="panel-body panel-body-table">

                <div class="table-responsive">

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th width="50">id</th>
                                <th>role</th>

                                <th width="200">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($roles as $key => $value)
                            <tr id="trow_{{$key}}">
                                <td class="text-center">{{$key+1}}</td>
                                <td><strong>{{$value->role}}</strong></td>
                                <td>
                                    <a href="{{route('admin.role.edit', $value->id)}}" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                    <a class="btn btn-danger btn-rounded btn-sm" onClick="return confirm_delete('Bạn chắc chắn muốn xóa role: {{$value->role}}')" href="{{route('admin.role.delete', $value->id)}}" ><span class="fa fa-times"></span></a>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to remove this row?</p>
                <p>Press Yes if you sure.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX-->
@endsection
