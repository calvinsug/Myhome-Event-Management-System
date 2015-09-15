<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	    <script src="../assets/library/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="../assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

		<?php
			include('../controller/connect.php');

			if(isset($_GET['EventID']))
				$EventID = $_GET['EventID'];

			if(isset($_GET['EventTitle']))
				$EventTitle = $_GET['EventTitle'];


			$query = "select * from registrationevent a join member b on a.memberid=b.memberid where EventID = '$EventID' order by ParticipantID asc";


			$result = mysql_query($query);

		?>

	</head>
	<body>
		
		<div id="popup">
				<div class="form">
					
							<div id="newRundown">
							<div class="field">
								<h2 align="center"><?php echo $EventTitle;?></h2>
								<hr/>
							</div>
							<br/>

							<div style="font-weight: bold;">	
									<div class="popupviewspace colortableheader">Member Name</div>
									
									<div class="popupviewspace colortableheader">Registration Date</div>
									<div class="popupviewspace colortableheader">Participant ID</div>
									<div class="popupviewspace colortableheader">Payment Status</div>
								</div>
								<br/>
									
							<?php

							if(mysql_num_rows($result) == 0)
								echo 'There is no Registration yet.';



						

							while($row  = mysql_fetch_array($result)){

							?>
								<div>	
									<div class="popupviewspace"><?php echo $row['MemberName']?></div>
									
									<div class="popupviewspace"><?php echo $row['RegistrationDate']?></div>
									<div class="popupviewspace"><?php echo $row['ParticipantID']?></div>
									<div class="popupviewspace"><?php echo $row['PaymentStatus']?></div>
								</div>	
								<div class="clear"></div>
							<?php
	
							}	//end of while

							?>

							

							<br/><br/>
						</div>

				</div>
			</div>


	</body>
</html>