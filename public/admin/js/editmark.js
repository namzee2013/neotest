$(document).ready(function(){
  var diem = $('#diem').text()
  var id = document.getElementById("UserTestID").value;
  $('a.save').on('click', function(e){
    e.preventDefault();
    var id = $(this).parents('div.marked').attr('id');
    var dieme = $(this).parents('div.marked').find('input')
    var diemi = parseInt(dieme.val());
    var diemmax = $(this).attr('diem-max')
    var comment = $(this).parents('div.marked').find('textarea').val()
    // console.log(diemmax);
    //console.log(diemi);
    if (isNaN(diemi) || comment === '') {
      alert(' Please enter mark and comment!!');
    }else if( diemi > diemmax || diemi < 0) {
      alert('Error !! Please enter mark > 0 and mark <= ' + diemmax);
    }else {
      diem = parseInt(diem) + diemi
      document.getElementById("diem").innerHTML = diem
      $(this).addClass('disabled hidden')
      document.getElementById(dieme[0].id).disabled = true;
        $.ajax({
          url: '/admin/test/update-comment',
          type:'GET',
          cache:false,
          data:{'id':id,'diem':diemi,'comment':comment},
          success: function(data){
            if (data === 'success') {

            }
          }
        });


    }
  });
  $('a.submit').on('click', function(e){
    e.preventDefault();
    var flag = true;
    var marks = document.getElementsByName('mark')
    marks.forEach(elem => {
      if (!document.getElementById(elem.id).disabled) {
        alert('Please enter mark for question: ' + elem.id);
        flag = false;
      }
    });

    if (flag) {
      $('img.loading').removeClass('visibled');
      $.ajax({
        url: '/admin/test/marked/post',
        type: 'GET',
        cache: false,
        data: {'id':id,'mark':diem},
        success: function (data) {
          if (data === 'success') {
            window.location = document.referrer;
          }
        }
      });
    }
  });
});
