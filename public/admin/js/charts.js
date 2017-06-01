var morrisCharts = function() {
  var datas = [
      {label: "Download Sales", value: 12},
      {label: "In-Store Sales", value: 30},
      {label: "Mail-Order Sales", value: 20}
  ];
  // console.log(datas);

  $.ajax({
    url: '/admin/statistic/test-with-mark',
    method: 'GET',
    cache: false,
    data:{},
    success: function(data){
      // console.log(data);
      // datas = [].concat(datas,data);
      Morris.Donut({
          element: 'statistic-with-mark',
          data: data,
          colors: ['#95B75D', '#1caf9a', '#FEA223']
      });
    }
  });
  $.ajax({
    url: '/admin/statistic/user-test',
    method: 'GET',
    cache: false,
    data:{},
    success: function(data){
      // console.log(data);
      // datas = [].concat(datas,data);
      Morris.Donut({
          element: 'user-test',
          data: data,
          colors: ['#95B75D', '#1caf9a', '#FEA223']
      });
    }
  });
  $.ajax({
    url: '/admin/statistic/test',
    method: 'GET',
    cache: false,
    data:{},
    success: function(data){
      // console.log(data);
      // datas = [].concat(datas,data);
      Morris.Donut({
          element: 'morris-donut-example',
          data: data,
          colors: ['#95B75D', '#1caf9a', '#FEA223']
      });
    }
  });

}();
