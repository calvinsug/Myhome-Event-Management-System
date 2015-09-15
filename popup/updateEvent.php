<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="../assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />
		<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
		<link rel="stylesheet" href="../assets/css/jquery-ui.css">
		<script src="../assets/library/jquery-ui.js"></script>

		<script src="../assets/library/tiny_mce/tiny_mce.js"></script>

		<!-- Datepicker  
		 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
		  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		  <link rel="stylesheet" href="/resources/demos/style.css">
		-->
		<script>

			$( document ).ready(function() {

				<?php 
				include('../controller/connect.php');
		          if(isset($_GET['success'])){

			     ?>
			     	
			     	javascript:parent.$.fancybox.close();

			     	alert('Update Event Success');
			     	
			     	javascript:parent.location.reload();
			     <?php    	
		          } 
		          $EventID = '';
		          if(isset($_GET['EventID']))
		          	$EventID = $_GET['EventID'];


		          $query = "select * from event where EventID = '$EventID' ";
		          $result = mysql_query($query);

		          $row = mysql_fetch_array($result);


			      ?>


			 	$('#formRegis').submit(function(e){
			 		console.log(e);



			 		tinymce.triggerSave();
			 		//alert('tes');

			 		$('#txtDesc').val($('#desc').val());


			 	});

			 	$('#startDate').datepicker({
			 		dateFormat : 'yy-mm-dd',
			 		minDate : '+1'
			 	});

			 	$('#endDate').datepicker({
			 		dateFormat : 'yy-mm-dd',
			 		minDate : '+1'
			 	});


			 	tinymce.init({
				    selector: "textarea",
				    width: 700
				});
			 	
			 	//pricefield
			 	$("input[name='price']").click(function(){
			 		
			 		if($(this).val() == 'paid')
			 			$('.pricefield').show();
			 		else
			 			$('.pricefield').hide();
			 		
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
			
			<div id="popup">
				<div class="form">
					<form method="post" action="../controller/doUpdateEvent.php" id="formRegis" enctype="multipart/form-data">
			
						<div id="newEvent">
							<div class="field">
								<h2 align="center">Update Event</h2>
								<hr/>
							</div>
							<br/>
							
							<div class="field" style="display:none">
								<span>Event ID</span>								
								<span><input id="title" name='EventID' value="<?php echo $EventID;?>" class="textbox" type="text"/></span>
							</div>

							<div class="field">
								<span>Event Title</span>
								<span><input id="title" name='title' value="<?php echo $row['EventTitle'];?>" class="textbox" type="text"/></span>
							</div>
							
							<div class="field">
								<span>Event Type</span>
								<span><input id="type" name='eventType' value="<?php echo $row['EventType'];?>" class="textbox" type="text"/></span>
							</div>

							<div class="field">
								<span>Start Date</span>
								<span><input id="startDate" name='startDate' value="<?php echo $row['StartDate']?>" class="textbox" type="text" disabled/></span>
							</div>

							<div class="field">
								<span>End Date</span>
								<span><input id="endDate" name='endDate' value="<?php echo $row['EndDate']?>" class="textbox" type="text" disabled/></span>
							</div>

							<br/>

							<div class="field">
								<span>Event Desc</span>
								<span><textarea name="Eventdesc" id="desc" class="textbox" rows="3" cols="40"><?php echo $row['EventDesc']?></textarea></span>
							</div>	

							<input type="text" style="display:none" name="desc" id="txtDesc" />

							<br/><br/>

							<div class="field">
								<span>Event Photo</span>
								<span><input type="file" class="textbox" id="file_upload" name="img" accept="image/png, image/jpg, image/jpeg"></span>
							</div>

							<div id="divImg" style="margin:0 0 20px 240px"><img style="width:100px;height:100px" src="../assets/images/photoevent/<?php echo $row['EventPhoto'];?>" id="imgPath"/></div>
							<br/><br/>
							
							<div class="field">
								<span>Capacity</span>
								<span><input id="txtCapacity" name='capacity' value="<?php echo $row['Capacity'];?>" class="textbox" type="text" disabled/></span>
							</div>

							<div class="field">
								<span>Price</span>
								<span>
									<input name="price" type="radio" value="free" <?php if($row['PaymentType'] == 'free') echo 'checked';?>/>Free
									<input name="price" type="radio" value="paid" <?php if($row['PaymentType'] == 'paid') echo 'checked';?>  />Paid
								</span>
							</div>

							<div class="field pricefield" <?php if($row['PaymentType'] == 'free') echo 'style="display:none"'?>>
								<span>Ticket Price</span>
								<span><input id="ticketPrice" name='ticketPrice' value="<?php echo $row['RegistrationFee'];?>" class="textbox" type="text"/></span>
							</div>

							<div class="field">
								
								<div class="submit"><input type="submit" class="btnCreateEvent" value="Update Event" class="sizesubmit"/></div>
							
								<div style="color:#FF0000;margin-bottom: 10px" align="center" id="eventerror">
					              <?php 
					                  if(isset($_GET['error'])) echo $_GET['error'];
					                  else echo "&nbsp;";
					              ?>
					            </div>
							</div>
							<br/><br/>
						</div>

					</form>
				</div>
			</div>
			
		</div>
	</body>
</html>