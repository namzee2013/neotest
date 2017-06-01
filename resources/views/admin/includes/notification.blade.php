@if(count($errors)>0)
<div class="alert alert-danger col-sm-8" >
    <ul>
        @foreach($errors->all() as $error)
        <li><strong>Error! </strong>{!! $error !!}</li>
        @endforeach
    </ul>
</div>
@endif
@if(Session::has('flash_messages'))
<div class="alert alert-success" >
    <strong>Done! </strong>{!! Session::get('flash_messages') !!}
</div>
@endif
<script type="text/javascript">
    $("div.alert-success").delay(7000).slideUp();
</script>
@if(Session::has('err_message'))
<div class="alert alert-danger" >
<strong>Fail! </strong>{!! Session::get('err_message') !!}
</div>
@endif
<script type="text/javascript">
    $("div.alert-danger").delay(7000).slideUp();
</script>