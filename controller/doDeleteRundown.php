<?php 
	include("connect.php");
	$EventID = $_GET['EventID'];
	$LocationID = $_GET['LocationID'];
	$EventTitle = $_GET['EventTitle'];
	$RundownID = $_GET['RundownID'];

	$query = "delete FROM rundownevent where RundownID='$RundownID'";

	//echo $query;die;

	mysql_query($query);

	mysql_close($con);

	header("location:../popup/viewRundown.php?success=1&EventID=$EventID&EventTitle=$EventTitle");
	
?>