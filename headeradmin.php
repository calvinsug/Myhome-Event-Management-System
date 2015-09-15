<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<?php 
	/*if(isset($_SESSION['StaffID'])){
		$StaffName = $_SESSION['StaffName'];
	}
	else{
		header("loginadmin.php?error=you must login first");
	}*/
	session_start();
	
	if(isset($_SESSION['StaffUsername'])){
		
		$StaffName = $_SESSION['StaffName'];
		$StaffRole = $_SESSION['StaffRole'];
	}
	else {

		header("location:notfound.php");
	}
	

?>



	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<div id="headerbgadmin">
				<div id="headeradmin">
					<a href="homeadmin.php"><img src="assets/images/Logoadmin.png"/></a>
					<div class="menuheader">
						<span class="submenuheaderadmin">

							<span>Welcome, <?php echo $StaffName;?></span>
						</span>
						<a href="controller/dologoutadmin.php">
							<span class="submenuheaderadmin">
								<span><img src="assets/images/logout.png"/></span>
								<span>Logout</span>
							</span>
						</a>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<br/><br/>
			<div class="menubaradmin">
				<ul>


					<li><a href="homeadmin.php"><div class="imgmenubaradmin"><img src="assets/images/dashboard.png"/></div>Dashboard</a></li>
					<li><a href="profileadmin.php"><div class="imgmenubaradmin"><img src="assets/images/profile.png"/></div>Profile</a></li>
					
					<?php
						if($StaffRole == 'PrayerOrganizer'){
							echo '<li><a href="memberadmin.php"><div class="imgmenubaradmin"><img src="assets/images/member.png"/></div>Member</a></li>';							
							echo '<li><a href="prayerrequestadmin.php"><div class="imgmenubaradmin"><img src="assets/images/prayerrequest.png"/></div>Prayer Request</a></li>';	
						}
						else if($StaffRole == 'President'){

							echo '<li><a href="staffadmin.php"><div class="imgmenubaradmin"><img src="assets/images/staff.png"/></div>Staff</a></li>
								<li><a href="memberadmin.php"><div class="imgmenubaradmin"><img src="assets/images/member.png"/></div>Member</a></li>
								<li><a href="branchadmin.php"><div class="imgmenubaradmin"><img src="assets/images/branch.png"/></div>Branch</a></li>
								<li><a href="eventadmin.php"><div class="imgmenubaradmin"><img src="assets/images/event.png"/></div>Event</a></li>
								<li><a href="newsadmin.php"><div class="imgmenubaradmin"><img src="assets/images/news.png"/></div>News</a></li>
								<li><a href="prayerrequestadmin.php"><div class="imgmenubaradmin"><img src="assets/images/prayerrequest.png"/></div>Prayer Request</a></li>
								<li><a href="testimonyadmin.php"><div class="imgmenubaradmin"><img src="assets/images/testimony.png"/></div>Testimony</a></li>';

						}
						else if($StaffRole == 'NewsOrganizer'){

							echo '<li><a href="newsadmin.php"><div class="imgmenubaradmin"><img src="assets/images/news.png"/></div>News</a></li>';
						}
						else if($StaffRole == 'EventOrganizer'){

							echo '<li><a href="memberadmin.php"><div class="imgmenubaradmin"><img src="assets/images/member.png"/></div>Member</a></li>
								<li><a href="eventadmin.php"><div class="imgmenubaradmin"><img src="assets/images/event.png"/></div>Event</a></li>';
						}
						else if($StaffRole == 'BranchOrganizer'){
							echo '<li><a href="memberadmin.php"><div class="imgmenubaradmin"><img src="assets/images/member.png"/></div>Member</a></li>
								  <li><a href="branchadmin.php"><div class="imgmenubaradmin"><img src="assets/images/branch.png"/></div>Branch</a></li>';

						}
					?>

					<!--
					<li><a href="staffadmin.php"><div class="imgmenubaradmin"><img src="assets/images/staff.png"/></div>Staff</a></li>
					<li><a href="memberadmin.php"><div class="imgmenubaradmin"><img src="assets/images/member.png"/></div>Member</a></li>
					<li><a href="branchadmin.php"><div class="imgmenubaradmin"><img src="assets/images/branch.png"/></div>Branch</a></li>
					<li><a href="eventadmin.php"><div class="imgmenubaradmin"><img src="assets/images/event.png"/></div>Event</a></li>
					<li><a href="newsadmin.php"><div class="imgmenubaradmin"><img src="assets/images/news.png"/></div>News</a></li>
					<li><a href="prayerrequestadmin.php"><div class="imgmenubaradmin"><img src="assets/images/prayerrequest.png"/></div>Prayer Request</a></li>	
					<li><a href="testimonyadmin.php"><div class="imgmenubaradmin"><img src="assets/images/testimony.png"/></div>Testimony</a></li>
					-->

				</ul>
			</div>
			<div class="clear"></div>
	</body>
</html>