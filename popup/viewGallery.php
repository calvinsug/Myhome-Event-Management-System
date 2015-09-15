<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 


<html>

	<head>

		<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="../assets/library/jquery-2.1.1.js"></script>
		<link rel="stylesheet" href="../assets/css/jquery-ui.css">
		
		<script src="../assets/library/jquery-ui.js"></script>


		<?php 
			include("../controller/connect.php");
			$EventID = '';
			
			session_start();

			if(isset($_GET['EventID']))
				$EventID = $_GET['EventID'];

			if(isset($_SESSION['StaffRole']))
				$StaffRole = $_SESSION['StaffRole'];

			$query = "select * from event where EventID = '$EventID'";
			$result = mysql_query($query);

			$row = mysql_fetch_array($result);

		?>

		<script>

			$( document ).ready(function() {
				<?php 
		          if(isset($_GET['success'])){
			     ?>
			     	
			     	//javascript:parent.$.fancybox.close();

			     	alert('Delete Photo Success');
			     	
			     	//location.reload();
			     <?php    	
		          } 
			    ?>

			    $('.delete').click(function(e){

			    	var answer = confirm ("Are you sure to delete this Photo?");

					if (!answer){
			    		e.preventDefault();
			    	}

			    });

			});


    	</script>
		
	</head>

	<body>
			
			
			<div>
				<div class="form">
					<form method="post" action="" id="formRegis">
						<div class="field">
							<h2 align="center"><?php echo $row['EventTitle']?></h2>
							<hr/>
						</div>
						<div class="field">
							<div class="membericon">
								<a href="viewGallery.php?EventID=<?php echo $EventID?>" class="addEvent">
									<img src="../assets/images/photogallery.png"/>
									Photo
								</a>
							</div>
							<div class="membericon">
								<a href="viewVideo.php?EventID=<?php echo $EventID?>" class="addEvent">
									<img src="../assets/images/videogallery.png"/>
									Video
								</a>
							</div>
						</div>
						<br/>
						<div class="popup">
							<table width="700" align="center">
								<?php 
									$query="select * from galleryevent where Type ='photo' and EventID = '$EventID' ";
									//echo $query;die;
									$result = mysql_query($query);
									$i=0;
									while($row = mysql_fetch_array($result)){
										//echo $i .' modulus 4 = '.($i%4); 
										if($i%4== 0){
								?>
											<tr align="center">
								<?php			
										//$row['Source']
										}
								?>
												<td>
													<img style="width:175px;height:175px;" src="../assets/images/photogallery/<?php echo $row['Source']?>"/>
													<br/>
													<?php if($StaffRole != "President"){ ?>
													<a href="../controller/doDeleteGallery.php?type=photo&id=<?php echo $row['GalleryID'];?>&EventID=<?php echo $EventID;?>" class="delete">
														<input type="button" value="Delete">
													</a>
													<?php }?>
												</td>
								<?php		
										if($i%4== 3){
								?>
											</tr>
								<?php			
										}

										$i++;
									}
								?>

								<!-- 
								<tr align="center">
									<td width="175" height="175">Photo 1</td>
									<td width="175" height="175">Photo 2</td>
									<td width="175" height="175">Photo 3</td>
									<td width="175" height="175">Photo 4</td>
								</tr>

								<tr align="center">
									<td width="175" height="175">Photo 5</td>
									<td width="175" height="175">Photo 6</td>
									<td width="175" height="175">Photo 7</td>
									<td width="175" height="175">Photo 8</td>
								</tr>
								<tr align="center">
									<td width="175" height="175">Photo 9</td>
									<td width="175" height="175">Photo 10</td>
									<td width="175" height="175">Photo 11</td>
									<td width="175" height="175">Photo 12</td>
								</tr> -->
							</table>
						</div>
						<br/><br/>
						<div class="font paging">
                                <img src="../assets/images/first.png"> <img src="../assets/images/prev.png"> 1 2 3 4 5 <img src="../assets/images/next.png"> <img src="../assets/images/last.png">
                        </div>
                        <br/><br/>
					</form>
				</div>
			</div>
		
		</div>
	</body>
</html>