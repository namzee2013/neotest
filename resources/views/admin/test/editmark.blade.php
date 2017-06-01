@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{route('admin.home')}}">Admin</a></li>
    <li><a href="{{route('admin.test.all')}}">Test</a></li>
    <li class="active">Edit Mark</li>
    <li class="active">{{$id}}</li>
</ul>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <style media="screen">
          .single{
            display: grid;
          }.multiple{
            display: grid;
          }.false{
            /*background: red;*/
            color: red;
          }.true{
            color: #1caf9a;
            /*color: #fff;*/
            color: #E04B4A;
          }.true{
            color: #1caf9a;
          }.visibled{
            display: none;
          }.diem{
            display: inline;
          }.totalmark{
            display: inline;
          }.sum{
            display: inline;
          }.error{
            border:2px solid red;
          }textarea.comment{
            margin-top: 10px;
          }a.save{
            margin-top: 10px;
          }
        </style>
      <form class="form-horizontal">
        <input id="UserTestID" type="hidden" name="" value="{{$id}}">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title"> Mark for test</h3>
                  <ul class="panel-controls">
                      <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                  </ul>
              </div>
              <div class="panel-body">
                @foreach($data as $key => $value)
                  <div id="{{$value->question_id}}" class="form-group">
                      <label class="col-md-3 col-xs-12 control-label">Câu {{$key+1}}</label>
                      <div class="col-md-6 col-xs-12">
                        <p><strong>{{$value->title}}</strong></p>
                        @if($value->type === 'single')
                          <div class="single">
                            @foreach($value->options as $keyOpt => $valueOpt)
                                @if($value->result === $valueOpt->id && $valueOpt->status === 1)
                                    <label class="check true">
                                      <strong>{{$characters[$keyOpt]}} . </strong>
                                      <input type="radio" class="iradio" name="iradio_{{$key}}" checked/>
                                      <strong>{{$valueOpt->content}}</strong>
                                    </label>
                                @elseif($value->result === $valueOpt->id)
                                    <label class="check false">
                                      <strong>{{$characters[$keyOpt]}} . </strong>
                                      <input type="radio" class="iradio" name="iradio_{{$key}}" checked/>
                                      {{$valueOpt->content}}
                                    </label>
                                @else
                                  <label class="check">
                                    <strong>{{$characters[$keyOpt]}} . </strong>
                                    <input type="radio" class="iradio" name="iradio_{{$key}}"/>
                                    {{$valueOpt->content}}
                                  </label>
                                @endif
                            @endforeach
                          </div>
                        @elseif($value->type === 'multiple')
                          <div class="multiple">
                            @foreach($value->options as $keyOpt => $valueOpt)
                              <?php $status = -1; ?>
                              @foreach($value->resultArr as $keyR => $valueR)
                                @if($valueOpt->status === 1 && $valueOpt->id === $valueR)
                                  <?php $status = 1; ?>
                                @elseif($valueOpt->id === $valueR)
                                  <?php $status = 0; ?>
                                @endif
                              @endforeach
                              @if($status === 1)
                                  <label class="check true">
                                    <strong>{{$characters[$keyOpt]}} . </strong>
                                    <input type="checkbox" class="icheckbox" checked/>
                                     <strong>{{$valueOpt->content}}</strong>
                                   </label>
                              @elseif($status === 0)
                                  <label class="check false">
                                    <strong>{{$characters[$keyOpt]}} . </strong>
                                    <input type="checkbox" class="icheckbox" checked/>
                                    {{$valueOpt->content}}
                                   </label>
                              @else
                                  <label class="check">
                                    <strong>{{$characters[$keyOpt]}} . </strong>
                                    <input type="checkbox" class="icheckbox"/>
                                    {{$valueOpt->content}}
                                   </label>
                              @endif
                            @endforeach
                          </div>
                        @else
                          <div class="text">
                              <textarea class="form-control" name="name" rows="8" cols="80">{{$value->result}}</textarea>
                              <!-- <div class="marked">
                                <input class="mark" id="{{$key+1}}" question="{{$key+1}}" type="text" maxlength="2"  name="mark" value="">
                                <a href="#" class="btn btn-primary save">save</a>
                              </div> -->
                          </div>
                        @endif
                      </div>
                      <div class="col-md-3 col-xs-12">

                        <div id="{{$value->id}}" class="marked">
                          @if($value->type === 'text')
                            @if(isset($value->diem))
                              <input class="mark form-control" id="{{$key+1}}" question="{{$key+1}}" type="text" maxlength="2"  name="mark" value="{{$value->diem}}">
                            @else
                              <input class="mark form-control" id="{{$key+1}}" question="{{$key+1}}" type="text" maxlength="2"  name="mark">
                            @endif
                            @if(isset($value->comment))
                              <textarea class="comment form-control" name="name" rows="3" placeholder="enter comment">{{$value->comment}}</textarea>
                            @else
                              <textarea class="comment form-control" name="name" rows="3" placeholder="enter comment"></textarea>
                            @endif
                            <a diem-max="{{$value->mark_max}}"  href="#" class="btn button-primary save">save</a>
                          @endif
                        </div>
                      </div>
                  </div>
                  <hr>
                @endforeach
                @if($total > 0)
                  <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label"><h3 class="sum">Tổng điểm Trước: </h3></label>
                      <div class="col-md-6 col-xs-12">
                          <h1 class="diem">{{$total}}</h1><h1 class="totalmark"> / {{$totalmark}}</h1>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label"><h3 class="sum">Tổng điểm: </h3></label>
                      <div class="col-md-6 col-xs-12">
                          <h1 id="diem" class="diem">{{$marktrue}}</h1><h1 class="totalmark"> / {{$totalmark}}</h1>
                      </div>
                  </div>
                @else
                  <div class="form-group">
                      <label class="col-md-3 col-xs-12 control-label"><h3 class="sum">Tổng điểm: </h3></label>
                      <div class="col-md-6 col-xs-12">
                          <h1 id="diem" class="diem">{{$marktrue}}</h1><h1 class="totalmark"> / {{$totalmark}}</h1>
                      </div>
                  </div>
                @endif

              </div>
              <div class="panel-footer">
                  <!-- <button class="btn btn-default">Clear Form</button> -->
                  <img class="loading pull-right visibled" src="{{asset('public/admin/assets/loading.gif')}}" alt="">
                  <a class="btn btn-primary pull-right submit">Save</a>
              </div>
          </div>
      </form>
    </div>
</div>
<script src="{{asset('public/admin/js/editmark.js')}}" type="text/javascript"></script>
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
