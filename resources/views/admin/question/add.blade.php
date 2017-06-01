@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Question</a></li>
    <li class="active">Add</li>
</ul>
@endsection
@section('content')
<script src="{{ asset('public/admin/js/jquery.validate.min.js') }}"></script>
<style>
    .cmxform fieldset p.error label {
        color: red;
    }
    div.container {
        background-color: #eee;
        border: 1px solid red;
        margin: 5px;
        padding: 5px;
    }
    div.container ol li {
        list-style-type: disc;
        margin-left: 20px;
    }
    div.container {
        display: none
    }
    .container label.error {
        display: inline;
    }
    form.cmxform {
        width: 30em;
    }
    form.cmxform label.error {
        display: block;
        margin-left: 1em;
        width: auto;
    }
    </style>
    <script>
    // only for demo purposes

    $().ready(function() {

        var container = $('div.container');
        // validate the form when it is submitted
        var validator = $("#form2").validate({
            errorContainer: container,
            errorLabelContainer: $("ol", container),
            wrapper: 'li'
        });

        $(".cancel").click(function() {
            validator.resetForm();
        });
    });
    </script>
<div class="page-content-wrap">

    <div class="col-md-12">

        <form class="form-horizontal" id="form2" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default">
                <!-- START DEFAULT FORM ELEMENTS -->
                <div class="panel-body">
                    <div class="col-md-12 container">
                        <h4>There are serious errors in your form submission, please see below for details.</h4>
                        <ol>
                        </ol>
                    </div>
                    <h4>Add new Question</h4>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category</label>
                        <div class="col-md-7">
                            <select class="form-control" name="category_id"  data-rule-required="true" data-msg-required="Please select category of question">
                                <option value="">Select Category</option>
                                @foreach ($categoryselect as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Type Question</label>
                        <div class="col-md-7">
                        @foreach ($type as $item)
                            <div class="col-md-4">
                                <input type="radio" name="type" data-rule-required="true" data-msg-required="Please select type of question" value="{{ $item['id'] }}" required> {{ $item['type'] }}
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Question</label>
                        <div class="col-md-7">
                            <textarea class="form-control" name="question" data-rule-required="true"  data-msg-required="Please enter content of question" rows="5" required>{!! old('question') !!}</textarea>
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

                </div>
                <div class="panel-footer">
                    <div class="col-md-10">
                        <a href="{{ asset('admin/category/list') }}" class="btn btn-default">Return List</a>
                        <button id="btn-save" class="btn btn-primary pull-right">Save</button>
                    </div>
                </div>
                <!-- END DEFAULT FORM ELEMENTS -->

            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var i = 01;


        $('#btn-save').click(function(){
            var searchIDs = $("input[name='correct[]']").map(function(){
            return $(this).val();
            }).get();

            console.log(searchIDs);
        });
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
                        +'<label class="col-md-3 control-label"><input type="radio" value="'+i+'" id="check'+i+'" name="correct" data-rule-required="true" data-msg-required="Select correct option"> Option</label>'
                        +'<div class="col-md-7">'
                            +'<input type="text" class="form-control" name="option['+i+']" data-rule-required="true" data-msg-required="Pls enter content option" id="text'+i+'" placeholder="Option content"/>'
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
                +'<label class="col-md-3 control-label"><input type="checkbox" value="'+i+'" id="check'+i+'" name="correct[]" data-rule-required="true" data-msg-required="Select correct option"> Option</label>'
                +'<div class="col-md-7">'
                +'<input type="text" class="form-control" name="option['+i+']"  data-rule-required="true" data-msg-required="Enter content option" id="text'+i+'" placeholder="Option content"/>'
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
</script>
@endsection
