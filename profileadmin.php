<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<?php
	include("headeradmin.php");
	include("controller/connect.php");
	if(!isset($_SESSION['StaffID']))
		header("location:notfound.php");

	$StaffID = $_SESSION['StaffID'];
	/*$query = "select * from staff";

	$result = mysql_query($query);
	$row = mysql_fetch_array($result);*/

	$query2 = "select * from staff a join phonestaff b on a.staffid = b.staffid where a.StaffID= '$StaffID'";

	$result2 = mysql_query($query2);
	$row = mysql_fetch_array($result2);
?>

<html>

	<head>

		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="assets/library/jquery-2.1.1.js"></script>
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
		<script src="assets/library/jquery-ui.js"></script>
		<script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

		<script type="text/javascript">
		$(document).ready(function(){

			$(".editProfile").fancybox({
					maxWidth	: 800,
					maxHeight	: 450,
					fitToView	: false,
					width		: '70%',
					height		: '100%',
					autoSize	: false,
					closeClick	: false,
					type: 'iframe'
			});
		
			$(".changePassword").fancybox({
					maxWidth	: 800,
					maxHeight	: 450,
					fitToView	: false,
					width		: '70%',
					height		: '100%',
					autoSize	: false,
					closeClick	: false,
					type: 'iframe'
			});

		});
		</script>

	</head>

	<body>
			
			<div id="contentadmin">
				<div class="headercontentadmin">Profile</div>
				<div class="clear"></div>
				<div class="fieldcontentadmin">
					<div class="subheaderadmin">
						<div class="adminicon2">
                            <a href="popup/editProfileAdmin.php" class="editProfile">
								<img src="assets/images/editprofile.png"/>
								Edit Profile
							</a>
                        </div>
                        <div class="adminicon2">
                            <a href="popup/changePasswordAdmin.php" class="changePassword">
								<img src="assets/images/changepassword.png"/>
								Change Password
							</a>
                        </div>
						<hr/>
					</div>
					<form method="post" action="" id="formRegis">

						<br/>
						<div class="field">
							
							<img width="200px" height="200px" src="assets/images/photostaff/<?php echo $row['StaffPhoto']?>" />
							<div class="clear"></div>
							<br/>
						</div>

						<div class="field">
							<span>Name</span>
							<span class="textbox"><?php echo $row['StaffName'];?></span>
							<hr/>
						</div>
						<div class="field">
							<span>Address</span>
							<span class="textbox"><?php echo $row['StaffAddress'];?></span>
							<hr/>
						</div>
						<div class="field">
							<span>Email</span>
							<span class="textbox"><?php echo $row['StaffEmail'];?></span>
							<hr/>
						</div>
						<div class="field">
							<span>Phone</span>
							<span class="textbox">
								<?php
									$row2 = mysql_fetch_array($result2);
									echo $row2['PhoneNumber'];
									while ($row2 = mysql_fetch_array($result2)) {
										echo ', '.$row2['PhoneNumber'];
									}
								?>
							</span>
							<hr/>
						</div>
						<br/><br/><br/>
					</form>
				</div>
				</div>
			</div>
			
		</div>
	</body>
</html>