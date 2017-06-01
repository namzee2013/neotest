var resultstamp = [];
var key = 0, JSONresultstamp;
var aaaa = 1;
var timeused, email, lsresultstamps, link, url, resultstamp, question_id, option_id, lsresultstamp;

$(document).ready(function(){
	lsresultstamp = localStorage.getItem('resultstamp');
	if (lsresultstamp) {
		resultstamp = JSON.parse(localStorage['resultstamp']);
		if ($('#all').length) {
			for (i = 0; i < resultstamp.length ; i++) {
				id = resultstamp[i].option_id;
				console.log($('#'+id).length);
				if ($('#'+id).length == 1) {
					$('#'+id).prop('checked',true);
				}
				if ($('#'+id).length == 0) {
					$('#'+resultstamp[i].question_id).val(resultstamp[i].option_id);
				}
			}
		}else{
			if($('textarea').length == 1){
				question_id = $('textarea').attr('id');
				for (i = 0; i < resultstamp.length ; i++) {
					if (resultstamp[i].question_id == question_id) {
						$('#'+question_id).val(resultstamp[i].option_id);
					}
				}
			}else{
				for (i = 0; i < resultstamp.length ; i++) {
					id = resultstamp[i].option_id;
					$('#'+id).prop('checked',true);
				}
			}
		}
	}
	
	$('input[type="radio"]').on('click',function(){
		question_id = $(this).attr('name');
		option_id = $(this).attr('option_id');
		var a = 0;
		if (resultstamp.length != 0) {
			for (i = 0; i < resultstamp.length; i++) {
				if (question_id === resultstamp[i].question_id) {
					resultstamp[i].option_id = option_id;
					a++;
				}
			}
			if (a==0) {
				resultstamp.push(
				{
					question_id:$(this).attr('name'), 
					option_id:$(this).attr('option_id'),
				});
			}
		}else{
			resultstamp.push(
				{
					question_id:$(this).attr('name'), 
					option_id:$(this).attr('option_id'),
				});	
		}
		lsresultstamp = JSON.stringify(resultstamp);
		localStorage.setItem('resultstamp',lsresultstamp);
		console.log(lsresultstamp);
	});	
	$('input[type="checkbox"]').on('click',function(){
		question_id = $(this).attr('name');
		option_id = $(this).attr('option_id');
		var b = 0;
		if (resultstamp.length != 0) {
			localStorage.setItem('resultstamp',resultstamp);	
			for (i = 0; i < resultstamp.length; i++) {
				if (question_id === resultstamp[i].question_id && option_id === resultstamp[i].option_id) {
					var index = resultstamp.indexOf(resultstamp[i]);
					resultstamp.splice(index,1);
					b++;
				}
			}
			if (b==0) {
				resultstamp.push(
				{
					question_id:question_id,
					option_id:option_id,
				});
			}
		}else{
			console.log(resultstamp);
			resultstamp.push(
				{
					question_id:question_id, 
					option_id:option_id,
				});
			console.log(resultstamp);
		}
		lsresultstamp = JSON.stringify(resultstamp);
		localStorage.setItem('resultstamp',lsresultstamp);
		console.log(lsresultstamp);
	});	
	$('.textarea').on('change',function(){
		var question_id = $(this).attr('id');
		var option_id = $(this).val();
		var key = 0;
		if (resultstamp != null) {
			for (var i = 0; i < resultstamp.length; i++) {
				if (resultstamp[i].question_id == question_id) {
					var index = resultstamp.indexOf(resultstamp[i]);
					resultstamp.splice(index,1);
				}
			}
			resultstamp.push(
				{
					question_id:question_id,
					option_id:option_id,
				});
		}else{
			resultstamp.push(
				{
					question_id:question_id,
					option_id:option_id,
				});
		}
		
		lsresultstamp = JSON.stringify(resultstamp);
		localStorage.setItem('resultstamp',lsresultstamp);
		console.log(lsresultstamp);
	});
	//jax to serve
	$('#submit').on('click',function(){
		if (confirm("Do you want to submit ?") == true) {

			timeused = $('#timeused').attr('timeused');
			link = $('#submit').attr('link');
			url = 'ok' ;
			email = $('#submit').attr('email');

			lsresultstamp = localStorage.getItem('resultstamp');
			resultstamp = JSON.parse(lsresultstamp);
			results = [];	
			if(resultstamp != null){
				pushresultstamp();
			}else{
				alert("Please choose an answer")
			}
		}
	});

	setInterval(function(){ 
		timeused = $('#timeused').attr('timeused');
		timetotal = $('#timetotal').attr('value')*60;
		if (timeused == timetotal) {

			link = $('#submit').attr('link');
			url = 'ok' ;
			email = $('#preview').attr('email');

			lsresultstamp = localStorage.getItem('resultstamp');
			resultstamp = JSON.parse(lsresultstamp);
			results = [];
			pushresultstamp();
		}
	}, 1000);

	function pushresultstamp(){
		if (resultstamp != null) {
			for (var i = 0 ; i < resultstamp.length; i++) {
				question_id = resultstamp[i].question_id;

				option_id = resultstamp[i].option_id;

				if (results.length > 0 ) {
					var abc = 0;
					for (var j = 0; j < results.length; j++) {
						if (question_id == results[j].question_id) {
							results[j].option_id.push(
								option_id
								);
							abc++;
						}
					}
					if (abc==0){
						results.push({
							"option_id":[].concat([],option_id),
							"question_id":question_id
							});
						
					}
				}
				else{
					results.push({
						"option_id":[].concat([],option_id),
						"question_id":question_id
						});
				}
			}
			
			$.ajax({
				url : url,
				type : "GET",
				cache: false,
				data: {'results':results, 'link': link, 'timeused':timeused, 'email':email},
				success:function(data){
					window.location.href = url + '/done';
					// console.log(data);
				},
				error:function(data){
					console.log("Error :" +data);
				}
			});
		}else{
			$.ajax({
				url : 'ok',
				type : "GET",
				cache: false,
				data: {'results':results, 'link': link, 'timeused':timeused, 'email':email},
				success:function(data){
					window.location.href = url + '/done';
					// console.log(data);
				},
				error:function(data){
					console.log("Error :" +data);
				}
			});
		}
		localStorage.clear();
	}
});
	