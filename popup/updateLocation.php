<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="../assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />
		

		<script>

			$( document ).ready(function() {
			 	$('#formRegis').submit(function(e){
			 		console.log(e);
			 		e.preventDefault();
			 	});



			 	lat = 0;
			 	lng = 0;

			 	<?php 
					$LocationID = $_GET['id'];
					$Lat = $_GET['lat'];
					$Lng = $_GET['lng'];
					$LocationName = $_GET['name'];
					$LocationAddress = $_GET['address'];

									//'Region' : $('select[name="region"]').val(),
									//'BranchAddress' : $('#pac-input').val()	
				
				?>

				$('#LocationName').val('<?php echo $LocationName?>');
				$('#pac-input').val('<?php echo $LocationAddress?>');

			 	$('.btnAddLocation').click(function(){
			 		
			 		$.ajax({
						url: "../controller/doUpdateLocation.php",
						type: "POST",
						dataType: "json",
						//contentType: "application/json; charset=utf-8",
						data : {
							'LocationID' : '<?php echo $LocationID?>',
							'Lat'  : lat,
							'Lng'  : lng,
							'LocationName' : $('#LocationName').val(),
							'LocationAddress' : $('#pac-input').val()						
						},
						success: function(data){
							if(data == '1'){
								javascript:parent.$.fancybox.close();
								alert('Update Location success.');
								//$('.fancybox-close');

								javascript:parent.location.reload();
								
																

								//$.fancybox.close();
							}
							else{
								alert(data);
							}
							
						}
					});

			 		/*$.post("../controller/doCreateBranch.php",
					    {StaffID:"STA0001",Lt:"22"}).done(function(data, textStatus, jqXHR){
					    	console.log(data);
					 
					     }).fail(function(jqXHR, textStatus, errorThrown) 
					    {
					        alert(textStatus);
					});
*/
			 		//alert('Add Branch Success.');


			 	});

			 	//$('#popup').css('margin','100px 0 0 0')

			 	
			});




			function initialize() {
			  var mapOptions = {
			    center: new google.maps.LatLng(<?php echo $Lat?>, <?php echo $Lng?>),
			    zoom: 13
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
			    anchorPoint: new google.maps.Point(<?php echo $Lat?>, <?php echo $Lng?>)
			  });

			  myLatlng = new google.maps.LatLng(<?php echo $Lat?>, <?php echo $Lng?>);
			  console.log(myLatlng);

			  marker.setPosition(myLatlng);

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

			    lat = place.geometry.location.k;
			    lng = place.geometry.location.D;
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
			
			<div id="popup">
				<div class="form">
					
						<div class="field">
							<h2 align="center">Update Location</h2>
							<hr/>
						</div>
						<br/>

						<div class="field">
							<span>Location Name</span>
							<span><input id="LocationName" class="textbox" type="text"/></span>
						</div>	

						<div class="field">
							<span>Location Address</span>
							<span><input id="pac-input" class="textbox" type="text" placeholder="Enter a location"/></span>
						</div>
						
						<div>
							
							<!--<div id="type-selector" class="controls">
								
								<input type="radio" name="type" id="changetype-all" checked="checked">
								<label for="changetype-all">All</label>

								<input type="radio" name="type" id="changetype-establishment">
								<label for="changetype-establishment">Establishments</label>

								<input type="radio" name="type" id="changetype-geocode">
								<label for="changetype-geocode">Geocodes</label>

								<input type="radio" name="type" id="changetype-address" checked="checked">
								<label for="changetype-address">Addresses</label>
							</div>-->
							<div id="map-canvas"></div>
						</div>
						<br/>
						
											

						<div class="field">
							<div class="submit"><input type="button" class="btnAddLocation" value="Update Location" class="sizesubmit"/></div>
						</div>
						<br/><br/>
					
				</div>
			</div>
			
		</div>
	</body>
</html>