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
			     	
			     	//javascript:parent.$.fancybox.close();

			     	alert('Delete Rundown Success.');
			     	
			     	//location.reload();
			     <?php    	
		          } 
			    ?>

				$('.delete').click(function(e){

			    	var answer = confirm ("Are you sure to delete this Rundown?");

					if (!answer){
			    		e.preventDefault();
			    	}

			    });

			 	<?php 
					$EventID = "";
					$EventTitle = "";

					if(isset($_GET['EventID']))
						$EventID = $_GET['EventID'];

					if(isset($_GET['EventTitle']))
						$EventTitle = $_GET['EventTitle'];

					include("../controller/connect.php");

					$query = "select RundownID,EventTitle, Dayrundown , startTime, endTime, description, c.LocationID,locationName, locationAddress 
						from rundownevent a join event b on a.eventid = b.eventid
						join location c on c.locationid = a.locationid 
						where a.eventID = '$EventID'
						order by dayrundown,StartTime asc";


					$result = mysql_query($query);

				?>
						
			});


    	</script>
	</head>
	<body>
			
			<div id="popup">
				<div class="form">
					<form method="post" action="../controller/doCreateRundown.php" id="formRegis">
			
							<div id="newRundown">
							<div class="field">
								<h2 align="center"><?php echo $EventTitle;?></h2>
								<hr/>
							</div>
							<br/>
						

						
									
							<?php

							if(mysql_num_rows($result) == 0)
								echo 'There is no rundown yet.';

							$day =1;
							$i=0;
							$location="";

							while($row  = mysql_fetch_array($result)){


								//untuk pemisahan antar hari
								if($day != $row['Dayrundown'] || $i ==0){
									$location = "";
							?>
								<h1> Day <?php echo $row['Dayrundown'];?> 
								
								</h1>



							<?php
								
								$day = $row['Dayrundown']; 
								} //end of pisahin hari

							?>
									
								<?php
									if($location != $row['locationName']){
										$location= $row['locationName'];
										
										?> <b> <?php echo "Location: ".$location; ?> </b>

								
								<br/>
								<?php } // end of pisahin location?>
								
									<?php echo $row['startTime'] .' - '?> 
									<?php echo $row['endTime'].' = '?>
									<?php echo $row['description']?>
									
							

							
							<br/>
							<?php


							$i++;	
							}	//end of while

							?>
							

							<br/><br/>
						</div>

					</form>
				</div>
			</div>
			
		</div>
	</body>
</html>