<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<script src="assets/library/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

		<script type="text/javascript">

	    $(document).ready(function(){

	        $(".forgotpass").fancybox({
	          maxWidth    : 800,
	          maxHeight   : 450,
	          fitToView   : false,
	          width       : '70%',
	          height      : '100%',
	          autoSize    : false,
	          closeClick  : false,
	          type        : 'iframe'
	        });

	    });


	    </script>
	</head>
	<body>
		<div id="container">
			<div id="headerbg">
				<div id="header">
					<img src="assets/images/Myhome.png"/>
				</div>
			</div>
			<div class="clear"></div>
			<br/><br/>
			<div id="content">
				<div class="form">
					<form method="post" action="controller/dologinadmin.php">
						<div class="field">
							<h2 align="center">Sign In Staff My Home Indonesia</h2>
							<hr/>
						</div>
						<br/>
						<div class="field">
							<span>Username</span>
							<span><input type="text" name="username" class="textbox"/></span>
						</div>
						<div class="field">
							<span>Password</span>
							<span><input type="password" name="password" class="textbox"/></span>
						</div>

						<br/><br/>
						<div class="field signin">
							<div class="submit"><input type="submit" value="Sign In" class="sizesubmit"/></div>
							<br/>
							 <div align="center" class="popup"><a class="forgotpass" href="popup/forgotPasswordadmin.php">Forgot Password?</a></div>
							<div style="color:#FF0000;margin-bottom: 10px" align="center" >
				              <?php 
				                  if(isset($_GET['error'])) echo $_GET['error'];
				                  else echo "&nbsp;";
				              ?>
				            </div>
						</div>
						<br/><br/><br/>
					</form>
					<br/>
				</div>
			</div>
			<?php 
				include("footer.php");
			?>
		</div>
	</body>
</html>