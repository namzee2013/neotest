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
                <label class="control-label">
                  Category
                  <select id="category" onchange="changeCate();" class="select_category" name="">
                    <option value="0">--Please select category--</option>
                    @foreach($cates as $key => $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                  </select>
                </label>

              </h3>
            </div>

            <div class="panel-body panel-body-table">

                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Time Spend</th>
                                <th>Time Total</th>
                                <th>Mark</th>
                                <th width="100">actions</th>
                            </tr>
                        </thead>
                        <tbody id="tblTests">
                          @foreach($tests as $key => $value)
                            <tr id="trow_{{$key}}" @if($key % 2 == 0) class="info" @endif>
                                <td class="text-center">{{$key+1}}</td>
                                <td><strong>{{$value->name}}</strong></td>
                                <td>{{$value->email}}</td>
                                <td>{{$value->timespend}} sec</td>
                                <td>{{$value->timetotal}} min</td>
                                @if($value->mark > 0)
                                  <td style="background-color: {{$value->color}}">{{$value->mark}}</td>
                                  <td>
                                    <a class="btn btn-danger" href="{{route('admin.test.editmark', $value->id)}}">Remark</a>
                                  </td>
                                @else
                                  <td>0</td>
                                  <td><a class="btn button-primary" href="{{route('admin.test.editmark', $value->id)}}">Mark</a></td>
                                @endif
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
        <div class="panel panel-default">
            <div class="panel-body">
              @include('admin.includes.rate')
            </div>
        </div>
    </div>
</div>
<script src="{{asset('public/admin/js/code/marked.js')}}" type="text/javascript">

</script>
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
