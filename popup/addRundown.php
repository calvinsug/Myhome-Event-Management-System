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
		          if(isset($_GET['success'])){
			     ?>
			     	
			     	javascript:parent.$.fancybox.close();

			     	alert('Create Rundown Success');
			     	
			     	javascript:parent.location.reload();
			     <?php    	
		          } 
			    ?>


			 	$('#formRegis').submit(function(e){
			 		console.log(e);


			 		$('#txtDesc').val($('#desc').val());


			 	});

			 	<?php 
					$EventID = "";
					echo $EventID;
					if(isset($_GET['EventID']))
						$EventID = $_GET['EventID'];


					include("../controller/connect.php");

					$query = "select DATEDIFF(endDate, startDate )+1 AS DiffDate FROM event where eventID = '$EventID'  " ;

					$result = mysql_query($query);

					$row  = mysql_fetch_array($result);

					$totalDay = $row[0];


				?>

					for(i=0;i< <?php echo $totalDay?>  ;i++)
						$('select[name="dayRundown"]').append('<option value="'+(i+1)+'">'+(i+1)+'</option>');
						



			 	$.ajax({
				  url: "../controller/getlocation.php",
				  type: "POST",
				  dataType: "json",
				  success: function(data){
				  	console.log(data);

				  	for(i=0;i<data.location.length;i++){
				 		$('select[name="Location"]').append('<option value="'+data.value[i]+'">'+data.location[i]+'</option>');
				 	}
				  }

				});


			 	/*$('#startDate').datepicker({
			 		dateFormat : 'yy-mm-dd',
			 		minDate : '+1'
			 	});

			 	$('#endDate').datepicker({
			 		dateFormat : 'yy-mm-dd',
			 		minDate : '+1'
			 	});*/

			});


    	</script>
	</head>
	<body>
			
			<div id="popup">
				<div class="form">
					<form method="post" action="../controller/doCreateRundown.php" id="formRegis">
			
							<div id="newRundown">
							<div class="field">
								<h2 align="center">Create Rundown Event</h2>
								<hr/>
							</div>
							<br/>
							
							<div id="rundownFormGeneral">	

								<div class="dayForm">
									
									<div class="rundown">

										<div class="field" style="display:none" >
											<span>Event ID</span>
											<span><input id="title" name="EventID" value="<?php echo $EventID;?>" class="textbox" type="text"/></span>
										</div>
										
										<div class="field">
											<span>Day Rundown</span>
											<span><select name="dayRundown" class="textbox"></select></span>
										</div>
									
										<div class="field">
											<span>Start Time Rundown</span>
											<span><input id="startTime" placeholder="HH:MM, example : 08:30" name="startTime" class="textbox" type="text"/></span>
										</div>

										<div class="field">
											<span>End Time Rundown</span>
											<span><input id="endTime" placeholder="HH:MM, example : 08:30" name="endTime" class="textbox" type="text"/></span>
										</div>

										<div class="field">
											<span>Description Rundown</span>
											<span><textarea name="Rundowndesc" id="desc" class="textbox" rows="3" cols="40"></textarea></span>
										</div>
										<br/><br/><br/>

										<div class="field">
											<span>Location Rundown</span>
											<span><select name="Location" id="ddlLocation" class="textbox"></select></span>
										</div>	
										
									</div>

								</div>
							</div>

							<div class="field">
								
								<div class="submit"><input type="submit" class="btnCreateRundown" value="Create Rundown" class="sizesubmit"/></div>
							
								<div style="color:#FF0000;margin-bottom: 10px" align="center" id="rundownerror">
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