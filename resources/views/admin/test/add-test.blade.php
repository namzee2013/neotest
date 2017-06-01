@extends('admin.layouts.master')
@section('breadcrumb')
<style type="text/css">
    .pd-top20{
        padding-top: 20px;
    }
</style>
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
            <div class="panel panel-default">
                <!-- START DEFAULT FORM ELEMENTS -->
                <div class="panel-body">
                    <h4>Choose Category</h4>  
                                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Category</label>
                            <div class="col-md-7">
                                <select class="form-control select" id="category_id" name="category_id">
                                    <option>Select Category</option>
                                    @foreach ($categoryselect as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>    
                <!-- END DEFAULT FORM ELEMENTS -->            
            </div>
            <div id="content-ajax">           
            </div>
            
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#category_id').on('change',function(){        
        sessionStorage.clear();
        var category = $("#category_id").val();
        window.location.href = "{{ asset('admin/test/add-new') }}/"+category;
    });
</script>
@endsection