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

			     	alert('Confirm Payment Done, please wait for confirmation.');
			     	
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
					//echo $EventID;
					if(isset($_GET['EventID']))
						$EventID = $_GET['EventID'];

					$MemberID = "";
					//echo $EventID;
					if(isset($_GET['MemberID']))
						$MemberID = $_GET['MemberID'];


				?>

			 
			});


    	</script>
	</head>
	<body>
			
			<div id="popup">
				<div class="form">
					<form method="post" action="../controller/doConfirmPayment.php" id="formRegis">
			
							<div id="newRundown">
							<div class="field">
								<h2 align="center">ConfirmPayment</h2>
								<hr/>
							</div>
							<br/>
							
							<div id="rundownFormGeneral">	

								<div class="dayForm">
									
									<div class="rundown">

										<div class="field" style="display:none">
											<span>Event ID</span>
											<span><input id="title" name="EventID" value="<?php echo $EventID;?>" class="textbox" type="text"/></span>
										</div>

										<div class="field" style="display:none">
											<span>Member ID</span>
											<span><input id="title" name="MemberID" value="<?php echo $MemberID;?>" class="textbox" type="text"/></span>
										</div>
										
										<div class="field">
											<span>Bank Account From</span>
											<span><input name="BankAccountFrom" class="textbox" type="text"/></span>
										</div>

									

									</div>

								</div>
							</div>

							<div class="field">
								
								<div class="submit"><input type="submit" class="btnAddMemberDivision" value="Confirm Payment" class="sizesubmit"/></div>
							
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