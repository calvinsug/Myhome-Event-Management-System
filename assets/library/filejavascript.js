var map;
var infoWindow;
      
function initialize(lt,lg) {
	var mapDiv = document.getElementById('map-canvas');
	map = new google.maps.Map(mapDiv, {
		center: new google.maps.LatLng(lt, lg),
		zoom: 13,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
    console.log(map);
	infoWindow = new google.maps.InfoWindow();
	createMarker(-6.875046, 107.614174,'Tempat A','assets/images/letter_a.png');
	createMarker(-6.904337, 107.61323,'Tempat B','assets/images/letter_b.png');
	createMarker(-6.899757, 107.599196,'Tempat C','assets/images/letter_c.png');

	/*google.maps.event.addListener(map, 'click', function(event) {
    	//alert('Point.X.Y: ' + event.latLng.B);
    	console.log(event.latLng);
	    console.log(event.latLng.k);
	    console.log(event.latLng.B);
		createMarker(event.latLng.k, event.latLng.B,'Tempat A','images/letter_a.png');
		document.getElementById("display1").value = event.latLng.k;
		document.getElementById("display2").value = event.latLng.B;
  	});*/
}
    
function createMarker(lt,lg,message,markers) {
	var latLng = new google.maps.LatLng(lt,lg);
	var marker = new google.maps.Marker({
		position: latLng,
		map: map,
		icon: markers
	});
    
	google.maps.event.addListener(marker, 'click', function() {
		var myHtml = '<strong>'+message+'</strong><br/>';
		infoWindow.setContent(myHtml);
		infoWindow.open(map, marker);
	});
}