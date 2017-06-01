var seconds_left = document.getElementById('timetotal').value*60;
// var seconds_left = 1*10;
var link = $('#submit').attr('link');
var save = localStorage.getItem('seconds_left');
var timeused;
if (save > 0) {
	seconds_left = save;
}
setInterval(function(){ myTimer() }, 1000);
function myTimer() {
	seconds_count = 0;
	if (seconds_left > 3600) {
		hours = pad( parseInt(seconds_left / 3600) );
		seconds_count = pad( seconds_left % 3600);
	} else {
		hours = 00;
	}
	if (seconds_left > 60) {
		minutes = pad( parseInt(seconds_left / 60) );
		if (seconds_count !=0 ) {
			seconds_count = pad(seconds_count % 60);
		}else {
			seconds_count = pad(seconds_left %60);
		}
	} else {
		minutes = 00;
	}
	if (seconds_left < 60 ) {
		seconds_count = pad(seconds_left);
		minutes=pad(minutes);
	}

    document.getElementById("tiles").innerHTML = "<span>"+"0" + hours + " : " +"</span><span>" + minutes + " : " + "</span><span>" + seconds_count + "</span>";
    var timeused = document.getElementById("timetotal").value*60 - seconds_left;
    $('#timeused').attr('timeused',timeused);
    if (seconds_left > 0) {
    	seconds_left--;
    	localStorage.setItem('seconds_left', seconds_left);
    }
}

function pad(n) {
	return (n < 10 ? '0' : '') + n;
}
