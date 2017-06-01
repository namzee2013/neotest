
<style type="text/css">
    .secret{
        display: none;
    }
</style>  
    <!-- START DEFAULT FORM ELEMENTS -->
    <div class="panel-body">
        <h4>Choose Question for Test</h4>                               
        <?php 
        $a = 0;
        $id = 1;
        
        ?>          
        @foreach ($array as $key => $question_option)
        @foreach ($question_option['question'] as $key => $value)
        <label class="col-md-offset-1 col-md-8">
            {{$a += 1}}{{' . '}}{{$value['title']}} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit distinctio amet laboriosam quibusdam corporis doloribus possimus tempore animi officiis, enim vel ut qui, architecto velit dignissimos voluptatum voluptatem et maiores, dicta blanditiis. Est quo sequi magnam doloremque at. Quod, eveniet?
            <?php
            $question_id = $value['id'];
            ?>
        </label>
        <div class="col-md-2">
            <a class="btn btn-info pull-right" name="add-question" id="add{{{$question_id}}}">Add to Test</a>
            <a class="btn btn-danger secret pull-right" name="remove-question" id="rem{{{$question_id}}}">Remove</a>
        </div>         
        <br>     
        @if($value['type_id'] == 1)
        @foreach ($question_option['option'] as $key => $value)
        <div class="col-md-offset-1 col-md-10" style="padding-bottom: 5px">
            <input type="radio" name="{{{$question_id}}}"> {{$value['content']}}
        </div>
        <?php 
        $key+=1;
        ?>
        @endforeach
        @elseif($value['type_id'] == 2)
        @foreach ($question_option['option'] as $key => $value)
        <div class="col-md-offset-1 col-md-10" style="padding-bottom: 5px">
            <input id="{{$value['id']}}" type="checkbox" name="{{$question_id}}"> {{$value['content']}}
        </div>
        <?php 
        $key+=1;
        ?>
        @endforeach
        @elseif($value['type_id'] == 3)
        <div class="col-md-offset-1 col-md-10" style="padding-bottom: 15px">
            <textarea class="form-control col-sm-3" placeholder="Answer the question" value=""></textarea>
        </div>
        @endif
        @endforeach
        @endforeach        
    </div>
    <div>{!! $getquestion->render() !!}</div>
    <div class="panel-footer">
        <div class="col-md-11">
            <a href="{{ asset('admin/test/list') }}" class="btn btn-default">Return List</a>
            <a class="btn btn-primary pull-right" id="btn-submit" data-toggle="modal" data-target="#myModal">Submit</a>
        </div>
    </div>
    <!-- END DEFAULT FORM ELEMENTS -->            
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Test Info</h5>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="col-md-3 control-label">Time Total (min)</label>
            <div class="col-md-7">
                <input type="number" class="form-control" id="timetotal" placeholder="Time"/>
            </div>
        </div>                    
        <div class="form-group">
            <label class="col-md-3 control-label">Expired</label>
            <div class="col-md-7">
                <input type="text" class="form-control datepicker" id="expired">
            </div>
        </div>  
    </div>
    <div></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue Choose Question</button>
        <button type="button" class="btn btn-primary" id="submit" data-token="{{ csrf_token() }}">Save Test</button>
    </div>
</div>
</div>
<script type="text/javascript">
    var arr = [];
    var i;
    $('.btn-info').click(function(){
        $(this).hide();
        var qid = $(this).attr('id').substring(3);
        $('#rem'+qid).attr('style','display:inline-block');
        arr.push(
        {
            id:qid
        });
        console.log(arr);
        $('#selected').remove();
        var selected = '<span id="selected" class="col-md-2 pull-right">Selected: '
                        + arr.length+' question</span>';
        $('#btn-submit').after(selected);

    });
    $('.btn-danger').click(function(){
        $(this).hide();
        var qid = $(this).attr('id').substring(3);
        $('#add'+qid).show();
        if(arr.length > 0){
            for(i= 0; i < arr.length; i++)
            {
                if(arr[i].id == qid)
                {
                    var index = arr.indexOf(arr[i]);
                    arr.splice(index,1);
                }
            }
        }

        console.log(arr);
        $('#selected').remove();
        var selected = '<span id="selected" class="col-md-2 pull-right">Selected: '
                        + arr.length+' question</span>';
        $('#btn-submit').after(selected);
    });
    $('#submit').click(function(){
        var url = '/admin/test/';
        var timetotal = $("#timetotal").val();
        var expired = $('#expired').val();
        var data = {
            _token:$(this).data('token'),
            arr: arr,
            expired: expired,
            timetotal: timetotal
        }
        console.log(data);
        $.ajax({
            url : url + 'customize-add',
            type : "post",
            cache : false,
            data: data,
            
            success:function(data){
                window.location.href = "{{ asset('admin/test/list') }}";
            },
            error:function(data){
                console.log("Error :" +data);
            }
        });
    });
</script>