<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>Admin Login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('public/admin/css/theme-default.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/admin/css/custom.css')}}">
    <!-- EOF CSS INCLUDE -->
</head>
<body>
    <div class="login-container">

        <div class="login-box animated fadeInDown">
            @yield('content')
<div class="login-footer">
    <div class="pull-left">
        &copy; 2017 NeoTest
    </div>
    <div class="pull-right">
        <!-- <a href="{{route('login')}}">login</a> -->
        <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
    </div>
</div>
</div>

</div>

</body>
</html>
