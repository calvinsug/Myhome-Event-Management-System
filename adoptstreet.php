<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<?php
	include("header.php");
?>

<html>

	<head>

		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
		<script src="assets/library/jquery-2.1.1.js"></script>
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
		
		<script src="assets/library/jquery-ui.js"></script>
		
		<script>

			$( document ).ready(function() {
			 	$('#formRegis').submit(function(e){
			 		console.log(e);
			 		e.preventDefault();
			 	});

			 	$.ajax({
				  url: "controller/getaddress.php",
				  type: "POST",
				  dataType: "json",
				  success: function(data){
				  	//alert(data);
				  	
				  	console.log(data);
				 
				  	$('input[name="branchaddress"]').autocomplete({
				  		//minLength: 5,
				  		source: data.address,
				  		minLength: 0,
				  		minChars: 0,
				  		autoFill: true,
					    mustMatch: true,
					    matchContains: false,
				  		//value: data.value,
				  		select: function( event, ui ) {
				  			//alert('select');
				  			//console.log(ui);

				  			console.log(ui.item.value);
				  			
				  			//console.log(data.address.indexOf(ui.item.value));

				  			//console.log(data.value[data.address.indexOf(ui.item.value)]);
							//console.log(data[2].value);			  			

							$('input[name="branchID"]').val(data.value[data.address.indexOf(ui.item.value)]);
							$('#pac-input').val(ui.item.value);
				  		}
					}).on('focus', function(event) {
					    var self = this;
					    $(self).autocomplete( "search", "");;
					});

				  	
				  }
				}); //end of Ajax

			 	
			});




			function initialize() {
			  var mapOptions = {
			    center: new google.maps.LatLng(-5.1308551, 119.41652840000006),
			    zoom: 5
			  };
			  var map = new google.maps.Map(document.getElementById('map-canvas'),
			    mapOptions);

			  var input = /** @type {HTMLInputElement} */(
			      document.getElementById('pac-input'));

			  var types = document.getElementById('type-selector');
			  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
			  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

			  var autocomplete = new google.maps.places.Autocomplete(input);
			  autocomplete.bindTo('bounds', map);

			  var infowindow = new google.maps.InfoWindow();
			  var marker = new google.maps.Marker({
			    map: map,
			    anchorPoint: new google.maps.Point(0, -29)
			  });

			  google.maps.event.addListener(autocomplete, 'place_changed', function() {
			    

			    infowindow.close();
			    marker.setVisible(false);
			    var place = autocomplete.getPlace();
			    if (!place.geometry) {
			      return;
			    }

			    // If the place has a geometry, then present it on a map.
			    if (place.geometry.viewport) {
			      map.fitBounds(place.geometry.viewport);
			    } else {
			      map.setCenter(place.geometry.location);
			      map.setZoom(17);  // Why 17? Because it looks good.
			    }
			    marker.setIcon(/** @type {google.maps.Icon} */({
			      url: place.icon,
			      size: new google.maps.Size(71, 71),
			      origin: new google.maps.Point(0, 0),
			      anchor: new google.maps.Point(17, 34),
			      scaledSize: new google.maps.Size(35, 35)
			    }));
			    
			    console.log(place.geometry);
			    console.log(place.geometry.location.k);
			    console.log(place.geometry.location.D);
				//document.getElementById("display1").value=place.geometry.location.k;
				//document.getElementById("display2").value=place.geometry.location.B;
			    marker.setPosition(place.geometry.location);
			    marker.setVisible(true);

			    var address = '';
			    if (place.address_components) {
			      address = [
			        (place.address_components[0] && place.address_components[0].short_name || ''),
			        (place.address_components[1] && place.address_components[1].short_name || ''),
			        (place.address_components[2] && place.address_components[2].short_name || '')
			      ].join(' ');
			    }

			    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
			    infowindow.open(map, marker);
			  });

			  // Sets a listener on a radio button to change the filter type on Places
			  // Autocomplete.
			  function setupClickListener(id, types) {
			    var radioButton = document.getElementById(id);

			    autocomplete.setTypes(types);
			    
			    /*google.maps.event.addDomListener(radioButton, 'click', function() {
			      autocomplete.setTypes(types);
			    });*/
			  }

			  
			  //setupClickListener('changetype-all', []);
			  setupClickListener('changetype-address', ['address']);
			  //setupClickListener('changetype-establishment', ['establishment']);
			  //setupClickListener('changetype-geocode', ['geocode']);
			  
			}

			google.maps.event.addDomListener(window, 'load', initialize);




    	</script>
	</head>

	<body>
			
			
			<div id="content">
				<div class="form">
					<form method="post" action="" id="formRegis">
						<div class="field">
							<h2 align="center">Profile</h2>
							<hr/>
						</div>
						<div class="field">
							<div class="membericon">
								<a href="popup/addEvent.php" class="addEvent">
									<img src="assets/images/editprofile.png"/>
									Edit Profile
								</a>
							</div>
							<div class="membericon">
								<a href="popup/addEvent.php" class="addEvent">
									<img src="assets/images/changepassword.png"/>
									Change Password
								</a>
							</div>
						</div>
						<br/>
						<div class="field colortablecontent">
							<span>Photo</span>
							<span class="textbox">asdasdas</span>
						</div>
						<div class="field">
							<span>Name</span>
							<span class="textbox">asdasdas</span>
						</div>
						<div class="field colortablecontent">
							<span>Address</span>
							<span class="textbox">asdasdas</span>
						</div>
						<div class="field">
							<span>Email</span>
							<span class="textbox">asdasdas</span>
						</div>
						<div class="field colortablecontent">
							<span>Phone</span>
							<span class="textbox">asdasdas</span>
						</div>
						<div class="field">
							<span>Adopt Street</span>
							<span class="textbox">asdasdas</span>
						</div>
						<br/><br/><br/>
					</form>
				</div>
			</div>
			<?php 
				include("footer.php");
			?>
		</div>
	</body>
</html>