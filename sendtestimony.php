<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="container">
			<div id="container">
			<div id="headerbg">
				<div id="header">
					<img src="<?php echo base_url().'assets/images/Myhome.png'?>"/>
					<div class="menuheader">
						<span class="submenuheader">
							<span><img src="<?php echo base_url().'assets/images/englishflag.jpg'?>"/></span>
							<span>ENG</span>
						</span>
						<span class="submenuheader">
							<span><img src="<?php echo base_url().'assets/images/indonesiaflag.jpg'?>"/></span>
							<span>IND</span>
						</span>
						<span class="submenuheader">
							<span><a href="<?php echo base_url()."controller1/login"; ?> ">Welcome Member</a></span>
						</span>
						<span class="submenuheader">|</span>
						<span class="submenuheader">
							<span><a href="<?php echo base_url()."controller1/register"; ?> ">Logout</a></span>
						</span>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="menubar">
				<ul>
					<li><a href="<?php echo base_url()."controller1/index"; ?>" class="menulink">Home</a></li>
					<li><a href="#">Adopt Street</a></li>
					<li><a href="#">Event</a></li>
					<li><a href="#">News</a></li>
					<li><a href="#">Prayer Request</a></li>
					<li><a href="#">Testimony</a></li>
					<li><a href="<?php echo base_url()."controller1/about"; ?>">About Us</a></li>
					<li><a href="<?php echo base_url()."controller1/contact"; ?>">Contact Us</a></li>
				</ul>
				<div class="search">
					<input type="text" name="search"/>
					<input type="submit" value="Search"/>
				</div>
			</div>
			<div class="clear"></div>
			<br/><br/>
			<div id="content">
				<div class="form">
					<form method="post" action="">
						<div class="field">
							<h2 align="center">Send Testimony</h2>
							<hr/>
						</div>
						<br/>
						<div class="field">
							<span>Title</span>
							<span><input type="text" name="fullname" class="textbox"/></span>
						</div>
						<div class="field">
							<span>Testimony Description</span>
							<span><textarea class="textarea"></textarea></span>
						</div>
						<br/><br/>
						<div class="field">
							<div class="submit"><input type="submit" value="Send" class="sizesubmit"/></div>
						</div>
						<br/><br/>
					</form>

				</div>
			</div>
			<div id="footer">
				<div class="widget">
					<img src="<?php echo base_url().'assets/images/facebook.png'?>"/>
					<img src="<?php echo base_url().'assets/images/twitter.png'?>"/>
				</div>
				<div>&copy; 2014 MyHomeIndonesia Rights Reserved</div>
			</div>
		</div>
	</body>
</html>