<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
   		
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	  	<script src="../assets/library/jquery-2.1.1.js"></script>
    <script type="text/javascript">

  	$(document).ready(function(){

  		$('.question').hide();

  		$('.btnSubmit').click(function(){

  			$.ajax({
  				url: "../controller/doResetPassword.php",
				type: "POST",
				dataType: "json",
				//contentType: "application/json; charset=utf-8",
				data : {
					'MemberID' : $('input[name="MemberID"]').val(),
					'answer' : $('input[name="answer"]').val(),
					'password' : $('input[name="password"]').val(),
					'confirmpassword' : $('input[name="confirmpassword"]').val(),						
				},
				success : function(data){

					if(data.status == '1'){

						alert('Reset Password Success.');
						javascript:parent.$.fancybox.close();
					}
					else{
						alert(data.error);
					}

				}

  			});
  			//$('#formReset').submit();


  		});

  		$('.btnNext').click(function(){


  			$.ajax({
				url: "../controller/getuser.php",
				type: "POST",
				dataType: "json",
				//contentType: "application/json; charset=utf-8",
				data : {
					'username' : $('input[name="username"]').val()										
				},
				success: function(data){
					if(data == '0'){
						
						
						alert('wrong username');
						//$.fancybox.close();
					}
					else{
						$('.user').slideUp(function(){


							if(data.SecurityQuestion == 'color')
								$('input[name="securityquestion"]').val('What is your favorite color?');
							else if(data.SecurityQuestion == 'book')
								$('input[name="securityquestion"]').val('What is your favorite book?');
							else if(data.SecurityQuestion == 'pet')
								$('input[name="securityquestion"]').val('What is your pet’s name?');
							else if(data.SecurityQuestion == 'nickname')
								$('input[name="securityquestion"]').val('What was your childhood nickname?');
							else if(data.SecurityQuestion == 'singer')
								$('input[name="securityquestion"]').val('Who was your favorite singer or band in high school?');


							$('input[name="MemberID"]').val(data.MemberID);

			  				$('.question').slideDown();

			  			});
					}
					
				}
			});


  			

  		});

  		




  	});


    </script>

	</head>
	<body>
		<div id="container">
			
			<div id="">
				<div class="form">
					<form id="formReset" method="post" action="controller/doResetPassword.php">
						<div class="field">
							<h2 align="center">Forgot Password</h2>
							<hr/>
						</div>
						<br/>
			

			<div class="user">
				<div class="field">
					<span>Username</span>
					<span><input type="text" name="username" class="textbox"/></span>
				</div>

	            <div class="field signin">
	              <div class="submit"><input type="button" value="Next" class="button btnNext"/></div>
	             
	            </div>
	        </div>    

            <div class="question">
	            <div class="field">
	              <span>Security Question</span>
	              <span><input type="text" name="securityquestion" readonly class="textbox"/></span>
	            </div>

	            <div style="display:none" class="field">
	              <span>Member ID</span>
	              <span><input type="text" name="MemberID" readonly class="textbox"/></span>
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
	              <span><input type="password" name="confirmpassword" class="textbox"/></span>
	            </div>
							<br/><br/>
							
	            <div class="field signin">
								<div class="submit"><input type="button" value="Change Password" class="button btnSubmit"/></div>
	             
							</div>

	            
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