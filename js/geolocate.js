// Does this browser support geolocation?
if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(locationSuccess, locationError);
}
else{
	showError("Your browser does not support Geolocation!");
}

function locationError(error){
	switch(error.code) {
		case error.TIMEOUT:
			showError("A timeout occured! Please try again!");
			break;
		case error.POSITION_UNAVAILABLE:
			showError('We can\'t detect your location. Sorry!');
			break;
		case error.PERMISSION_DENIED:
			showError('Please allow geolocation access for this to work.');
			break;
		case error.UNKNOWN_ERROR:
			showError('An unknown error occured!');
			break;
	}

}

function showError(msg){
	alert(msg);
}

function locationSuccess(position) {
	var lat = position.coords.latitude;
	var lon = position.coords.longitude;
	
	$.ajax({
			type: 'POST',
			url: './weather.php',
			data: "latitude="+lat+"&longtitude="+lon,
			success: function(html) {
				alert(html);
			}
	});
	
}