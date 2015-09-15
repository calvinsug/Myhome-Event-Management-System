<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
   
    <script type="text/javascript">

  


    </script>

	</head>
	<body>
		<div id="container">
			
			<div id="content">
				<div class="form">
					<form method="post" action="controller/dologin.php">
						<div class="field">
							<h2 align="center">Forgot Password</h2>
							<hr/>
						</div>
						<br/>
						<div class="field">
							<span>Username</span>
							<span><input type="text" name="username" class="textbox"/></span>
						</div>

            <div class="field signin">
              <div class="submit"><input type="button" value="Next" class="button"/></div>
             
            </div>


            <div class="field">
              <span>Security Question</span>
              <span><input type="text" name="securityquestion" readonly class="textbox"/></span>
            </div>

            <div class="field">
              <span>Answer</span>
              <span><input type="text" name="answer" class="textbox"/></span>
            </div>

						<div class="field">
							<span>New Password</span>
							<span><input type="password" name="password" class="textbox"/></span>
						</div>
            <div class="field">
              <span>Confirm Password</span>
              <span><input type="password" name="password" class="textbox"/></span>
            </div>
						<br/><br/>
						
            <div class="field signin">
							<div class="submit"><input type="submit" value="Change Password" class="button"/></div>
             
						</div>

            <div style="color:#FF0000;margin-bottom: 10px" align="center" >
              <?php 
                  if(isset($_GET['error'])) echo $_GET['error'];
                  else echo "&nbsp;";
              ?>
            </div>


						<br/><br/>
					</form>
					<br/>
				</div>
			</div>


<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->
			

		</div>
	</body>
</html>