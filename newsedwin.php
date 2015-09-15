<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	    <script src="assets/library/filejavascript.js"></script>
	</head>
	<body onload="initialize(-6.875046,107.614174)">
		<div id="container">
			
		<?php
			include('header.php');
		?>

			<div id="content">
				<div class="form">
					<div class="field">
						<h2 align="center">News</h2>
						<hr/>
					</div>
					<div align="center">
						<table class="tablemember">

							<?php 
								include("controller/connect.php");

								$query = "select * from news";

								$result = mysql_query($query);
								//$i=0;
								while($row=mysql_fetch_array($result)){
									//if($i % 2 ==0){


							?>
							<tr>
								<td colspan="2"><b><?php echo $row['Title'];?></b></td>
							</tr>

							<tr class="colortablecontent">
								<td><img style="width:200px;height:144px" src="assets/images/photonews/<?php echo $row['Photo']?>" class="newspicture"/></td>
								
								<td>
									<table>
										<tr>
											<td class="newstext2"><?php echo $row['Description']?></td>
										</tr>
									<tr>
										<td>
											<div class="popup"><a href="newsdetails.php">Continue reading</a></div>
										</td>
									</tr>
									</table>
								</td>
							</tr>

							<?php
								}
							?>

						</table>
						<br/><br/>
					</div>
				</div>
				<div class="clear"></div>
				<br/><br/>
			</div>
			<?php
				include("footer.php");
			?>
		</div>
	</body>
</html>