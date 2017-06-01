<table  class="table-bordered">
    <thead>
        <tr>
          <td width="20">#</td>
          <td width="80">Category</td>
          <td width="100"> Label</td>
          <td width="50">color</td>
        </tr>
    </thead>
    <tbody id="tblColors">
      @foreach($rates as $key => $value)
        <tr>
          <td>{{$key}}</td>
          <td>{{$value->category->name}}</td>
          <td>{{$value->label}}</td>
          <td style="background-color: {{$value->color}}"></td>
        </tr>
      @endforeach
    </tbody>
</table>
