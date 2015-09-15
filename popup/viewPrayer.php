<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>

		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">

	</head>
	<body>
			
			<div id="popup">
				<div class="form">

					<?php 
						$RequestID = "";
						
						if(isset($_GET['RequestID']))
							$RequestID = $_GET['RequestID'];

						include("../controller/connect.php");

						$query = "select PrayerDesc,DATE_FORMAT(SendDate,'%d %b %Y %T') as SendDate,Status,PrayerRespond from prayerrequest where RequestID = '$RequestID'";

						$result = mysql_query($query);

						if(mysql_num_rows($result)){
							$row= mysql_fetch_array($result);
					?>
					<div id="newRundown">
						<div class="field">
							<h2 align="center"><?php echo $row['SendDate'];?></h2>
							<hr/>
							<h2>Prayer Description : </h2><br/>
							<?php echo $row['PrayerDesc'];?>
							<hr/>
							<h2>Prayer Respond : </h2>
							<?php 

								if($row['Status'] == 'pending'){
									echo 'Wait for respond.';

								}
								else{
									echo $row['PrayerRespond'];

								}


							?>


						</div>
						<br/>
								
						<?php

							

						?>
						

						<br/><br/>
					</div>

					<?php
						}
					?>

				</div>
			</div>
			
		</div>
	</body>
</html>