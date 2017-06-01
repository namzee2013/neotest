@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li class="active">Dashboard</li>
</ul>
@endsection
@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-6">

        <!-- START DONUT CHART -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Count Tests each Category</h3>
            </div>
            <div class="panel-body">
                <div id="morris-donut-example" style="height: 300px;"></div>
            </div>
        </div>
        <!-- END DONUT CHART -->

    </div>
    <div class="col-md-6">

        <!-- START DONUT CHART -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Count User Test each Category</h3>
            </div>
            <div class="panel-body">
                <div id="user-test" style="height: 300px;"></div>
            </div>
        </div>
        <!-- END DONUT CHART -->

    </div>
  </div>

  <div class="row">
    <div class="col-md-6">

        <!-- START DONUT CHART -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Rate Tests</h3>
            </div>
            <div class="panel-body">
                <div id="statistic-with-mark" style="height: 300px;"></div>
            </div>
        </div>
        <!-- END DONUT CHART -->

    </div>
  </div>
</div>
@endsection

@section('script')

<script type="text/javascript" src="{{asset('public/admin/js/charts.js')}}"></script>
@endsection
