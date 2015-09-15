<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	    <script src="assets/library/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

		<script>
		$( document ).ready(function() {

				$('.viewRundown').fancybox({
					maxWidth	: 800,
					maxHeight	: 450,
					fitToView	: false,
					width		: '70%',
					height		: '100%',
					autoSize	: false,
					closeClick	: false,
					type 		: 'iframe'
				});

				$(".confirmPayment").fancybox({
				maxWidth	: 800,
				maxHeight	: 450,
				fitToView	: false,
				width		: '70%',
				height		: '100%',
				autoSize	: false,
				closeClick	: false,
				type 		: 'iframe'
			});

			$('.registerEvent').click(function(e){
				var x = $(this);

				var answer = confirm ("Are you sure to register this Event?");
				if (answer){
					
					$.ajax({
						url: "controller/doRegisterEvent.php",
						type: "POST",
						dataType: "json",
						//contentType: "application/json; charset=utf-8",
						data : {
							'EventID'  : x.attr('eventid')
						},
						success: function(data){
							console.log(data);
							if(data == '1'){
								
								alert('You have registered this event.');	
								//$('.registerEvent').remove();
								location.reload();

								//$.fancybox.close();
							}
							else{
								alert('Registration Failed.');
							}
							
						}
					});


				}

			});

		});


		</script>

	</head>
	<body>
		<div id="container">
			
			<?php
				include("header.php");
				
				if(isset($_SESSION['MemberID']))
					$MemberID = $_SESSION['MemberID'];
				
				if(isset($_GET['EventID']))
					$EventID = $_GET['EventID'];

				include("controller/connect.php");

				$query = "select EventID, EventTitle, EventPhoto, EventDesc, PaymentType,RegistrationFee, Capacity, DATE_FORMAT(DATE_SUB( StartDate, INTERVAL 1 DAY ),'%d %b %Y') AS EndRegis
							FROM event where eventid = '$EventID' ";

				$queryavailable = "select Capacity-max(ParticipantID) as AvailableSeats
									from RegistrationEvent a join event b on a.eventid = b.eventid
									where a.EventID = '$EventID'";

				$result = mysql_query($query);
				$resultavailable = mysql_query($queryavailable);
				//$i=0;

				if(mysql_num_rows($result) > 0){
					$row = mysql_fetch_array($result);
					$rowavailable = mysql_fetch_array($resultavailable);

			?>
					<div id="content">
						<div class="form">
							<div class="field">
								<h2 align="center">Event Details</h2>
								<hr/>
							</div>
							<div class="field">
								<div><b><?php echo $row['EventTitle'];?></b></div><br/>
								<div><img width="700" height="500" src="assets/images/photoevent/<?php echo $row['EventPhoto']?>" class="newspicture"/></div>
								<div class="clear"></div><br/>
								<div class="colortableheader">Event Description</div>
								<div><?php echo $row['EventDesc']?></div><br/>
								<div class="colortableheader">Location Event</div>
								<table width="700">

									<?php 
										$query2 = "select distinct a.LocationID , locationName, locationAddress
													from rundownevent a join location b on a.locationid = b.locationid
													where eventID = '$EventID'";

										$result2 = mysql_query($query2);

										while($row2= mysql_fetch_array($result2)){

									?>

									<tr>
										<td><?php echo $row2['locationName']?></td>
										<td><?php echo $row2['locationAddress'];?></td>
									</tr>

									<?php 
										}
									?>
									
									<tr>
										<td class="popup">
											<a href="popup/viewRundownMember.php?EventTitle=<?php echo $row['EventTitle']?>&EventID=<?php echo $row[0];?>" class="viewRundown">
												<input class="button" type="button" value="Rundown Event"/>									
											</a>
										</td>
									</tr>
								</table>
								<br/>
								<div class="colortableheader">Ticket Information</div>
								<div>
									<table width="700">
										<tr>
											<td><b>Payment Type</b></td>
											<td><b>Price</b></td>
											<td><b>End Registration</b></td>
											<td><b>Available Seat</b></td>
										</tr>
										<tr>
											<td><?php echo $row['PaymentType']?></td>
											<td>Rp. <?php echo $row['RegistrationFee'];?></td>
											<td><?php echo $row['EndRegis']?></td>
											<td>
												<?php if($rowavailable['AvailableSeats'] != NULL) echo $rowavailable['AvailableSeats'];
													else echo $row['Capacity'];
												?>/<?php echo $row['Capacity'];?></td>
										</tr>
									</table>
									
									<?php
									if($rowavailable['AvailableSeats'] == '0'){
										echo 'No available seats.';
									}
									else{
										if(isset($_SESSION['MemberID'])){
										?>
										<hr/>
										<?php	
											$query3 = "select * from RegistrationEvent where EventID = '$EventID' and MemberID = '$MemberID' ";
											$result3 = mysql_query($query3);
											if(mysql_num_rows($result3) > 0){
												$row3 = mysql_fetch_array($result3);

												if($row3['PaymentStatus'] == 'done'){
													echo 'You have registered this event. Your participant ID is '.$row3['ParticipantID'];
												
												}
												else if($row3['PaymentStatus'] == 'wait'){

													echo 'You have confirm payment. Please wait for confirmation.';
												}
												else{
													?>
													<div class="popup">
													<a href="popup/confirmPayment.php?EventID=<?php echo $EventID;?>&MemberID=<?php echo $MemberID;?>" class="confirmPayment">
													<input class="button" type="button"  eventid='<?php echo $row['EventID']?>' value="Confirm Payment"/>
													</a>
													</div>
													<?php

												} 

											}	
											else{
											?>
											<input class="button registerEvent" type="button" eventid='<?php echo $row['EventID']?>' value="Register"/>
											
										<?php
											}
										}
									}
									?>

								</div><br/>
							</div>
						</div>
						<div class="clear"></div>
						<br/><br/>
					</div>

			<?php		

				}


			?>

			
			<?php
				include("footer.php");
			?>
		</div>
	</body>
</html>