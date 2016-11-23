/**
 * Arctext.js
 * A jQuery plugin for curved text
 * http://www.codrops.com
 *
 * Copyright 2011, Pedro Botelho / Codrops
 * Free to use under the MIT license.
 *
 * Date: Mon Jan 23 2012
 */


var time; var on = true; var seconds = 59; var minutes = 19;

var startTime = function(){
	if(on){
		seconds--;
		time = setTimeout("startTime()",1000);
		if(seconds < 0){
			seconds = 59; minutes--;
		}		
		document.getElementById("minutes").value = minutes;
		document.getElementById("seconds").value = seconds;
		if(seconds == 0 && minutes == 0){
			alert("Se acabó el tiempo");
			on = false;
		}
	}
}

/*var stopStart = function(){
		document.getElementById("time").innerHTML = !on ? "Stop" : "Start";
		if(!on){
			on = true;	startTime();
		}else{
			on = false;	clearTimeout(time);
		}
}*/
