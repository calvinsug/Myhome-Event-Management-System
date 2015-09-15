<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>

		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<script>

			$( document ).ready(function() {

				<?php 
		          if(isset($_GET['success'])){
			     ?>
			     	
			     	javascript:parent.$.fancybox.close();

			     	alert('Respond prayer success.');
			     	
			     	javascript:parent.location.reload();
			     <?php    	
		          } 

			    if(isset($_GET['error'])){
			     	$error = $_GET['error'];
			     ?>
			     	
			     		

			     	alert('<?php echo $error;?>');
			     	
			     <?php    	
		          } 
			    ?>

			});




    	</script>


	</head>
	<body>
			<div id="popup">
				<div class="form">
					<form method="post" action="../controller/doConfirmPrayer.php">
						<?php 
							$RequestID = "";
							
							if(isset($_GET['id']))
								$RequestID = $_GET['id'];

							include("../controller/connect.php");

							$query = "select PrayerDesc,DATE_FORMAT(SendDate,'%d %b %Y %T') as SendDate,Status,PrayerRespond from prayerrequest where RequestID = '$RequestID'";

							$result = mysql_query($query);

							if(mysql_num_rows($result)){
								$row= mysql_fetch_array($result);
						?>
						<div id="newRundown">
							<h2 align="center"><?php echo $row['SendDate'];?></h2>
							<div class="field">
								<hr/>
								<h2>Prayer Description : </h2><br/>
								<?php echo $row['PrayerDesc'];?>
								
								<hr/>
							</div>
							
							

							<div class="field">
								<h2>Prayer Respond : </h2>
								
								<textarea  name="PrayerRespond"></textarea>

							</div>
							
							<input type="text" name="RequestID"  value="<?php echo $RequestID;?>" style="display:none">

							<br/><br/>
							<div align="center">
								<input type="submit" value="Respond Prayer">
							</div>
						</div>
					</form>
					<?php
						}
					?>

				</div>
			</div>
			
		</div>
	</body>
</html>