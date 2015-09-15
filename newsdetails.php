<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
	<head>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	    
	</head>
	<body>
		<div id="container">
			
			<?php
				include("header.php");

				include("controller/connect.php");
				if(isset($_GET['NewsID']))
					$NewsID = $_GET['NewsID'];

				$query = "select * from news where NewsID = '$NewsID' ";

				$result = mysql_query($query);
				//$i=0;

				//if(mysql_num_rows($result) > 0){
					$row = mysql_fetch_array($result);

			?>

			<div id="content">
				<div class="form">
					<div class="field">
						<h2 align="center">News Details</h2>
						<hr/>
					</div>
					<div class="field">
						<div><b><?php echo $row['Title'];?></b></div><br/>
						<div><img style="width:700px;height:500px" src="assets/images/photonews/<?php echo $row['Photo']?>" class="newspicture"/></div>
						<div class="clear"></div>
						<br/>
						<div style="" class="colortableheader">News Description</div>
						<div class="descdetails"><?php echo $row['Description'];?></div><br/>
						
					</div>
				</div>
				<div class="clear"></div>
				<br/><br/>
			</div>

			<?php
				//}
				include("footer.php");
			?>
		</div>
	</body>
</html>