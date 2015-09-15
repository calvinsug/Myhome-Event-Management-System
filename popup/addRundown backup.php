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
			 	$('#formRegis').submit(function(e){
			 		
			 		

			 	});


			 	$.ajax({
				  url: "../controller/getEvent.php",
				  type: "POST",
				  dataType: "json",
				  success: function(data){
				  	//alert(data);
				  	
				  	//console.log(data.StaffID.length);
				 	var myOptions={};

				 	for(i=0;i<data.EventID.length;i++){
				 		$('select[name="Event"]').append('<option value="'+data.EventID[i]+'">'+data.EventName[i]+'</option>');

				 	}
				  }
				}); //end of Ajax

		
			});


    	</script>
	</head>
	<body>


			<div id="popup">
				<div class="form">
					<form method="post" action="../controller/doCreateRundown.php" id="formRegis" enctype="multipart/form-data">
		
						<div class="field">
							<h2 align="center">Create Rundown</h2>
							<hr/>
						</div>
						<br/>
						
						<div class="field">
							<span>Action</span>
							<span>
								<select name="action" class="textbox">
									<option value="view">View</option>
									<option value="create">Create</option>
									
								</select>
							</span>
						</div>

						<div class="field">
							<span>Event</span>
							<span>
								<select name="Event" id="ddlEvent" class="textbox">
									
								</select>
							</span>
						</div>

						<div class="field">
							
							<div class="submit"><input type="submit" class="btnCreateRundown" value="Create Rundown" class="sizesubmit"/></div>
						
							<div style="color:#FF0000;margin-bottom: 10px" align="center" id="eventerror">
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
			
		</div>
	</body>
</html>