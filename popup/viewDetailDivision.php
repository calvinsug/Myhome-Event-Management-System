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

			     	alert('Delete Committee Success');
			     	
			     	//location.reload();
			     <?php    	
		          } 
			    	
		          	session_start();

					$EventID = "";
					$EventTitle = "";

					if(isset($_GET['EventID']))
						$EventID = $_GET['EventID'];

					if(isset($_GET['EventTitle']))
						$EventTitle = $_GET['EventTitle'];

					if(isset($_SESSION['StaffRole']))
						$StaffRole = $_SESSION['StaffRole'];

					include("../controller/connect.php");

					$query = "select a.DivisionID, a.MemberID,eventTitle , DivisionName , MemberName
								from memberdivision a join event b on a.eventid=b.eventid
								join division c on a.divisionid = c.divisionid 
								join member d on a.memberid = d.memberid
								where a.eventid = '$EventID' 
								order by divisionName asc" ;


					$result = mysql_query($query);

				?>

				$('.delete').click(function(e){

			    	var answer = confirm ("Are you sure to delete this Committee?");

					if (!answer){
			    		e.preventDefault();
			    	}

			    });
						
			});


    	</script>
	</head>
	<body>
			
			<div id="popup">
				<div class="form">
					<form method="post" action="../controller/doCreateRundown.php" id="formRegis">
			
							<div class="popup" id="newRundown">
							<div class="field">
								<h2 align="center"><?php echo $EventTitle;?></h2>
								<hr/>
							</div>
							<br/>
						

						
									
							<?php

							if(mysql_num_rows($result) == 0)
								echo 'There is no Detail Division yet.';

							
							$division="";

							while($row  = mysql_fetch_array($result)){

								//untuk pemisahan antar division
								if($division != $row['DivisionName']){
									$division = $row['DivisionName'];
							?>
								<h1>Division <?php echo $row['DivisionName'];?> 
								
								</h1>

							<?php
								} //end of pisahin division

							?>
								
									<?php echo 'Name = '.$row['MemberName'];?> 

									<?php if($StaffRole != "President"){ ?>
										<a href="../controller/doDeleteCommittee.php?MemberID=<?php echo $row['MemberID']?>&DivisionID=<?php echo $row['DivisionID'];?>&EventTitle=<?php echo $EventTitle;?>&EventID=<?php echo $EventID;?>" class="delete">
											<input type="button" value="Delete">
										</a>
									<?php } ?>			

							<br/>
							<?php
	
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