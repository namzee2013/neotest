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
  textarea{
    max-height: 150px;
    width: 100%;
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
  .btn-preview{
    color: #fff;
    background-color: #337ab7;
    padding:7px 10px;
    border: 1px solid #2e6da4;
    border-radius: 5px;
    text-decoration: none;

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
    min-height: 250px;
    display: block;
    width: 60%;
    margin: 0 auto;
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
  #images-question{
    width: 150px;
  }
    
</style>
<body id="each">
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
		@php $a = 1; @endphp
		<div id="each-question">
    	@foreach ($array['question'] as $key => $value)
	    	<div class="option" style="display: block; line-height: 110%;">
        	<p class="col-sm-12 title-question">
        	  <span class="question-count">Question {{$id+1}}{{': '}} </span>{{$value['title']}}
          </p><br>
	        @php $question_id = $value['id']; @endphp
  				@if($value['type_id'] == 1)
  					@foreach ($array['option'] as $key => $value)
  	            		<input id="{{$value['id']}}" option_id="{{$value['id']}}" type="radio" name="{{$question_id}}" content="{{$value['content']}}" value="{{$a}}" style="display: inline-block;width: 5%">
  						<?php 
  							$key+=1;
  						?>
            	<p style="display: inline-block;width: 90%;">
                {{$value['content']}}
              </p>
              <br>
  	            	@endforeach
  	        	@elseif($value['type_id'] == 2)
  	        		@foreach ($array['option'] as $key => $value)
  	            		<input id="{{$value['id']}}" option_id="{{$value['id']}}" type="checkbox" value="" name="{{$question_id}}" content="{{$value['content']}}" value="{{$a}}" style="display: inline-block;width: 5%">
  						<?php 
  							$key+=1;
  						?>
              <p style="display: inline-block;width: 90%;">
  	            		{{$value['content']}}
              </p>
              <br>
  	            	@endforeach
  	        	@else
          			<div style="display: block;">
                  		<textarea id="{{$question_id}}" class="textarea form-control" rows="10" placeholder="Answer the question" value=""></textarea>
  					     </div>
  				    @endif
	    	</div>
    	@endforeach    
			<div class="paginate allnumberquestion col-sm-12">
				@if ($id < 1)
					@php $pre = $count; @endphp
          <a href="#">
            <img id="previous" src="{{ asset('public/images/previous.jpg') }}" alt="">
          </a> 
				@else
					@php $pre = $id; @endphp
					<a href="{{ url('test',[$link,$pre]) }}">
						<img id="previous" src="{{ asset('public/images/previous.jpg') }}" alt="">
					</a>
        @endif
				@if($id-1 < 1)
					@php $numberquestion = 1; @endphp
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion]) }}">{{$numberquestion}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion + 1]) }}">{{$numberquestion + 1}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion + 2]) }}">{{$numberquestion + 2}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion + 3]) }}">{{$numberquestion + 3}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion + 4]) }}">{{$numberquestion + 4}}</a>
				@elseif($id + 3 > $count)
					@php $numberquestion = $count; @endphp
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion - 4]) }}">{{$numberquestion - 4}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion - 3]) }}">{{$numberquestion - 3}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion - 2]) }}">{{$numberquestion - 2}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion - 1]) }}">{{$numberquestion - 1}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$numberquestion]) }}">{{$numberquestion}}</a>
				@else
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$id-1]) }}">{{$id-1}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$id]) }}">{{$id}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$id+1]) }}">{{$id+1}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$id+2]) }}">{{$id+2}}</a>
					<a class="btn-page" id="numberquestion" href="{{ url('test',[$link,$id+3]) }}">{{$id+3}}</a>
				@endif
				@if ($id >= ($count - 1))
					@php $next = 1; @endphp
          <a href="#">
            <img id="next" src="{{ asset('public/images/next.jpg') }}" alt="">
          </a>
				@else
					@php $next = $id + 2; @endphp
					<a href="{{ url('test',[$link,$next]) }}">
						<img id="next" src="{{ asset('public/images/next.jpg') }}" alt="">
					</a>
        @endif
			</div>	
			<div class="paginate" >
				<a class="preview btn-preview" id="preview" email={{$email}} href="{{ url('test',[$link,'all']) }}">Preview</a>
			</div>
		</div>
	</div>
	<script src="{{ asset('public/test/js/timecountdown.js') }}" type="text/javascript" charset="utf-8">
	</script>
	<script src="{{ asset('public/test/js/cookie-input.js') }}" type="text/javascript" charset="utf-8">
	</script>
</body>
</html>