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

			     	alert('Send Prayer Request Success.');
			     	
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
					
						<form method="post" action="../controller/doprayerrequest.php">
							<div class="field">
								<h2 align="center">Send Prayer Request</h2>
								<hr/>
							</div>
							<br/>
							
							<div class="field">
							<span>Prayer Request</span>
							<span><textarea class="textarea" name="prequest"></textarea></span>
							</div>

							<br/><br/>
							<div class="field">
								<div class="submit"><input type="submit" value="Send Prayer Request" class="button"/></div>
							</div>
							<br/><br/>
						</form>

						<br/><br/>
					
				</div>
			</div>
			
		</div>
	</body>
</html>