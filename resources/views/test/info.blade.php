<!DOCTYPE html>
<html>
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
<style>
.body{
    background: #F7F7F7;
}
form {
    margin-top: 12%;
    background: #fff;
}

input[type=text], input[type=email] {
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    height: 30%;
}

.container {
    padding: 16px;
}

</style>
<body class="body col-sm-12">

<form method="post" class="col-sm-4 col-sm-offset-4">
    {{csrf_field()}}
  <div class="imgcontainer">
    <img src="{{ asset('public/images/neolab-vn.jpg') }}" alt="Avatar" class="avatar">
  </div>

  <div class="container col-sm-12">
    {{-- <label class="col-sm-12"><b>Name</b></label> --}}
    <input class="col-sm-12" type="text" placeholder="Enter Name" name="name" required>

    {{-- <label class="col-sm-12"><b>Email</b></label> --}}
    <input class="col-sm-12" type="email" placeholder="Enter Email" name="email" required>

    <input type="hidden" placeholder="Enter Email" name="link" value="{{$link}}">
    @if(session('msg'))
        <div class="alert alert-danger col-sm-12">
            {{ session('msg') }}
        </div>
    @endif
    <button type="submit">Login</button>
  </div>
</form>

</body>
</html>
