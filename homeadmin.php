<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<script src="assets/library/jquery-2.1.1.js"></script>
<script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

<script>
$( document ).ready(function() {
		

		$(".addBranch").fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,			
		});

		$(".addNews").fancybox({
				maxWidth	: 800,
				maxHeight	: 450,
				fitToView	: false,
				width		: '70%',
				height		: '100%',
				autoSize	: false,
				closeClick	: false,
				type: 'iframe',
		});

		$(".addEvent").fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			type 		: 'iframe'
		});

		$(".addLocation").fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			type 		: 'iframe'
		});

		$(".addDivision").fancybox({
			maxWidth	: 800,
			maxHeight	: 450,
			fitToView	: false,
			width		: '70%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			type 		: 'iframe'
		});

});


</script>

<html>
	
	<body>
		<div id="container">
			<?php include("headeradmin.php"); ?>
			<div id="contentadmin">
				<div class="headercontentadmin">Dashboard</div>
				<div class="clear"></div>
				
				<?php if($StaffRole != "President" && $StaffRole != "PrayerOrganizer"){ ?>
				<div class="fieldcontentadmin">


					<div class="subheaderadmin">
						<h2>Quick Links</h2>
						<hr/>
					</div>
					<div>
					
					<?php if($StaffRole =='EventOrganizer'  ){ ?>
						<div class="quicklinksadmin">
							<a href="popup/addEvent.php" class="addEvent">
								<img src="assets/images/neweventicon.png"/>
								Create Event
							</a>
						</div>
					<?php } ?>	


					<?php if($StaffRole =='NewsOrganizer'  ){ ?>
						<div class="quicklinksadmin">
							<a href="popup/addNews.php" class="addNews">
								<img src="assets/images/createnewsicon.png"/>
								Create News
							</a>
						</div>
					<?php } ?>
					
					<?php if($StaffRole =='BranchOrganizer'  ){ ?>	
						<div class="quicklinksadmin">
							<a href="popup/addBranch.html" data-fancybox-type="iframe" class="addBranch">
								<img src="assets/images/newbranchicon.png"/>
								Create Branch
							</a>
						</div>
					<?php } ?>	
						<!-- <div class="quicklinksadmin">
							<a href="confirmpaymentadmin.php">
								<img src="assets/images/confirmationpaymenticon.png"/>
								Confirmation<br/>Payment
							</a>
						</div> -->

					<?php if($StaffRole =='EventOrganizer'  ){ ?>
						<div class="quicklinksadmin">
							<a href="popup/addLocation.php" class="addLocation">
								<img src="assets/images/createlocationicon.png"/>
								Create Location
							</a>
						</div>
						<div class="quicklinksadmin">
							<a href="popup/addDivision.php" class="addDivision">
								<img src="assets/images/createdivisionicon.png"/>
								Create Division
							</a>
						</div>
					<?php }?>	

					</div>
				</div>
				<?php } ?>


				<div class="clear"></div>
				<br/>
				<div class="fieldcontentadmin">
					<div class="subheaderadmin">
						<h2>Information</h2>
						<hr/>
					</div>
					<div>
						<table class="tableadmin">
							<tr class="colortableheader">
								<td colspan="2">Data Activity MyHome Indonesia</td>
							</tr>

							<?php 
								include('controller/connect.php');
								$query1 = "select count(StaffID) as TotalStaff from staff";
								$query2 = "select count(MemberID) as TotalMember from member";
								$query3 = "select count(eventid) as FreeEvent from event where paymenttype='free'";
								$query4 = "select count(eventid) as PaidEvent from event where paymenttype='paid'";
								$query5 = "select count(eventid) as RegistrationEvent from registrationevent where paymentStatus = 'done'";
								$query6 = "select count(NewsID) as TotalNews from news";
								$query7 = "select count(RequestID) as TotalRequest from prayerrequest";
								$query8 = "select count(TestimonyID) as TotalTestimony from testimony";

								$result1 = mysql_query($query1);
								$result2 = mysql_query($query2);
								$result3 = mysql_query($query3);
								$result4 = mysql_query($query4);
								$result5 = mysql_query($query5);
								$result6 = mysql_query($query6);
								$result7 = mysql_query($query7);
								$result8 = mysql_query($query8);

								$row1=mysql_fetch_array($result1);
								$row2=mysql_fetch_array($result2);
								$row3=mysql_fetch_array($result3);
								$row4=mysql_fetch_array($result4);
								$row5=mysql_fetch_array($result5);
								$row6=mysql_fetch_array($result6);
								$row7=mysql_fetch_array($result7);
								$row8=mysql_fetch_array($result8);
							?>

							<tr>
								<td>Total Staff</td>
								<td align="center"><?php echo $row1[0];?></td>
							</tr>
							<tr class="colortablecontent">
								<td>Total Member</td>
								<td align="center"><?php echo $row2[0];?></td>
							</tr>
							<tr>
								<td>Total Event Free</td>
								<td align="center"><?php echo $row3[0];?></td>
							</tr>
							<tr class="colortablecontent">
								<td>Total Event Paid</td>
								<td align="center"><?php echo $row4[0];?></td>
							</tr>
							<tr>
								<td>Total Registration Event</td>
								<td align="center"><?php echo $row5[0];?></td>
							</tr>
							<tr class="colortablecontent">
								<td>Total News</td>
								<td align="center"><?php echo $row6[0];?></td>
							</tr>
							<tr>
								<td>Total Prayer Request</td>
								<td align="center"><?php echo $row7[0];?></td>
							</tr>
							<tr class="colortablecontent">
								<td>Total Testimony</td>
								<td align="center"><?php echo $row8[0];?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</body>
</html>