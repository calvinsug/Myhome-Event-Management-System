<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>

		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
		<link rel="stylesheet" href="../assets/css/jquery-ui.css">
		<script src="../assets/library/jquery-ui.js"></script>

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

			     	alert('Change Password success.');
			     	
			     	javascript:parent.location.reload();
			     <?php    	
		          } 
			    ?>

			 
			});


    	</script>
	</head>
	<body>
			
			<div id="popup">
				<div class="form">
					<form method="post" action="../controller/doChangePassword.php" id="formRegis">
			
							<div id="newRundown">
							<div class="field">
								<h2 align="center">Change Password</h2>
								<hr/>
							</div>
							<br/>
							
							<div id="rundownFormGeneral">	

								<div class="dayForm">
									
									<div class="rundown">

										
										<div class="field">
											<span>Old Password</span>
											<span><input name="oldPassword" class="textbox" type="password"/></span>
										</div>

										<div class="field">
											<span>New Password</span>
											<span><input name="password" class="textbox" type="password"/></span>
										</div>

										<div class="field">
											<span>Confirm Password</span>
											<span><input name="confirmPassword" class="textbox" type="password"/></span>
										</div>

									</div>

								</div>
							</div>

							<div class="field">
								<br/><br/>
								<div class="submit"><input type="submit" class="btnAddMemberDivision button" value="Change Password"/></div>
							
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