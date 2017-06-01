function changeCate() {
  var categoryId = $('#category').val();
  var temp = '';
  $.ajax({
    url:'/admin/test/marked/category/'+categoryId,
    type:'GET',
    cache:false,
    data:{'id':categoryId},
    success:function(data){
      // console.log(data);
      if (data.length > 0) {
        data.forEach((value,key) => {
          temp += '<tr id="trow_'+key+'"';if(key%2==0)temp+= 'class="info"';temp+= '>'
              +'<td class="text-center">'+(key+1)+'</td>'
              +'<td><strong>'+value.name+'</strong></td>'
              +'<td>'+value.email+'</td>'
              +'<td>'+value.timespend+'</td>'
              +'<td>'+value.timetotal+'</td>';
              if (value.mark > 0) {
                temp += '<td style="background-color: '+value.color+'">'+value.mark+'</td>'
                +'<td>'
                  +'<a class="btn btn-danger" href="'+baseURL+'/admin/test/'+value.id+'/marked'+'">Remark</a>'
                +'</td>'
              }else {
                temp += '<td>0</td>'
                +'<td><a class="btn button-primary" href="'+baseURL+'/admin/test/'+value.id+'/marked'+'">Mark</a></td>'
              }

          temp += '</tr>';
        });
      }
      $('#tblTests').html(temp);
    }
  });
  var tempC = '';
  $.ajax({
    url:'/admin/rate/category/'+categoryId,
    type:'GET',
    cache:false,
    data:{'id':categoryId},
    success:function(data){
      if (data.length > 0) {
        data.forEach((value,key) => {
          tempC += '<tr>'
            +'<td>'+key+'</td>'
            +'<td>'+value.category.name+'</td>'
            +'<td>'+value.label+'</td>'
            +'<td style="background-color: '+value.color+'"></td>'
          +'</tr>'
        });
      }
      $('#tblColors').html(tempC);
    }
  });
}
