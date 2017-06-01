@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{route('admin.home')}}">Admin</a></li>
    <li><a href="{{route('admin.test')}}">Test</a></li>
    <li class="active">Edit Mark</li>
    <li class="active">{{$id}}</li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 ">
      <style media="screen">
        .disabled{
          display: none;
        }
      </style>
        <div class="panel panel-default">

            <div class="panel-heading">
              <h3 class="panel-title">
                <a href="{{route('admin.test')}}">Back</a>
                </h3>
            </div>

            <div class="panel-body panel-body-table">



                    <table id="{{$id}}" class="table" >
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Question</th>
                                <th>Option</th>
                                <th width="200">
                                  <label class="check">
                                    <input type="checkbox" class="check_all" id="check_all"/>
                                    check all
                                   </label>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $key => $value)
                            <tr @if($key % 2 == 0) class="row-color" @endif>
                              <td>{{$key+1}}</td>
                              <td>{{$value->title}}</td>
                              @if($value->type === 'single')

                              @endif
                              <td>
                                @foreach($value->options as $keyOpt => $valueOpt)
                                  @if($value->type === 'single')
                                    @if($valueOpt->status === 1)
                                      <label class="check">
                                        <input type="radio" class="iradio" name="iradio_{{$key}}" checked=""/>
                                        <strong>{{$valueOpt->content}}</strong>
                                      </label>
                                    @else
                                      <label class="check">
                                        <input type="radio" class="iradio" name="iradio_{{$key}}"/>
                                        <strong>{{$valueOpt->content}}</strong>
                                      </label>
                                    @endif

                                  @elseif($value->type === 'multiple')
                                    @if($valueOpt->status === 1)
                                    <label class="check">
                                      <input type="checkbox" class="icheckbox" checked=""/>
                                       <strong>{{$valueOpt->content}}</strong>
                                     </label>
                                    @else
                                    <label class="check">
                                      <input type="checkbox" class="icheckbox"/>
                                       <strong>{{$valueOpt->content}}</strong>
                                     </label>
                                    @endif

                                  @else

                                  @endif
                                @endforeach
                              </td>
                              <td>
                                <div id="set_mark" class="marked">
                                  <input class="mark form-control" id="{{$key+1}}" question="{{$key+1}}" type="text" maxlength="2"  name="mark" value="{{$value->mark_max}}">
                                  <a id="{{$value->id}}" href="#" class="btn button-primary save">save</a>
                                </div>
                              </td>

                            </tr>
                          @endforeach
                          <tr id="all" class="disabled">
                            <td colspan="3">Điểm mỗi câu: </td>
                            <td colspan="1">
                              <input class="mark form-control" id="{{$key+1}}" question="{{$key+1}}" type="text" maxlength="2"  name="mark" value="{{$value->mark_max}}">
                              <a id="{{$value->id}}" href="#" class="btn button-primary save-all">save</a>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="3">Tổng điểm: </td>
                            <td id="summark" colspan="1">0</td>
                          </tr>

                        </tbody>
                    </table>

            </div>
        </div>


    </div>
</div>
<script src="{{asset('public/admin/js/setmark.js')}}" type="text/javascript"></script>
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
