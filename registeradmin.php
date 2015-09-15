<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>-->
		<script src="assets/library/jquery-2.1.1.js"></script>
		<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
		
		<script src="assets/library/jquery-ui.js"></script>
		  
		<script>

		$( document ).ready(function() {
		    //console.log( "ready!" );
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

			  			//console.log(ui.item.value);
			  			
			  			//console.log(data.address.indexOf(ui.item.value));

			  			//console.log(data.value[data.address.indexOf(ui.item.value)]);
						//console.log(data[2].value);			  			

						$('input[name="branchID"]').val(data.value[data.address.indexOf(ui.item.value)]);
			  		}
				}).on('focus', function(event) {
				    var self = this;
				    $(self).autocomplete( "search", "");;
				});

			  	
			  }
			}); //end of Ajax

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

		});

    	</script>
	</head>
	<body>
		<div id="container">
			<div id="headerbg">
				<div id="header">
					<img src="assets/images/Myhome.png"/>
				</div>
			</div>
			<div class="clear"></div>
			<br/><br/>
			<div id="content">
				<div class="form">
					<form method="post" action="controller/doregisAdmin.php" id="formRegis" enctype="multipart/form-data">
						<div class="field">
							<h2 align="center">Register Staff My Home Indonesia</h2>
							<hr/>
						</div>
						<br/>
						<div class="field">
							<span>Username</span>
							<span><input type="text" id="idUsername" name="username" class="textbox classUsername"/></span>
						</div>
						<div class="field">
							<span>Password</span>
							<span><input type="password" name="password" class="textbox"/></span>
						</div>
						<div class="field">
							<span>Confirm Password</span>
							<span><input type="password" name="confirmpassword" class="textbox"/></span>
						</div>

						<div class="field">
							<span>Firstname</span>
							<span><input type="text" name="firstname" class="textbox"/></span>
						</div>
						<div class="field">
							<span>Lastname</span>
							<span><input type="text" name="lastname" class="textbox"/></span>
						</div>
						<div class="field">
							<span>Email</span>
							<span><input type="text" name="email" class="textbox"/></span>
						</div>
						<div class="field">
							<span>Phone</span>
							<span><input type="text" name="phone" class="textbox"/></span>
						</div>

						<div class="field">
							<span>Address</span>
							<span><textarea name="address" class="textbox" rows="4"> </textarea> </span>
						</div>				
						
						<br/><br/><br/>		

						<div class="field">
							<span>StaffRole</span>
							<span>
								<!-- <input type="text" name="role" class="textbox"> -->
								<select name="role" class="textbox">
									<option value="EventOrganizer">Event Organizer</option>
									<option value="NewsOrganizer">News Organizer</option>
									<option value="PrayerOrganizer">Prayer Organizer</option>
									<option value="BranchOrganizer">Branch Organizer</option>
								</select>	

							</span>
						</div>

						<div class="field">
							<span>Question Security</span>
							<span>
								<select name="questionsecurity" class="textbox">
									<option value="pet">What is your pet’s name?</option>
									<option value="book">What is your favorite book?</option>
									<option value="nickname">What was your childhood nickname?</option>
									<option value="singer">Who was your favorite singer or band in high school?</option>
									<option value="color">What is your favorite color?</option>
								</select>
							</span>
						</div>

						<div class="field">
							<span>Answer</span>
							<span><input type="text" name="answer" class="textbox"/></span>
						</div>

						<div style="display:none" id="fieldbranch">
							<input type="text" name="branchID" />
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
							
						</div>
						<br/>

					    <div class="field">
							<span>Photo</span>
							<span><input type="file" class="textbox" id="file_upload" name="img" accept="image/png, image/jpg, image/jpeg"></span>
						</div>

						<div id="divImg" style="margin:0 0 20px 410px"><img src="" id="imgPath"/></div>

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

						<div class="field">
							<div class="submit"><input type="submit" value="Register" class="sizesubmit btnSubmit"/></div>
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
			<?php 
				include("footer.php");
			?>
		</div>
	</body>
</html>