@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{route('admin.home')}}">Admin</a></li>
    <li class="active">Test</li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
              <h3 class="panel-title">
                </h3>
            </div>

            <div class="panel-body panel-body-table">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-actions">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Time Total</th>
                                <th>Expired</th>
                                <th>Mark Total</th>
                                <th width="100">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($tests as $key => $value)
                            <tr id="trow_{{$key}}">
                                <td class="text-center">{{$key+1}}</td>
                                <td>{{$value->timetotal}}</td>
                                <td>{{$value->expired}}</td>
                                <td>{{$value->total_mark}}</td>
                                <td>
                                  <a class="btn btn-info" href="{{route('admin.test.setmark', $value->id)}}">Set Mark</a>
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
