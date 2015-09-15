<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		
		<script src="../assets/library/jquery-2.1.1.js"></script>
	

		<script>

			$( document ).ready(function() {

				<?php 
					

		          if(isset($_GET['success'])){
			     ?>
			     	
			     	javascript:parent.$.fancybox.close();

			     	alert('Update Testimony Success.');
			     	
			     	javascript:parent.location.reload();
			     <?php    	
		          } 

			    if(isset($_GET['error'])){
			     	$error = $_GET['error'];
			     ?>
		
			     	alert('<?php echo $error;?>');
			     	
			     <?php    	
		          }	
		          	if(isset($_GET['id']))
			         	$id= $_GET['id'];
			        else $id='';
					
					if(isset($_GET['Title']))
						$Title = $_GET['Title'];
					else $Title = '';
					
					if(isset($_GET['Description']))
						$Description = $_GET['Description']; 
					else $Description = '';
			    ?>
			    $('input[name="Title"]').val('<?php echo $Title;?>');
			    $('.textarea').val('<?php echo $Description;?>');

			});




    	</script>
	</head>
	<body>
			
			<div id="popup">
				<div class="form">
					
						<form method="post" action="../controller/doUpdateTestimony.php">
							<div class="field">
								<h2 align="center">Update Testimony</h2>
								<hr/>
							</div>
							<br/>

							<input type="text" name="TestimonyID" value="<?php echo $id;?>" style="display:none">

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
								<div class="submit"><input type="submit" value="Update Testimony" class="sizesubmit"/></div>
							</div>


							<br/><br/>
						</form>

						<br/><br/>
					
				</div>
			</div>
			
		</div>
	</body>
</html>