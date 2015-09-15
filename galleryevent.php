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

		<script type="text/javascript" src="assets/library/jquery.fancybox.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css?v=2.1.5" media="screen" />

		<script type="text/javascript">

			$(document).ready(function(){

				$(".fancybox").fancybox({
		            helpers: {
		                title : {
		                  	type : 'float'
		                }
		            },
		            height: 600
   		        });


			});

		</script>

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
									$dataPerPage = 1;
									$noPage = 1;

									if(isset($_REQUEST['page']))
										$noPage = $_REQUEST['page'];
									
									$offset = ($noPage-1) * $dataPerPage;

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
													<a class="fancybox" rel="gallery1" href="assets/images/photogallery/<?php echo $row['Source']?>">
														<img style="width:175px;height:175px;" src="assets/images/photogallery/<?php echo $row['Source']?>"/>
													</a>
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
							
							<!-- <img src="assets/images/first.png"> <img src="assets/images/prev.png"> 1 2 3 4 5 <img src="assets/images/next.png"> <img src="assets/images/last.png">
							 -->
							<?php 
										//untuk mengetahui jumlah data
									/*$query3 = "select count(*) as jmlhData from galleryevent where Type ='photo'";
									$result2 = mysql_query($query3);
									$data = mysql_fetch_array($result2);
									$jmlhData = $data['jmlhData'];

									//echo $query3;
									//echo $jmlhData;
									$prev = $noPage-1;

									$jmlhPage = ceil($jmlhData / $dataPerPage);
									//echo $jmlhPage;die;
									if($noPage > 1)	echo "<a href='{$_SERVER['PHP_SELF']}?page=1'> <img src='assets/images/first.png'> </a>"; 
		                            if($noPage > 1)	echo "<a href='{$_SERVER['PHP_SELF']}?page=$prev'> <img src='assets/images/prev.png'> </a>"; 
							

									for($page = 1 ; $page <= $jmlhPage; $page++){
									
										if($page == $noPage)	
											echo "<b>$page</b>";
										else echo "<a href='{$_SERVER['PHP_SELF']}?page=$page'> $page </a>";
									
									}	
									$next = $noPage+1;

									if($noPage < $jmlhPage)	echo "<a href='{$_SERVER['PHP_SELF']}?page=$next'> <img src='assets/images/next.png'> </a>"; 
		                            if($noPage < $jmlhPage)	echo "<a href='{$_SERVER['PHP_SELF']}?page=$jmlhPage'> <img src='assets/images/last.png'> </a>"; 
							*/
							?>
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