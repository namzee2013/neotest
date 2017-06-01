@extends('admin.layouts.master')
@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="#">Home</a></li>
    <li><a href="#">Test</a></li>
    <li class="active">List</li>
</ul>
@endsection
@section('content')
<style type="text/css">
    .copied{
        display: none;
        color:#1caf9a;
    }
</style>
<?php
    use App\TestQuestion;
    use App\Category;
    use App\Test;
?>
<div class="page-content-wrap">
    <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">                     
                <a href="{{ asset('admin/test/add') }}" class="btn btn-info">Add Test (Random Question)</a>
                <a href="{{ asset('admin/test/add-test') }}" class="btn btn-info">Add Test (Choose Question)</a>
                <a href="{{ asset('admin/test/question-add') }}" class="btn btn-info">Add Test (Also add Question)</a>
            </div>
            <div class="panel-heading">                                
                <h3 class="panel-title">List All Test</h3>
            </div>
            <div class="panel-body">
                <div class="panel-group accordion">
                @foreach ($categoryselect as $category)
                    <div class="panel panel-primary" style="box-shadow: none; border-radius: 0">
                        <div class="panel-heading ui-draggable-handle">
                            <h4 class="panel-title">
                                <?php
                                    $totaltest = Test::where('category_id', $category['id'])->get()->toArray();                      
                                ?>
                                <a href="#cate{{$category['id']}}">
                                    {{$category['name']}} Test (quantity: {{count($totaltest)}})
                                </a>
                            </h4>
                        </div>                                
                        <div class="panel-body" id="cate{{$category['id']}}">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Link</th>
                                        <th>Question</th>
                                        <th>Time Updated</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($test as $item)
                                        @if ($category['id'] == $item['category_id'])
                                            <?php
                                                $testquestion = TestQuestion::where('test_id',$item['id']);
                                                $countquestion = count($testquestion->get()->toArray());
                                            ?>
                                            <tr>
                                                <td>{{ $item['id'] }}</td>
                                                <td>
                                                    <a class="btn btn-info" data-toggle="modal" data-target="#sendMail{{ $item['id'] }}">Send Link</a>
                                                    <button class="btn btn-warning" data-clipboard-text="{{ asset('/test') }}/{{ $item['link'] }}">Copy Link</button>                            
                                                </td>
                                                <td>{{ $countquestion }}</td>
                                                <td>{{ $item['updated_at'] }}</td>
                                                <td>
                                                    <a href="{{ asset('admin/test/view') }}/{{ $item['id'] }}" title="Edit"><i class="fa fa-cog fa-1x3"></i></a>    
                                                    <a  data-toggle="modal" data-target="#del{{ $item['id'] }}" title="Delete"><i class="fa fa-trash-o fa-1x3"></i></a> 

                                                </td>
                                            </tr>
                                        @endif                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>                                
                    </div>
                @endforeach
                @foreach ($test as $item)
                <!-- Modal -->
                <div class="modal fade" id="del{{ $item['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete Item</h4>
                        </div>
                        <div class="modal-body">
                            Delete this data. Are you sure?
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <a href="{{ asset('admin/test/delete') }}/{{ $item['id'] }}" class="btn btn-primary">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="sendMail{{ $item['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form action="{{ asset('admin/test/send-link') }}" method="POST"> 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Send Test</h5>
                      </div>
                      <div class="modal-body" style="min-height: 80px">
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-7">
                                <input type="text" class="form-control" name="email" placeholder="Email receiver" required/>
                                <input type="hidden" class="form-control" name="link" value="{{ asset('/test') }}/{{$item["link"]}}"/>
                                <input type="hidden" class="form-control" name="test_id" value="{{$item["id"]}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-9" style="padding-top: 5px">
                                <span>Send multiple with format: abc@mail.cc,adad@mail.cc</span>
                            </div>
                        </div>          
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit">Send</button>
                      </div>
                    </div>
                </form>   
              </div>
            </div>
            @endforeach                   
                </div>
            </div>
        </div>
        <!-- END DEFAULT DATATABLE -->
    </div>
</div>  
<script src="{{ asset('public/admin/js/clipboard.js') }}"></script>
<script type="text/javascript">    
    var copied = '<span class="copied"> Copied!</span>';
    $('.btn-warning').on('click',function(){   
        $('.copied').remove();
        $(this).after(copied);
    });
    var clip = new Clipboard('.btn-warning');

    clip.on('success', function(e) {
        $('.copied').show();
        $('.copied').fadeOut(2000);
    });
</script>
@endsection