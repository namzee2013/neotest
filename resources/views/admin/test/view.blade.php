@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Test</a></li>
    <li class="active">View</li>
</ul>
@endsection
@section('content')<style type="text/css">
    .text-green {
        color: #1caf9a !important;
    }
</style>
<div class="page-content-wrap">
    <div class="col-md-12">  
            <div class="panel panel-default">
                <!-- START DEFAULT FORM ELEMENTS -->
        <form class="form-horizontal" action="{{ asset('admin/test/update') }}/{{ $test->id }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                <div class="panel-body">                    
                    <h4>Add Question to Test</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Type Question</label>
                        <div class="col-md-7">
                        @foreach ($type as $item)                            
                            <div class="col-md-4">
                                <input type="radio" name="type" value="{{ $item['id'] }}" required> {{ $item['type'] }}
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Question</label>
                        <div class="col-md-7">
                            <textarea class="form-control" name="question" rows="5" required>{!! old('question') !!}</textarea>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Image</label>
                        <div class="col-md-7">
                            <input type="file" class="fileinput btn-success" accept="image/*" name="image" title="Choose Image" id="image" style="left: -175.734px; top: 6px;">
                        </div>
                    </div>
                    <div id="check-option" >
                    </div>
                    <div id="radio-option" >
                    </div>
                    <div id="text-option" >
                    </div>                     
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-7">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Add Question">
                        </div>
                    </div>   
                </div>
                </form>
                <div class="panel-body">
                @if (count($gettestquestion))
                    <h4>List Question of Test</h4>                               
                        <?php 
                        $a = 0;
                        $id = 1;
                    ?>          
                    @foreach ($array as $key => $question_option)
                        @foreach ($question_option['question'] as $key => $value)
                                <div class="col-md-10" style="padding-top: 15px">
                                    <span class="col-md-1">Question: </span>
                                    <label class="col-md-8 text-green">
                                        {{ ucwords($value['title']) }}
                                    </label>
                                    <span class="col-md-3">{{ $value['created_at'] }} </span>
                                </div>                                        
                                <div class="col-md-2">
                                        <a class="btn btn-danger pull-right" href="{{ asset('admin/test/del-test-question') }}/{{ $gettestquestion[$a]['id'] }}">Remove</a>
                                    
                                </div>         
                                <?php
                                    $a = $a +1;
                                ?>       
                            @if ($value['image'] != null)
                                <div class="col-md-offset-2 col-md-6">
                                    <img style="width: 100%" src="{{ asset('uploads/images') }}/{{ $value['image'] }}">
                                </div>
                            @endif
                            @if($value['type_id'] == 1)
                                @foreach ($question_option['option'] as $key => $value)
                                    <div class="col-md-offset-1 col-md-10" style="padding-bottom: 5px">
                                        <input type="radio" name="{{{$value['id']}}}" required> {{$value['content']}}
                                    </div>
                                @endforeach
                            @elseif($value['type_id'] == 2)
                                @foreach ($question_option['option'] as $key => $value)
                                    <div class="col-md-offset-1 col-md-10" style="padding-bottom: 5px">
                                        <input id="{{$value['id']}}" type="checkbox" name="{{$value['id']}}"> {{$value['content']}}
                                    </div>
                                @endforeach
                            @elseif($value['type_id'] == 3)
                                    <div class="col-md-offset-1 col-md-8" style="padding-bottom: 5px">
                                        <textarea class="form-control col-sm-3" placeholder="Answer the question" value=""></textarea>
                                    </div>
                            @endif
                        @endforeach
                    @endforeach            
                    <div class="col-md-6">
                        <div class="pull-right">{!! $gettestquestion->render() !!}</div>
                    </div>
                @endif
                          
                </div>

                <div class="panel-footer">
                    <div class="col-md-10">
                        <a href="{{ asset('admin/test/list') }}" class="btn btn-default">Return List</a>
                        <a class="btn btn-primary pull-right" data-toggle="modal" data-target="#saveTest">Submit</a>
                    </div>
                </div>
                <!-- END DEFAULT FORM ELEMENTS -->            
            </div>
            <!-- Modal -->
            <div class="modal fade" id="saveTest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
              <form class="form-horizontal" action="{{ asset('admin/test/save-test') }}/{{ $test->id }}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Test Info</h5>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Time Total (min)</label>
                        <div class="col-md-7">
                            <input type="number" class="form-control" name="timetotal" placeholder="Time"/>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="col-md-3 control-label">Expired</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control datepicker" name="expired">
                        </div>
                    </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue Add Question</button>
                    <input type="submit" class="btn btn-primary" id="submit" value="Save Test"/>
                  </div>
                </div>
              </form>
              </div>
            </div>
    </div>
</div>
<script type="text/javascript">
    var i = 01;    
    

    $(document).on('click', '.btn-remove', function(e) {
        e.preventDefault();
        $(this).parents('.option').remove();
    });
    $(document).on("click", ".col-md-4 input[type='radio']", function(e) {
        
        var val = $(this).attr('value'); 
        $('.btn-option').remove();
        if(val == 1) {
            var btnRadio = '<div class="form-group btn-option">'
                    +'<div class="col-md-3"></div>'
                    +'<div class="col-md-7">'
                        +'<a type="button" class="btn btn-default btn-add-radio-option">Add Option</a>'
                    +'</div>'  
                +'</div>';
                $('#radio-option').after(btnRadio);
                $(".check-option").remove();
                $(".btn-add-check-option").remove();
                $(".btn-add-radio-option").on("click", function(e) {
                    radio = '<div class="form-group option radio-option">'
                        +'<label class="col-md-3 control-label"><input type="radio" value="'+i+'" id="check'+i+'" name="correct"> Option</label>'
                        +'<div class="col-md-7">'
                            +'<input type="text" class="form-control" name="option['+i+']" id="text'+i+'" placeholder="Option content"/>'
                        +'</div>'
                            +'<a href="#" class="btn btn-danger btn-remove"><i class="fa fa-times" aria-hidden="true"></i></a>'
                    +'</div>';
                    e.preventDefault();
                    $('#radio-option').after(radio);
                    i++;
                });
            }
        else if(val == 2)
        {
            var btnCheck = '<div class="form-group btn-option">'
            +'<div class="col-md-3"></div>'
            +'<div class="col-md-7">'
            +'<a type="button" class="btn btn-default btn-add-check-option">Add Option</a>'
            +'</div>'  
            +'</div>';
            $('#radio-option').after(btnCheck);
            $(".radio-option").remove();
            $(".btn-add-radio-option").remove();
            $(".btn-add-check-option").on("click", function(e) {
                check = '<div class="form-group option check-option">'
                +'<label class="col-md-3 control-label"><input type="checkbox" value="'+i+'" id="check'+i+'" name="correct['+i+']"> Option</label>'
                +'<div class="col-md-7">'
                +'<input type="text" class="form-control" name="option['+i+']" id="text'+i+'" placeholder="Option content"/>'
                +'</div>'
                +'<a href="#" class="btn btn-danger btn-remove"><i class="fa fa-times" aria-hidden="true"></i></a>'
                +'</div>';
                e.preventDefault();
                $('#check-option').after(check);
                i++;
            });

        }
        else{
        }
        
    });
</script>
@endsection