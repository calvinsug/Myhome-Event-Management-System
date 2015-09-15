<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
		<link rel="stylesheet" href="../assets/css/jquery-ui.css">
		
		<script src="../assets/library/jquery-ui.js"></script>
		<script type="text/javascript" src="../assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

		 
		 <?php
			include('../controller/connect.php');
			session_start();

			if(isset($_SESSION['MemberID']))
				$MemberID = $_SESSION['MemberID'];

			$query = "select * from member a join branch b on a.BranchID=b.BranchID where MemberID = '$MemberID'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
		 ?>


		<script>

		$( document ).ready(function() {

			<?php 
		          if(isset($_GET['success'])){
			     ?>
			     	
			     	javascript:parent.$.fancybox.close();

			     	alert('Update Profile Success.');
			     	
			     	javascript:parent.location.reload();
			     <?php    	
		          } 

		          ?>

		  


			$('.addPhone').click(function(){
				//alert('qwe');
				x = $('input[name="totalPhone"]').val();
				x++;

				$('#formPhone').append('<div class="field">'+
							'<span>Phone '+x+
							'<span><input type="text" name="phone'+x+'" class="textbox"/></span>'+
						'</div>');

				$('input[name="totalPhone"]').val(x);
			});

			$('#file_upload').change(function(e) {
	        	attachmentFile = e.target.files;
	   
	   			console.log(attachmentFile);

	            if(attachmentFile.length)
	            	extension = attachmentFile[0].name.substr(attachmentFile[0].name.length-3).toLowerCase();
	            else 
	            	$('#txtFile').val("");
	            
	            if(attachmentFile.length)
	            {
	                if(attachmentFile[0].size > 2000000)
	                {
	                	alert("File size cannot exceed 2 MB limit");
	                    attachmentFile = null;
	                    
	                    $('#divImg').html('<img src="" id="imgPath"/>'); 
	                    $('#file_upload').val('');
	                }
	                else if(extension != 'jpg' && extension != 'png' && extension != 'gif' ){
	                	alert("File extension must be .jpg, .png, or .gif");
	                    attachmentFile = null;
	                   
	                    $('#divImg').html('<img src="" id="imgPath"/>');   
	                    $('#file_upload').val('');
	                }
	                else
	                {
	                    
	                    prepareUpload(e);
	                }
	            }
	        });

			function prepareUpload(event){
				files = event.target.files;
				if (files && files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#imgPath')
							.attr('src', e.target.result)
							.width(100)
							.height(100);
						
					};
					reader.readAsDataURL(files[0]);
				}
			}

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

			  var marker = [];
			  var infowindow = [];

/*			    infowindow.close();
			    marker.setVisible(false);
*/			   
		    //console.log( "ready!" );
			$.ajax({
			  url: "../controller/getaddress.php",
			  type: "POST",
			  dataType: "json",
			  success: function(data){
			  	//alert(data);
			  	
			  	//console.log(data);
			 	
			 	for(i=0;i<data.address.length;i++){
			 		$('select[name="branchID"]').append('<option member="'+data.TotalMember[i]+'" lat="'+data.lat[i]+'" lng="'+data.lng[i]+'" value="'+data.value[i]+'">'+data.address[i]+'</option>');
	
				var infowindow = new google.maps.InfoWindow();
				var marker = new google.maps.Marker({
				    map: map,
				    anchorPoint: new google.maps.Point(0, -29)
				  });			    
			 		
			 	var address =data.address[i];
			    
			 	infowindow.setContent('<div style="width:250px;height:60px">'+address + '<br/>Total Member : '+data.TotalMember[i]+'</div>');
			 	//infowindow.open(map, marker);
			 	var latlng = new google.maps.LatLng(data.lat[i], data.lng[i]);
    			console.log(latlng);

			    marker.setPosition(latlng);
			    marker.setVisible(true);

	/*		    google.maps.event.addListener(marker[i], 'click', function(marker[i],infowindow[i]) {
    			    console.log(infowindow[i]);

			  	})(marker[i],infowindow[i]);*/

				google.maps.event.addListener(marker,'click', (function(marker,infowindow){ 
			        return function() {
			           //infowindow.setContent(content);
			           infowindow.close();
			           infowindow.open(map,marker);
			        };
			    })(marker,infowindow));


			 	}

			 	$('select[name="branchID"]').change(function(){
				//var x = $(this);	
				lat = $('option:selected', this).attr('lat');
				lng = $('option:selected', this).attr('lng');

				console.log(lat);
				console.log(lng);

				map.setZoom(19);
			  //var autocomplete = new google.maps.places.Autocomplete(input);

			  var infowindow = new google.maps.InfoWindow();
			    	
				 var marker = new google.maps.Marker({
				    map: map,
				    anchorPoint: new google.maps.Point(0, -29),
				    title: 'tes'
				  });


				 console.log(marker);

				infowindow.close();
			    marker.setVisible(false);
			    
				var latlng = new google.maps.LatLng(lat, lng);
    			console.log(latlng);

			    marker.setPosition(latlng);
			    marker.setVisible(true);

			    var address = $('select[name="branchID"] option:selected').text();
			  	
			  	infowindow.setContent('<div style="width:250px;height:60px">'+address + '<br/>Total Member : '+ $('select[name="branchID"] option:selected').attr('member') +'</div>');
			    infowindow.open(map, marker);

			    google.maps.event.addListener(marker,'click', (function(marker,infowindow){ 
			        return function() {
			           //infowindow.setContent(content);
			           infowindow.close();
			           infowindow.open(map,marker);
			        };
			    })(marker,infowindow));

			});


			  	
			  } //end of success
			}); //end of Ajax


/*			    marker.setPosition(place.geometry.location);
			    marker.setVisible(true);

			    var address = '';
			    

			    infowindow.setContent(address);
			    infowindow.open(map, marker);
*/			 
	
			}
				google.maps.event.addDomListener(window, 'load', initialize);

		});

    	</script>
	</head>
	<body>
		<div id="container">
			
			
				<div class="form">
					<form method="post" action="../controller/doeditprofile.php" id="formRegis" enctype="multipart/form-data">
						<div class="field">
							<h2 align="center">Edit Profile</h2>
							<hr/>
						</div>
						<br/>
						
					

						<div class="field">
							<span>Name</span>
							<span><input type="text" name="MemberName" value="<?php echo $row['MemberName'];?>" class="textbox"/></span>
						</div>
						
						<div class="field">
							<span>Email</span>
							<span><input type="text" name="email" value="<?php echo $row['MemberEmail'];?>" class="textbox"/></span>
						</div>
						<?php 
							$query2 = "select * from phonemember a join member b on a.memberid=b.memberid where a.memberid='$MemberID'";
							$result2 = mysql_query($query2);
							$i=0;

							while($row2= mysql_fetch_array($result2)){
								$i++;

							
						?>
						<div class="field">
							<span>Phone <?php echo $i?></span>
							<span><input type="text" name="phone<?php echo $i;?>" value="<?php echo $row2[1]?>" class="textbox"/></span>
						</div>

						<?php
							}
						?>

						<div class="field">
							<span></span>
							<span><input class="button addPhone" type="button" value="Add Phone"></span>
						</div>

						<div id="formPhone"></div>

						<div class="field" style="display:none">
							<span>Total Phone Before</span>
							<span><input type="text" name="totalPhoneBefore" value="<?php echo $i;?>" class="textbox"/></span>
						</div>

						<div class="field" style="display:none">
							<span>Total Phone</span>
							<span><input type="text" name="totalPhone" value="<?php echo $i;?>" class="textbox"/></span>
						</div>

						<div class="field">
							<span>Member Address</span>
							<span><textarea name="address" class="textbox"  rows="4"><?php echo $row['MemberAddress'];?></textarea> </span>
						</div>				

						<br/><br/><br/>		

						<div class="field">
							<span>Address Adopt</span>
							<span><select name="branchID" class="textbox"> </select></span>
						</div>

						<div id="map-canvas"></div>	
						
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
							
						</div>
						<br/>

					    <div class="field">
							<span>Photo</span>
							<span><input type="file" class="textbox" id="file_upload" name="img" accept="image/png, image/jpg, image/jpeg"></span>
						</div>

						<div id="divImg" style="margin:0 0 20px 240px"><img style="width:100px;height:100px" src="../assets/images/photomember/<?php echo $row['MemberPhoto']?>" id="imgPath"/></div>

						<!--
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
						-->
						<br/><br/>
						<div class="field">
							<div class="submit"><input type="submit" value="Update Profile" class="button btnSubmit"/></div>
							<div style="color:#FF0000;margin-bottom: 10px" align="center" >
				              <?php 
				                  if(isset($_GET['error'])) echo $_GET['error'];
				                  else echo "&nbsp;";
				              ?>
				          </div>
						</div>
						
						<br/><br/>
					</form>
				</div>
			
			
		</div>
	</body>
</html>