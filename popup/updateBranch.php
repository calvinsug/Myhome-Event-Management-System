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

		<?php 
			$BranchID = $_GET['id'];
			$StaffID = $_GET['staffid'];
			$Lat = $_GET['lat'];
			$Lng = $_GET['lng'];
			$Region = $_GET['region'];
			$BranchAddress = $_GET['address'];

							//'Region' : $('select[name="region"]').val(),
							//'BranchAddress' : $('#pac-input').val()	
		
		?>

		<script>

			$( document ).ready(function() {
			 	$('#formRegis').submit(function(e){
			 		console.log(e);
			 		e.preventDefault();
			 	});

			 	//alert('<?php echo $StaffID?>');

			 	$('select[name="Staff"]').val('<?php echo $StaffID?>');
			 	$('#pac-input').val('<?php echo $BranchAddress?>');
			 	$('select[name="region"]').val('<?php echo $Region?>');

			 	lat = <?php echo $Lat;?>;
			 	lng = <?php echo $Lng;?>;

			 	$.ajax({
				  url: "../controller/getstaff.php",
				  type: "POST",
				  dataType: "json",
				  success: function(data){
				  	//alert(data);
				  	
				  	//console.log(data.StaffID.length);
				 	var myOptions={};

				 	for(i=0;i<data.StaffID.length;i++){
				 		$('select[name="Staff"]').append('<option value="'+data.StaffID[i]+'">'+data.StaffName[i]+'</option>');


				 	}
						 	
					 	//console.log(data.StaffID[i]);
					 	//myOptions.push('1','s');

					//data.StaffID[i] : data.StaffName[i] 


					/*<select name="Staff" class="textbox">
									<option value="STA0001">Staff1</option>
									<option value="STA0002">Staff2</option>
									
								</select>*/


				 	/*var mySelect = $('select[name="Staff"]');
					$.each(myOptions, function(val, text) {
					    mySelect.append(
					        $('<option></option>').val(val).html(text)
					    );
					});*/

				  	
				  }
				}); //end of Ajax

			 	/*var myOptions = {
				    test : 'text1',
				    test3 : 'text2'
				var mySelect = $('select[name="Staff"]');
				$.each(myOptions, function(val, text) {
				    mySelect.append(
				        $('<option></option>').val(val).html(text)
				    );
				});
				};*/


			 	$('.btnUpdateBranch').click(function(){
			 		
			 		$.ajax({
						url: "../controller/doUpdateBranch.php",
						type: "POST",
						dataType: "json",
						//contentType: "application/json; charset=utf-8",
						data : {
							'BranchID' : '<?php echo $BranchID?>',
							'StaffID' : $('select[name="Staff"]').val(),
							'Lat'  : lat,
							'Lng'  : lng,
							'Region' : $('select[name="region"]').val(),
							'BranchAddress' : $('#pac-input').val()								
						},
						success: function(data){
							if(data == '1'){
								javascript:parent.$.fancybox.close();
								alert('Update Branch success.');
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
			    zoom: 18
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
			    marker.setVisible(true);
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
							<h2 align="center">Update Branch</h2>
							<hr/>
						</div>
						<br/>
						<div class="field">
							<span>Branch Address</span>
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
							<span>Staff</span>
							<span>
								<select name="Staff" id="ddlStaff" class="textbox">
									
								</select>
							</span>
						</div>

						<div class="field">
							<span>Region</span>
							<span>
								<select name="region" class="textbox">
									<option value="home">Home</option>
									<option value="office">Office</option>
									<option value="school">School / Collage</option>
									<option value="publicfacilities">Public Facilities</option>
								</select>
							</span>
						</div>
						<div class="field">
							<div class="textbox">
								<ol>
									<li>Office: a place where could be a place to work. For example: an office.</li>
									<li>Home: a place that bs used as examples of residential homes, houses, shops, hotels, apartments, dormitories, boarding-lodging.</li>
									<li>School or college: a place where could be a place to learn. For example: school, college, where lessons, the course.</li>
									<li>Public facilities: a place that used public facilities. For example: hospitals, government buildings, workplaces, airports, terminals, railway stations.</li>
									<br/><br/>
								</ol>
							</div>
						</div>

						

						<div class="field">
							<div class="submit"><input type="button" class="btnUpdateBranch" value="Update Branch" class="sizesubmit"/></div>
						</div>
						<br/><br/>
					
				</div>
			</div>
			
		</div>
	</body>
</html>