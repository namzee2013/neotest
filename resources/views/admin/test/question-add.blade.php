@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Test</a></li>
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
                    <h4>Add new Test</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category</label>
                        <div class="col-md-7">
                            <select id="category" class="form-control select">
                                <option value="">Select Category</option>
                                @foreach ($categoryselect as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" >Type Question</label>
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
                    <div id="check-option" >
                    </div>
                    <div id="radio-option" >
                    </div>
                    <div id="text-option" >
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-3">                            
                            <a class="btn btn-info pull-right" id="addQuestion">Add Question to Test</a>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="col-md-10">
                        <a href="{{ asset('admin/category/list') }}" class="btn btn-default">Return List</a>
                        <button class="btn btn-primary pull-right">Save Test</button>
                    </div>
                </div>
                <!-- END DEFAULT FORM ELEMENTS -->

            </div>
        </form>
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
            $('.form-horizontal').attr('action','{{ asset('admin/question/add-one-choice') }}');
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
            $('.form-horizontal').attr('action','{{ asset('admin/question/add-multi-choice') }}');
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
            $('.form-horizontal').attr('action','{{ asset('admin/question/add-text-quest') }}');
        }
        
    });
    $(document).ready(function(){
        var data = [];
        var save = localStorage.getItem['data'];
        if(save)
        {
            data = JSON.parse(localStorage['data']);
            console.log('test: '+data);
        }
        $('#addQuestion').click(function(){
            var category_id = $('#category').val();
            var type = $('input[name=type]:checked').val();
            var question = $('textarea[name=question]').val();
            var option = [];
            $('input[name^="option"]').each(function() {
                    option.push({
                        option: $(this).val(),
                        status: 0
                    });
                });
            var optionLength = option.length;
            if (type == 1) {
                var correct = $('input[name=correct]:checked').val();
                for (var i = 0; i < optionLength; i++) {
                    if($('input[name^="option['+correct+'"]').val() == option[i].option)
                    {
                        option[i].status = 1;
                    }
                }
            }
            else if(type == 2)
            {
                var correct = [];
                $('input[name^="correct"]:checked').each(function() {
                    correct.push({
                        value: $(this).val()
                    });
                });
                var JSONcorrect = JSON.stringify(correct);
                var correctLenght = correct.length;
                for (var i = 0; i < optionLength; i++) {
                    for (var j = 0; j < correctLenght; j++) {
                        var crr = correct[j].value;
                        var test = $('input[name^="option['+crr+']').val();
                        if(test == option[i].option)
                        {
                            option[i].status = 1;
                        }  
                    }
                }
            }
            data.push({
                category: category_id,
                type: type,
                question: question,
                option: option
            });
            JSONdata = JSON.stringify(data);
            localStorage.setItem('data', JSONdata);
            console.log(localStorage['data']); 
            
        });
    });
    
</script>
@endsection
