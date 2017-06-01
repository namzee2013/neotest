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
                    <h4>Choose Type of Question</h4>  
                <div class="panel-footer">
                    <div class="col-md-12">
                        <div class="col-md-4 pd-top20">
                            <a href="{{ asset('admin/question/add-one-choice') }}" class="btn btn-success btn-block">One-choice Question</a>
                        </div>
                        <div class="col-md-4 pd-top20">
                            <a href="{{ asset('admin/question/add-multi-choice') }}" class="btn btn-success btn-block">Multi-choice Question</a>
                        </div>
                        <div class="col-md-4 pd-top20">
                            <a href="{{ asset('admin/question/add-text-quest') }}" class="btn btn-success btn-block">Text Question</a>
                        </div>
                    </div>
                </div>
                <!-- END DEFAULT FORM ELEMENTS -->            
            </div>
        </form>
    </div>
</div>
@endsection