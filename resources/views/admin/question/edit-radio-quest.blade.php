@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Question</a></li>
    <li class="active">Edit</li>
</ul>
@endsection
@section('content')
<div class="page-content-wrap">
    <div class="col-md-12">
        <form class="form-horizontal" action="{{ asset('admin/question/edit-radio-quest') }}/{{ $question['id'] }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default">
                <!-- START DEFAULT FORM ELEMENTS -->
                <div class="panel-body">
                    <h4>Edit One-choice Question</h4>
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
                            <input type="hidden" name="type_id" value="1">
                        </div>
                    </div>
                    @foreach ($option as $item)
                        <div class="form-group option">
                            <label class="col-md-3 control-label">
                            @if ($item['status'] == 1)
                                <input type="radio" value="{{ $item['id']}}" name="correct" checked>
                            @else
                                <input type="radio" value="{{ $item['id']}}"  name="correct">
                            @endif
                             Option</label>
                            <div class="col-md-7">
                                <input type="hidden" name="option_id[{{ $item['id'] }}]" value="{{ $item['id'] }}">
                                <input type="text" class="form-control" name="option[{{ $item['id']}}]" id="{{ $item['id']}}" value="{!! $item['content'] !!}">
                            </div>
                            <a href="{{ asset('admin/question/del-option') }}/{{ $item['id'] }}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </div>
                    @endforeach
                    <div id="options" >
                    </div>
                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-7">
                            <a type="button" class="btn btn-default btn-add-more-option">Add Option</a>
                        </div>  
                    </div>

                </div>
                <div class="panel-footer">
                    <div class="col-md-10">
                        <a href="{{ asset('admin/question/list') }}" class="btn btn-default">Return List</a>
                        <button class="btn btn-primary pull-right">Update</button>
                    </div>
                </div>
                <!-- END DEFAULT FORM ELEMENTS -->

            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var i = 01;
    $(".btn-add-more-option").on("click", function(e) {
        tempopt = '<div class="form-group option">'
            +'<label class="col-md-3 control-label"><input type="radio" value="'+i+'" id="check'+i+'" name="correct"> Option</label>'
            +'<div class="col-md-7">'
                +'<input type="text" class="form-control" name="option['+i+']" id="text'+i+'" placeholder="Option content"/>'
            +'</div>'
                +'<a href="#" class="btn btn-danger btn-remove"><i class="fa fa-times" aria-hidden="true"></i></a>'
        +'</div>';
        e.preventDefault();
        $('#options').after(tempopt);
        i++;
    });

    $(document).on('click', '.btn-remove', function(e) {
        e.preventDefault();
        $(this).parents('.option').remove();
    });
    // $(document).on("click", "input[type='radio']", function(e) {
    //     var idattr = $(this).attr('id');
    //     var id     = idattr.substring(5);
        
    // });
</script>
@endsection
