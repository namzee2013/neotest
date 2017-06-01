@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Question</a></li>
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
                    <h4>Add new One-choice Question</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category</label>
                        <div class="col-md-7">
                            <select class="form-control select" name="category_id" >
                                <option value="">Select Category</option>
                                @foreach ($categoryselect as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Question</label>
                        <div class="col-md-7">
                            <textarea class="form-control" name="question" rows="5">{!! old('question') !!}</textarea>
                            <input type="hidden" name="type_id" value="1">
                        </div>
                    </div>
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
                        <a href="{{ asset('admin/category/list') }}" class="btn btn-default">Return List</a>
                        <button class="btn btn-primary pull-right">Save</button>
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
