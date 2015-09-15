<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<?php
	include("header.php");
?>

<html>

	<head>

		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<script src="assets/library/jquery-2.1.1.js"></script>
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
		
		<script src="assets/library/jquery-ui.js"></script>
		<?php 
			include("controller/connect.php");
			$EventID = '';
			if(isset($_GET['EventID']))
				$EventID = $_GET['EventID'];

			$query = "select * from event where EventID = '$EventID'";
			$result = mysql_query($query);

			$row = mysql_fetch_array($result);

		?>

	</head>

	<body>
			
			
			<div id="content">
				<div class="form">
					<form method="post" action="" id="formRegis">
						<div class="field">
							<h2 align="center"><?php echo $row['EventTitle']?></h2>
							<hr/>
						</div>
						<div class="field">
							<div class="membericon">
								<a href="galleryevent.php?EventID=<?php echo $EventID?>" class="addEvent">
									<img src="assets/images/photogallery.png"/>
									Photo
								</a>
							</div>
							<div class="membericon">
								<a href="videogalleryevent.php?EventID=<?php echo $EventID?>" class="addEvent">
									<img src="assets/images/videogallery.png"/>
									Video
								</a>
							</div>
						</div>
						<br/>
						<div>
							<table width="700" align="center">
								<?php 
									$query='select * from galleryevent where Type ="video" ';
									$result = mysql_query($query);
									$i=0;
									while($row = mysql_fetch_array($result)){

										if($i%4== 0){
								?>
											<tr align="center">
								<?php			
										//$row['Source']
										}
								?>
												<td width="175" height="175">
													<iframe width="175" height="175" src="<?php echo $row['Source']?>" frameborder="0" allowfullscreen></iframe>
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


								<!-- <tr align="center">
									<td width="175" height="175">Video 1</td>
									<td width="175" height="175">Video 2</td>
									<td width="175" height="175">Video 3</td>
									<td width="175" height="175">Video 4</td>
								</tr>
								<tr align="center">
									<td width="175" height="175">Video 5</td>
									<td width="175" height="175">Video 6</td>
									<td width="175" height="175">Video 7</td>
									<td width="175" height="175">Video 8</td>
								</tr>
								<tr align="center">
									<td width="175" height="175">Video 9</td>
									<td width="175" height="175">Video 10</td>
									<td width="175" height="175">Video 11</td>
									<td width="175" height="175">Video 12</td>
								</tr> -->


							</table>
						</div>
						<br/><br/>
						<div class="font paging">
                        
                        <!--         <img src="assets/images/first.png"> <img src="assets/images/prev.png"> 1 2 3 4 5 <img src="assets/images/next.png"> <img src="assets/images/last.png">
                         -->
                        </div>
                        <br/><br/>
					</form>
				</div>
			</div>
			<?php 
				include("footer.php");
			?>
		</div>
	</body>
</html>