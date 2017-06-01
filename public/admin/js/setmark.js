$(document).ready(function(){
  var getSumMark = function()
  {
    var test_id = $('table').attr('id')
    // console.log(test_id);
    $.ajax({
      url: '/admin/test/get-sum-mark',
      type: 'GET',
      cache: false,
      data: {'test_id':test_id},
      success: function(data){
        document.getElementById('summark').innerHTML = data;
      }
    });
  }
  getSumMark();
  $('input#check_all').unbind();
  $('input#check_all').on('click' ,function() {

    var setmark = $('div#set_mark');
    var all = $('#all');
    if ($(this).is(':checked')) {
      setmark.addClass('disabled')
      all.removeClass('disabled')
    }else {
      setmark.removeClass('disabled')
      all.addClass('disabled');

    }
  });
  // var checkbox = document.getElementById('check_all')
  // console.log(checkbox);
  // checkbox.onclick = function(event) {
  //     console.log(checkbox);
  //     var checkbox = event.target;
  //     var setmark = $('div#set_mark');
  //     var all = $('#all');
  //     // console.log(setmark);
  //     if (checkbox.checked) {
  //       setmark.removeClass('disabled')
  //       all.addClass('disabled');
  //     } else {
  //       setmark.addClass('disabled')
  //       all.removeClass('disabled')
  //     }
  // };
  $('a.save').on('click', function(){
    var id = $(this).attr('id');
    var mark_ques = $(this).parents('div#set_mark').find('input').val();
    var test_id = $('table').attr('id');
    $.ajax({
      url: '/admin/test/question/'+id+'/set-mark',
      type: 'GET',
      cache: false,
      data: {'id':id,'mark':mark_ques,'test_id':test_id},
      success: function (data) {
        getSumMark();
      }
    });
  });
  $('a.save-all').on('click', function(){
    var test_id = $('table').attr('id')
    var mark = $(this).parents('#all').find('input').val();
    $.ajax({
      url: '/admin/test/set-mark-all',
      type: 'GET',
      cache: false,
      data: {'test_id':test_id,'mark':mark},
      success: function(data){
        window.location = document.referrer;
      }
    });
  });
});
