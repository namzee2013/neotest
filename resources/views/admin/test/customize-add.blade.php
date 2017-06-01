@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Test</a></li>
    <li class="active">Add</li>
</ul>
@endsection
@section('content')
<style type="text/css">
    .secret{
        display: none;
    }
    .text-green {
        color: #1caf9a !important;
    }
</style>
<?php 
    use App\Option;
?>
<div class="page-content-wrap">
    <div class="col-md-12">
        <form class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">   
            <div class="panel panel-default">
                <!-- START DEFAULT FORM ELEMENTS -->
                <div class="panel-body">
                    <h4>Choose Question for Test</h4>
                    @foreach ($getquestion as $item)
                        <?php
                            $type = $item['type_id'];
                            $question_id = $item['id'];
                            $option = Option::where('question_id', $question_id)->get();
                            
                        ?>
                        <div class="col-md-10" style="padding-top: 15px">
                            <span class="col-md-1">Question: </span>
                            <label class="col-md-11 text-green">
                                {{ ucwords($item['title']) }}
                            </label>
                        </div>                                        
                        <div class="col-md-2">
                            <a class="btn btn-info pull-right" name="add-question" id="add{{{$question_id}}}">Add to Test</a>
                            <a class="btn btn-danger secret pull-right" name="remove-question" id="rem{{{$question_id}}}">Remove</a>
                        </div> 
                        @if($type == 1)
                            @foreach ($option as $key => $value)
                                <div class="col-md-offset-1 col-md-10" style="padding-bottom: 5px">
                                    <input type="radio" name="{{{$question_id}}}"> {{$value['content']}}
                                </div>
                            @endforeach
                        @elseif($type == 2)
                            @foreach ($option as $key => $value)
                                <div class="col-md-offset-1 col-md-10" style="padding-bottom: 5px">
                                    <input id="{{$value['id']}}" type="checkbox" name="{{$question_id}}"> {{$value['content']}}
                                </div>
                            @endforeach
                        @elseif($type == 3)
                            <div class="col-md-offset-1 col-md-10" style="padding-bottom: 5px">
                                <textarea class="form-control col-sm-3" placeholder="Answer the question" value=""></textarea>
                            </div>
                        @endif
                     @endforeach 
                </div>
                <div class="col-md-6"><div class="pull-right">{!! $getquestion->render() !!}</div></div>
                <div class="panel-footer">
                    <div class="col-md-11">
                        <a href="{{ asset('admin/test/list') }}" class="btn btn-default">Return List</a>
                        <a class="btn btn-primary pull-right" id="btn-submit" data-toggle="modal" data-target="#myModal">Submit</a>
                    </div>
                </div>
                <!-- END DEFAULT FORM ELEMENTS -->            
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Test Info</h5>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Time Total (min)</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" id="timetotal" placeholder="Time"/>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Expired</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control datepicker" id="expired">
                        </div>
                    </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue Choose Question</button>
                    <button type="button" class="btn btn-primary" id="submit" data-token="{{ csrf_token() }}">Save Test</button>
                  </div>
                </div>
              </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var arr = [];
    var i;
    $(document).ready(function(){
        var save = sessionStorage.getItem('arr');
        if (save) {
            arr = JSON.parse(sessionStorage['arr']);
            for (i = 0; i < arr.length ; i++) {
                id = arr[i].id;
                $('#add'+id).attr('style','display:none');
                $('#rem'+id).attr('style','display:inline-block');
                $('#selected').remove();
                var selected = '<span id="selected" class="col-md-3 pull-right">Selected: '
                        + arr.length+' question</span>';
                $('#btn-submit').after(selected);
            }
        }
        $('.btn-info').click(function(){
            $(this).hide();
            var qid = $(this).attr('id').substring(3);
            $('#rem'+qid).attr('style','display:inline-block');
            arr.push(
                {
                    id:qid
                });

            $('#selected').remove();
            var selected = '<span id="selected" class="col-md-3 pull-right">Selected: '
                        + arr.length+' question</span>';
            $('#btn-submit').after(selected);
            console.log(arr);
            JSONarray = JSON.stringify(arr);
            sessionStorage.setItem('arr',JSONarray);
            console.log(sessionStorage['arr']);

        });
        $('.btn-danger').click(function(){
            $(this).hide();
            var qid = $(this).attr('id').substring(3);
            $('#add'+qid).show();
            if(arr.length > 0){
                for(i= 0; i < arr.length; i++)
                {
                    if(arr[i].id == qid)
                    {
                        var index = arr.indexOf(arr[i]);
                        arr.splice(index,1);
                    }
                }
            }

            $('#selected').remove();
            var selected = '<span id="selected" class="col-md-3 pull-right">Selected: '
                        + arr.length+' question</span>';
            $('#btn-submit').after(selected);
            console.log(arr);
            JSONarray = JSON.stringify(arr);
            sessionStorage.setItem('arr',JSONarray);
            console.log(sessionStorage['arr']);
        });
        $('#submit').click(function(){
            var url = '/admin/test/';
            var timetotal = $("#timetotal").val();
            var expired = $('#expired').val();
            console.log(timetotal+ "|" + expired);
            var data = {
                _token:$(this).data('token'),
                arr: arr,
                expired: expired,
                timetotal: timetotal,
                category: {{ $cate }}
            }
            $.ajax({
                url : url + 'customize-add/{{ $cate }}',
                type : "post",
                cache : false,
                data: data,
                
                success:function(data){
                    sessionStorage.clear();
                    window.location.href = "{{ asset('admin/test/list') }}";
                },
                error:function(data){
                    console.log("Error :" +data);
                }
            });
        });
    });
</script>
@endsection