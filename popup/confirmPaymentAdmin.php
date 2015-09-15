<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
			
			<script src="../assets/library/jquery-2.1.1.js"></script>
			<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />

			<script>

			$( document ).ready(function() {
				
				<?php
				session_start();

				$EventID = '';
				$EventTitle = '';

				if(isset($_GET['EventID']))
					$EventID = $_GET['EventID'];

				if(isset($_GET['EventTitle']))
					$EventTitle = $_GET['EventTitle'];

				if(isset($_SESSION['StaffRole']))
					$StaffRole = $_SESSION['StaffRole'];

		        if(isset($_GET['success'])){
			     	
			    ?>

			     	alert('Confirm Payment Done.');
			     	
			    <?php    	
		          } 
			    ?>

			    $('.acceptPayment').click(function(e){

			    	var answer = confirm ("Are you sure to confirm this Payment?");

					if (!answer){
			    		e.preventDefault();
			    	}
			    });

			});
			</script>

	<body>
		<div id="container">
			
			<div id="contentadmin">
				
				<div class="field">
					<h2 align="center"><?php echo $EventTitle;?> Payment Confirmation</h2>
					<hr/>
				
				<div class="clear"></div>
				<div>
					
					<div class="field">	

						<div style="font-weight: bold;">	
							<div class="popupviewspace colortableheader">Member Name</div>
							
							<div class="popupviewspace colortableheader">Bank Account From</div>
							<div class="popupviewspace colortableheader">Confirm Request</div>

						</div>
						<br/>

							<?php 
								include("../controller/connect.php");

								$query = "select a.EventID,a.MemberID,EventTitle, MemberName, PaymentType,PaymentStatus, BankAccountFrom,RegistrationDate
											FROM registrationevent a
											JOIN event b ON a.eventid = b.eventid
											JOIN member c ON a.memberid = c.memberid
											where PaymentType = 'paid' and a.EventID = '$EventID'
											ORDER BY eventTitle ASC";

								$result = mysql_query($query);
								$i=0;
								while($row=mysql_fetch_array($result)){
									

									/*select EventTitle, MemberName, PaymentStatus, BankAccountFrom, BankAccountTo, RegistrationDate
											FROM registrationevent a
											JOIN event b ON a.eventid = b.eventid
											JOIN member c ON a.memberid = c.memberid
											ORDER BY eventTitle ASC
									*/

								//class="colortablecontent"  -> untuk warna row
							?>



							<div class="field">	
									<div class="popupviewspace"><?php echo $row['MemberName']?></div>
									
									<div class="popupviewspace">
										<?php 
										if($row['PaymentStatus'] == "wait")
											echo $row['BankAccountFrom'];
										else echo 'pending';
										?>
									</div>
									<div class="popupviewspace"><?php
										if($row['PaymentStatus'] == "wait"){

									?>

									<?php 
										if($StaffRole == "President"){ 
											echo 'wait';
										}
										else{
										?>
										<a class="acceptPayment" href="../controller/doAcceptPayment.php?MemberID=<?php echo $row['MemberID']?>&EventID=<?php echo $row['EventID']?>"><input type="button" value="Confirm"></a>
									<?php } ?>

									<?php
										}
										else if($row['PaymentStatus'] == 'pending'){
											echo 'pending';
										}
									else									
									echo "Done";	
									?></div>

							</div>	
							<div class="clear"></div>
								
							<?php 							
								$i++;
								}		
							?>

					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</body>
</html>