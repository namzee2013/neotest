<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<link rel="icon" href="{{asset('public/favicon.ico')}}" type="image/x-icon" />
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<script type="text/javascript">
		window.location.hash="no-back-button";
		window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
		window.onhashchange=function(){window.location.hash="no-back-button";}
	</script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">NEOLAB</a>
    </div>
  </div>
</nav>
<div class="direction col-sm-7 col-sm-offset-2">
	<h1 style="text-align: center;">Congratulation !!!</h1>
	<h2 style="text-align: center;">We will contact you shortly, thank you for your time !</h2>
</div>
</body>
</html>