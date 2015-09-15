<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<script type="text/javascript" src="../assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="../assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />
		

		<script>

			$( document ).ready(function() {

				<?php 
		          if(isset($_GET['success'])){
			     ?>
			     	
			     	javascript:parent.$.fancybox.close();

			     	alert('Add Testimony Success. Thanks for your testimony.');
			     	
			     	javascript:parent.location.reload();
			     <?php    	
		          } 

			    if(isset($_GET['error'])){
			     	$error = $_GET['error'];
			     ?>
			     	
			     		

			     	alert('<?php echo $error;?>');
			     	
			     <?php    	
		          } 
			    ?>

			});




    	</script>
	</head>
	<body>
			
			<div id="popup">
				<div class="form">
					
						<form method="post" action="../controller/doAddTestimony.php">
							<div class="field">
								<h2 align="center">Send Testimony</h2>
								<hr/>
							</div>
							<br/>
							<div class="field">
								<span>Title</span>
								<span><input type="text" name="Title" class="textbox"/></span>
							</div>
							
							<div class="field">
								<span>Description</span>
								<span><textarea class="textarea" name="Description"></textarea></span>
							</div>
							<br/><br/>
							<div class="field">
								<div class="submit"><input type="submit" value="Send Testimony" class="button"/></div>
							</div>
							<br/><br/>
						</form>

						<br/><br/>
					
				</div>
			</div>
			
		</div>
	</body>
</html>