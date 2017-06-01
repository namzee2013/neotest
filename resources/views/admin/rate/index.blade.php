@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{route('admin.home')}}">Admin</a></li>
    <li class="active">Role</li>
</ul>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
              <h3 class="panel-title">
                <a href="{{route('admin.rate.create')}}" class="btn btn-info">Add Rate</a>
                <label class="control-label">
                  Category
                  <select id="category" onchange="changeCate();" class="select_category" name="">
                    <option value="0">--please category--</option>
                    @foreach($cates as $key => $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                  </select>
                </label>
              </h3>
            </div>
            <div class="panel-body panel-body-table">

                <div class="table-responsive">

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th width="50">id</th>
                                <th>Category</th>
                                <th>Label</th>
                                <th>Limit bottom</th>
                                <th>Limit top</th>
                                <th width="100">Color</th>
                                <th width="200">actions</th>
                            </tr>
                        </thead>
                        <tbody id="tblRates">
                          @foreach($rates as $key => $value)
                            <tr id="trow_{{$key}}">
                                <td class="text-center">{{$key+1}}</td>
                                <td>{{$value->category->name}}</td>
                                <td><strong>{{$value->label}}</strong></td>
                                <td>{{$value->index1}}</td>
                                <td>{{$value->index2}}</td>
                                <td style="background-color: {{$value->color}}"></td>
                                <td>
                                    <a href="{{route('admin.rate.edit', $value->id)}}" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                    <a class="btn btn-danger btn-rounded btn-sm" onClick="return confirm_delete('Bạn chắc chắn muốn xóa rate: {{$value->label}}')" href="{{route('admin.rate.delete', $value->id)}}" ><span class="fa fa-times"></span></a>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
var changeCate = function(){
    var categoryId = $('#category').val();
    var temp = '';
    $.ajax({
      url:'/admin/rate/category/' + categoryId,
      type:'GET',
      cache:false,
      data:{'id':categoryId},
      success: function(data){
        // console.log(data);
        if (data.length > 0) {
          data.forEach((value,key) => {
            temp += '<tr id="trow_'+key+'">'
                +'<td class="text-center">'+(key+1)+'</td>'
                +'<td>'+value.category.name+'</td>'
                +'<td><strong>'+value.label+'</strong></td>'
                +'<td>'+value.index1+'</td>'
                +'<td>'+value.index2+'</td>'
                +'<td style="background-color: '+value.color+'">'+value.id+'</td>'
                +'<td>'
                    +'<a href="'+baseURL+'/admin/rate/edit/'+value.id+'" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>'
                    +'<a href="'+baseURL+'/admin/rate/delete/'+value.id+'" class="btn btn-danger btn-rounded btn-sm" onClick="return confirm_delete(\'Bạn chắc chắn muốn xóa rate: '+value.label+' \')"  ><span class="fa fa-times"></span></a>'
                +'</td>'
            +'</tr>';

          });
        }
        $('#tblRates').html(temp);
      }
    });

}
</script>
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
