<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>-->
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
		<link rel="stylesheet" href="../assets/css/jquery-ui.css">
		
		<script src="../assets/library/jquery-ui.js"></script>
		<script type="text/javascript" src="../assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

		 
		 <?php
			include('../controller/connect.php');
			session_start();

			if(isset($_SESSION['StaffID']))
				$StaffID = $_SESSION['StaffID'];

			$query = "select * from staff where StaffID = '$StaffID'";
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

		});

    	</script>
	</head>
	<body>
		<div id="container">
			
			
				<div class="form">
					<form method="post" action="../controller/doeditprofileAdmin.php" id="formRegis" enctype="multipart/form-data">
						<div class="field">
							<h2 align="center">Edit Profile</h2>
							<hr/>
						</div>
						<br/>
						
						<div class="field">
							<span>Name</span>
							<span><input type="text" name="StaffName" value="<?php echo $row['StaffName'];?>" class="textbox"/></span>
						</div>
						
						<div class="field">
							<span>Email</span>
							<span><input type="text" name="email" value="<?php echo $row['StaffEmail'];?>" class="textbox"/></span>
						</div>
						<?php 
							$query2 = "select * from phonestaff a join staff b on a.staffid=b.staffid where a.staffid='$StaffID'";
							$result2 = mysql_query($query2);
							$i=0;

							while($row2= mysql_fetch_array($result2)){
								$i++;

						?>
						<div class="field">
							<span>Phone <?php echo $i?></span>
							<span><input type="text" name="phone<?php echo $i;?>" value="<?php echo $row2['PhoneNumber']?>" class="textbox"/></span>
						</div>

						<?php
							}
						?>

						<div class="field">
							<span></span>
							<span><input type="button" value="Add Phone" class="addPhone"></span>
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
							<span>Staff Address</span>
							<span><textarea name="address" class="textbox"  rows="4"><?php echo $row['StaffAddress'];?></textarea> </span>
						</div>				

						<br/><br/><br/>		
						
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

						<div id="divImg" style="margin:0 0 20px 240px"><img style="width:100px;height:100px" src="../assets/images/photostaff/<?php echo $row['StaffPhoto']?>" id="imgPath"/></div>

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
							<div class="submit"><input type="submit" value="Update Profile" class="sizesubmit btnSubmit"/></div>
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