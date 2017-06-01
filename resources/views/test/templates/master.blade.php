<!DOCTYPE html>
<html>
<head>
  <title>NeoLab Test</title>
  {{-- <link rel="stylesheet" href="reset.css" /> --}}
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{asset('public/favicon.ico')}}" type="image/x-icon" />  
  <script src="{{ asset('public/js/jquery-3.2.1.min.js') }}" type="text/javascript" charset="utf-8"></script>
  <link type="text/css" src="{{ asset('bootstrap/css/bootstrap.min.css') }}"/>
  <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</head>
<style type="text/css">
  /* http://meyerweb.com/eric/tools/css/reset/ 
   v2.0 | 20110126
   License: none (public domain)
  */

  html, body, div, span, applet, object, iframe,
  h1, h2, h3, h4, h5, h6, p, blockquote, pre,
  a, abbr, acronym, address, big, cite, code,
  del, dfn, em, img, ins, kbd, q, s, samp,
  small, strike, strong, sub, sup, tt, var,
  b, u, i, center,
  dl, dt, dd, ol, ul, li,
  fieldset, form, label, legend,
  table, caption, tbody, tfoot, thead, tr, th, td,
  article, aside, canvas, details, embed, 
  figure, figcaption, footer, header, hgroup, 
  menu, nav, output, ruby, section, summary,
  time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
  }
  /* HTML5 display-role reset for older browsers */
  article, aside, details, figcaption, figure, 
  footer, header, hgroup, menu, nav, section {
    display: block;
  }
  body {
    line-height: 1;
  }
  ol, ul {
    list-style: none;
  }
  blockquote, q {
    quotes: none;
  }
  blockquote:before, blockquote:after,
  q:before, q:after {
    content: '';
    content: none;
  }
  table {
    border-collapse: collapse;
    border-spacing: 0;
  }
  body{
    width: 100%;
    max-width: 1366px;
    background: #f7f1f1;
    margin: 0 auto;
    font-family: 'Roboto', sans-serif;
  }
  #header{
    width: 90%;
    margin: 0 auto;
    background: #fff;
    border-bottom: 1px solid #dedede;
  }
  #logo,#content-header,#time-remaining{
    display: inline-block;
    vertical-align: top;
  }
  #logo{
    width: 30%;
  }
  #logo img{
    padding: 10px 20px;
    width: 50%;
    max-height: 70px;
  }
  #content-header{
    width: 45%;
  }
  #time-remaining{
    width: 20%;
    padding: 13px 0;
    position: relative;
  }
  #time-remaining #time-div{
    background: #fff;
    padding:5px 10px;
    position: fixed;
    z-index: 999;
  }
  .h1-text{
    font-size: 2.3em;
    padding: 20px 0;
  }
  .h2-text-center{
    font-size: 2em;
    text-align: center;
  }
  .h3-text{
    font-size:1.5em;
  }
  .h4-text-center{
    text-align: center;
    font-size:1em;
    padding-bottom: 5px;
  }
  #container{
    width: 90%;
    margin: 0 auto;
    background: #FFF;
  }
  #content-test{
    width: 70%;
    margin: 0 auto;
    padding-top: 100px;
    height: auto;
  }
  #content-test form{
    width: 80%;
    padding-left: 50px; 
    padding-bottom: 50px;
    /*font-family: 'Georgia'; */
  }
  #content-test #each-question{
    width: 80%;
    padding-left: 50px; 
    padding-bottom: 50px;
    /*font-family: 'Georgia'; */
  }
  .title-question{
    padding-top: 20px;
    padding-bottom: 10px;
    line-height: 20px;
    color: #337ab7;
    font-weight: bold;
  }
  .question-count{
    color: #000;
  }
  #content-test textarea{
    width: 90%;
    font-size: 1em;
    line-height: 20px;
    /*font-family: 'Georgia'; */
    border-radius: 5px;
  }
  .option{
    padding-bottom: 10px;
  }
  .option input{
    vertical-align: top;
    margin-left: 5%; 
  }
  .btn{
    padding:20px 0;
  }
  .btn-each{    
    color: #fff;
    background-color: #337ab7;
    padding:7px 10px;
    border: 1px solid #2e6da4;
    border-radius: 5px;
    text-decoration: none;
    margin-right: 60%;
  }
  .btn-preview{
    color: #fff;
    background-color: #337ab7;
    padding:7px 10px;
    border: 1px solid #2e6da4;
    border-radius: 5px;
    text-decoration: none;

  }
  .btn-submit{
    background: #008e06;
    border: 1px solid #007105;
    color:#fff;
    padding:7px 10px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
  }

  .btn-page{
    background: #fff;
    border: 1px solid #ccc;
    color:#000;
    padding:7px 10px;
    border-radius: 5px;
    text-decoration: none;
    margin-top: 20px;
  }
  .question{
    min-height: 300px;
  }
  .paginate{
    width: 100%;
    padding-top: 30px; 
    text-align: center;
  }
  .paginate div{
    display: inline-block;
    padding-bottom: 30px; 
  }
  .option{
    display: block;
    width: 100%;
  }
  .option input {
    display: inline-block;
    width: 10%;
    padding: 0;
    margin: 0;
  }
  .option p{
    font-size: 80%;
    display: inline-block;
    width: 89%;
    line-height: 130%;
  }

  #next{
    background: url('/public/images/next.jpg') 0 5px / 30px 30px no-repeat;
    width: 40px;
    height: 40px;
    vertical-align: middle;
    padding: 0;
  }

  #previous{
    background: url('/public/images/previous.jpg') 0 5px / 30px 30px no-repeat;
    width: 40px;
    height: 40px;
    vertical-align: middle;
    padding: 0;
  }
  #previous:hover, #next:hover{
    cursor: pointer;
  }
  a{
    text-decoration: none;
  }

</style>
<body>
  <div id="header">
    <div id="logo">
      <img src="http://jobs.neo-lab.vn/wp-content/uploads/2016/05/logo.png" alt="logo">
    </div>
    <div id="content-header">
      <h1 class="h1-text">Test: <span style="text-transform: uppercase;">{{$name}}</span></h1>
    </div>
    <div id="time-remaining">
      <div id="time-div">
        <input type="hidden" name="" id="timetotal" value="{{$timetotal}}">
        <h4 class="h4-text-center">Time remaining</h4>
        <h2 id="tiles" class="h2-text-center"></h2>
        <div id="timeused" style="background: transparent;"></div>
      </div>
    </div>
  </div>
  <div id="container">
    <div id="content-test">
      @yield('content')
    </div>
  </div>
  
<script src="{{ asset('public/test/js/timecountdown.js') }}" type="text/javascript" charset="utf-8">
</script>
<script src="{{ asset('public/test/js/cookie-input.js') }}" type="text/javascript" charset="utf-8">
</script>
</body>
</html>